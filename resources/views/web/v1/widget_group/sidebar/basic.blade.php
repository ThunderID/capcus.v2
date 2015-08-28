<div class="row hidden-xs hidden-md hidden-lg">
	<div class="hidden-xs col-sm-6 hidden-md hidden-lg">
			@include('web.v1.widgets.ads.250x250'		, ['widget_class' => 'mb-sm text-center'])
		</div>
		<div class="hidden-xs col-sm-6 hidden-md hidden-lg">
			@include('web.v1.widgets.ads.250x250'		, ['widget_class' => 'mb-sm text-center'])
		</div>
	</div>

	<div class='hidden-sm'>
		<div class='mb'>
			@include('web.v1.widgets.ads.250x250'			, ['widget_class' => 'mb-sm text-center'])
		</div>
	</div>

	@include('web.v1.widgets.newsletter.subscribe'			, ['widget_template' => 'well'])

	<div class='hidden-sm'>
		@include('web.v1.widgets.ads.250x250'			, ['widget_class' => 'mb-sm text-center'])
	</div>

	@include('web.v1.widgets.articles.list'		, [
		'widget_template' 	=> 'well',
		'articles'			=> $sidebar_article
	])

	@include('web.v1.widgets.categories.destinations.ranked'	, [
		'widget_template' 	=> 'well',
		'widget_title'	 	=> 'Top Destination',
		'destinations'		=> $top_destination
	])

	@include('web.v1.widgets.vendors.supported_by'		, [
		'widget_template' 	=> 'well',
		'widget_title'		=> 'Supported By',
		'vendors'			=> $supported_by
	])
</div>