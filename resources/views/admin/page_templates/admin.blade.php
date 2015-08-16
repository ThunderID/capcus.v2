<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CAPCUS.ID - Administrator</title>

	<!-- Bootstrap CSS -->
	<link href='{{elixir("css/admin.css")}}' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	@yield('css')

</head>
<body>

	@yield('nav', '[nav]')

	<div id="wrapper">
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			{{-- LOAD NAV_SIDEBAR --}}
			@yield('nav_sidebar', '[nav_sidebar]')
		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="hidden-sm hidden-md hidden-lg">
						<a href="#menu-toggle" id="menu-toggle" class='btn btn-info pull-left mr-sm'><i class='glyphicon glyphicon-list'></i></a>
						<span class='text-lg'>CAPCUS</span>
						<hr>
					</div>

					<div class="col-lg-12 mt-sm">
						{{-- page content --}}
						@include('admin.widgets.common.alerts')
						
						<div class="row">
							<div class="hidden-xs col-sm-3 col-md-3 col-lg-2">
								<div class='sidebar2 mr-md' data-spy="affix" data-offset-top="0" >
									<h4 class='text-primary text-bold text-uppercase'>
										{{$content_title}}
									</h4>
									<hr>

									{{-- LOAD SIDEBAR 2 CONTENT --}}
									@yield('content_sidebar', '[content_sidebar]')
								</div>
							</div>
							<div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
								

								{{-- sidebar2 replacement for mobile --}}
								<div class='hidden-sm hidden-md hidden-lg mb-lg'>
									<div class='mt-sm mr-sm mb-sm ml-sm pt-sm'>
										{{-- LOAD SIDEBAR 2 CONTENT --}}
										@yield('content_sidebar', '[content_sidebar]')
									</div>
									<hr/>
								</div>

								{{-- LOAD PAGE CONTENT --}}
								@yield('content_body', '[content_body]')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- jQuery -->
	{!! Html::script('plugins/jquery/jquery.min.js') !!}
	<!-- Bootstrap JavaScript -->
	{!! Html::script('plugins/bootstrap.min.js') !!}
	
	@include('admin.plugins.redactor')
	@include('admin.plugins.inputmask')
	@include('admin.plugins.slugify')
	@include('admin.plugins.select2')
	@include('admin.plugins.tooltip')
	@include('admin.plugins.single_submit')
	@include('admin.plugins.no_enter_form')

	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		// ---------------------------- ENABLE BOOTSTRAP TOOLTIP ----------------------------
	</script>

	@yield('modal')
	@yield('js')
</body>
</html>