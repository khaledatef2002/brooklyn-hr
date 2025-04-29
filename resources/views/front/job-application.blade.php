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
                        <div class="card-header bg-white fw-bold">@lang('front.personal-image') <span class="text-muted">@lang('front.optional')</span></div>
                        <div class="card-body row g-3">
                            <div class="auto-image-show">
                                <input capture="user" id="cover" name="image" type="file" class="profile-img-file-input" accept="image/*" hidden>
                                <div role="button" style="width: 200px;" class="d-flex flex-column align-items-cneter">
                                    <div class="profile-photo-edit d-flex justify-content-center align-items-center" style="aspect-ratio: 1 / 1;overflow:hidden">
                                        <img src="{{ asset('front/images/no-image.jpeg') }}" style="min-width:100%;min-height:100%;" alt="article-cover">
                                    </div>
                                    <p class="btn btn-success mt-2 mb-0 choose_gallery" type="button">@lang('front.choose-gallery')</p>
                                    <p class="btn btn-primary mt-2 mb-0 choose_camera" type="button">@lang('front.choose-camera')</p>
                                </div>
                            </div> 
                        </div>
                    </div>
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
                                    <input type="text" name="date_of_birth" class="form-control date_mask" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.phone-number')</label>
                                    <input dir="ltr" type="text" name="phone_number" class="form-control" x-mask="01#########">
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">@lang('front.nationality')</label>
                                    <select name="nationality" class="form-select select2">
                                        @foreach (App\Enum\NationalityValues::getList() as $value)
                                            <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">@lang('front.city')</label>
                                <select name="city" class="form-select select2">
                                    @foreach (App\Enum\CityValues::getArray() as $value)
                                        <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
                                    @endforeach
                                </select>
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
                                    <input type="text" name="education[0][date_of_completion]" class="form-control date_year_mask" placeholder="yyyy">
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
                                                            <option value="{{ $level }}">{{ __('front.' . strtolower($level)) }}</option>
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
                    <div class="card mb-4 border-0 shadow-sm"
                        x-data="{health_certificate_date: null, health_certificate_date_value: '', health_problem: null, health_problem_value: '', starting_duration: null, starting_duration_value: ''}">
                        <div class="card-header bg-white fw-bold">@lang('front.other-details')</div>
                        <div class="card-body row g-3">
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.military-service')</label>
                                <select name="military_service" class="form-select select2">
                                    @foreach (App\Enum\MilitaryServiceValues::getValues() as $value)
                                        <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.religion')</label>
                                <select name="religion" class="form-select select2">
                                    @foreach (App\Enum\ReligionValues::getValues() as $value)
                                        <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('front.social-status')</label>
                                <select name="social_status" class="form-select select2">
                                    @foreach (App\Enum\SocialStatus::getValues() as $value)
                                        <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
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
                                <input type="text" name="expected_salary" step="0.01" class="form-control salary_mask">
                            </div>

                            {{-- Boolean Fields --}}
                            <div class="col-12 d-flex">
                                <div class="col-md-6">
                                    <label class="form-label d-block">@lang('front.do-you-have-certification')</label>
                                    <div class="form-check form-check-inline">
                                        <input x-model="health_certificate_date" id="do_you_have_health_certificate_yes" type="radio" name="do_you_have_health_certificate" value="1" class="form-check-input">
                                        <label for="do_you_have_health_certificate_yes" class="form-check-label">@lang('front.yes')</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input x-model="health_certificate_date" id="do_you_have_health_certificate_no" type="radio" name="do_you_have_health_certificate" value="0" class="form-check-input">
                                        <label for="do_you_have_health_certificate_no" class="form-check-label">@lang('front.no')</label>
                                    </div>
                                </div>
                                <div class="col-md-6" x-show="health_certificate_date == 1">
                                    <label class="form-label" for="health_certificate_date">@lang('front.health-certificate-date')</label>
                                    <input x-model="health_certificate_date_value" type="text" name="health_certificate_date" class="form-control date_mask" placeholder="dd/mm/yyyy">
                                </div>
                                <template x-effect="if (health_certificate_date == 0) health_certificate_date_value = ''"></template>
                            </div>

                            <div class="col-12 d-flex">
                                <div class="col-md-6">
                                    <label class="form-label d-block">@lang('front.ready-to-start-immediately')</label>
                                    <div class="form-check form-check-inline">
                                        <input x-model="starting_duration" id="ready_to_start_yes" type="radio" name="ready_to_start" value="1" class="form-check-input">
                                        <label for="ready_to_start_yes" class="form-check-label">@lang('front.yes')</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input x-model="starting_duration" id="ready_to_start_no" type="radio" name="ready_to_start" value="0" class="form-check-input">
                                        <label for="ready_to_start_no" class="form-check-label">@lang('front.no')</label>
                                    </div>
                                </div>
                                <div class="col-md-6" x-show="starting_duration == 0">
                                    <label class="form-label d-block">@lang('front.starting-duration')</label>
                                    <select x-model="starting_duration" id="starting_duration" name="starting_duration" class="form-select select2">
                                            <option disabled selected>@lang('front.select-an-option')</option>
                                        @foreach (App\Enum\StartingPeriodOptions::getValues() as $value)
                                            <option value="{{ $value }}">{{ __('front.' . $value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <template x-effect="if (starting_duration == 1) { starting_duration_value = '';$('select#starting_duration').val($('select#starting_duration option:first').val()).trigger('change');}"></template>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-block">@lang('front.willing-to-work-in-any-place')</label>
                                <div class="form-check form-check-inline">
                                    <input id="work_in_any_place_yes" type="radio" name="work_in_any_place" value="1" class="form-check-input">
                                    <label for="work_in_any_place_yes" class="form-check-label">@lang('front.yes')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="work_in_any_place_no" type="radio" name="work_in_any_place" value="0" class="form-check-input">
                                    <label for="work_in_any_place_no" class="form-check-label">@lang('front.no')</label>
                                </div>
                            </div>

                            <div class="col-12 d-flex">
                                <div class="col-md-6">
                                    <label class="form-label d-block">@lang('front.any-health-problems')</label>
                                    <div class="form-check form-check-inline">
                                        <input x-model="health_problem" id="any_health_problems_yes" type="radio" name="any_health_problems" value="1" class="form-check-input">
                                        <label for="any_health_problems_yes" class="form-check-label">@lang('front.yes')</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input x-model="health_problem" id="any_health_problems_no" type="radio" name="any_health_problems" value="0" class="form-check-input">
                                        <label for="any_health_problems_no" class="form-check-label">@lang('front.no')</label>
                                    </div>
                                </div>
                                <div class="col-md-6" x-show="health_problem == 1">
                                    <label class="form-label" for="health_problem">@lang('front.health_problem')</label>
                                    <input x-model="health_problem_value" type="text" name="health_problem" class="form-control">
                                </div>
                                <template x-effect="if (health_problem == 0) health_problem_value = '';"></template>
                            </div>

                        </div>
                    </div>

                    {{-- Upload CV --}}
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-white fw-bold">@lang('front.upload-cv') <span class="text-muted text-sm">@lang('front.optional')</span> <span class="text-muted text-sm">@lang('front.required-for-managers')</span></div>
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
                <p class="text-danger fw-bold text-center">@lang('front.job-applying-is-unavilable')</p>
            @endif
        </div>
    </div>

@endsection

@section('additional-js-libs')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('custom-js')
    <script>
        document.querySelectorAll('.date_mask').forEach(function (input) {
            new Cleave(input, {
                date: true,
                delimiter: '/',
                datePattern: ['d', 'm', 'Y']
            });
        });

        document.querySelectorAll('.date_year_mask').forEach(function (input) {
            new Cleave(input, {
                date: true,
                delimiter: '/',
                datePattern: ['Y']
            });
        });

        document.querySelectorAll('.salary_mask').forEach(function (input) {
            new Cleave(input, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });

        const phone_number_mask = new Cleave('input[name="phone_number"]', {
            prefix: '01',
            delimiter: '',
            blocks: [2, 9],
        });

        $('.select2').select2({ width: '100%' });

        let educationIndex = 1;

        document.getElementById('addEducationRow').addEventListener('click', function () {
            const container = document.getElementById('educationContainer');
            const newEntry = document.createElement('div');
            newEntry.className = 'row g-3 education-entry mt-3';
            newEntry.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">@lang('front.name-of-school-college-university')</label>
                <input type="text" name="education[${educationIndex}][name]" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">@lang('front.quification-obtained')</label>
                <input type="text" name="education[${educationIndex}][qualifications]" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">@lang('front.date-of-certification')</label>
                <input type="text" name="education[${educationIndex}][date_of_completion]" class="form-control date_year_mask" placeholder="yyyy">
            </div>
            <div class="col-md-1 d-flex align-items-end pb-1">
                <button type="button" class="btn btn-danger btn-sm remove-education">&times;</button>
            </div>
            `;
            container.appendChild(newEntry);
            educationIndex++;

            const date_element = newEntry.querySelector('input.date_mask');
            new Cleave(date_element, {
                date: true,
                delimiter: '/',
                datePattern: ['d', 'm', 'Y']
            });

            const date_year_element = newEntry.querySelector('input.date_year_mask');
            new Cleave(date_year_element, {
                date: true,
                delimiter: '/',
                datePattern: ['Y']
            });
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
                <input id="work_experience_${experienceIndex}_company_name" type="text" name="work_experience[${experienceIndex}][company_name]" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label for="work_experience_${experienceIndex}_jworking_duration">@lang('front.working_duration')</label>
                <input id="work_experience_${experienceIndex}_working_duration" type="text" name="work_experience[${experienceIndex}][working_duration]" class="form-control">
            </div>
            <div class="col-md-4 mt-3">
                <label for="work_experience_${experienceIndex}_monthly_salary">@lang('front.monthly-salary')</label>
                <input id="work_experience_${experienceIndex}_monthly_salary" type="text" name="work_experience[${experienceIndex}][monthly_salary]" class="form-control salary_mask">
            </div>
            <div class="col-md-4">
                <label for="work_experience_${experienceIndex}_position">@lang('front.position')</label>
                <input id="work_experience_${experienceIndex}_position" type="text" name="work_experience[${experienceIndex}][position]" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label for="work_experience_${experienceIndex}_reason_for_leaving">@lang('front.reason-for-leaving')</label>
                <input id="work_experience_${experienceIndex}_reason_for_leaving" type="text" name="work_experience[${experienceIndex}][reason_for_leaving]" class="form-control">
            </div>
            <div class="col-md-1 mt-3 d-flex align-items-end pb-1">
                <button type="button" class="btn btn-danger btn-sm remove-experience">&times;</button>
            </div>
            `;
            container.appendChild(newEntry);
            experienceIndex++;

            const salary_input = newEntry.querySelector('input.salary_mask');
            new Cleave(salary_input, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-experience')) {
                if(e.target.closest('#experienceContainer').querySelectorAll('.experience-entry').length == 1)
                {
                    const container = document.getElementById('experienceContainer');
                    container.innerHTML = `
                        <p class="text-center mb-1 fw-bold">{{ __('front.no-work-experience') }}</p>
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