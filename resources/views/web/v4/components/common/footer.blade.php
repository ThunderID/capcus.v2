<?php
	$required_variables = [];
	foreach ($required_variables as $x)
	{
		if (!array_key_exists($x, get_defined_vars(oid)))
		{
			throw new Exception('web.v3.components.common.footer: ' . $x . ": Required", 1);
		}
	}
?>

<div class="row">
	{{-- WIDGET --}}
	<div class="col-md-3 mb-xl">
		{!! Html::image('images/logo/logo-new-white.png', 'Capcus.id', ['class' => 'hidden-sm hidden-xs']) !!}
		{!! Html::image('images/logo/logo-new-white.png', 'Capcus.id', ['class' => 'hidden-md hidden-lg']) !!}

		<p class='mt-lg ml-md'>
			THE CEO BUILDING, Lv 12
			<br>Jl. TB Simatupang No. 18C
			<br>Jakarta Selatan 12430, Indonesia
			<br><a href="mailto:contact@capcus.id" class='text-yellow'>contact[at]capcus.id</a>
			<br>&nbsp;
			<br class='mt-lg'>©2015 CAPCUS.ID. All rights reserved
		</p>


	</div>
	{{-- END / WIDGET --}}

	{{-- WIDGET --}}
	<div class="col-md-6 mb-xl">
		<h3 class='text-yellow'>Tentang Capcus</h3>
		<p>
			CAPCUS menyediakan kemudahan kepada travellers untuk mencari paket tour yang sesuai dengan kebutuhannya. 
			Tentunya paket tour tersebut diselenggarakan oleh travel agent yang bisa dipercaya karena CAPCUS telah
			memverifikasi travel agent yang telah menjadi partner kami.
		</p>
			
		<p>
			Dengan adanya CAPCUS, travellers tidak lagi ribet untuk mencari paket tour dengan menghubungi masing-masing
			travel agent dan mencari paket tour secara manual yang sesuai dengan kebutuhannya
		</p>

		<p>
			100% Free, No Booking Fee, No Other Fee!
		</p>

		<p>Lets Travel!</p>
		<a href="{{ route('web.about.tnc') }}">Term &amp; Condition</a>

	</div>
	{{-- END / WIDGET --}}

	{{-- WIDGET --}}
	<div class="col-md-3">
		<h3 class='text-yellow'>Stay Updated!</h3>
		@include('web.v4.components.common.subscribe')

		<h3 class='text-yellow'>Find us on Social Media</h3>
		<div class="socmed text-center">
			<a href="http://twitter.com/capcusid" class='mr-lg'><i class="fa fa-twitter"></i></a>
			<a href="http://facebook.com/capcusid" class='mr-lg'><i class="fa fa-facebook"></i></a>
			<a href="http://instagram.com/capcusid" class='mr-lg'><i class="fa fa-instagram"></i></a>
		</div>

		
	</div>
	{{-- END / WIDGET --}}
</div>
