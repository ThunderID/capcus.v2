@section('content_1')
	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul>
						<li><a href="{{ route('web.home') }}">Home</a></li>
						<li><a href="{{ route('web.blog') }}">Blog</a></li>
						<li><span>{{ $article->title }}</span></li>
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
					<div class="blog-page__content blog-single">
						<!-- POST -->
						<div class="post">
							<div class="post-meta">
								<div class="date">{{ $article->published_at->format('d M Y')}}</div>
							</div>
							<div class="post-title">
								<h1>{{ $article->title }}</h1>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mb-lg mt-xs">
									<img src="{{ $article->images->where('name', 'SmallImage')->first()->path }}" alt="{{ $article->title }}"  style='width:100%'>
								</div>
							</div>
							<div class="post-body">
								<div class="post-content">
									{!! $article->content !!}
								</div>
							</div>
						</div>
						<!-- END / POST -->


						<!-- RELATED POSTS -->
						@if ($related_articles->count())
							<div class="related-post">
								<h4>BACA JUGA</h4>
								<div class="related-slider owl-carousel owl-theme" style="opacity: 1; display: block;">
									<div class="owl-wrapper-outer autoHeight" style="height: 181px;">
										<div class="owl-wrapper" style="width: 3392px; left: 0px; display: block; -webkit-transition: all 800ms ease; transition: all 800ms ease; -webkit-transform: translate3d(-848px, 0px, 0px);">
											@foreach ($related_articles as $x)
												<div class="owl-item" style="width: 848px;">
													<div class="post">
														<div class="post-media">
															<div class="image-wrap image-style">
																<a href="{{ route('web.blog.show', ['year' => $x->published_at->year , 'month' => $x->published_at->month, 'slug' => $x->slug ]) }}">
																	<img src="{{ $x->images->where('name','SmallImage')->first()->path }}" alt="" style="height: 100%; width: auto;">
																</a>
															</div>
														</div>
														<div class="post-body">
															<div class="post-meta">
																<div class="date"> {{$x->published_at->format('d M Y')}} </div>
															</div>
															<div class="post-title">
																<h2>
																	<a href="{{ route('web.blog.show', ['year' => $x->published_at->year , 'month' => $x->published_at->month, 'slug' => $x->slug ]) }}">{{ $x->title }}</a>
																</h2>
															</div>
															<div class="post-content">
																<p>{{str_limit($x->summary,200)}}</p>
															</div>
															<div class="post-link">
																<a href="{{ route('web.blog.show', ['year' => $x->published_at->year , 'month' => $x->published_at->month, 'slug' => $x->slug ]) }}" class="awe-btn awe-btn-style2">Baca selengkapnya</a>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								<div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><i class="fa fa-caret-left"></i></div><div class="owl-next"><i class="fa fa-caret-right"></i></div></div></div></div>
							</div>
							<!-- END / RELATED POSTS -->
						@endif

						<!-- COMMENTS -->
						{{-- <div id="comments">
							<!-- LEAVER YOUR COMMENT -->
							<div id="respond">
								<div class="reply-title">
									<h4>3 Comments</h4>
								</div>
								<form>
									<div class="row">
										<div class="col-md-12">
											<div class="form-item form-textarea-wrapper">
												<textarea>Comment here</textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-item form-name">
												<input type="text" value="Your name">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-item form-email">
												<input type="text" value="Your email">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-actions">
												<input type="submit" value="Post Comment">
											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- END / LEAVER YOUR COMMENT -->

							<div class="commentlist-wrapper">
								<ul class="commentlist">
									<li class="comment">
										<div class="comment-box">
											<div class="comment-author">
												<a href="#"><img src="images/img/demo-thumb.jpg" alt=""></a>
											</div>
											<div class="comment-body">
												<cite class="fn"><a href="#">Gofar</a></cite>
												<p>Mauris tincidunt, quam at feugiat efficitur, justo nunc efficitur justo, a hendrerit lectus neque eu nibh. Praesent eu sem erat. Fusce non sagittis lorem.</p>
												<div class="comment-meta">
													<span>5 days ago</span>
												</div>
												<div class="comment-abs">
													<a href="#" class="comment-edit-link">Edit</a> // 
													<a href="#" class="comment-reply-link">Reply</a>
												</div>
											</div>
										</div>
										<ul class="children">
											<li class="comment bypostauthor">
												<div class="comment-box">
													<div class="comment-author">
														<a href="#"><img src="images/img/demo-thumb.jpg" alt=""></a>
													</div>
													<div class="comment-body">
														<cite class="fn">
															<a href="#">Gofar</a>
															<span class="byauthor">Author</span>
														</cite>
														<p>Aliquam volutpat elit non urna faucibus condimentum. Pellentesque nibh libero, consequat at nibh a, tincidunt rutrum magna. Curabitur in posuere risus, dictum euismod dolor. Vestibulum auctor orci sed elit ultricies tempus. Praesent facilisis tellus turpis, ac congue lorem consectetur ac.</p>
														<div class="comment-meta">
															<span>5 days ago</span>
														</div>
														<div class="comment-abs">
															<a href="#" class="comment-edit-link">Edit</a> // 
															<a href="#" class="comment-reply-link">Reply</a>
														</div>
													</div>
												</div>
											</li>
										</ul>
									</li>

									<li class="comment">
										<div class="comment-box">
											<div class="comment-author">
												<a href="#"><img src="images/img/demo-thumb.jpg" alt=""></a>
											</div>
											<div class="comment-body">
												<cite class="fn"><a href="#">Gofar</a></cite>
												<p>Pellentesque nibh libero, consequat at nibh a, tincidunt rutrum magna. Curabitur in posuere risus, dictum euismod dolor. Vestibulum auctor orci sed elit ultricies tempus. Praesent facilisis tellus turpis, ac congue lorem consectetur ac.</p>
												<div class="comment-meta">
													<span>5 days ago</span>
												</div>
												<div class="comment-abs">
													<a href="#" class="comment-edit-link">Edit</a> // 
													<a href="#" class="comment-reply-link">Reply</a>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div> --}}
						<!-- END / COMMENTS -->
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
												<img src="{{ $x->images->where('name', 'SmallImage')->first()->path }}" alt="{{ $x->name }}" width='100%'>
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