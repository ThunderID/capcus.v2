@extends('web.v3.page_templates.v3')

@section('nav')
	{{-- @include('web.v3.components.common.nav') --}}
@stop

@section('ads_leaderboard')
	{{-- @include('web.v3.components.common.search') --}}
@stop

@section('search')
	{{-- @include('web.v3.components.common.search') --}}
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


@section('content_1')
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-xxxl pt-xxxl">
				<h1>Opps, Halaman Tidak Ditemukan</h1>
				<p></p>
				<p><a href="{{ route('web.home')}}" class='awe-btn awe-btn-style2 text-lg'><i class='fa fa-home'></i> Kembali ke Home</a></p>
			</div>
		</div>
	</div>
@stop