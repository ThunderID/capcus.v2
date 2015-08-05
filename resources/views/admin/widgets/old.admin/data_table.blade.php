<?php 
	$filters = array_only($UserComposer['widget_data']['data'], ['filter_user_name']);
?>

@extends('admin.widget_templates.' . ($widget_template ? $widget_template : 'plain_no_title'))

@if (!$widget_error_count)
	@section('widget_title')
		@if (method_exists($UserComposer['widget_data']['data']['user_db'], 'total'))
			{{number_format($UserComposer['widget_data']['data']['user_db']->total())}} results :
		@else
			{{number_format($UserComposer['widget_data']['data']['user_db']->count())}} results :
		@endif

		@if (count(array_filter($filters)))

			@if ($UserComposer['widget_data']['data']['filter_user_name'])
				<a href='{{route("admin.admin.index", array_except($filters, "filter_user_title"))}}' class="label label-primary ml-xs">
					<i class='glyphicon glyphicon-remove'></i> 
					Name: 
					*{{$UserComposer['widget_data']['data']['filter_user_name'] . '*'}}
				</a>
			@endif

		@else
			all {{str_replace('_', ' ', $view_name)}}
		@endif
	@overwrite

	@section('widget_body')
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Since</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				@forelse ($UserComposer['widget_data']['data']['user_db'] as $x)
					<tr>
						<td>
							@if (method_exists($UserComposer['widget_data']['data']['user_db'], 'firstItem'))
								{{$UserComposer['widget_data']['data']['user_db']->firstItem() + $i++}}
							@else
								{{++$i}}
							@endif
						</td>
						<td>{{$x->name}}</td>
						<td>{{$x->email}}</td>
						<td>{{$x->created_at->diffForHumans()}}</td>
						<td class='text-right'>
							<div class="btn-group">
								<a href='{{route("admin.admin.edit", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></a>
							</div>
							<div class="btn-group">
								<a href='{{route("admin.admin.show", ["id" => $x->id])}}' type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></a>
							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan='6'>
							No data found
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		<hr>
		<div class="text-center">
			@if ($UserComposer['widget_data']['data']['user_db'])
				@if (method_exists($UserComposer['widget_data']['data']['user_db'], 'firstItem'))
					@if ($UserComposer['widget_data']['data']['user_db']->total())
						Displaying {{ $UserComposer['widget_data']['data']['user_db']->total() > 0 ? $UserComposer['widget_data']['data']['user_db']->firstItem() . ' - ' . $UserComposer['widget_data']['data']['user_db']->lastItem() : 0 }} of {!! $UserComposer['widget_data']['data']['user_db']->total() !!} 
						<div>{!! $UserComposer['widget_data']['data']['user_db']->appends($filters)->render() !!}</div>
					@else
						0 Results
					@endif
				@endif
			@endif
		</div>
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif