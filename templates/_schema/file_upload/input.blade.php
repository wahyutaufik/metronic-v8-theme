<fileupload>
    <div class="dropzone fileupload" data-url="{{ $url }}" data-bucket="{{ $self['bucket'] }}">
        @if(count($value) > 0)
            <input type="hidden" name="{{ $self['name'] }}" id="{{ $self['name'] }}" value='{{ json_encode($value) }}'/>
        @else
            <input type="hidden" name="{{ $self['name'] }}" id="{{ $self['name'] }}" />
        @endif
        <!--begin::Message-->
        <div class="dz-message needsclick">
            <!--begin::Icon-->
            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
            <!--end::Icon-->
    
            <!--begin::Info-->
            <div class="ms-4">
                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Click to upload.</h3>
                <span class="fs-7 fw-bold text-gray-400">Upload only 1 file</span>
            </div>
            <!--end::Info-->
        </div>
    </div>
</fileupload>
