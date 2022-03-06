@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('login_success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('login_success') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
					<li>名前: {{ Auth::user()->name }}</li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
