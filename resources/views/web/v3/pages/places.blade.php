@section('content_1')
	<?php
		$breadcrumbs['Home'] = route('web.home');
		if ($destination->id)
		{
			$breadcrumbs['Tujuan Wisata'] = route('web.places');
			$breadcrumbs[$destination->name] = '';
		}
		else
		{
			$breadcrumbs['Tujuan Wisata'] = '';
		}
	?>
	{{-- BREADCRUMB --}}
	@include('web.v3.components.common.breadcrumb', ['links' => $breadcrumbs])

	{{-- FILTERS --}}
	@include('web.v3.components.places.top_filters')
@stop

@section('search_tour_tab')
@stop

@section('content_2')
	<div class="container mt-xl">
		<div class="row">
			{{-- SIDE FILTER --}}
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				@include('web.v3.components.places.filter')
			</div>

			{{-- CONTENT --}}
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" >
				<main>
					@if ($filters['nama'])
						<h1 class='text-lg mb-lg'>Pencarian Tujuan Wisata "{{$filters['nama']}}" {{$destination->name ? 'di ' . $destination->long_name : ''}} {{$current_page > 1 ? " / Halaman " . $current_page : '' }}</h2>
					@else
						<h1 class='text-lg mb-lg'>Tujuan Wisata {{$destination->name ? 'di ' . $destination->long_name : ''}} {{$current_page > 1 ? " / Halaman " . $current_page : '' }}</h2>
					@endif
				
					<div class="row">
						@forelse ($places as $x)
							<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 mb-xl">
								@include('web.v3.components.places.list', ['place' => $x])
							</div>
						@empty
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
								<div class='bg-white pt-lg pb-lg'>Tidak ada tujuan wisata dalam kriteria terpilih</div>
							</div>
						@endforelse
					</div>
					
					<!-- PAGINATION -->
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@include('web.v3.components.common.pagination', [
								'route_name' 	=> 'web.places',
								'appends'		=> ['destination' => $filters['destination'] ? $filters['destination'] : 'semua', 'tags' => implode(',', $filters['tags'])]
							])
						</div>	
					</div>
					<!-- END / PAGINATION -->
				</main>
			</div>
		</div>
	</div>
@stop


@section('js')
	@parent

	{!! HTML::script('plugins/selectize/js/standalone/selectize.min.js') !!}
	{!! HTML::style('plugins/selectize/css/selectize.css') !!}
	<script>
		$('.selectize').selectize({});
	</script>
@stop