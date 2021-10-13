@extends('shared/read')
<?php
use ROH\Util\Inflector;
?>
@section('header-title')
    {{ f('pagetitle', l('View {0}', Inflector::humanize(f('controller')->getClass()))) . ' Details' }}
@stop

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ f('controller.url') }}" class="text-muted text-hover-primary">{{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">{{ f('pagetitle', l('View {0}', Inflector::humanize(f('controller')->getClass()))) }}</li>
        <!--end::Item-->
    </ul>
@stop

@section('fields')
<!--begin::Layout-->
<div class="d-flex flex-column flex-xl-row">
	<!--begin::Sidebar-->
	<div class="flex-column flex-lg-row-auto w-100 w-lg-300px mb-10">
		<!--begin::Card-->
		<div class="card card-flush">
			<!--begin::Card header-->
			<div class="card-header">
				<!--begin::Card title-->
				<div class="card-title">
					<h2 class="mb-0">{{ $entry['name'] }}</h2>
				</div>
				<!--end::Card title-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Permissions-->
				<div class="d-flex flex-column text-gray-600">
					@foreach($permissions as $key => $permission)
                    @if($key < 5)
                    <div class="d-flex align-items-center py-2">
                    <span class="bullet bg-primary me-3"></span>{{$permission['permissions']['submodule'] . ' ' . $permission['permissions']['action']}}</div>
                    @endif
                    @endforeach
                    @if(count($permissions) > 5)
                    <div class='d-flex align-items-center py-2'>
                        <span class='bullet bg-primary me-3'></span>
                        <em>and {{count($permissions) - 5}} more...</em>
                    </div>
                    @endif
				</div>
				<!--end::Permissions-->
			</div>
			<!--end::Card body-->
			<!--begin::Card footer-->
			<div class="card-footer pt-0">
				<a type="button" href="{{ f('controller.url', '/'.$entry['$id'].'/update') }}" class="btn btn-light btn-active-primary">Edit Role</a>
			</div>
			<!--end::Card footer-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Sidebar-->
	<!--begin::Content-->
	<div class="flex-lg-row-fluid ms-lg-10">
		<!--begin::Card-->
		<div class="card card-flush mb-6 mb-xl-9">
			<!--begin::Card header-->
			<div class="card-header pt-5">
				<!--begin::Card title-->
				<div class="card-title">
					<h2 class="d-flex align-items-center">Users Assigned
					<span class="text-gray-600 fs-6 ms-1">({{count($users)}})</span></h2>
				</div>
				<!--end::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Search-->
					<div class="d-flex align-items-center position-relative my-1" data-kt-view-roles-table-toolbar="base">
						<!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
						<span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
						</span>
						<!--end::Svg Icon-->
						<input type="text" data-kt-roles-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
					</div>
					<!--end::Search-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-view-roles-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-view-roles-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-view-roles-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
					<!--begin::Table head-->
					<thead>
						<!--begin::Table row-->
						<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
							<th class="w-10px pe-2">
								<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_roles_view_table .form-check-input" value="1" />
								</div>
							</th>
							<th class="min-w-50px">ID</th>
							<th class="min-w-150px">User</th>
							<th class="min-w-125px">Joined Date</th>
							<th class="text-end min-w-100px">Actions</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="fw-bold text-gray-600">
						@foreach ($users as $key => $user)
						<tr>
							<!--begin::Checkbox-->
							<td>
								<div class="form-check form-check-sm form-check-custom form-check-solid">
									<input class="form-check-input" type="checkbox" value="1" />
								</div>
							</td>
							<!--end::Checkbox-->
							<!--begin::ID-->
							<td>{{$user['$id']}}</td>
							<!--begin::ID-->
							<!--begin::User=-->
							<td class="d-flex align-items-center">
								<!--begin:: Avatar -->
								<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
									<a href="{{URL::site('user').'/'.$user['$id']}}">
										<div class="symbol-label">
											<img src="{{Theme::base('assets/metronic/media/avatars/150-1.jpg')}}" alt="Emma Smith" class="w-100" />
										</div>
									</a>
								</div>
								<!--end::Avatar-->
								<!--begin::User details-->
								<div class="d-flex flex-column">
									<a href="{{URL::site('user').'/'.$user['$id']}}" class="text-gray-800 text-hover-primary mb-1">{{$user['first_name']}} {{$user['last_name']}}</a>
									<span>{{$user['email']}}</span>
								</div>
								<!--begin::User details-->
							</td>
							<!--end::user=-->
							<!--begin::Joined date=-->
							<td>{{$user['_created_time']}}</td>
							<!--end::Joined date=-->
							<!--begin::Action=-->
							<td class="text-end">
								<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">Actions
								<!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
								<span class="svg-icon svg-icon-5 m-0">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)" />
										</g>
									</svg>
								</span>
								<!--end::Svg Icon--></a>
								<!--begin::Menu-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="{{URL::site('user').'/'.$user['$id']}}" class="menu-link px-3">View</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3" data-kt-roles-table-filter="delete_row">Delete</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu-->
							</td>
							<!--end::Action=-->
						</tr>
						@endforeach
					</tbody>
					<!--end::Table body-->
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Content-->
</div>
<!--end::Layout-->
@stop