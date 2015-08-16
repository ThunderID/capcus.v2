<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('admin.v2.components.common.carousel: ' . $x . ": Required", 1);
		}
	}
?>

@for ($i = 1; $i <= 12; $i++)
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="panel panel-default">
			  <div class="panel-body">
					Panel content
			  </div>
		</div>
	</div>
@endfor