@section('content_body')
	<div class="container-fluid mt-md">
		<div class="row">

			{{-- LEADERBOARD BEFORE CONTENT & SIDEBAR --}}
			<div class="hidden-xs hidden-sm col-md-12 hidden-lg mt-xs">
				@include('web.v1.widgets.ads.728x90', ['widget_class' => 'mb-sm text-center'])
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1>Hi, {{Auth::user()->name}}</h1>
			</div>

			{{-- MAIN CONTENT --}}
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				@include('web.v1.widgets.common.alerts')
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						@include('web.v1.widgets.me.profile_form',[
							'widget_template' => 'well', 
							'user'	=> Auth::user()
						])
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						@include('web.v1.widgets.me.update_password',['widget_template' => 'well', 'widget_options' => 
							[
								"data"	=> [
									'filter_user_id'	=> Auth::id()
								]
							]
						])
					</div>
				</div>
			</div>


			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				@include('web.v1.widget_group.sidebar.basic')
			</div>

		</div>
	</div>
@stop