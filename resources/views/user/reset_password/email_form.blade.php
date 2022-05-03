@extends('layouts.app')
<link href="{{ asset('css/password_reset.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="card">
			<div>
				<h2 class="mailform-title">パスワード再設定メールを送信します</h2>
				<form class="form-mail" method="POST" action="{{ route('password_reset.email.send') }}">
					@csrf
					<div>
						<label for="email" class="sr-only">メールアドレス</label>
						<input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="メールアドレス" required autofocus>
						@error('email')
							<span class="error">{{ $message }}</span>
						@enderror
					</div>
					<button class="login-btn btn-lg btn-info mt-5" type="submit">再設定用メールを送信</button>
				</form>
				<div class="back-btn mt-5">
					<a class="back-btn btn-lg btn-success mt-5" href="{{ route('login.show') }}">戻る</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
