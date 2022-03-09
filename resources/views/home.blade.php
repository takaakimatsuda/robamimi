@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
				<x-alert type="success" :session="session('success')"/>


                    {{ __('You are logged in!') }}
					<li>名前: {{ Auth::user()->name }}</li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
