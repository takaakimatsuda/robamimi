@extends('layouts.app')
<link href="{{ asset('css/signin.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="flash_message  bg-secondary">
			{{ session('flash_message') }}
		</div>
		@foreach ($errors->all() as $error)
			<div class="login-alert alert-danger">
				<li>{{ $error }}</li>
			</div>
		@endforeach

		<x-alert type="danger" :session="session('danger')"/>

		<div class="card">
			<form class="form-signin" method="POST" action="{{ route('login') }}">
				@csrf
				<h2 class="login-title">『ロバミミ』を使ってみよう。</h1>

				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
				<i class="fab fa-twitter fa-3x"></i><i class="fab fa-instagram fa-3x"></i><br>
				<button class="login-btn btn-lg btn-warning" type="submit">ログイン</button><br>
			</form>
			<a class="register-btn btn-lg btn-info" href="{{ route('register') }}">新規登録</a>
			<a class="pass-forget-btn btn-lg btn-success" href="{{ route('password_reset.email.form') }}">パスワードを忘れた方</a>
		</div>
	</div>
</div>
@endsection
