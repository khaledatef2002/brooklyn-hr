<?php

namespace App\Http\Controllers\Front;

use App\Enum\JobApplicationStatus;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'do_you_have_health_certificate' => 'required|boolean',
            'phone_number' => 'required|string|max:20',
            'military_service' => 'required|string',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string',
            'religion' => 'required|string',
            'social_status' => 'required|string',
            'no_of_childs' => 'required|integer|min:0',
            'position' => 'required|string',
            'ready_to_start' => 'required|boolean',
            'any_crime' => 'required|boolean',
            'expected_salary' => 'required|numeric',
            'work_in_any_place' => 'required|boolean',
            'any_health_problems' => 'required|boolean',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    
            'english_spoken' => 'required|string',
            'english_written' => 'required|string',
            'english_reading' => 'required|string',
            'english_comprehension' => 'required|string',
    
            'arabic_spoken' => 'required|string',
            'arabic_written' => 'required|string',
            'arabic_reading' => 'required|string',
            'arabic_comprehension' => 'required|string',
    
            'education' => 'required|array',
            'education.*.name' => 'required|string',
            'education.*.qualifications' => 'required|string',
            'education.*.date_of_completion' => 'required|date',
    
            'work_experience' => 'nullable|array',
            'work_experience.*.company_name' => 'required|string',
            'work_experience.*.position' => 'required|string',
            'work_experience.*.job_type' => 'required|string',
            'work_experience.*.monthly_salary' => 'required|string',
            'work_experience.*.joining_date' => 'required|string',
            'work_experience.*.reason_for_leaving' => 'required|string',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $application = JobApplication::create([
            ...$request->except(['cv', 'education', 'work_experience']),
            'cv' => $cvPath,
            'status' => JobApplicationStatus::PENDING->value,
        ]);

        foreach ($request->education as $edu) {
            $application->educations()->create([
                'name' => $edu['name'],
                'qualifications' => $edu['qualifications'],
                'date_of_completion' => $edu['date_of_completion'],
            ]);
        }
    
        // Save Work Experience entries
        if ($request->has('work_experience')) {
            foreach ($request->work_experience as $exp) {
                $application->workExperiences()->create([
                    'company_name' => $exp['company_name'],
                    'position' => $exp['position'],
                    'job_type' => $exp['job_type'],
                    'monthly_salary' => $exp['monthly_salary'],
                    'joining_date' => $exp['joining_date'],
                    'reason_for_leaving' => $exp['reason_for_leaving'],
                ]);
            }
        }
        
        // Mail::to($internship->email)->send(new InternshipRequestSentMail($internship));

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
