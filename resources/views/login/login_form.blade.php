@extends('layouts.app')
<link href="{{ asset('css/signin.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<form class="form-signin" method="POST" action="{{ route('login') }}">
					@csrf
					<h1 class="h3 mb-3 font-weight-normal">『ロバミミ』を使ってみよう。</h1>
					@foreach ($errors->all() as $error)
						<div class="alert alert-danger">
							<li>{{ $error }}</li>
						</div>
					@endforeach

					<x-alert type="danger" :session="session('danger')"/>

					<label for="inputEmail" class="sr-only">Email address</label>
					<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
