@extends('layout')
<?php
use ROH\Util\Inflector;
?>
@section('pagetitle')
    {{ f('pagetitle', l('Detail {0}', Inflector::humanize(f('controller')->getClass()))) }}
@stop

@section('header-title')
    {{ f('pagetitle', l('Detail {0}', Inflector::humanize(f('controller')->getClass()))) }}
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
        <li class="breadcrumb-item text-dark">{{ f('pagetitle', l('Detail {0}', Inflector::humanize(f('controller')->getClass()))) }}</li>
        <!--end::Item-->
    </ul>
@stop

@section('fields')
    <div class="card card-custom" id="readform">
        <div class="card-body">
            @foreach (f('controller')->schema() as $name => $field)
            <div class="form-group row mb-8">
                @if (!$field['hidden'])
                <div class="col-xl-3 col-lg-3 col-form-label">
                    {{ $field->label() }}
                </div>
                <div class="col-lg-9 col-xl-9">
                    {{ $entry->format($name, 'readonly') }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <div class="card-footer d-flex bd-highlight">
            <div class="flex-grow-1 bd-highlight">
                <!--begin::Button-->
                <a type="button" href="{{ f('controller.url', '/' . $entry['$id'] . '/update') }}" class="btn btn-primary me-3">
                    <span class="indicator-label">Update</span>
                </a>
                <!--end::Button-->
                <!--begin::Button-->
                <a href="{{ f('controller.url') }}" type="button" class="btn btn-light">Cancel</a>
            </div>
            <div class="bd-highlight">
                <a href="javascript:;" class="btn btn-text-danger btn-active-light-danger form-delete" data-id="{{$entry['$id']}}" title="Delete">Delete</a>
            </div>
            <!--end::Button-->
        </div>
    </div>
@stop
