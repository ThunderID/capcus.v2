@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or "Schedule Form"}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.tour.schedules.store', ['tour_id' => $TourComposer['widget_data']['data']['tour_db']->id, 'id' => $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="mb-xs">
					<strong class='text-uppercase'>Departure At</strong>
					@if ($errors->has('depart_at'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('depart_at'))}}</span>
					@endif

					{!! Form::input('datetime-local', 'depart_at', ($TourScheduleComposer['widget_data']['data']['tour_schedule_db']->depart_at ? $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->depart_at->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('depart_at') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('depart_at') ? $errors->first('depart_at') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Return At</strong>
					@if ($errors->has('return_at'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('return_at'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'return_at', ($TourScheduleComposer['widget_data']['data']['tour_schedule_db']->return_at ? $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->return_at->format('d/m/Y H:i') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy hh:mm',
																						'data-toggle'		=> ($errors->has('return_at') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('return_at') ? $errors->first('return_at') : ''), 
																						'data-inputmask'	=> "'alias':'datetime'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Currency Used </strong>
					@if ($errors->has('currency'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('currency'))}}</span>
					@endif
					{!! Form::select('currency', ['IDR' => 'IDR', 'USD' => 'USD'], $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->currency, [
																						'class' 			=> 'form-control select2',
																						'placeholder'		=> 'enter the currency',
																						'data-toggle'		=> ($errors->has('currency') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('currency') ? $errors->first('currency') : ''), 
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Price </strong>
					@if ($errors->has('price'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('price'))}}</span>
					@endif
					{!! Form::input('numeric', 'price', $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->price, [
																	'class' 			=> 'form-control',
																	'placeholder'		=> 'enter the price',
																	'data-toggle'		=> ($errors->has('price') ? 'tooltip' : ''), 
																	'data-placement'	=> 'left', 
																	'title' 			=> ($errors->has('price') ? $errors->first('price') : ''), 
																 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Discount </strong>
					@if ($errors->has('discount'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('discount'))}}</span>
					@endif
					{!! Form::input('numeric', 'discount', $TourScheduleComposer['widget_data']['data']['tour_schedule_db']->discount, [
																	'class' 			=> 'form-control',
																	'placeholder'		=> 'enter the discount (same currency as price)',
																	'data-toggle'		=> ($errors->has('discount') ? 'tooltip' : ''), 
																	'data-placement'	=> 'left', 
																	'title' 			=> ($errors->has('discount') ? $errors->first('discount') : ''), 
																 ])
					!!}
				</div>

				<div class="col-xs-offset-4 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<button type='submit' class='btn btn-default btn-block mt-sm'>Save</button>
				</div>
			</div>
		</div>

		{!! Form::close() !!}
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif