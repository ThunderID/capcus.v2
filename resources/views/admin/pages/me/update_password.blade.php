@section('content_title')
	{{Auth::user()->name}}
@stop

@section('content_sidebar')
	<p>To update your password, please enter your current password and your new password in the form on the right side
	
	<p class='mt-md'><strong>Tips</strong>
	<br>Password must be at least 8 characters
@stop

@section('content_body')
	@include('admin.widgets.me.update_password_form')
@stop