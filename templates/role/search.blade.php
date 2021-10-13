@extends('shared/search')
@section('fields')
<!--begin::Row-->
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
    @foreach ($entries as $entry)
    <!--begin::Col-->
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card card-flush h-md-100">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{$entry['name']}}</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-1">
                <!--begin::Users-->
                <div class="fw-bolder text-gray-600 mb-5">Total users with this role: {{$entry['users']}}</div>
                <!--end::Users-->
                <!--begin::Permissions-->
                <div class="d-flex flex-column text-gray-600">
                    @foreach($entry['permissions'] as $key => $permission)
                    @if($key < 3)
                    <div class="d-flex align-items-center py-2">
                    <span class="bullet bg-primary me-3"></span>{{$permission['permissions']['submodule'] . ' ' . $permission['permissions']['action']}}</div>
                    @endif
                    @endforeach
                    @if(count($entry['permissions']) > 3)
                    <div class='d-flex align-items-center py-2'>
                        <span class='bullet bg-primary me-3'></span>
                        <em>and {{count($entry['permissions']) - 3}} more...</em>
                    </div>
                    @endif
                </div>
                <!--end::Permissions-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div class="card-footer flex-wrap pt-0">
                <a href="{{ f('controller.url', '/'.$entry['$id']) }}" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                <a href="{{ f('controller.url', '/'.$entry['$id'].'/update') }}" class="btn btn-light btn-active-primary my-1 me-2">Edit Role</a>
                <!-- <button type="button" class="btn btn-light btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button> -->
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
    @endforeach
    <!--begin::Add new card-->
    <div class="ol-md-4">
        <!--begin::Card-->
        <div class="card h-md-100">
            <!--begin::Card body-->
            <div class="card-body d-flex flex-center">
                <!--begin::Button-->
                <!-- <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role"> -->
                <a type="button" href="{{ f('controller.url', '/null/create') }}" class="btn btn-clear d-flex flex-column flex-center">
                    <!--begin::Illustration-->
                    <img src="{{Theme::base('assets/metronic/media/illustrations/user-role.png')}}" alt="" class="mw-100 mh-150px mb-7" />
                    <!--end::Illustration-->
                    <!--begin::Label-->
                    <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                    <!--end::Label-->
                </a>
                <!--begin::Button-->
            </div>
            <!--begin::Card body-->
        </div>
        <!--begin::Card-->
    </div>
    <!--begin::Add new card-->
</div>
<!--end::Row-->
@stop