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

	<section class="awe-parallax page-heading-demo" style="background-position: 50% 12px;">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="blog-heading-content text-uppercase">
				<h2>TRAVEL BLOG</h2>
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
							<span class="pagination-prev"><i class="fa fa-caret-left"></i></span>
							<span class="current">1</span>
							<a href="#">2</a>
							<a href="#">3</a>
							<a href="#">4</a>
							<a href="#" class="pagination-next"><i class="fa fa-caret-right"></i></a>
						</div>
						<!-- END / PAGINATION -->
					</div>
				</div>
				<div class="col-md-3">
					<div class="page-sidebar">
						<!-- WIDGET -->
						<div class="widget widget_search">
							<h3>Search in Blog</h3>
							<form>
								<input type="search" value="Search and hit enter">
							</form>
						</div>
						<!-- END / WIDGET -->

						<!-- WIDGET -->
						<div class="widget widget_follow_us">
							<h3>Follow us</h3>
							<div class="awe-social">
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-youtube-play"></i></a>
							</div>
						</div>
						<!-- END / WIDGET -->
						
						<!-- WIDGET -->
						<div class="widget widget_has_thumbnail">
							<h3>Recent Posts</h3>
							<ul>
								<li>
									<div class="image-wrap image-cover">
										<a href="single-post.html">
											<img src="images/img/1.jpg" alt="">
										</a>
									</div>
									<div class="content">
										<a href="#">How to Crteate Course in this theme? This is title of the blog</a>
									</div>
								</li>
								<li>
									<div class="image-wrap image-cover">
										<a href="single-post.html">
											<img src="images/img/2.jpg" alt="">
										</a>
									</div>
									<div class="content">
										<a href="#">Top 10 Design courses of October 2013</a>
									</div>
								</li>
								<li>
									<div class="image-wrap image-cover">
										<a href="single-post.html">
											<img src="images/img/3.jpg" alt="">
										</a>
									</div>
									<div class="content">
										<a href="#">How to Crteate Course in this theme? This is title of the blog</a>
									</div>
								</li>
							</ul>
						</div>
						<!-- END / WIDGET -->


					</div>
				</div>
			</div>
		</div>
	</section>
@stop