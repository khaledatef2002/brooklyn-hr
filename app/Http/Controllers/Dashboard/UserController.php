<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\SendNewAccountInfoMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware()
    {
        return [
            new Middleware('role:manager')
        ];
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $users = User::query();
            return DataTables::of($users)
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>
                    <a href='" . route('dashboard.users.edit', $row) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>
                    <form data-id='".$row['id']."' onsubmit='remove_user(event)'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='_token' value='" . csrf_token() . "'>
                        <button class='remove_button' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                    </form>
                </div>";
            })
            ->editColumn('user', function(User $user){
                return "
                    <div class='d-flex align-items-center gap-2'>
                        <div class='rounded-4 overflow-hidden d-flex justify-content-center align-items-cneter' style='width: 30px; height: 30px;'>
                            <img src='". $user->display_image ."' style='min-width: 100%; min-height:100%'>  
                        </div>
                        <span>{$user->full_name} ". (Auth::id() == $user->id ? '('. __('dashboard.you') .')' : '') ."</span>
                    </div>
                ";
            })
            ->editColumn('phone_number', function(User $user){
                return $user->phone_number;
            })
            ->editColumn('role', function(User $user){
                return'<span class="badge bg-primary">'. $user->getRoleNames()[0] .'</span>';
            })
            ->rawColumns(['user', 'role', 'action'])
            ->make(true);
        }
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'min:8', Rules\Password::defaults()],
            'date_of_birth' => 'required|date',
            'country_code' => 'required|string|size:2',
            'phone_number' => ['required', 'numeric', 'unique:users,phone_number', 'phone:' . $request->input('country_code')],
            'role' => 'required|string|exists:roles,id'
        ]);

        if($request->hasFile('image'))
        {
            $randomName = now()->format('YmdHis') . '_' . Str::random(10) . '.webp';
            $path = public_path('storage/users/' . $randomName);
            $manager = new ImageManager(new Driver());
            $manager->read($request->file('image'))
            ->scale(height: 300)
            ->encode(new AutoEncoder('webp', 80))
            ->save($path);    

            $data['image'] = 'users/' . $randomName;
        }

        $role = Role::findById($request->role);
        $user = User::create($data);
        $user->assignRole($role);

        return response()->json(['message' => __('dashboard.user_created')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:8', Rules\Password::defaults()],
            'date_of_birth' => 'required|date',
            'country_code' => 'required|string|size:2',
            'phone_number' => ['required', 'numeric', 'unique:users,phone_number,' . $user->id, 'phone:' . $request->input('country_code')],
            'role' => 'required|string|exists:roles,id'
        ]);

        if($request->hasFile('image'))
        {
            if($user->image)
            {
                unlink(public_path('storage/' . $user->image));
            }

            $randomName = now()->format('YmdHis') . '_' . Str::random(10) . '.webp';
            $path = public_path('storage/users/' . $randomName);
            $manager = new ImageManager(new Driver());
            $manager->read($request->file('image'))
            ->scale(height: 300)
            ->encode(new AutoEncoder('webp', 80))
            ->save($path);    

            $data['image'] = 'users/' . $randomName;
        }

        $role = Role::findById($request->role);
        $user->update(empty($data['password']) ? collect($data)->except('password')->toArray() : $data);
        $user->syncRoles([$role]);

        return response()->json(['message' => __('dashboard.user_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => __('dashboard.user_deleted')]);
    }
}
