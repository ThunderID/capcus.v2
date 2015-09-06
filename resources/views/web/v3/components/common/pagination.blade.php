<?php
	$required_variables = ['start_pagination', 'last_pagination', 'current_page', 'route_name', 'appends' ];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.pagination: ' . $x . ": Required", 1);
		}
	}

	if (!is_array($appends))
	{
		$appends = [];
	}
?>


<div class="page__pagination">
	@if ($start_pagination == 1)
		<a href="{{ route($route_name)}}" class='pagination-prev'><i class="fa fa-caret-left"></i></a>
	@else
		<a href="{{ route($route_name, $appends + ['page' => $current_page - 1])}}" class='pagination-prev'><i class="fa fa-caret-left"></i></a>
	@endif
	@for ($i = $start_pagination; $i <= $last_pagination; $i++ )
		<a href="{{ route($route_name, $appends + ['page' => ($i == 1 ? null : $i)]) }}" class="{{$i == $current_page ? 'current' : ''}}">{{$i}}</a>
	@endfor
	@if ($last_pagination == $current_page)
		<a href="{{ route($route_name, $appends + ['page' => ($last_pagination == 1? null : $last_pagination)]) }}" class='pagination-next'><i class="fa fa-caret-right"></i></a>
	@else
		<a href="{{ route($route_name, $appends + ['page' => $current_page+1]) }}" class='pagination-next'><i class="fa fa-caret-right"></i></a>
	@endif
</div>