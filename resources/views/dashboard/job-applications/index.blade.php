@extends('dashboard.layouts.app')

@section('title', __('dashboard.job-applications'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('front.apply') }}" target="_blank"><button class="btn btn-primary"><i class="ri-eye-fill me-1 align-bottom"></i> @lang('dashboard.view-apply-form')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<div class="card">
    <div class="card-body table-responsive pb-5">
        <table class="table table-bordered table-striped pb-5" id="dataTables">
            <thead>
                <tr class="table-dark">
                    <th>@lang('dashboard.name')</th>
                    <th>@lang('front.city')</th>
                    <th>@lang('dashboard.phone_number')</th>
                    <th>@lang('dashboard.position')</th>
                    <th>@lang('dashboard.expected_salary')</th>
                    <th>@lang('dashboard.date_of_birth')</th>
                    <th>@lang('dashboard.status')</th>
                    <th>@lang('dashboard.cv')</th>
                    <th>@lang('dashboard.created_at')</th>
                    <th>@lang('dashboard.action')</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/job-applications.js') }}" type="module"></script>
    <script>
        var table
        $(document).ready( function () {
            table = $('#dataTables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.job-applications.index') }}",
                columns: [
                            { data: 'name', name: 'name' },
                            { data: 'city', name: 'city' },
                            { data: 'phone_number', name: 'phone_number' },
                            { data: 'position', name: 'position' },
                            { data: 'expected_salary', name: 'expected_salary' },
                            { data: 'date_of_birth', name: 'date_of_birth' },
                            { data: 'status', name: 'status' },
                            { data: 'cv', name: 'cv' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'action', name: 'action'}
                        ],
                language: __table_lang
            });
        });
    </script>
@endsection