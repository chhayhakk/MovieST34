@extends('auth.layout')
@section('main')
<form action="{{ route('password.update') }}" class="sign__form" method="POST">
	@csrf
	<a href="" class="sign__logo">
		<img src="img/logo.svg" alt="">
	</a>
<input type="hidden" value="{{request()->route('token')}}" name ="token">
	<div class="sign__group">
		<input type="text" name="email" class="sign__input" placeholder="Email" value={{$_GET['email']}}>
		@error('email')
	<span class="error-message">{{$message}}</span>
	@enderror
	</div>
	

	<div class="sign__group">
		<input type="password" name="password" class="sign__input" placeholder="Password">
		@error('password')
		<span class="error-message">{{$message}}</span>
		@enderror
	</div>

	<div class="sign__group">
		<input type="password" name ="password_confirmation" class="sign__input" placeholder="ConfirmPassword">
	</div>

	
	<button class="sign__btn" type="submit">Reset Password</button>

</form>
@endsection