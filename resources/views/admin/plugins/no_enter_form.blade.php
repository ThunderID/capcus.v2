<script>
	$('form.no_enter input, form.no_enter select').on("keyup keypress", function(e) {
		var code = e.keyCode || e.which; 
		if (code  == 13) 
		{
			e.preventDefault();
			return false;
		}
	});
</script>