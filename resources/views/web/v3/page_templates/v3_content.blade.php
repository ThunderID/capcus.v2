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

@section('footer')
	@include('web.v3.components.common.footer')
@stop

@section('basic_js')
	@include('web.v3.components.js.slider')
	@include('web.v3.components.js.compare_tour')
@stop
