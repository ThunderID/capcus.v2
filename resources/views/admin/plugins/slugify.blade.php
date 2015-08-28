	{!! Html::script(asset('plugins/slugify/jquery.slugify.js')) !!}

<script>
	$('.slugify').each( function() {
		$( this ).slugify('input[name='+$(this).attr('data-slugify')+']');
	});
</script>