<p>Untuk mendapatkan informasi penawaran paket tour dan informasi travelling terbaru dari kami, silahkan isikan email anda di bawah ini

{!! Form::open(['url' => route('web.subscription.add'), 'method' => 'post']) !!}
	<div class="input-group">
		<input type="text" class="pt-0 pb-0 form-control" placeholder="me@email.com" style='height:35px !important' name='email'>
		<span class="input-group-btn">
			<button class="btn btn-yellow" type="submit">Subscribe</button>
		</span>
	</div><!-- /input-group -->
{!! Form::close() !!}

