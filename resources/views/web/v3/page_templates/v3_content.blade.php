@section('nav')
	@include('web.v3.components.common.nav')
@stop

@section('search')
	{{-- @include('web.v3.components.common.search') --}}
@stop

@section('ads_leaderboard')
	<div class='mt-xxxl'>
		@include('web.v3.components.ads.728x90')
	</div>
@stop

@section('toggle-menu-responsive')
	@include('web.v3.components.common.toggle-menu-responsive')
@stop

@section('footer_top_margin')
	<div class="clearfix mt-xxxl"></div>
	<div class="clearfix mt-xxxl"></div>
@stop


@section('footer')
	@include('web.v3.components.common.footer')
@stop

@section('header_js')
	{{-- GOOGLE DFP --}}
	<script type='text/javascript'>
	  var googletag = googletag || {};
	  googletag.cmd = googletag.cmd || [];
	  (function() {
	    var gads = document.createElement('script');
	    gads.async = true;
	    gads.type = 'text/javascript';
	    var useSSL = 'https:' == document.location.protocol;
	    gads.src = (useSSL ? 'https:' : 'http:') +
	      '//www.googletagservices.com/tag/js/gpt.js';
	    var node = document.getElementsByTagName('script')[0];
	    node.parentNode.insertBefore(gads, node);
	  })();
	</script>

	<script type='text/javascript'>
	  googletag.cmd.push(function() {
	    googletag.defineSlot('/176127224/CAPCUS-300x250', [300, 250], 'div-gpt-ad-1443787522312-0').addService(googletag.pubads());
	    googletag.defineSlot('/176127224/CAPCUS-728x90', [728, 90], 'div-gpt-ad-1443787522312-1').addService(googletag.pubads());
	    googletag.pubads().enableSingleRequest();
	    googletag.pubads().collapseEmptyDivs();
	    googletag.enableServices();
	  });
	</script>
	{{-- END OF GOOGLE DFP --}}
@stop

@section('basic_js')
	{{-- @include('web.v3.components.js.slider') --}}
	@include('web.v3.components.js.compare_tour')

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-68155327-1', 'auto');
		ga('send', 'pageview');
	</script>

@stop

