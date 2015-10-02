<?php
	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['homegrids'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		Homepage Grid
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Grid #</th>
					<th>Type</th>
					<th>Title</th>
					<th>Configuration</th>
					<th>Link To</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@for ($i = 1; $i <= 12; $i++)
					<tr class='text-regular'>
						<td>{{$i}}</td>
						@if ($homegrids instanceOf \Illuminate\Support\Collection)
							<?php $i = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
							<td>
								{{ $homegrids->where('name', 'homegrid_' . $i)->first()->type }}
								@if ($homegrids->where('name', 'homegrid_' . $i)->first()->is_featured)
									<br><span class="label label-info">Featured</span>
								@endif
							</td>
							<td>{{ $homegrids->where('name', 'homegrid_' . $i)->first()->title }}</td>
							<td>
								@if (str_is('destination', $homegrids->where('name', 'homegrid_' . $i)->first()->type) || str_is('featured_destination', $homegrids->where('name', 'homegrid_' . $i)->first()->type))
									<p><strong>Destination</strong><br>{{ $homegrids->where('name', 'homegrid_' . $i)->first()->destination_detail->long_name }}</p>

								@elseif (str_is('tour_tags', $homegrids->where('name', 'homegrid_' . $i)->first()->type))
									<p><strong>Tag</strong><br>{{ $homegrids->where('name', 'homegrid_' . $i)->first()->tag_detail->tag }}</p>

								@elseif (str_is('script', $homegrids->where('name', 'homegrid_' . $i)->first()->type))
									<p><strong>Script</strong><br>{{ $homegrids->where('name', 'homegrid_' . $i)->first()->script }}</p>

								@elseif (str_is('link', $homegrids->where('name', 'homegrid_' . $i)->first()->type))
									<p><strong>Link</strong><br>{{ $homegrids->where('name', 'homegrid_' . $i)->first()->link }}</p>
								@endif
								<p><strong>Image</strong><br><a href="{{ $homegrids->where('name', 'homegrid_' . $i)->first()->image_url }}" target="_blank">{{ $homegrids->where('name', 'homegrid_' . $i)->first()->image_url }}</a></p>
							</td>
						@else
							<td colspan='2'>Has not been set</td>
						@endif
						<td>
							<a href="{{ route('admin.settings.home.homegrids.edit', ['grid_id' => $i])}} " class="btn btn-link">Edit</a>
						</td>
					</tr>
				@endfor
			</tbody>
		</table>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif