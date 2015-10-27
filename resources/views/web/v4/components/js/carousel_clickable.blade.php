<script>
	$('.carousel-inner').on('click', 'img', function(event) {
		/* Act on the event */
		if ($(this).data('link') != 'undefined')
		{
			window.open($(this).data('link'), '_blank');
		}
	});
</script>