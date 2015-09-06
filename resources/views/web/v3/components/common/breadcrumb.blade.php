<?php
	$required_variables = ['links'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('common.breadcrumb: ' . $x . ": Required", 1);
		}
	}
?>

<div class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<ul>
					@forelse ($links as $label => $url)
						@if ($url)
							<li><a href="{{ $url }}">{{$label}}</a></li>
						@else
							<li><span>{{ $label }}</span></li>
						@endif
					@empty
					@endforelse
				</ul>
			</div>
		</div>
	</div>
</div>