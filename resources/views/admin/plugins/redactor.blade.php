{!! Html::script(asset('plugins/redactor/redactor.min.js')) !!}
{!! Html::style(asset('plugins/redactor/redactor.css')) !!}

<script>
	$('.wysiwyg').redactor({
		minHeight : $(this).attr('data-height') ? $(this).attr('data-height') + 'px' : 500,
		toolbarFixed: true,
		image_dir : "images"
	});
</script>