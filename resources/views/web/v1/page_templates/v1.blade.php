<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

	<title>CAPCUS.ID - {{$page_title}}</title>

	@yield('css')
</head>
<body>

	@yield('mobile_nav', '[mobile_nav]')
	

	<div id="wrapper">
		<aside>
			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-10">
						<div class='hidden-xs'>
							@yield('sidebar_1', '[sidebar_1]')
							<hr class='border-dotted mt-xs'>
						</div>

						<div class='text-center'>
							@yield('sidebar_2', '[sidebar_2]')
						</div>

						<hr class='border-dotted'>
					</div>

					<div class='col-xs-12 pt-xs'>
						@yield('sidebar_3', '[sidebar_3]')
					</div>

					<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-10">
						<hr class='border-dotted mb-xs'>
					</div>

					<div class='col-xs-12'>
						@yield('sidebar_4', '[sidebar_4]')
					</div>

					<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-lg-10">
						<hr class='border-dotted mt-xs mb-xs'>
					</div>
					
					<div class="col-xs-12 text-center">
						@yield('sidebar_5', '[sidebar_5]')
					</div>
				</div>

				<div class="footer text-center text-regular">
					<footer>
						@yield('sidebar_footer', '[sidebar_footer]')
					</footer>
				</div>
			</div>
		</aside>

		<main>
			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 pl-0 pr-0">
							{{-- SEARCH TOUR --}}
							<header>
								<div class="ml-0 pl-0 mr-0 pr-0 hidden-xs hidden-sm">
									<div class='bg-white-glass fullwidth sticky pt-xs pb-xs top' data-spy="affix">
										<div class='ml-lg searchbar'>
											@yield('sticky_bar', '[sticky_bar]')
										</div>
									</div>
								</div>	
							</header>

							<div class="clearfix mt-lg"></div>
							{{-- MAIN CONTENT --}}
							<div class='pt-searchbar'>
								@yield('content_header')
							</div>

							<div class="container-fluid">
								@yield('content_body')
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	{{-- LOGIN MODAL --}}
	<div class="modal fade" id="login-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Welcome To Capcus</h4>
				</div>
				<div class="modal-body">
					{{-- @include('web.widgets.common.login_form') --}}
				</div>
			</div>
		</div>
	</div>

	{{-- Share social media modal --}}
	<div class="modal fade" id="share-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Share Tour</h4>
				</div>
				<div class="modal-body">
					<iframe src=""></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap CSS -->
	{!! HTML::style(elixir('css/style1.css'))!!}

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<link property='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Comfortaa' rel='stylesheet' type='text/css'>
	<link property='stylesheet' rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	@include('admin.plugins.inputmask')
	<script>
		function show_login_modal()
		{
			$('#login-modal').modal('show');
		}

		$(".link_to_popup_window").click(function(event) { 
			var obj = $(this);
			var w = screen.width / 2;
			var h = 400;
			var left = (screen.width/2)-(w/2);
			var top = (screen.height/2)-(h/2);

			if (w < 364)
			{
				window.open(obj.data('href'),'_blank');
			}
			else
			{
				window.open(obj.data('href'),'_blank','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
			}
		});

		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
			$("#search-bar").addClass("hidden");
		});

		$("#search-toggle").click(function(e) {
			e.preventDefault();
			$("#search-bar").toggleClass("hidden");
			$("#wrapper").removeClass("toggled");
		});
	</script>

	@yield('modal')
	@yield('js')
</body>
</html>

@section('sidebar_1')
	<a href="{{route('web.home')}}">
		<img src="{{asset('images/'.$main_logo['result']['file_url'])}}" alt="{{$main_logo['img_alt']}}" class='{{$main_logo['img_class'] or ""}}'>
	</a>
@stop