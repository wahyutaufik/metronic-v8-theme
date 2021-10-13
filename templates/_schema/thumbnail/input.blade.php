
<!--begin::Image input-->
<div class="image-input image-input-empty thumbnail-input" data-kt-image-input="true" style="background-image: url({{Theme::base('/assets/metronic/media/avatars/blank.png')}})" data-url="{{ $url }}" data-bucket="{{ $self['bucket'] }}">
     <!--begin::Image preview wrapper-->
     <div class="image-input-wrapper w-125px h-125px"></div>
     <!--end::Image preview wrapper-->

     <!--begin::Edit button-->
     <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
        data-kt-image-input-action="change"
        data-bs-toggle="tooltip"
        data-bs-dismiss="click"
        title="Change avatar"
    >
        <i class="bi bi-pencil-fill fs-7"></i>
        @if(count($value) > 0)
        <input type="hidden" name="{{ $self['name'] }}" id="{{ $self['name'] }}" value='{{ json_encode($value) }}'/>
        @else
        <input type="hidden" name="{{ $self['name'] }}" id="{{ $self['name'] }}" />
        @endif

        <!--begin::Inputs-->
        <input type="file" accept=".png, .jpg, .jpeg" />
        <!--end::Inputs-->
     </label>
     <!--end::Edit button-->
 </div>
 <!--end::Image input-->
