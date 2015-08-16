<?php

	// ------------------------------------------------------------------------------------------------------------------------
	// REQUIRED VARIABLES
	// ------------------------------------------------------------------------------------------------------------------------
	$required_variables = ['headlines', 'filters'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars()))
		{
			throw new Exception($widget_name . ": $" .$x.': has not been set', 10);
		}
	}

	// ------------------------------------------------------------------------------------------------------------------------
	// PREDEFINED VARIABLE
	// ------------------------------------------------------------------------------------------------------------------------
	// prepare UI for calendar
	$events = [];
	try {

		if ($headlines)
		{
			foreach ($headlines as $v)
			{
				$events[] = ['id' 	=> $v->id, 
							 'title'=> $v->title . ' (Priority: '.$v->priority.')', 
							 'url'	=> route('admin.'.$route_name.'.show', ['id' => $v->id]),
							 'class'=> 'event_info',
							 'start'=> $v->active_since->format('Y-m-d H:i:s'),
							 'end'	=> $v->active_until->format('Y-m-d H:i:s'),
							 'backgroundColor' => "#fff",
							 ];
			}
		}
	} catch (Exception $e) {
		
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		Headlines
	@overwrite

 	@section('widget_body')
		<div id='calendar'></div>
		<hr>
		<div id="text-center">
			@if ($headlines)
				@if (method_exists($headlines, 'firstItem'))
					@if ($headlines->total())
						Displaying {{ $headlines->total() > 0 ? $headlines->firstItem() . ' - ' . $headlines->lastItem() : 0 }} of {!! $headlines->total() !!} 
						<div>{!! $headlines->appends($filters)->render() !!}</div>
					@else
						0 Results
					@endif
				@endif
			@endif
		</div>
	@overwrite

	@section('js')
		
		@parent

		{!! Html::script('plugins/fullcalendar/lib/moment.min.js') !!}
		{!! Html::script('plugins/fullcalendar/fullcalendar.min.js') !!}

		<script type="text/javascript">
			$('#calendar').fullCalendar({
				defaultDate: moment('{{$filters['filter_headline_since']}}', 'YYYYMMDD'),
				header: { 
					left: 'title',
					center: '',
					right: ''
				},
				eventLimit: true, // allow "more" link when too many events
				eventColor: '#0090c0',
				eventTextColor: '#0090c0',
				events: {!! json_encode($events) !!}
			});
			
			$('#calendar .fc-right').append('<a href="{{ 
															route('admin.'.$route_name.'.index', [
																							'filter_headline_month' => $filters['filter_headline_since']->subMonth()->month, 
																							'filter_headline_year' 	=> $filters['filter_headline_since']->year
																							]) 
														}}" class="btn btn-default btn-sm" style="width:40px;font-weight:bold;"><i class="fa fa-chevron-left"></i></a>' + 
														'<a href="{{ route('admin.'.$route_name.'.index', ['filter_headline_month' => $filters['filter_headline_since']->addMonth(2)->month, 'filter_headline_year' => $filters['filter_headline_since']->year]) }}" class="btn btn-default btn-sm" style="width:40px;font-weight:bold;"><i class="fa fa-chevron-right"></i></a>' 
											);
			
		</script>
	@overwrite

	@section('css')
		@parent
		{!! Html::style('plugins/fullcalendar/fullcalendar.min.css') !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif