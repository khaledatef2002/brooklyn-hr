@extends('dashboard.layouts.app')

@section('title', __('dashboard.user.create'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.users.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="create-user-form">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="position-relative d-inline-block auto-image-show">
                            <label for="image" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="@lang('dashboard.select-image')" role="button">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <div class="avatar-xs">
                                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                            <i class="ri-image-fill"></i>
                                        </div>
                                    </div>
                                    <input class="form-control d-none" name="image" id="image" type="file" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded">
                                        <img default-src="{{ asset('back/images/users/default-avatar-icon-of-social-media-user-vector.jpg') }}" src="{{ asset('back/images/users/default-avatar-icon-of-social-media-user-vector.jpg') }}" class="rounded-3" style="min-height: 100%;min-width: 100%;" />
                                    </div>
                                </div>
                            </label>
                        </div> 
                    </div>
                    <div class="d-flex gap-3 flex-wrap mb-3">
                        <div class="flex-fill">
                            <label class="form-label" for="first_name">@lang('dashboard.first_name')</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="@lang('dashboard.first_name')">
                        </div>
                        <div class="flex-fill">
                            <label class="form-label" for="last_name">@lang('dashboard.last_name')</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="@lang('dashboard.last_name')">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">@lang('dashboard.email')</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="@lang('dashboard.email')">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">@lang('dashboard.password')</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="@lang('dashboard.password')">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="date_of_birth">@lang('dashboard.date_of_birth')</label>
                        <input type="date" data-provider="flatpickr" data-date-format="Y-m-d" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="@lang('dashboard.date_of_birth')">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="mb-1">@lang('dashboard.phone')</label>
                        <input class="form-control country-selector" type="tel" name="phone" placeholder="@lang('dashboard.phone')">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="role">Role:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="">@lang('dashboard.select.choose-option')</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button id="create" class="btn btn-success w-sm">@lang('dashboard.create')</button>        
        </div>
    </div>
</form>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/users.js') }}" type="module"></script>
@endsection