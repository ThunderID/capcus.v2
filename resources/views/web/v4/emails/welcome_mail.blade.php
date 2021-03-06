<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<!-- If you delete this meta tag, Half Life 3 will never be released.-->
	<!-- Template by marcosilva.co.uk, base on Zurb responsive templates and boiler plate, images and copy from http://www.hardgraft.com/ -->
		
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>CAPCUS - Welcome {{ $user->name }}</title>
	<style type="text/css">

		/* ------------------------------------- 		GLOBAL ------------------------------------- */
		* {
			margin:0;
			padding:0;
		}
		* {
			font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;
		}
		img {
				max-width:100%;
		}
		.collapse {
			padding-right:15px;
			padding:0;
		}
		body {
			-webkit-font-smoothing:antialiased;
				-webkit-text-size-adjust:none;
				width:100%!important;
				height: 100%;
		}
		/* ------------------------------------- 		ELEMENTS ------------------------------------- */
		a {
			color:#0091EA;
			font-size:12px;
		}
		.bt {
			padding-top:10px;
		}
		p.callout {
			padding:9px;
			font-size:12px;
		}
		p.text {
			padding-left:5px;
			font-size:12px;
		}
		p.left {
			padding:5px;
			font-size:12px;
			text-align:left;
		}
		.prod {
			margin:0;
			padding:0;
			color:#aaaaaa;
		}
		.callout a {
			font-weight:bold;
			color: #aaaaaa;
		}
		/* ------------------------------------- 		HEADER ------------------------------------- */
		table.head-wrap {
			width:100%;
		}
		.header.container table td.logo {
			padding:15px;
		}
		.header.container table td.label {
			padding:15px;
			padding-left: 0px;
		}
		/* ------------------------------------- 		BODY ------------------------------------- */
		table.body-wrap {
			width: 100%;
		}
		/* ------------------------------------- FOOTER------------------------------------- */
		table.footer-wrap {
			width:100%;
		    background-color: #FFD34E;
		    height: 50px;
		}
		table.footer-wrap2 {
			width: 100%;
		}
		}
		/* ------------------------------------- 		TYPOGRAPHY ------------------------------------- */
		h1,h2,h3,h4,h5,h6 {
		font-family:"Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
		line-height:1.1;
		margin-bottom:5px;
		color:#000;
		}
		h1 small,h2 small,h3 small,h4 small,h5 small,h6 small {
		font-size:60%;
		color:#6f6f6f;
		line-height:0;
		text-transform:none;
		}
		h1 {
		font-weight:200;
		font-size:18px;
		padding:20px;
		letter-spacing:3px;
		font-weight:300;
		}
		h2 {
		font-weight:200;
		font-size:37px;
		}
		h3 {
		font-weight:500;
		font-size:27px;
		}
		h4 {
		font-weight:500;
		font-size:23px;
		}
		h5 {
		font-weight:900;
		font-size:13px;
		color:#c2a67e;
		}
		h6 {
		font-weight:900;
		font-size:14px;
		text-transform:uppercase;
		color:#444;

		}
		h7 {
		font-weight:900;
		font-size:14px;
		text-transform:uppercase;
		color:#444;
		padding:5px;
		}
		.collapse {
		margin:0!important;
		}
		p,ul {
			margin-bottom:2px;
			font-weight:normal;
			font-size:12px;
			line-height:2;
		}
		p.lead {
		font-size:13px;
		}
		p.last {
		margin-bottom:0px;
		}
		ul li {
		margin-left:5px;
		list-style-position: inside;
		}
		/* --------------------------------------------------- 		RESPONSIVENESS		Nuke it from orbit. ------------------------------------------------------ */
		/* Set a max-width,and make it display as block so it will automatically stretch to that width,but will also shrink down on a phone or something */
		.container {
		display:block!important;
		max-width:600px!important;
		margin:0 auto!important;
		/* makes it centered */
		clear:both!important;
		}
		/* This should also be a block element,so that it will fill 100% of the .container */
		.content {
		padding:5px;
		max-width:600px;
		margin:0 auto;
		display: block;
		}

		/* Let's make sure tables in the content area are 100% wide */
		.content table {
		width: 100%;
		}
		/* Odds and ends */
		.column {
		width:300px;
		float:left;
		}
		.column tr td {
		padding:5px;
		}
		.column-wrap {
			padding:0!important;
			margin:0 auto;
			max-width:600px!important;
		}
		.column table {
		width:100%;
		}
		.social .column {
		width:280px;
		min-width:279px;
		float:left;
		}
		.column3 {
		width:300px;
		float:left;
		}
		.column3 tr td {
		padding:1px;
		}
		.column3-wrap {
			padding:0!important;
			margin:0 auto;
			max-width:600px!important;
		}
		.column3 table {
		width:100%;
		}
		.column2 {
		width:240px;
			float:left;
		}
		.column2 tr td {
		padding:5px;
		}
		.column2-wrap {
			padding:0!important;
			margin:0 auto;
			max-width:600px!important;
		}
		.column2 table {
		width:100%;
		}
		.social .column {
		width:280px;
		min-width:279px;
		float: left;
		}
		/* Odds and ends */
		.prod {
		width:200px;
		float:left;
		}
		.prod tr td {
		padding:5px;
		}
		.prod-wrap {
			padding:0!important;
			margin:0 auto;
			max-width:600px!important;
		}
		.prod table {
		width:100%;
		}
		.prod .column {
		width:200px;
		min-width:200px;
		float: left;
		}
		/* Be sure to place a .clear element after each set of columns,just to be safe */
		.clear {
		display:block;
		clear: both;
		}
		/* ------------------------------------------- 		PHONE		For clients that support media queries.		Nothing fancy. -------------------------------------------- */
		@media only screen and (max-width:600px) {
			a[class="btn"] {
			display:block!important;
			margin-bottom:10px!important;
			background-image:none!important;
			margin-right:0!important;
		}
		div[class="column"] {
			width:auto!important;
			float:none!important;
		}
		div[class="column2"] {
			width:auto!important;
			float:none!important;
		}
		div[class="column3"] {
			width:auto!important;
			float:none!important;
		}
		table[class="top"] {
			width:auto!important;
			float:none!important;
		}
		.prod {
			width:150px;
			float:left;
		}
				table.social div[class="column"] {
				width: auto!important;
		}
		}
	</style>
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
	<img editable="true" />
	{{-- TOP --}}
	<table class="head-wrap" bgcolor="#FFD34E">
	<tr>
		<td></td>
		<td class="header container">
			<div class="content">
				<table bgcolor="#FFD34E" class="">
				<tr>
					<td>
						<a href="http://facebook.com/capcusid" target="_blank"><img src="{{asset('images/socialmedia/fb.png')}}" alt='capcus.id' height='30'/></a>
						<a href="http://twitter.com/capcusid" target="_blank"><img src="{{asset('images/socialmedia/twitter.png')}}" alt='capcus.id' height='30'/></a>
						<a href="http://instagram.com/capcusid" target="_blank"><img src="{{asset('images/socialmedia/instagram.png')}}" alt='capcus.id' height='30'/></a>
					</td>
					<td align="right">
					</td>
				</tr>
				</table>
			</div>
		</td>
		<td></td>
	</tr>
	</table>

	<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">
			<!-- content -->
			<div class="content">
				<table bgcolor="" class="social" width="100%">
				<tr>
					<td align="center">
						<a href='http://capcus.id'>
							<img src="{{asset('images/logo-black.png')}}" alt='capcus.id' height='100' style='margin:20px 0'/>
						</a>
					</td>
				</tr>
				</table>
			</div>
			
			{{-- TITLE --}}
			<div class="content">
				<!-- Line -->
				<table width="18" height="81">
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="1150" style="border-bottom: 1px solid #e5e5e5;">
						</td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					</table>
				</td>
				<!-- DIVIDER TITLE -->
				<td align="center" valign="middle">
					<tr>
						<td height="0" border="5px" cellspacing="0" cellpadding="0">
							<h7>WELCOME {{ $user['name'] }},</h7>
						</td>
					</tr>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="1150" style="border-bottom: 1px solid #e5e5e5;">

						</td>
					</tr>
					<tr>
						<td>
						</td>
					</tr>
					</table>
				</td>
				</table>
			</div>

			<div class="content">
				<p class='bt'>Selamat bergabung bersama capcus.id,</p>
				
				<p class='bt'>
					<strong>
						Terima kasih telah bergabung menjadi bagian dari keluarga traveller capcus.id. Kami bertujuan untuk menyediakan 
						kemudahan dan kenyamanan dalam perencanaan pemilihan paket tour yang sesuai dengan kebutuhan anda.
					</strong>
				</p>

				<p class='bt'>
					Dalam capcus.id anda dapat mencari paket-paket tour yang sesuai dengan kebutuhan anda, baik dari destinasi perjalanan anda,
					durasi perjalanan, budget perjalanan, dan travel agent penyelenggara paket tour anda. Kami telah bekerja sama dengan berbagai
					travel agent terpercaya untuk memberikan pelayanan yang terbaik bagi anda.
				</p>

				<p class='bt'>
					Selamat berlibur!
					<br/>&nbsp;
					<br/>&nbsp;
					<br/>&nbsp;
				</p>

				<p class='bt'>
				Tim CAPCUS.ID				
				</p>
			</div>
			
			<div class="clear bt">
			</div>
		</td>
		<td></td>
	</tr>
	</table>
	<!-- FOOTER -->
	<table class="footer-wrap bt">
	<tr>
		<td></td>
		<td class="container">
			<!-- content -->
			<div class="content">
				<table>
				<tr>
					<td align="left">
						<p>
							CAPCUS menyediakan kemudahan kepada travellers untuk mencari paket tour yang sesuai dengan kebutuhannya. 
							Dengan adanya CAPCUS, travellers tidak lagi perlu menghubungi travel agent untuk mencari paket tour yang 
							sesuai dengan kebutuhannya
						</p>
						<p>
							<a href="{{route('web.subscription.unsubscribe', ['id' => $subscriber->id, 'token' => Hash::make($subscriber->email)])}}" style='color:black !important; text-decoration:none; font-size:11px;'>Unsubscribe</a>
							{{-- | <a href="{{route('web.about.contact_us')}}" style='color:black !important; text-decoration:none; font-size:11px;'>Contact Us</a> --}}
						</p>
					</td>
				</tr>
				</table>
			</div>
			<!-- /content -->
		</td>
		<td></td>
	</tr>
	</table>
	<!-- /FOOTER -->
</body>
</html>