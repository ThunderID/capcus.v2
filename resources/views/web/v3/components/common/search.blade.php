<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.search: ' . $x . ": Required", 1);
		}
	}
?>

<div class="search-box">
	<span class="searchtoggle"><i class="awe-icon awe-icon-search"></i></span>
	{!! Form::open(['url' => route('web.home'), 'method' => 'GET', 'class' => 'form-search']) !!}
		<div class="form-item">
			<input type="text" value="Search &amp; hit enter">
		</div>
	{!! Form::close() !!}
	</form>
</div>