<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class SystemSettingsController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('role:manager')
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        return view('dashboard.system-settings.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_internship_form_avilable' => ['nullable', 'in:on,off']
        ]);

        $data['is_internship_form_avilable'] = $data['is_internship_form_avilable'] ?? null == 'on' ? true : false;
        
        $settings = SystemSetting::all()->first();

        if ($request->hasFile('logo')) {
            if ($settings->logo && file_exists(public_path('storage/' . $settings->logo))) {
                unlink(public_path('storage/' . $settings->logo));
            }
        
            $randomName = now()->format('YmdHis') . '_' . Str::random(10) . '.webp';
            $directory = public_path('storage/website-logo/');
            
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
        
            $path = $directory . $randomName;
            $manager = new ImageManager(new Driver());
            $manager->read($request->file('logo'))
                ->scale(height: 400)
                ->encode(new AutoEncoder('webp', 80))
                ->save($path);
        
            $data['logo'] = 'website-logo/' . $randomName;
        }

        $settings->update($data);


        return response()->json(['message' => __('dashboard.system_settings_saved')]);
    }
}
