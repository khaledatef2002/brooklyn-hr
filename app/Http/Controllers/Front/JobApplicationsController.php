<?php

namespace App\Http\Controllers\Front;

use App\Enum\JobApplicationStatus;
use App\Enum\StartingPeriodOptions;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class JobApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.job-application');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],

            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'phone_number' => 'required|string|regex:/^01\d{9}$/',
            'nationality' => 'required|string',
            'address' => 'required|string',

            'education' => 'required|array',
            'education.*.name' => 'required|string',
            'education.*.qualifications' => 'required|string',
            'education.*.date_of_completion' => 'nullable|date_format:Y',

            'english_spoken' => 'required|string',
            'english_written' => 'required|string',
            'english_reading' => 'required|string',
            'english_comprehension' => 'required|string',
    
            'arabic_spoken' => 'required|string',
            'arabic_written' => 'required|string',
            'arabic_reading' => 'required|string',
            'arabic_comprehension' => 'required|string',

            'work_experience' => 'nullable|array',
            'work_experience.*.company_name' => 'required|string',
            'work_experience.*.position' => 'required|string',
            'work_experience.*.monthly_salary' => 'required|string',
            'work_experience.*.working_duration' => 'required|string',
            'work_experience.*.reason_for_leaving' => 'required|string',

            'military_service' => 'required|string',
            'religion' => 'required|string',
            'social_status' => 'required|string',
            'no_of_childs' => 'nullable|integer|min:0',
            'position' => 'required|string',
            'expected_salary' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/',

            'do_you_have_health_certificate' => 'required|boolean',
            'health_certificate_date' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->do_you_have_health_certificate) {
                    if (!$value) {
                        $fail(__('The health certificate date is required when you have a health certificate.'));
                    } elseif (!\DateTime::createFromFormat('d/m/Y', $value)) {
                        $fail(__('The health certificate date must be in the format d/m/Y.'));
                    }
                }
            }],

            'ready_to_start' => 'required|boolean',
            'starting_duration' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->ready_to_start) {
                    if (!$value) {
                        $fail(__('Starting Duration is required when you are not ready to start immediately.'));
                    } elseif (!in_array($value, StartingPeriodOptions::getValues())) {
                        $fail(__('Wrong value for starting duration'));
                    }
                }
            }],

            'work_in_any_place' => 'required|boolean',
            
            'any_health_problems' => 'required|boolean',
            'health_problem' => ['sometimes', function ($attribute, $value, $fail) use ($request) {
                if ($request->any_health_problems) {
                    if (!$value) {
                        $fail(__('You should mention the health problems you have.'));
                    }
                }
            }],
            
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',        
        ]);

        $data['expected_salary'] = str_replace(',', '', $data['expected_salary']);
        $data['date_of_birth'] = Carbon::createFromFormat("d/m/Y", $data['date_of_birth'])->format("Y-m-d");
        
        if($request->do_you_have_health_certificate)
        {
            $data['health_certificate_date'] = Carbon::createFromFormat("d/m/Y", $data['health_certificate_date'])->format("Y-m-d");
        }

        if($request->hasFile('cv'))
        {
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        if($request->hasFile('image'))
        {
            $randomName = now()->format('YmdHis') . '_' . Str::random(10) . '.webp';
            $path = public_path('storage/employees_images/' . $randomName);
            $manager = new ImageManager(new Driver());
            $manager->read($request->file('image'))
            ->scale(height: 300)
            ->encode(new AutoEncoder('webp', 80))
            ->save($path);    

            $data['image'] = 'employees_images/' . $randomName;
        }
        
        $application = JobApplication::create([
            ...$data,
            'status' => JobApplicationStatus::PENDING->value,
        ]);

        foreach ($request->education as $edu) {
            $application->educations()->create([
                'name' => $edu['name'],
                'qualifications' => $edu['qualifications'],
                'date_of_completion' => $edu['date_of_completion'],
            ]);
        }
    
        if ($request->has('work_experience')) {
            foreach ($request->work_experience as $exp) {
                $exp['joining_date'] = Carbon::createFromFormat("d/m/Y", $exp['joining_date'])->format("Y-m-d");
                
                $application->workExperiences()->create([
                    'company_name' => $exp['company_name'],
                    'position' => $exp['position'],
                    'job_type' => $exp['job_type'],
                    'monthly_salary' => $exp['monthly_salary'],
                    'reason_for_leaving' => $exp['reason_for_leaving'],
                ]);
            }
        }

        return response()->json(['message' => __('dashboard.job_application_sent')]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
