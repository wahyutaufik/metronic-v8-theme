@extends('layout')
@section('customcss')
<link href="{{ Theme::base('assets/metronic/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@stop

<?php
use ROH\Util\Inflector;
use App\Library\Pagination;
?>
<?php
$schema = array();
$columns = array();
$count = 0;
foreach (f('controller')->schema() as $key => $field) {
    $className = get_class($field);
    $seg = explode('\\', $className);
    if ($field['list-column']) {
        $columns[] = [
            'data' => $key,
            'label' => $field['label'],
            'bucket' => isset($field['bucket']) ? $field['bucket'] : null,
        ];
        $schema[] = $field;
    }
}
?>

@section('pagetitle')
   {{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}
@stop

@section('header-title')
   {{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}
@stop

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-dark">{{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}</li>
        <!--end::Item-->
    </ul>
@stop

@section('fields')
<div class="card">
    <div class="card-body">

        <div class="d-flex flex-stack mb-5">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-2 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                </span>
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search {{ l('{0}', Inflector::humanize(f('controller')->getClass())) }}"/>
            </div>
            
            <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="tooltip" title="Coming Soon">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"></path>
                            </g>
                        </svg>
                    </span>
                    Filter
                </button>
                
                <a type="button" href="{{ f('controller.url', '/null/create') }}" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"></rect>
                            <rect fill="#000000" opacity="0.5" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"></rect>
                        </svg>
                    </span>
                    Add {{ l('{0}', Inflector::humanize(f('controller')->getClass())) }}
                </a>
            </div>
            
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                </div>

                <a type="button" href="javascript:;" class="btn btn-danger delete-selected" title="Delete">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>
                            </g>
                        </svg>
                    </span>
                    Delete Selected
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        @if (count($schema))
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="1"/>
                                </div>
                            </th>
                            @foreach ($schema as $key => $field)
                            <th>{{ $field['label'] }}</th>
                            @endforeach
                            <th class="text-end min-w-100px">Actions</th>
                        @else
                            <th>Data</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('customjs')
<script src="{{ Theme::base('assets/metronic/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
"use strict";

var KTDatatablesServerSide = function () {
    var table;
    var dt;

    var columns = <?=json_encode($columns)?>;
    columns.unshift({
        data: '',
        defaultContent: ''
    });
    columns.push({
        data: '',
        defaultContent: ''
    });

    const columnDefs = [
        {
            targets: 0,
            orderable: false,
            render: function (data, type, row) {
                var data = row['$id'];
                return `
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="${data}" />
                </div>`;
            }
        },
        {
            targets: 1,
            render: function (data, type, row) {
                var id = row['$id'];
                return `
                    <a href="{{ f('controller.url') }}/${id}" class="text-gray-600 text-hover-primary">
                        ${data}
                    </a>
                `;
            }
        },
        {
            targets: -1,
            data: null,
            orderable: false,
            className: 'text-end',
            render: function (data, type, row) {
                var data = row['$id'];
                return `
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                        Actions
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="{{ f('controller.url') }}/${data}/update" class="menu-link px-3" data-kt-users-table-filter="edit_row">
                                Edit
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="javascript:;" class="menu-link px-3 form-delete" data-id="/${data}" title="Delete">
                                Delete
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                `;
            },
        },
    ];

    // Private functions
    var initDatatable = function () {
        dt = $("#kt_datatable_example_1").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            select: {
                style: 'os',
                selector: 'td:first-child',
                className: 'row-selected'
            },
            ajax: {
                url:   `{{f('controller.url', '.json')}}`,
                data: {
                    'format': 'datatable'
                }
            },
            columns: columns,
            columnDefs: columnDefs
        });
        
        table = dt.$;
        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#kt_datatable_example_1');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#kt_datatable_example_1');
        const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');
        
        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');
        console.log(allCheckboxes)

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
        }
    }
}();

$(document).ready(function() {
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });

    $(document).on('click', '.form-delete', function() {

        var id = $(this).data('id');
        if(!id) return;

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure want to delete this data?",
            icon: "warning",
            showCancelButton: true,
        })
        .then((willDelete) => {
            if (willDelete.isConfirmed) {
                $.ajax({
                    url: "{{f('controller.url')}}"+id+"/delete.json",
                    type: "POST",
                }).done((response) => {
                    toastr.success('{{ l('{0}', Inflector::humanize(f('controller')->getClass())) }} deleted.', 'Success!');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                }).catch(err => {
                    toastr.error('Error happened!', 'Error!');
                });
            }
        });
    });

    $(document).on('click', '.delete-selected', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure want to delete this data?",
            icon: "warning",
            showCancelButton: true,
        })
        .then((willDelete) => {
            const allCheckboxes = document.querySelectorAll('tbody [type="checkbox"]');

            // Count checked boxes
            var delete_ids = [];
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    delete_ids.push(c.value);
                }
            });
            $.ajax({
                url: "{{f('controller.url')}}/"+delete_ids.join()+"/delete.json",
                type: "POST",
            }).done((response) => {
                toastr.success('{{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }} deleted.', 'Success!');
                $('#kt_datatable_example_1').DataTable().ajax.reload();
            }).catch(err => {
                toastr.error('Error happened!', 'Error!');
            });
        });
    });
});
</script>
@stop
