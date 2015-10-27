<?php
	$required_variables = ['articles', 'colcount_xs', 'colcount_sm', 'colcount_md', 'colcount_lg'];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception($widget_name . ":" . $x . ": Required", 1);
		}
	}

	if (12 % $colcount_xs != 0)
	{
		throw new Exception($widget_name . ": colcount_xs : must be a factor of 12", 1);
	}

	if (12 % $colcount_sm != 0)
	{
		throw new Exception($widget_name . ": colcount_sm : must be a factor of 12", 1);
	}

	if (12 % $colcount_md != 0)
	{
		throw new Exception($widget_name . ": colcount_md : must be a factor of 12", 1);
	}

	if (12 % $colcount_lg != 0)
	{
		throw new Exception($widget_name . ": colcount_lg : must be a factor of 12", 1);
	}

	$col_xs = 12 / $colcount_xs;
	$col_sm = 12 / $colcount_sm;
	$col_md = 12 / $colcount_md;
	$col_lg = 12 / $colcount_lg;
?>

<div class="row">
	@forelse ($articles as $article)
		<div class="col-xs-{{$col_xs}} col-sm-{{$col_sm}} col-md-{{$col_md}} col-lg-{{$col_lg}} mb-lg blog-grid">
			<a href="{{ route('web.blog.show', ['year' => $article->published_at->year, 'month' => $article->published_at->month, 'slug' => $article->slug])}}">
				<img src="{{ $article->images->where('name', 'SmallImage')->first()->path }}" alt="{{$article->title}}" class="fullwidth image43">
				<div class='title'>
					{{$article->title}}
				</div>
			</a>
			<div class='content'>
				<div>
					{{$article->summary}}
				</div>
			</div>
		</div>
	@empty
	@endforelse
</div>