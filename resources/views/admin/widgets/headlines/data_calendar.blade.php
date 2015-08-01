<?php 
	$filters = array_only($HeadlineComposer['widget_data']['data'], ['filter_headline_since', 'filter_headline_until']);

	// prepare UI for calendar
	$events = [];
	try {

		foreach ($HeadlineComposer['widget_data']['data']['headline_db'] as $v)
		{
			$events[] = ['id' 	=> $v->id, 
			             'title'=> $v->name, 
			             'url'	=> route('admin.headlines.show', ['id' => $v->id]),
			             'class'=> 'event_info',
			             'start'=> $v->active_since->format('Y-m-d H:i:s'),
			             'end'	=> $v->active_until->format('Y-m-d H:i:s'),
			             'backgroundColor' => "#fff",
			             ];
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
			@if ($HeadlineComposer['widget_data']['data']['headline_db'])
				@if (method_exists($HeadlineComposer['widget_data']['data']['headline_db'], 'firstItem'))
					@if ($HeadlineComposer['widget_data']['data']['headline_db']->total())
						Displaying {{ $HeadlineComposer['widget_data']['data']['headline_db']->total() > 0 ? $HeadlineComposer['widget_data']['data']['headline_db']->firstItem() . ' - ' . $HeadlineComposer['widget_data']['data']['headline_db']->lastItem() : 0 }} of {!! $HeadlineComposer['widget_data']['data']['headline_db']->total() !!} 
						<div>{!! $HeadlineComposer['widget_data']['data']['headline_db']->appends($filters)->render() !!}</div>
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

			$('#calendar .fc-right').append(
											'<a href="{{ route('admin.headlines.index', ['filter_headline_month' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $filters['filter_headline_since'])->subMonth()->format('m'), 'filter_headline_year' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $filters['filter_headline_since'])->subMonth()->format('Y') ]) }}" class="btn btn-default btn-sm" style="width:40px;font-weight:bold;"><i class="fa fa-chevron-left"></i></a>' + 
											'<a href="{{ route('admin.headlines.index', ['filter_headline_month' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $filters['filter_headline_since'])->addMonth()->format('m'), 'filter_headline_year' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $filters['filter_headline_since'])->addMonth()->format('Y')])}}" class="btn btn-default btn-sm" style="width:40px;font-weight:bold;"><i class="fa fa-chevron-right"></i></a>'
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