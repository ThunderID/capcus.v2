@section('content_1')
	<div class='bg-white'>
		<div class='container'>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cps-breadcrumb">
					<a href="{{ route('web.home') }}">Home</a>
					<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
					@if ($current_page > 1)
						<a href="{{ route('web.blog') }}">Blog</a>
						<span class='ml-5 mr-5 text-gray'><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></span>
						<span>Halaman {{$current_page}}</span>
					@else
						<span>Blog</span>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-sm">
					<h1>Travel Blog {{ $current_page > 1 ? " / Halaman " . $current_page : ""}}</h1>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@include('web.v4.components.articles.grid', ['articles' => $articles, 'colcount_xs' => 1, 'colcount_sm' => 2, 'colcount_md' => 2, 'colcount_lg' => 3])
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pagination mt-xxxl text-center">
					<!-- PAGINATION -->
					@if ($start_pagination == 1)
						<a href="{{ route('web.blog')}}" class='pagination-prev'><i class="glyphicon glyphicon-triangle-left"></i></a>
					@else
						<a href="{{ route('web.blog', ['page' => $current_page - 1])}}" class='pagination-prev'><i class="glyphicon glyphicon-triangle-left"></i></a>
					@endif
					@for ($i = $start_pagination; $i <= $last_pagination; $i++ )
						<a href="{{ route('web.blog', ['page' => ($i == 1 ? null : $i)]) }}" class="{{$i == $current_page ? 'current' : ''}}">{{$i}}</a>
					@endfor
					@if ($last_pagination == $current_page)
						<a href="{{ route('web.blog', ['page' => ($last_pagination == 1? null : $last_pagination)]) }}" class='pagination-next'><i class="glyphicon glyphicon-triangle-right"></i></a>
					@else
						<a href="{{ route('web.blog', ['page' => $current_page + 1]) }}" class='pagination-next'><i class="glyphicon glyphicon-triangle-right"></i></a>
					@endif
				</div>
			</div>
		</div>
	</section>
@stop
