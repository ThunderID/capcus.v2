@section('content_1')
	<section class="awe-parallax" style="background-position: 50% 12px;">
		<div class="awe-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xs-push-3 text-black">
					<h3 class='mb-lg mt-xxxl text-uppercase'>Contact Us!</h3>

					{!! Form::open(['method' => 'post', 'url' => route('web.about.contactus.post')]) !!}

					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label>Name</label>
							{!! Form::text('name', '', ['class' => 'form-control'] )!!}
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<label>Email</label>
							{!! Form::text('email', '', ['class' => 'form-control'] )!!}
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-sm">
							<label>Messages</label>
							<br>{!! Form::textarea('messages', '', ['rows' => 10, 'style' => 'width:100%;height:auto !important'] )!!}
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-md">
							<button type='submit' class='btn btn-yellow btn-block'>Kirim</button>
						</div>
					</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</section>
@stop

@section('search_tour_tab')
@stop

@section('content_2')
@stop