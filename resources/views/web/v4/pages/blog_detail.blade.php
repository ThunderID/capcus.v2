@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					<a href="{{ route('web.blog') }}">Blog</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					{{str_limit($article->title, 100)}}
				</div>
			</div>
		</div>
	</div>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container">
		<div class="row">
			<main>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1 class='mb-5 pb-0'>{{$article->title}}</h1>
					<span class='text-gray'>{{ $article->published_at->diffForHumans() }} . {{$article->writer->name}}</span>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-black text-md">
					{!! $article->content !!}
				</div>
			</main>
		</div>

		<hr class='mt-xxl'>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3>BACA JUGA ...</h3>
				@include('web.v4.components.articles.grid', ['articles' => $related_articles, 'colcount_xs' => 1, 'colcount_sm' => 2, 'colcount_md' => 2, 'colcount_lg' => 3])

			</div>
		</div>
	</div>
@stop