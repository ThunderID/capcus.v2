<?php
	if ($VendorComposer['widget_data']['data']['filter_vendor_subscription_id'])
	{	
		$subscription = $VendorComposer['widget_data']['data']['vendor_db']->subscriptions->find($VendorComposer['widget_data']['data']['filter_vendor_subscription_id']);
	}
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		{{$widget_title or (!$VendorSubscriptionComposer['widget_data']['data']['vendor_subscription_db']->id ? "Add New Subscription" : "Edit Subscription: " . $VendorSubscriptionComposer['widget_data']['data']['vendor_subscription_db']->since->format('d-m-Y') . ' to ' . $VendorSubscriptionComposer['widget_data']['data']['vendor_subscription_db']->until->format('d-m-Y'))}}
	@overwrite

	@section('widget_body')
		{!! Form::open(['method' => 'post', 'url' => route('admin.vendor.subscription.store', ['vendor_id' => $VendorComposer['widget_data']['data']['vendor_db']->id, 'subscription_id' => $subscription->id]), 'class' => 'no_enter' ]) !!}
		<div class="row mb-lg">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="mb-xs">
					<strong class='text-uppercase'>Since (date)</strong>
					@if ($errors->has('since'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('since'))}}</span>
					@endif

					{!! Form::input('datetime-local', 'since', ($subscription->id ? \Carbon\Carbon::parse($subscription->since)->format('d/m/Y') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('since') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('since') ? $errors->first('since') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Until (date)</strong>
					@if ($errors->has('until'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('until'))}}</span>
					@endif
					{!! Form::input('datetime-local', 'until', ($subscription->id ? \Carbon\Carbon::parse($subscription->until)->format('d/m/Y') : ''), [
																						'class' 			=> 'form-control',
																						'placeholder'		=> 'dd/mm/yyyy',
																						'data-toggle'		=> ($errors->has('until') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('until') ? $errors->first('until') : ''), 
																						'data-inputmask'	=> "'alias':'date'"
																					 ])
					!!}
				</div>

				<div class="mb-xs">
					<strong class='text-uppercase'>Subscription </strong>
					@if ($errors->has('subscription'))
						<span class='text-danger pull-right'>{{implode(', ', $errors->get('subscription'))}}</span>
					@endif
					{!! Form::select('subscription', $CategoryComposer['widget_data']['data']['category_db']->lists('path_name', 'id'), $subscription->category_id, [ 
																						'class' 			=> 'form-control select2',
																						'placeholder'		=> 'enter the subscription',
																						'data-toggle'		=> ($errors->has('subscription') ? 'tooltip' : ''), 
																						'data-placement'	=> 'left', 
																						'title' 			=> ($errors->has('subscription') ? $errors->first('subscription') : ''), 
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