<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{Theme::base('assets/metronic/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{Theme::base('assets/metronic/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<script>
    window.base_url = '{{URL::base("")}}';
    window.site_url = '{{URL::site("")}}';
    window.blank_image = '{{Theme::base("assets/media/users/blank.png")}}';
</script>

<script src="{{ Theme::base('assets/custom/js/components/datepicker.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/components/fileupload.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/components/search-reference.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/components/themes.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/components/thumbnail.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/sidebar-menu.js') }}" type="text/javascript"></script>
<script src="{{ Theme::base('assets/custom/js/notification.js') }}" type="text/javascript"></script>
