@section('content_body')
	<div class="container-fluid">
		<div class="row">

			{{-- LEADERBOARD BEFORE CONTENT & SIDEBAR --}}
			<div class="hidden-xs hidden-sm col-md-12 hidden-lg mt-xs">
				@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			{{-- MAIN CONTENT --}}
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<div class='text-center hidden-md mt-md'>
					@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
				</div>

				<div class='mb-md'>
					<h1 class='text-uppercase mb-lg'>
						Vendor
					</h1>

					@foreach (['diamond', 'gold', 'silver', 'bronze'] as $group)
						@include('web.v1.widgets.vendors.grid',[
							'widget_template'	=> 'well',
							'widget_title'		=> $group,
							'vendors' 			=> $vendors[$group]
						])
					@endforeach
				</div>
			</div>

			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-md">
				@include('web.v1.widget_group.sidebar.basic')
			</div>

		</div>
	</div>
@stop