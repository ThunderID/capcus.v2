<div class='mb-sm'>	
	<a class="btn btn-primary" data-toggle="modal" href='#modal-add-image'><span class="fa fa-image" aria-hidden="true"></span></a>
	{!! Form::text('images', '', ['class' => 'form-control', 'id' => 'images']) !!}

</div>	
<div class='row images_list'>
</div>

@section('js')
	<div class="modal fade" id="modal-add-image">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add Image</h4>
				</div>
				<div class="modal-body">

					{!! Form::text('image_index') !!}
					<div class='mb-sm'>
						<strong class='text-uppercase'>Image URL</strong>
						@if ($errors->has('image_url'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('image_url'))}}</span>
						@endif
						{!! Form::text('image_url', '', [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('image_url') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('image_url') ? $errors->first('image_url') : ''), 
																]) 
						!!}
					</div>

					<div class='mb-sm'>
						<strong class='text-uppercase'>Title</strong>
						@if ($errors->has('title'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('title'))}}</span>
						@endif
						{!! Form::text('title', '', [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('title') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'title' 			=> ($errors->has('title') ? $errors->first('title') : ''), 
																]) 
						!!}
					</div>


					<div class='mb-sm'>
						<strong class='text-uppercase'>Description</strong>
						@if ($errors->has('description'))
							<span class='text-danger pull-right'>{{implode(', ', $errors->get('description'))}}</span>
						@endif
						{!! Form::textarea('description', '', [
																'class' 			=> 'form-control', 
																'required' 			=> 'required',
																'data-toggle' 		=> ($errors->has('description') ? 'tooltip' : ''), 
																'data-placement' 	=> 'bottom', 
																'description' 			=> ($errors->has('description') ? $errors->first('description') : ''), 
																]) 
						!!}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id='btn_add_image'>Save changes</button>
				</div>
			</div>
		</div>
	</div>
	@parent


	<script>
		var images = [];

		// ADD IMAGE
		$('#btn_add_image').click(function(event) {
			/* Act on the event */
			var obj_btn = $(this);
			var obj_image_index 	= $(this).parent().parent().find('text[name=image_index]');
			var obj_image_url 		= $(this).parent().parent().find('input[name=image_url]');
			var obj_title 			= $(this).parent().parent().find('input[name=title]');
			var obj_description 	= $(this).parent().parent().find('textarea[name=description]');

			if (obj_image_url.val() && obj_title.val())
			{
				if (typeof obj_image_index.val() == 'undefined')
				{
					images.push({image_url: obj_image_url.val(), title: obj_title.val(), description:obj_description.val()});
				}
				else
				{
					images[obj_image_index.val()] = {image_url: obj_image_url.val(), title: obj_title.val(), description:obj_description.val()};
				}
				
				
				$('#images').val(JSON.stringify(images));
				obj_btn.parents('.modal').modal('hide');
				display_images();
			}
			else
			{
				error_message = "Invalid input.\n";
				if (!obj_image_url.val())
				{
					error_message += " - Please enter the image URL\n";
				}
				if (!obj_title.val())
				{
					error_message += " - Please enter the title of the image\n";
				}
			}

		});

		// delete
		$('.images_list').on('click', '.btn_delete_image', function(event){
			index = $(this).data('index');
			if (confirm('Are you sure to delete this?'))
			{
				images.splice(index,1);
				display_images();
			}
			else
			{
				event.preventDefault();
			}
		})

		$('#modal-add-image').on('shown.bs.modal', function(event){
			var modal = $(this);
			var i = $(event.relatedTarget).data('index');

			if (typeof i !== 'undefined')
			{
				if (typeof images[i] !== 'undefined')
				{
					modal.find('text[name=image_index]').val(i);
					modal.find('input[name=image_url]').val(images[i].image_url);
					modal.find('input[name=title]').val(images[i].title);
					modal.find('textarea[name=description]').val(images[i].description);
				}
			}
		});

		$('#modal-add-image').on('hidden.bs.modal', function(event){
			var obj_image_index 	= $(this).find('text[name=image_index]');
			var obj_image_url 		= $(this).find('input[name=image_url]');
			var obj_title 			= $(this).find('input[name=title]');
			var obj_description 	= $(this).find('textarea[name=description]');


			obj_image_index.val('');
			obj_image_url.val('');
			obj_title.val('');
			obj_description.val('');
		});


		// DISPLAY IMAGE
		function display_images()
		{
			var html = '';
			var index = 0;
			$('.images_list').html('');
			images.forEach(function(image) {
				html += '<div class="col-xs-12 col-sm-4">' 								 + 
											'<div class="thumbnail">' 										 + 
												'<img src="'+image.image_url+'" alt="">' 					 + 
													'<div class="caption">' 								 + 
														'<h3>'+image.title+'</h3>' 							 + 
														'<p>'												 +
															image.description								 +
														'</p>'												 +
														'<p class="mt-md text-center">'												 +
															'<a class="btn btn-primary btn_edit_image" data-index="'+index+'" data-toggle="modal" href="#modal-add-image">Edit</a> ' + 
															'<a class="btn btn-default btn_delete_image" data-index="'+index+'">Delete</a>' +
														'</p>' 												 + 
													'</div>' 												 + 
												'</div>'													 +
											'</div>'														 +
										'</div>';
				index++;
			});
			$('.images_list').html(html);
		}
	</script>
@stop