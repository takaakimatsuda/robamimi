@extends('layouts.app')

<link href="{{ asset('css/password_reset.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="card">
			<h2 class="mailform-title">新しいパスワードを設定</h1>
			<form class="form-mail" method="POST" action="{{ route('password_reset.update') }}">
				@csrf
				<div>
					<input type="hidden" name="reset_token" value="{{ $userToken->token }}">
						<div class="input-group">
							<label for="password" class="label sr-only">パスワード</label>
							<input type="password" name="password" class="input {{ $errors->has('password') ? 'incorrect' : '' }} form-control" placeholder="パスワード" required autofocus>
							@error('password')
								<div class="error">{{ $message }}</div>
							@enderror
							@error('token')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					<div class="input-group mt-4">
						<label for="password_confirmation" class="label sr-only">パスワードを再入力</label>
						<input type="password" name="password_confirmation" class="input {{ $errors->has('password_confirmation') ? 'incorrect' : '' }} form-control" placeholder="パスワードを再入力" required autofocus>
					</div>
					<div class="password-reset-btn mt-5">
						<button class="login-btn btn-lg btn-success" type="submit">パスワードを再設定</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection
