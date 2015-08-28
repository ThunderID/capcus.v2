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
					<h1 class='text-uppercase'>{{ $article->title }}</h1>
					<p class='text-light '>
						{{$article->published_at->diffForHumans()}} - By {{ $article->user->name }}
					</p>
				
					<div class="clearfix mb-xs"></div>

					<div class='text-center hidden-xs'>
						{!! Html::image($article->thumbnail, $article->title, ['class' => 'width50']) !!}
					</div>

					<div class='text-center hidden-lg hidden-md hidden-sm'>
						{!! Html::image($article->thumbnail, $article->title, ['class' => 'fullwidth']) !!}
					</div>

					<div class="clearfix mb-md"></div>

					<div class='pull-right hidden-xs hidden-sm col-md-4 col-lg-4'>
						@include('web.v1.widgets.tours.list', [
							'widget_template' => 'well',
							'widget_title'	=> 'Paket Tour Terbaru',
							'tours'	=> $tours
						])
					</div>
					{!! $article->content !!}

					<div class='hidden-md hidden-lg col-xs-12'>
						<h3>Paket Tour Terbaru</h3>
						@include('web.v1.widgets.tours.grid', [
							'tours'	=> $tours
						])
					</div>
				</div>
			</div>

			{{-- RIGHT SIDEBAR --}}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mt-md">
				@include('web.v1.widget_group.sidebar.basic')
			</div>

		</div>
	</div>
@stop