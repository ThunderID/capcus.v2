{!! Html::style('plugins/select2/css/select2.min.css') !!}
{!! Html::script('plugins/select2/js/select2.min.js') !!}

<script>
	// ---------------------------- BASIC SELECT2 ----------------------------
	$('.select2').select2();
	$('.select2-tags').select2({
		tags: true
	});

	// ---------------------------- SELECT2 ARTICLE ----------------------------
	$('.select2-article').select2({
		ajax: {
			url: "{{route('api.article.latest')}}",
			dataType: 'json',
			delay: 250,
			data: function (params) {
					return {
						q: params.term
					};
				},
			processResults: function (data, page) {
						return {
							results: data
						};
					},
			cache: true
		},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 3,
		templateResult: function(repo) { 
			if (repo.loading) return repo.text;
			return repo.title + ' (By: ' + repo.user.name + ', Published At: ' + repo.published_at + ')';
		},
		templateSelection: function(repo) { 
			return repo.title || repo.text;
		}
	});
</script>
