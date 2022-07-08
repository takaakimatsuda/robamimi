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
						@if (isset($user->icon))
							<img class="icon" src="{{ $user->icon }}">
						@else
							<i class="fas fa-user-circle fa-8x"></i>
						@endif
					</div>
				</div>
			<form action="{{ route('user.postEdit') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row mb-3">
					<div class="col-md-8 offset-md-2">
						<h7 class="icon-title">アイコンを更新する場合は画像を設定してください</h7>
						<input id="image" type="file" name="image"><br>
						<div class="default-image mt-1">
							<input type="checkbox" name="defaultImage">アイコンをデフォルトに戻す
						</div>
						@if (Auth::id() == 4)
							<p class="text-danger">※ゲストユーザーは、ユーザー名とメールアドレスを編集できません。</p>
						@endif
							<p class="username-title">ユーザーネーム</p>
						@if (Auth::id() == 4)
							<input type="text" name="name" class="form-control " value="{{ $user->name }}" placeholder="ユーザーネーム" readonly/>
						@else
							<input type="text" name="name" class="form-control " value="{{ $user->name }}" placeholder="ユーザーネーム" />
						@endif
						<p class="mailaddress-title">メールアドレス</p>
						@if (Auth::id() == 4)
							<input type="text" name="email" class="form-control " value="{{ $user->email }}" placeholder="メールアドレス" readonly/><br />
						@else
							<input type="text" name="email" class="form-control " value="{{ $user->email }}" placeholder="メールアドレス" /><br />
						@endif
						<button type="submit"  class="btn btn-primary" >
							更新する
						</button>
					</div>
				</div>
			</form>
			<div class="mb-2 text-end">
				<form action="{{ route('user.delete') }}" method="POST">
				@csrf
					<button type="submit"  class="btn btn-link" >
						退会する
					</button>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection
