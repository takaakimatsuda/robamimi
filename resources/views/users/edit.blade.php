@extends('layouts.app')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="card">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-8 offset-md-2">
						<h5>現在のプロフィール画像</h5>
						<img src="{{ $user->icon }}">
					</div>
				</div>
			<!-- 重要な箇所ここから -->
			<form action="{{ route('users.postEdit', ['id' => $user->id]) }}"
				method="post">
				@csrf
				<input type="hidden" name="id" value="{{ $user->id }}" />
				<p>名前</p>
				<input type="text" name="name" value="{{ $user->name }}" />
				<p>メール</p>
				<input type="text" name="email" value="{{ $user->email }}" /><br />
				<input type="submit" value="更新" />
			</form>
			<!-- 重要な箇所ここまで -->
			</div>
		</div>
	</div>
</div>
@endsection
