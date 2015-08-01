{{----------------------------------------------------------------------------------------------------------------------}}
{{-- MOBILE NAV --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('mobile_nav')
	@include('web.v1.widget_group.mobile_nav')
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- LOGO --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_1')
	<a href='{{route("web.home")}}'>
		{!! HTML::image(asset('images/logo-black-sm.png'), '', ['class' => 'fullwidth']) !!}
	</a>
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- SOCIAL MEDIA --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_2')
	<a href='http://facebook.com/capcusid' class='text-xxl' target="_blank">
		<i class='fa fa-facebook-square'></i>
	</a>
	<a href='http://twitter.com/capcusid' class='text-xxl' target="_blank">
		<i class='fa fa-twitter-square'></i>
	</a>
	<a href='http://instagram.com/capcusid' class='text-xxl' target="_blank">
		<i class='fa fa-instagram'></i>
	</a>
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- USER MENU --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_3')
	@if (Auth::user())
		<ul class='mb-lg ml-0 pl-0'>
			<li class='pl-xs mb-5'>
				Hi, {{Auth::user()->name}}
			</li>
			<li>
				<a class="{{str_is('web.me.index', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.me.index")}}' >
					Voucher Tour 
				</a>
			</li>
			<li>
				<a class="{{str_is('web.me.profile.edit', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.me.profile.edit")}}' >
					Edit Profil
				</a>
			</li>
			<li>
				<a class="{{str_is('web.logout', strtolower(Route::CurrentRouteName())) ? 'active' : '' }}" href='{{route("web.logout")}}' >
					Logout
				</a>
			</li>
		</ul>
	@else
		<div class='text-center mb-xs'>
			<a href="{{route('web.login')}}" class='inline'>Daftar / Login</a>
		</div>
	@endif
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- MAIN MENU --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_4')
	<ul>
		<li>
			<a href='{{route("web.home")}}' class='{{ str_is("web.home", Route::currentRouteName()) ? "active" : "" }}'>
				Home
			</a>
		</li>
		<li>
			<a href='{{route("web.tour")}}' class='{{ str_is("web.tour*", Route::currentRouteName()) ? "active" : "" }}'>
				Tour
			</a>
		</li>
		<li>
			<a href='{{route("web.vendor")}}' class='{{ str_is("web.vendor*", Route::currentRouteName()) ? "active" : "" }}'>
				Vendors
			</a>
		</li>
		<li>
			<a href='{{route("web.blog")}}' class='{{ str_is("web.blog*", Route::currentRouteName()) ? "active" : "" }}'>
				Blog
			</a>
		</li>
	</ul>
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- ARE YOU VENDOR --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_5')
	<a href=''>
		Are you vendor?
	</a>
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- SIDEBAR FOOTER --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sidebar_footer')
	PT TAM &copy; 2015
	<br/>
	<a href='javascript:;'>About Us</a> . 
	<a href='javascript:;'>Contact Us</a>	
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- SEARCH TOUR --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('sticky_bar')
	<div class='inline fullwidth'>
		{!! Form::open(['url' => route('web.tour'), 'method' => 'GET']) !!}
			<span class='select-simple'>
				{!! Form::select('vendor', 
								["" => "Semua Vendor"] + $vendor_db->lists('name', 'slug'),
								$filters['vendor'], 
								['class' => 'width25', 'placeholder' => 'pilih vendor']) 
				!!}
			</span>
			&nbsp;
			
			<span class='select-simple'>
				{!! Form::select('tujuan', 
								["" => "Semua Tujuan"] + $destination_db->lists('path_name', 'ori_path_name'),
								$filters['tujuan'], 
								['class' => 'width25', 'placeholder' => 'pilih tujuan tour']) 
				!!}
			</span>
			&nbsp;

			<span class='select-simple'>
				{!! Form::select('keberangkatan', ['' => "Semua Keberangkatan"] + (is_array($departure_lists) ? $departure_lists : []),
								$filters['keberangkatan'], 
								['class' => 'width25', 'placeholder' => 'pilih tanggal keberangkatan']) 
				!!}
			</span>
			&nbsp;

			<span class='select-simple'>
				{!! Form::select('budget', 
								$budget_list, 
								$filters['budget'], 
								['class' => 'width25', 'placeholder' => 'pilih budget']) 
				!!}
			</span>

			<div class="clearfix hidden-sm hidden-md hidden-lg"></div>

			<button type='submit' class='btn btn-default pt-xs pb-xs ml-xs' style='margin-top:-4px;'>CARI</button>
		{!! Form::close(); !!}
	</div>
@stop

{{----------------------------------------------------------------------------------------------------------------------}}
{{-- COMMON JS --}}
{{----------------------------------------------------------------------------------------------------------------------}}
@section('js')
		@parent

		<link property='stylesheet' href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet" />
		<script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>

		<link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" />
		<script src="{{asset('plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
		<script src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	
		<script>
			$('.select2').select2({});
			$('.daterangepicker').daterangepicker();
		</script>
	@stop