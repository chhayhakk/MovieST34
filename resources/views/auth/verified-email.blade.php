@extends('auth.layout')
@section('main')
<!-- authorization form -->
<form action="{{route('login')}}" method="GET" class="sign__form">
	@csrf
	<a href="index.html" class="sign__logo">
		<img src="img/logo.svg" alt="">
	</a>

	<div class="sign__group">
		<span style="color:aliceblue">Please Check your email for verification</span>
	</div>

	
	
	<button class="sign__btn">Back to Login</button>
</form>
<!-- end authorization form -->
@endsection