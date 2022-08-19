@extends('layouts.app')

<link href="{{ asset('css/password_reset.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="card">
			<div>
				<h2 class="mailform-title">パスワードリセットメールを送信しました</h2>

				<a href="{{ route('login.show') }}">TOPへ</a>
			</div>
		</div>
	</div>
</div>
@endsection
