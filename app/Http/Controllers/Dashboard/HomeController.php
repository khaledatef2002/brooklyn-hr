<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\InternshipRequestStatus;
use App\Enum\JobApplicationStatus;
use App\Enum\TaskStatus;
use App\Http\Controllers\Controller;
use App\Models\InternshipRequest;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $statistics = $this->get_statistics();
        return view('dashboard.index', compact('statistics'));
    }

    private function get_statistics()
    {
        $pending_jobs = JobApplication::where('status', JobApplicationStatus::PENDING->value)->count();
        $accepted_jobs = JobApplication::where('status', JobApplicationStatus::ACCEPTED->value)->count();
        $rejected_jobs = JobApplication::where('status', JobApplicationStatus::REJECTED->value)->count();

        return [
            'pending_jobs' => $pending_jobs,
            'accepted_jobs' => $accepted_jobs,
            'rejected_jobs' => $rejected_jobs,
        ];
    }
}
