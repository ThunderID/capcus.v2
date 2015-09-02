@section('content_1')
	<?php
		$breadcrumbs['Home'] = route('web.home');
		$breadcrumbs['Blog'] = route('web.blog');
		$breadcrumbs[str_limit($article->title, 100)] = '';
	?>
	@include('web.v3.components.common.breadcrumb', ['links' => $breadcrumbs])

	<section class="bg-blog-page" style='height:100%;'>
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

	<div class="container">
		<div class="row">
			<main>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1 class='mb-5'>{{$article->title}}</h1>
					<br>{{ $article->published_at->diffForHumans() }} . {{$article->writer->name}}
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-black text-md mt-xl">
					{!! $article->content !!}
				</div>
			</main>
		</div>

		<hr class='mt-xxl'>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3>BACA JUGA ...</h3>
				@include('web.v3.components.articles.grid', ['articles' => $related_articles, 'colcount_xs' => 1, 'colcount_sm' => 2, 'colcount_md' => 2, 'colcount_lg' => 3])

			</div>
		</div>
	</div>


	
@stop