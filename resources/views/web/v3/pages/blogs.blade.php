@section('content_1')
	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						<li><span>Blog</span></li>
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
				<div class="col-md-9">
					<div class="blog-page__content">
						@forelse ($articles as $article)
							<!-- POST -->
							<div class="post">
								<div class="post-media">
									<div class="image-wrap image-style">
										<a href="{{ route('web.blog.show', ['year' => $article->published_at->year, 'month' => $article->published_at->month, 'slug' => $article->slug])}}">
											<img src="{{ $article->images->where('name', 'MediumImage')->first()->path }}" alt="{{$article->title}}" style="height: 100%; width: auto;">
										</a>
									</div>
								</div>
								<div class="post-body">
									<div class="post-meta">
										<div class="date">{{ $article->published_at->format('d M Y') }}</div>
									</div>
									<div class="post-title">
										<h2>
											<a href="{{ route('web.blog.show', ['year' => $article->published_at->year, 'month' => $article->published_at->month, 'slug' => $article->slug])}}">{{ $article->title }}</a>
										</h2>
									</div>
									<div class="post-content">
										<p>{{ str_limit($article->summary, 200) }}</p>
									</div>
									<div class="post-link">
										<a href="{{ route('web.blog.show', ['year' => $article->published_at->year, 'month' => $article->published_at->month, 'slug' => $article->slug])}}" class="awe-btn awe-btn-style2">Baca selengkapnya</a>
									</div>
								</div>
							</div>
							<!-- END / POST -->
						@empty
							<div class='text-center'>
								<div class='bg-white-glass pt-lg pb-lg'>Tidak ada article untuk saat ini</div>
							</div>
						@endforelse

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
				</div>
				<div class="col-md-3">
					<div class="page-sidebar">

						<!-- WIDGET -->
						<div class="widget widget_has_thumbnail">
							<h3>TOP DESTINATIONS</h3>
							<ul>
								@foreach ($top_destinations as $x)
									<li>
										<div class="image-wrap image-cover">
											<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $x->path_slug ] ) }}">
												<img src="{{ $x->images->where('name', 'SmallImage')->first()->path }}" alt="{{ $x->name }}">
											</a>
										</div>
										<div class="content">
											<a href="{{ route('web.tour', ['travel-agent' => 'semua-travel-agent', 'tujuan' => $x->path_slug]) }}">
												{{$x->long_name}}
											</a>
										</div>
									</li>
								@endforeach
							</ul>
						</div>
						<!-- END / WIDGET -->


					</div>
				</div>
			</div>
		</div>
	</section>
@stop