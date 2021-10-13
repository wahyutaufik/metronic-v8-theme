<?php
$current = '';
$cur_url = URL::current();
if ($cur_url != URL::site('unauthorized')) {
    $current = $cur_url;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head><base href="../../">
        <title>
            @section('pagetitle')
                {{ f('page.title', 'Welcome') }}
            @show
            - Bono
        </title>
		<link rel="shortcut icon" href="{{ Theme::base('assets/metronic/media/logos/favicon.ico') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        
		<link href="{{ Theme::base('assets/metronic/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ Theme::base('assets/metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ Theme::base('assets/custom/css/custom.css') }}" rel="stylesheet" type="text/css"/>
	</head>
    
	<body id="kt_body" class="bg-body">
        <notification class="notification-alert">
			{{ f('notification.show') }}
		</notification>

		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ Theme::base('assets/metronic/media/illustrations/development-hd.png') }})">
                @section('content')
				<div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-20">
					<a href="{{URL::site()}}" class="mb-10 pt-lg-20">
						<img alt="Logo" src="{{ Theme::base('assets/metronic/media/logos/logo-2-dark.svg') }}" class="h-50px mb-5" />
					</a>
                    
					<div class="pt-lg-10">
						<h1 class="fw-bolder fs-2qx text-gray-800 mb-7">Welcome to Bono Metronic</h1>
                        
						<div class="fw-bold fs-3 text-muted mb-15">You are not authorized to access this page, maybe you should Sign In first to access it.</div>
                        
						<div class="text-center mb-10">
                            <a href="{{ URL::site('/login').'?!continue='.\Bono\Helper\URL::redirect($current) }}" class="btn btn-lg btn-primary fw-bolder">Sign In</a>
						</div>
					</div>
				</div>
                @show
			</div>
		</div>
		<script src="{{ Theme::base('assets/metronic/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ Theme::base('assets/metronic/js/scripts.bundle.js') }}"></script>
        <script src="{{ Theme::base('assets/custom/js/notification.js') }}" type="text/javascript"></script>
        @yield('js')
	</body>
</html>