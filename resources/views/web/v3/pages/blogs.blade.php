@section('content_1')
	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						@if ($current_page > 1)
							<li><a href="{{ route('web.blog') }}">Blog</a></li>
							<li><span>Halaman {{$current_page}}</span></li>
						@else
							<li><span>Blog</span></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class="bg-blog-page" style='height:100%;'>
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="blog-heading-content text-uppercase">
				<h2>TRAVEL BLOG {{ $current_page > 1 ? "/ Halaman " . $current_page : ""}}</h2>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	
	<section class="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@include('web.v3.components.articles.grid', ['articles' => $articles, 'colcount_xs' => 1, 'colcount_sm' => 2, 'colcount_md' => 2, 'colcount_lg' => 3])
					

					<!-- PAGINATION -->
					<div class="page__pagination mt-xxxl">
						@if ($start_pagination == 1)
							<a href="{{ route('web.blog')}}" class='pagination-prev'><i class="fa fa-caret-left"></i></a>
						@else
							<a href="{{ route('web.blog', ['page' => $current_page - 1])}}" class='pagination-prev'><i class="fa fa-caret-left"></i></a>
						@endif
						@for ($i = $start_pagination; $i <= $last_pagination; $i++ )
							<a href="{{ route('web.blog', ['page' => ($i == 1 ? null : $i)]) }}" class="{{$i == $current_page ? 'current' : ''}}">{{$i}}</a>
						@endfor
						@if ($last_pagination == $current_page)
							<a href="{{ route('web.blog', ['page' => ($last_pagination == 1? null : $last_pagination)]) }}" class='pagination-next'><i class="fa fa-caret-right"></i></a>
						@else
							<a href="{{ route('web.blog', ['page' => $i+1]) }}" class='pagination-next'><i class="fa fa-caret-right"></i></a>
						@endif
					</div>
					<!-- END / PAGINATION -->
				</div>
				{{-- <div class="col-md-4">
					
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@include('web.v3.components.common.subscribe')
						</div>
					</div>

					<hr>

					<!-- WIDGET -->
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class='text-black mb-lg mt-xs'>Destinasi Trending</h4>
							@include('web.v3.components.destinations.sidebar',['destinations' => $top_destinations])
						</div>
					</div>
					<!-- END / WIDGET -->

					<hr>


					<!-- PAKET TOUR TERBARU -->
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class='text-black mb-lg mt-xs'>PAKET TOUR TERBARU</h4>

							@include('web.v3.components.tours.text', [
																				'tours'			 	=> $latest_tours, 
																				'colcount_xs'		=> 2,
																				'colcount_sm'		=> 2,
																				'colcount_md'		=> 2,
																				'colcount_lg'		=> 2,
																				])
						</div>
					</div>
					<!-- END / WIDGET -->
				</div> --}}
			</div>
		</div>
	</section>
@stop