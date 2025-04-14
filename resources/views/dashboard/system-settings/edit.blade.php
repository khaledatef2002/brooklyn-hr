@extends('dashboard.layouts.app')

@section('title', __('dashboard.system-settings'))

@section('content')

<form id="edit-system-settings-form">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="position-relative d-inline-block auto-image-show">
                            <label for="logo" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="@lang('dashboard.select-image')" role="button">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                            <i class="ri-image-fill"></i>
                                        </div>
                                    </div>
                                    <input class="form-control d-none" name="logo" id="logo" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="{{ asset('storage/' . $settings->logo) }}" class="rounded-3" style="min-height: 100%;min-width: 100%;" />
                                    </div>
                                </div>
                            </label>
                        </div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name">@lang('dashboard.system-name')</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('dashboard.name')" value="{{ $settings->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">@lang('dashboard.description')</label>
                        <textarea class="form-control" id="description" name="description" placeholder="@lang('dashboard.description')"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label w-100" for="is_internship_form_avilable">@lang('dashboard.job-form')</label>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="is_internship_form_avilable" {{ $settings->is_internship_form_avilable ? 'checked' : '' }} name="is_internship_form_avilable" autocomplete="off">
                            <label class="btn btn-outline-primary" for="is_internship_form_avilable">@lang('dashboard.avilable')</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">@lang('dashboard.save')</button>
        </div>
    </div>
</form>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/system-settings.js') }}" type="module"></script>
@endsection