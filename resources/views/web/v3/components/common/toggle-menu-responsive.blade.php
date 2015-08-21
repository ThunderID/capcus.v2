<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.toggle-menu-responsive: ' . $x . ": Required", 1);
		}
	}
?>

<a class="toggle-menu-responsive" href="#">
	<div class="hamburger">
		<span class="item item-1"></span>
		<span class="item item-2"></span>
		<span class="item item-3"></span>
	</div>
</a>