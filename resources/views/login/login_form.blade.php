@extends('layouts.app')
<link href="{{ asset('css/signin.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		@foreach ($errors->all() as $error)
			<div class="login-alert alert-danger">
				<li>{{ $error }}</li>
			</div>
		@endforeach
		<div class="flash_message  bg-secondary">
			{{ session('flash_message') }}
		</div>


		<x-alert type="danger" :session="session('danger')"/>

		<div class="card">
			<form class="form-signin" method="POST" action="{{ route('login') }}">
				@csrf
				<h3 class="login-title">『ロバミミ』はスレッド型SNSです</h1>
				<li class="login-detail">話したいジャンルでスレッドを立てます。</li>
				<li class="login-detail">スレッドの中で感想を話し合います。</li>
				<li class="login-detail">ネタバレを気にせず交流しましょう！</li>

				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
				<!-- <i class="fab fa-twitter fa-3x"></i><i class="fab fa-instagram fa-3x"></i><br> -->
				<button class="login-btn btn-lg btn-warning fw-bold" type="submit">ログイン</button>
				<a class="guest-btn btn-lg btn-primary fw-bold text-white text-decoration-none" href="{{ route('login.guest') }}">
					ゲストログイン
				</a>
				<br>
			</form>
			<a class="register-btn btn-lg btn-info fw-bold" href="{{ route('register') }}">新規登録</a>
			<a class="pass-forget-btn btn-lg btn-success fw-bold" href="{{ route('password_reset.email.form') }}">パスワードを忘れた方</a>
		</div>
	</div>
</div>
@endsection
