@extends('layouts.app')
<link href="{{ asset('css/users_edit.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	<div class="row justify-content-center">
			<!-- フラッシュメッセージ -->
	@if (session('flash_message'))
		<div class="flash_message  bg-success">
			{{ session('flash_message') }}
		</div>
	@endif
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-8 offset-md-2">
						<h5>現在のアイコン</h5>
						<img class="icon" src="{{ $user->icon }}">
					</div>
				</div>
			<!-- 重要な箇所ここから -->
			<form action="{{ route('users.postEdit') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row mb-3">
					<div class="col-md-8 offset-md-2">
						<h7 class="icon-title">アイコンを更新する場合は画像を設定してください</h7>
						<input id="image" type="file" name="image">
						<p class="username-title">ユーザーネーム</p>
						<input type="text" name="name" class="form-control " value="{{ $user->name }}" placeholder="ユーザーネーム" />
						<p class="mailaddress-title">メールアドレス</p>
						<input type="text" name="email" class="form-control " value="{{ $user->email }}" placeholder="メールアドレス" /><br />
						<button type="submit"  class="btn btn-primary" >
							更新
						</button>
					</div>
				</div>
			</form>
			<form action="{{ route('users.delete') }}" method="POST">
			@csrf
				<button type="submit"  class="btn btn-primary" >
								退会する
				</button>
			</form>
			<!-- 重要な箇所ここまで -->
			</div>
		</div>
	</div>
</div>
@endsection
