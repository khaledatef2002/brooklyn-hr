@extends('dashboard.layouts.app')

@section('title', __('dashboard.job-application.show') . $job_application->name . " " . $job_application->created_at->format("Y-m-d"))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.job-applications.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">@lang('front.personal-image')</div>
            <div class="card-body row g-3">
                <div class='rounded-4 overflow-hidden d-flex justify-content-center align-items-cneter' style='width: 150px; height: 150px;'>
                    <img src="{{ $job_application->image ? asset('storage/' . $job_application->image) : asset('back/images/users/default-avatar-icon-of-social-media-user-vector.jpg') }}" style='min-width: 100%; min-height:100%'>  
                </div>
            </div>
        </div>
        {{-- Personal Info --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">@lang('front.personal-information')</div>
            <div class="card-body row g-3">
                <div class="d-flex gap-2 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">@lang('front.full-name'):</label>
                        <span class="d-block">{{ $job_application->name }}</span>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">@lang('front.date-of-birth')</label>
                        <span class="d-block">{{ $job_application->date_of_birth }}</span>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="flex-fill">
                        <label class="form-label">@lang('front.phone-number')</label>
                        <span class="d-block">{{ $job_application->phone_number }}</span>
                    </div>
                    <div class="flex-fill">
                        <label class="form-label">@lang('front.nationality')</label>
                        <span class="d-block">{{ $job_application->nationality }}
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">@lang('front.address')</label>
                    <span class="d-block">{{ $job_application->address }}</span>
                </div>
                
            </div>
        </div>

        {{-- Education --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">@lang('front.education')</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>@lang('front.name-of-school-college-university')</th>
                            <th>@lang('front.quification-obtained')</th>
                            <th>@lang('front.date-of-certification')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job_application->educations as $education)
                            <tr>
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->qualifications }}</td>
                                <td>{{ $education->date_of_completion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Language Proficiency --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">@lang('front.language-proficiency')</div>
            <div class="card-body row g-3 table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>@lang('front.language')</th>
                            <th>@lang('front.spoken')</th>
                            <th>@lang('front.written')</th>
                            <th>@lang('front.reading')</th>
                            <th>@lang('front.comprehension')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $langs = ['english', 'arabic'];
                            $skills = ['spoken', 'written', 'reading', 'comprehension'];
                            $levels = App\Enum\LanguageRate::getList();
                        @endphp
                        @foreach ($langs as $lang)
                            <tr>
                                <td>@lang('front.' . $lang)</td>
                                @foreach ($skills as $skill)
                                    <td>
                                        {{ $job_application[$lang . '_' . $skill] }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Work Experience --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">@lang('front.work-experience')</div>
            <div class="card-body" id="experienceContainer">
                @if ($job_application->workExperiences->count() > 0)
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>@lang('front.company-name')</th>
                                <th>@lang('front.working-duration')</th>
                                <th>@lang('front.monthly-salary')</th>
                                <th>@lang('front.position')</th>
                                <th>@lang('front.reason-for-leaving')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job_application->experiences as $experience)
                                <tr>
                                    <td>{{ $experience->company_name }}</td>
                                    <td>{{ $experience->working_duration }}</td>
                                    <td>{{ $experience->monthly_salary }}</td>
                                    <td>{{ $experience->position }}</td>
                                    <td>{{ $experience->reason_for_leaving }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center mb-1 fw-bold">@lang('front.no-work-experience')</p>
                @endif
            </div>
        </div>

        {{-- Other Info --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">@lang('front.other-details')</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">@lang('front.military-service')</label>
                    <span class="d-block">{{ $job_application->military_service }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.religion')</label>
                    <span class="d-block">{{ $job_application->religion }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.social-status')</label>
                    <span class="d-block">{{ $job_application->social_status }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.number-of-children')</label>
                    <span class="d-block">{{ $job_application->no_of_children | 0 }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.position-applied-for')</label>
                    <span class="d-block">{{ $job_application->position }}</span>
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.expected-salary')</label>
                    <span class="d-block">{{ $job_application->expected_salary }}</span>
                </div>



                <div class="d-flex flex-wrap col-12">
                    <div class="col-md-6">
                        <label class="form-label">@lang('front.do-you-have-certification')</label>
                        <span class="d-block">{{ $job_application->do_you_have_health_certificate ? __('front.yes') : __('front.no') }}</span>
                    </div>
                    @if ($job_application->health_certificate_date)
                        <div class="col-md-6">
                            <label class="form-label">@lang('front.health-certificate-date')</label>
                            <span class="d-block">{{ $job_application->health_certificate_date }}</span>
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-wrap col-12">
                    <div class="col-md-6">
                        <label class="form-label">@lang('front.ready-to-start-immediately')</label>
                        <span class="d-block">{{ $job_application->ready_to_start ? __('front.yes') : __('front.no') }}</span>
                    </div>
                    @if ($job_application->starting_duration)
                        <div class="col-md-6">
                            <label class="form-label">@lang('front.starting-duration')</label>
                            <span class="d-block">{{ $job_application->starting_duration }}</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label">@lang('front.willing-to-work-in-any-place')</label>
                    <span class="d-block">{{ $job_application->work_in_any_place ? __('front.yes') : __('front.no') }}</span>
                </div>
                <div class="d-flex flex-wrap col-12">
                    <div class="col-md-6">
                        <label class="form-label">@lang('front.any-health-problems')</label>
                        <span class="d-block">{{ $job_application->any_health_problems ? __('front.yes') : __('front.no') }}</span>
                    </div>
                    @if ($job_application->health_problem)
                        <div class="col-md-6">
                            <label class="form-label">@lang('front.health_problem')</label>
                            <span class="d-block">{{ $job_application->health_problem }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/users.js') }}" type="module"></script>
@endsection