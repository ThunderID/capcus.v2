<?php
	$required_variables = ['option_list', 'tour_schedule'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ': ' . $x . ": Required", 1);
		}
	}

	$simple_options = $option_list->reject(function($opt){
		switch (strtolower($opt->name))
		{
			case 'hotel': case 'flight':
				return true;
			default: 
				return false;
		}
	});

	$other_options = $option_list->reject(function($opt){
		switch (strtolower($opt->name))
		{
			case 'hotel': case 'flight':
				return false;
			default: 
				return true;
		}
	});
?>

<div class='row'>
	@foreach ($other_options as $option)
		<div class="col-xs-2 col-sm-3 col-md-3 col-lg-2">
			{{$option->name}}
		</div>
		<div class="col-xs-10 col-sm-9 col-md-9 col-lg-10">
			@if ($tour_schedule->tour->options->where('id', $option->id)->count())
				@if (is_numeric($tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description) && ($tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description <= 5))
					@for ($i = 1; $i <= 5; $i++)
						@if ($i <= $tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description)
							<i class='fa fa-star text-yellow'></i>
						@else
							<i class='fa fa-star-o text-yellow'></i>
						@endif
					@endfor
				@else
					{{$tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description}}
				@endif
			@else
				Not Included
			@endif
		</div>
	@endforeach
</div>

<div class="row mt-xs">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<b>Harga Termasuk:</b>
	</div>
	@foreach ($simple_options as $option)
		@if ($layout_style == 'list')
			@if ($tour_schedule->tour->options->where('id', $option->id)->count())
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<i class='fa fa-check-circle-o text-yellow'></i>
					{{$option->name}}
				</div>
			@endif
		@else
			@if ($tour_schedule->tour->options->where('id', $option->id)->count())
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
					<i class='fa fa-check-circle-o text-yellow'></i>
					{{$option->name}}
				</div>
			@endif
		@endif
	@endforeach
</div>

<div class="row mt-xs">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<b>Harga Belum Termasuk:</b>
	</div>
	@foreach ($simple_options as $option)
		@if ($layout_style == 'list')
			@if (!$tour_schedule->tour->options->where('id', $option->id)->count())
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<i class='fa fa-circle-o text-gray'></i>
					{{$option->name}}
				</div>
			@endif
		@else
			@if (!$tour_schedule->tour->options->where('id', $option->id)->count())
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
					<i class='fa fa-circle-o text-gray'></i>
					{{$option->name}}
				</div>
			@endif
		@endif
	@endforeach
</div>
{{-- <div class="row mt-xs">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<b>Detail Paket:</b>
	</div>
	@foreach ($simple_options as $option)
		@if ($layout_style == 'list')
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@if ($tour_schedule->tour->options->where('id', $option->id)->count())
					<i class='fa fa-check-circle-o text-yellow'></i>
				@else
					<i class='fa fa-circle-o'></i>
				@endif
				{{$option->name}}
			</div>
		@else
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
				@if ($tour_schedule->tour->options->where('id', $option->id)->count())
					<i class='fa fa-check-circle-o text-yellow'></i>
				@else
					<i class='fa fa-circle-o'></i>
				@endif
				{{$option->name}}
			</div>
		@endif
	@endforeach
</div> --}}


{{-- <table class="table bg-transparent">
	<thead>
		<tr>
			<th colspan="2" class='border-bottom-1'>Include/Exclude</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($option_list as $option)
			<tr>
				<td valign="top">
					@if ($tour_schedule->tour->options->where('id', $option->id)->count())
						<i class='fa fa-check-circle-o text-yellow'></i>
					@else
						<i class='fa fa-circle-o'></i>
					@endif
					<strong>{{$option->name}}</strong> 
				</td>
				<td valign="top">
					<span class='pl-md'>
						@if (is_numeric($tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description) && ($tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description <= 5))
							@for ($i = 1; $i <= 5; $i++)
								@if ($i <= $tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description)
									<i class='fa fa-star text-yellow'></i>
								@else
									<i class='fa fa-star-o text-yellow'></i>
								@endif
							@endfor
						@else
							{{$tour_schedule->tour->options->where('id', $option->id)->first()->pivot->description}}
						@endif
					</span>
				</td>
			</tr>
		@endforeach
	</tbody>
</table> --}}