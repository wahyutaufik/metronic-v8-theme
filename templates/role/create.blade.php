@extends('shared/create')
<?php
use ROH\Util\Inflector;
?>
@section('pagetitle')
    {{ f('pagetitle', l('Create {0}', Inflector::humanize(f('controller')->getClass()))) }}
@stop

@section('fields')

<div class="card">
    <div class="card-body">
        <!-- BEGIN FORM-->
        <form method="post" class="form" id="createform">
            <div class="d-flex flex-column me-n7 pe-7">
                <div class="fv-row mb-10">
                    @foreach (f('controller')->schema() as $name => $field)
                    <div class="form-group row">
                        @if (!$field['hidden'])
                        <div class="col-xl-3 col-lg-3 col-form-label">
                            {{ $field->label() }}
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            {{ $entry->format($name, 'input') }}
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                <!--begin::Permissions-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                    <!--end::Label-->
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                                <?php $checkbox = 0 ?>
                                <!--begin::Table row-->
                                @foreach($previlege as $key => $value)
                                <!-- <tr rowspan="2">
                                    <td class="text-gray-800">{{$key}}</td>
                                </tr> -->
                                @foreach($value as $k => $v )
                                <tr>
                                    <!--begin::Label-->
                                    <td class="text-gray-800">{{$k}}</td>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <td>
                                        <!--begin::Wrapper-->
                                        <div class="d-flex">
                                            @foreach($v as $action => $data)
                                            @if($data['exists'])
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input class="form-check-input" type="checkbox" value="{{$data['uri']}}" checked name="rule[]" />
                                                <span class="form-check-label">{{$action}}</span>
                                            </label>
                                            <!--end::Checkbox-->
                                            @else
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                <input class="form-check-input" type="checkbox" value="{{$data['uri']}}" name="rule[]" />
                                                <span class="form-check-label">{{$action}}</span>
                                            </label>
                                            <!--end::Checkbox-->
                                            @endif
                                            @endforeach
                                        </div>
                                        <!--end::Wrapper-->
                                    </td>
                                    <!--end::Options-->
                                </tr>
                                @endforeach
                                @endforeach
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table wrapper-->
                </div>
                <!--end::Permissions-->
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                            <?php $collapse = 1 ?>
                            <?php $checkbox = 0 ?>
                            @foreach($previlege as $key => $value)
                            <div class="card">
                                <div class="card-header" id="headingOne6">
                                    <div class="card-title" data-toggle="collapse" data-target="#collapse_{{ $collapse }}" aria-expanded="true" aria-controls="collapse_{{ $collapse }}">
                                        <i class="flaticon-pie-chart-1"></i> {{$key}}
                                    </div>
                                </div>
                                <div id="collapse_{{ $collapse }}" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                                    <div class="card-body">
                                    <?php $count = 0 ?>
                                    @foreach($value as $k => $v )
                                        @if($count % 3 == 0)
                                        <div class="row">
                                        @endif
                                        <div class="col-md-4">
                                            <div class="col-md-12"><label>{{$k}}</label></div>
                                            <div class="col-md-12">
                                                <div class="checkbox-list">
                                                    @foreach($v as $action => $data)
                                                    @if($data['exists'])
                                                    <label class="form-check form-check-custom form-check-solid mb-5">
                                                        <input type="checkbox" class="form-check-input" value="{{$data['uri']}}" checked name="rule[]"/>
                                                        <span class="form-check-label">{{$action}}</span>
                                                    </label>
                                                    @else
                                                    <label class="form-check form-check-custom form-check-solid mb-5">
                                                        <input type="checkbox" class="form-check-input" value="{{$data['uri']}}" name="rule[]"/>
                                                        <span class="form-check-label">{{$action}}</span>
                                                    </label>
                                                    @endif
                                                    <?php $checkbox++; ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <?php $count++; ?>
                                        @if($count % 3 == 0 || count($value) == $count)
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <?php $collapse++; ?>
                            @endforeach
                        </div>
                    </div>
                </div> -->
            </div>
        </form>
        <!-- END FORM-->
    </div>
    @section('action-control')
    <div class="card-footer d-flex bd-highlight">
        <div class="flex-grow-1 bd-highlight">
            <button type="button" class="btn btn-primary me-3" onclick="$('#createform').submit ()">
                <span class="indicator-label">Submit</span>
            </button>

            <a href="{{ f('controller.url') }}" type="button" class="btn btn-light">Cancel</a>
        </div>
    </div>
    @show
</div>
@stop




