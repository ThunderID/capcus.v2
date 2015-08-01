<nav class="navbar navbar-default hidden-md hidden-lg text-center navbar-fixed-top pt-5 pb-5">
	<div class='absolute topleft mt-xs mb-xs ml-xs'><a href="javascript:;" id="menu-toggle" class=' btn btn-info btn-lg'><i class='glyphicon glyphicon-list'></i></a></div>
	<div class='absolute topright mt-xs mb-xs mr-xs'><a href="javascript:;" id="search-toggle" class=' btn btn-info btn-lg'><i class='fa fa-search fa-6'></i></a></div>

	@yield('mobile_main_logo', '[mobile_main_logo]')

	<div class="hidden hidden-md hidden-lg text-center" id="search-bar">
		<div class="row">
			<div class="col-xs-12 hidden-md hidden-lg">
				<div class='bg-white-glass fullwidth sticky searchbar' data-spy="affix">
					@yield('mobile_top_bar', '[mobile_top_bar]')
				</div>
			</div>
		</div>
	</div>	
</nav>