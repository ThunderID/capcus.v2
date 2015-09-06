<?php
	$required_variables = ['destination_list', 'tag_list', 'filters'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('places.filter' . $x . ": Required", 1);
		}
	}
?>

{!! Form::open(['url' => route('web.places'), 'method' => 'GET']) !!}
	<div class="page-sidebar filter_tour_schedule_results">
		<div class="sidebar-title">
			<h2>FILTER</h2>
		</div>
		
		<div class="widget widget_has_radio_checkbox pb-sm">
			<h3>NAMA</h3>
			{!! Form::text('nama', $filters['nama'], ['class' => 'form-control']) !!}
		</div>	

		<div class="widget widget_has_radio_checkbox pb-xs">
			<h3>LOKASI</h3>
			{!! Form::select('destination', $destination_list, ($destination ? $destination->path_slug : 'semua'), ['class' => 'selectize']) !!}
		</div>	

		<div class="widget widget_has_radio_checkbox">
			<h3>KATEGORI</h3>
			<ul>
				<ul>
					@foreach ($tag_list as $k => $v)
						<li>
							<label>
								<input type="checkbox" value="{{ $k }}" {{ in_array($k, $filters['tags']) || empty($filters['tags']) ? 'checked=checked' : '' }} name='tag[]'>
								<i class="awe-icon awe-icon-check"></i>

								{{ ucwords($k) }}
							</label>
						</li>
					@endforeach
				</ul>
			</ul>
		</div>

		<div class="widget widget_has_radio_checkbox">
			<div class='text-center'>
				<button type='submit' class='awe-btn btn-block'>Filter</button>							
			</div>
		</div>
	</div>
{!! Form::close() !!}