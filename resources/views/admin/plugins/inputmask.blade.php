{!! HTML::script(asset('plugins/jquery.inputmask/jquery.inputmask.bundle.min.js')) !!}

<script>
	$(document).ready(function(){
		$(":input").inputmask();
	});
</script>
