<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\InternshipRequestStatus;
use App\Enum\JobApplicationStatus;
use App\Http\Controllers\Controller;
use App\Mail\SendNewAccountInfoMail;
use App\Models\InternshipRequest;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

class JobApplicationsController extends Controller implements HasMiddleware
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
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $job_applications = JobApplication::query();
            return DataTables::of($job_applications)
            ->addColumn('action', function(JobApplication $job_application){
                $is_already_user = User::where('email', $job_application->email)->count() > 0;
                return 
                "
                <div class='dropdown'>
                    <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                        <i class='ri-more-fill'></i>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end' data-popper-placement='bottom-end' style='position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-34px, 29px);'>
                    <li>
                        <a class='dropdown-item' role='button' href='". route('dashboard.job-applications.show', $job_application->id) ."'>
                            <i class='ri-eye-fill align-bottom me-2 text-muted'></i>
                            ". __('dashboard.show') ."
                        </a>
                    </li>    
                    <li>
                        <a class='dropdown-item' role='button' href='". route('dashboard.job-applications.print', $job_application->id) ."'>
                            <i class='ri-printer-line align-bottom me-2 text-muted'></i>
                            ". __('dashboard.print') ."
                        </a>
                    </li>    
                "
                .
                ($job_application->status == JobApplicationStatus::PENDING->value ?
                "
                    <li>
                        <a class='dropdown-item accept' data-id='". $job_application->id ."' role='button'>
                            <i class='ri-check-double-line align-bottom me-2 text-muted'></i>
                            ". __('dashboard.accept') ."
                        </a>
                    </li>
                    <li>
                        <a class='dropdown-item reject' data-id='". $job_application->id ."' role='button'>
                            <i class='ri-user-unfollow-line align-bottom me-2 text-muted'></i>
                            ". __('dashboard.reject') ."
                        </a>
                    </li>
                "
                :"") 
                .
                "
                        <li>
                            <form data-id='".$job_application->id."' onsubmit='remove_user(event)'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='" . csrf_token() . "'>
                                <button class='remove_button dropdown-item edit-list' type='button'>
                                    <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i>
                                    ". __('dashboard.delete') ."
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                ";
            })
            ->editColumn('city', function(JobApplication $job_application){
                return __('front.' . $job_application->city);
            })
            ->editColumn('cv', function(JobApplication $job_application){
                return $job_application->cv ? "<a href='". asset('storage/' . $job_application->cv) ."' target='_blank'> <i class='ri-file-transfer-line fs-3'></i> </a>" : "";
            })
            ->editColumn('created_at', function(JobApplication $job_application){
                return "<bdi>" . $job_application->created_at->format('Y/m/d h:i:sa') . "</bdi>";
            })
            ->editColumn('status', function(JobApplication $job_application){
                return match($job_application->status){
                    JobApplicationStatus::ACCEPTED->value => '<span class="badge text-bg-success">'. __('dashboard.accepted') .'</span>',
                    JobApplicationStatus::PENDING->value => '<span class="badge text-bg-warning">'. __('dashboard.pending') .'</span>',
                    JobApplicationStatus::REJECTED->value => '<span class="badge text-bg-danger">'. __('dashboard.rejected') .'</span>'
                };
            })
            ->editColumn('name', function(JobApplication $job_application){
                return 
                    "
                    <div class='d-flex align-items-center gap-2'>
                    "
                    . 
                    ($job_application->image ? "
                        <div class='rounded-4 overflow-hidden d-flex justify-content-center align-items-cneter' style='width: 30px; height: 30px;'>
                            <img src='". asset('storage/' . $job_application->image) ."' style='min-width: 100%; min-height:100%'>  
                        </div>
                    " : "")
                    . 
                    "
                        <span>{$job_application->name}</span>
                    </div>
                ";
            })
            ->rawColumns(['name', 'created_at', 'cv', 'status', 'action'])
            ->make(true);
        }
        return view('dashboard.job-applications.index');
    }

    public function accept(Request $request, JobApplication $job_application)
    {
        $job_application->status = JobApplicationStatus::ACCEPTED->value;
        $job_application->save();

        return response()->json(['message' => __('dashboard.job_application_accepted')]);       
    }
    
    public function reject(JobApplication $job_application)
    {
        $job_application->status = JobApplicationStatus::REJECTED->value;
        $job_application->save();

        return response()->json(['message' => __('dashboard.job_application_rejected')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $job_application)
    {
        if($job_application->cv && Storage::disk('public')->exists($job_application->cv))
        {
            Storage::disk('public')->delete($job_application->cv);
        }

        $job_application->delete();

        return response()->json(['message' => __('dashboard.job_application_deleted')]);
    }

    public function show(JobApplication $job_application)
    {
        return view('dashboard.job-applications.show', compact('job_application'));
    }

    public function print(JobApplication $job_application)
    {
        $response = Http::get(ENV('API_HOST') . '/api/job-application/print', [
            'job_application' => $job_application->toArray(),
            'settings' => app('settings')->toArray(),
            'asset_path' => asset("")
        ]);

        return response($response->body())
        ->header('Content-Type', 'application/pdf');
    }
}
