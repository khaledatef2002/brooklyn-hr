@extends('front.layouts.main')

@section('title', __('front.apply-job-form'))

@section('content')
   
    <div class="content border-0 rounded-3 col-lg-8 m-auto">
        <div>
            <div class="image-container mx-auto d-flex justify-content-center align-items-center overflow-hidden mt-3" style="height:100px">
                <img src="{{ asset('storage/'. $settings->logo) }}" style="height:100%">
            </div>
            <h1 class="text-center mb-2">@lang('front.job-apply')</h1>
            <div class="text-center mb-2">
                @foreach (LaravelLocalization::getSupportedLocales() as $key => $lang)
                    @if ($key != LaravelLocalization::getCurrentLocale())
                        <a href="{{ LaravelLocalization::getLocalizedURL($key) }}" class="dropdown-item notify-item language py-2" data-lang="{{ $key }}" title="{{ $lang['name'] }}">
                            <img src="{{ asset('back') }}/images/flags/{{ $key }}.svg" alt="user-image" class="me-2 rounded" height="18">
                        </a>
                    @endif
                @endforeach
            </div>
            @if ($settings->is_internship_form_avilable)
                <form id="apply-job">
                    @csrf
                    
                    {{-- Personal Info --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">@lang('front.personal-information')</div>
                        <div class="card-body row g-3">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.full-name')</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.date-of-birth')</label>
                                    <input type="date" name="date_of_birth" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.phone-number')</label>
                                    <input type="text" name="phone_number" class="form-control">
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.nationality')</label>
                                    <input type="text" name="nationality" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">@lang('front.address')</label>
                                <textarea name="address" class="form-control" rows="2"></textarea>
                            </div>
                            
                        </div>
                    </div>

                    {{-- Education --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">@lang('front.education')</h5>
                            <button type="button" class="btn btn-sm btn-success" id="addEducationRow">
                                + @lang('front.add-more')
                            </button>
                        </div>
                        <div class="card-body" id="educationContainer">
                            <div class="row g-3 education-entry">
                                <div class="col-md-4">
                                    <label class="form-label">@lang('front.name-of-school-college-university')</label>
                                    <input type="text" name="education[0][name]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('front.quification-obtained')</label>
                                    <input type="text" name="education[0][qualifications]" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('front.date-of-certification')</label>
                                    <input type="date" name="education[0][date_of_completion]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Language Proficiency --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">@lang('front.language-proficiency')</div>
                        <div class="card-body row g-3 table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
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
                                                    <select name="{{ $lang }}_{{ $skill }}" class="form-select select2">
                                                        @foreach ($levels as $level)
                                                            <option value="{{ $level }}">{{ ucfirst($level) }}</option>
                                                        @endforeach
                                                    </select>
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
                        <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">@lang('front.work-experience')</h5>
                            <button type="button" class="btn btn-sm btn-success" id="addExperienceRow">
                                + @lang('front.add-more')
                            </button>
                        </div>
                        <div class="card-body" id="experienceContainer">
                            <p class="text-center mb-1 fw-bold">@lang('front.no-work-experience')</p>
                        </div>
                    </div>
                      

                    
                    {{-- Other Info --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">@lang('front.other-details')</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.military-service')</label>
                                <select name="military_service" class="form-select select2">
                                    @foreach (App\Enum\MilitaryServiceValues::getValues() as $value)
                                        <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.religion')</label>
                                <select name="religion" class="form-select select2">
                                    @foreach (App\Enum\ReligionValues::getValues() as $value)
                                        <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.social-status')</label>
                                <select name="social_status" class="form-select select2">
                                    @foreach (App\Enum\SocialStatus::getValues() as $value)
                                        <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.number-of-children')</label>
                                <input type="number" name="no_of_childs" class="form-control" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.position-applied-for')</label>
                                <input type="text" name="position" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.expected-salary')</label>
                                <input type="number" name="expected_salary" step="0.01" class="form-control">
                            </div>

                            {{-- Boolean Fields --}}
                            @php
                                $booleans = [
                                    'do_you_have_health_certificate' => __('front.do-you-have-certification'),
                                    'ready_to_start' => __('front.ready-to-start-immediately'),
                                    'any_crime' => __('front.have-you-committed-any-crime'),
                                    'work_in_any_place' => __('front.willing-to-work-in-any-place'),
                                    'any_health_problems' => __('front.any-health-problems')
                                ];
                            @endphp

                            @foreach ($booleans as $name => $label)
                                <div class="col-md-6">
                                    <label class="form-label d-block">{{ $label }}</label>
                                    <div class="form-check form-check-inline">
                                        <input id="{{ $name }}_yes" type="radio" name="{{ $name }}" value="1" class="form-check-input">
                                        <label for="{{ $name }}_yes" class="form-check-label">@lang('front.yes')</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="{{ $name }}_no" type="radio" name="{{ $name }}" value="0" class="form-check-input">
                                        <label for="{{ $name }}_no" class="form-check-label">@lang('front.no')</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Upload CV --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">@lang('front.upload-cv')</div>
                        <div class="card-body">
                            <input type="file" name="cv" class="form-control" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mb-3">
                        <span class="loader"></span>
                        <p class="mb-0">@lang('front.apply')</p>
                    </button>
                </form>
            @else
                <p class="text-danger fw-bold text-center">@lang('front.internship-applying-is-unavilable')</p>
            @endif
        </div>
    </div>

@endsection

@section('additional-js-libs')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('custom-js')
    <script>
        $('.select2').select2({ width: '100%' });

        let educationIndex = 1;

        document.getElementById('addEducationRow').addEventListener('click', function () {
            const container = document.getElementById('educationContainer');
            const newEntry = document.createElement('div');
            newEntry.className = 'row g-3 education-entry mt-3';
            newEntry.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">@lang('front.name-of-school-college-university')</label>
                <input type="text" name="education[${educationIndex}][name]" class="form-control" placeholder="Institute Name">
            </div>
            <div class="col-md-4">
                <label class="form-label">@lang('front.quification-obtained')</label>
                <input type="text" name="education[${educationIndex}][qualifications]" class="form-control" placeholder="Qualifications">
            </div>
            <div class="col-md-3">
                <label class="form-label">@lang('front.date-of-certification')</label>
                <input type="date" name="education[${educationIndex}][date_of_completion]" class="form-control">
            </div>
            <div class="col-md-1 d-flex align-items-end pb-1">
                <button type="button" class="btn btn-danger btn-sm remove-education">&times;</button>
            </div>
            `;
            container.appendChild(newEntry);
            educationIndex++;
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-education')) {
            e.target.closest('.education-entry').remove();
            }
        });


        let experienceIndex = 0;

        document.getElementById('addExperienceRow').addEventListener('click', function () {
            const container = document.getElementById('experienceContainer');
            if(container.querySelectorAll('.experience-entry').length == 0)
                container.innerHTML = '';
            const newEntry = document.createElement('div');
            newEntry.className = 'row g-3 experience-entry';
            newEntry.innerHTML = `
            <div class="col-md-4">
                <label for="work_experience_${experienceIndex}_company_name">@lang('front.company-name')</label>
                <input id="work_experience_${experienceIndex}_company_name" type="text" name="work_experience[${experienceIndex}][company_name]" class="form-control" placeholder="Company Name">
            </div>
            <div class="col-md-4 mt-3">
                <label for="work_experience_${experienceIndex}_joining_date">@lang('front.joining-date')</label>
                <input id="work_experience_${experienceIndex}_joining_date" type="date" name="work_experience[${experienceIndex}][joining_date]" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label for="work_experience_${experienceIndex}_monthly_salary">@lang('front.monthly-salary')</label>
                <input id="work_experience_${experienceIndex}_monthly_salary" type="text" name="work_experience[${experienceIndex}][monthly_salary]" class="form-control" placeholder="Monthly Salary">
            </div>
            <div class="col-md-4">
                <label for="work_experience_${experienceIndex}_position">@lang('front.position')</label>
                <input id="work_experience_${experienceIndex}_position" type="text" name="work_experience[${experienceIndex}][position]" class="form-control" placeholder="Position">
            </div>
            <div class="col-md-4">
                <label for="work_experience_${experienceIndex}_job_type">@lang('front.job-type')</label>
                <input id="work_experience_${experienceIndex}_job_type" type="text" name="work_experience[${experienceIndex}][job_type]" class="form-control" placeholder="Job Type">
            </div>
            <div class="col-md-3 mt-3">
                <label for="work_experience_${experienceIndex}_reason_for_leaving">@lang('front.reason-for-leaving')</label>
                <input id="work_experience_${experienceIndex}_reason_for_leaving" type="text" name="work_experience[${experienceIndex}][reason_for_leaving]" class="form-control" placeholder="Reason for Leaving">
            </div>
            <div class="col-md-1 mt-3 d-flex align-items-end pb-1">
                <button type="button" class="btn btn-danger btn-sm remove-experience">&times;</button>
            </div>
            `;
            container.appendChild(newEntry);
            experienceIndex++;
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-experience')) {
                if(e.target.closest('#experienceContainer').querySelectorAll('.experience-entry').length == 1)
                {
                    const container = document.getElementById('experienceContainer');
                    container.innerHTML = `
                        <p class="text-center mb-1 fw-bold">لا يوجد خبرات</p>
                    `;
                }
                else
                {
                    e.target.closest('.experience-entry').remove();
                }
            }
        });
    </script>
@endsection