@extends('auth.layout')
@section('main')
<!-- authorization form -->
<form action="{{route('password.email')}}" method="POST" class="sign__form">
    @csrf
    <a href="index.html" class="sign__logo">
        <img src="img/logo.svg" alt="">
    </a>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600" style="color:green;">
            {{session('status')}}
        </div>
    @else
        <div class="sign__group">
            <input type="text" class="sign__input" name="email" placeholder="Email">
            @error('email')
                <span style="color:red">
                    {{$message}}
                </span>
            @enderror
        </div>
        <button class="sign__btn" type="submit">Request</button>
    @endif
</form>
<!-- end authorization form -->
@endsection
