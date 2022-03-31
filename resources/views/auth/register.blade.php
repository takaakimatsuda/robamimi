@extends('layouts.app')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-8 offset-md-2">
						<i class="fas fa-user-circle fa-8x"></i>
					</div>
				</div>
				<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
					@csrf

					<div class="row mb-3">
						<div class="col-md-8 offset-md-2">
							<label for="image" class="btn btn-success">
    							アイコン設定
							</label>
							<p>選択されていません</p>
							<input id="image" type="file" name="image">
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-md-8 offset-md-2">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザーネーム">

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">

						<div class="col-md-8 offset-md-2">
							<label for="email" class="sr-only">Email address</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">

						<div class="col-md-8 offset-md-2">
						<label for="password" class="sr-only">Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="row mb-3">

						<div class="col-md-8 offset-md-2">
							<label for="passwordconfirm" class="sr-only">Password Confirm</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードを再入力">
						</div>
					</div>

					<div class="row mb-0">
						<div class="col-md-8 offset-md-2">
							<button type="submit" class="btn btn-primary">
								新規登録
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
@endsection
