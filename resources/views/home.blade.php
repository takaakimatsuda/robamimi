@extends('layouts.app')
<link href="{{ asset('css/notification.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	@if (session('flash_message'))
		<div class="flash_message  bg-success">
			{{ session('flash_message') }}
		</div>
	@endif
<div class="mt-5 pt-2 text-left border-bottom">
		<p class="h4 fw-bold">通知</p>
	</div>
    <div class="row d-flex justify-content-center col-12">
		{{-- 通知 --}}
		@foreach ($notifications as $notification)
			@if (isset($notification->comment))
				<div class="col-1 text-end">
					@if (isset($notification->comment->user->icon))
						<img class="icon rounded-circle mt-2" src="{{ $notification->comment->user->icon }}">
					@else
						<i class="fas fa-user-circle fa-4x mt-2"></i>
					@endif
				</div>
				<div class="bg-white rounded-md p-2 col-11">
					<p class="fw-bold d-inline-block mb-1 col-9 text-start fs-6">{{$notification->comment->user->name}}さんが<a class="text-decoration-none fw-bold" href="{{ route('comment.index', ['id'=>$notification->comment->thread_id]) }}">あなたのスレッド</a>にコメントしました</p>
					<p class="d-inline-block text-start col-12 text-secondary mb-0">{{$notification->created_at->diffForHumans($carbon);}}</p>
				</div>
			@elseif (isset($notification->like))
				<div class="col-1 text-end">
					@if (isset($notification->like->user->icon))
						<img class="icon rounded-circle" src="{{ $notification->like->user->icon }}">
					@else
						<i class="fas fa-user-circle fa-4x mt-2"></i>
					@endif
				</div>
				<div class="bg-white rounded-md p-2 col-11">
					<p class="fw-bold d-inline-block mb-1 col-9 text-start fs-6">{{$notification->like->user->name}}さんが<a class="text-decoration-none fw-bold" href="{{ route('comment.index', ['id'=>$notification->like->comment->thread_id]) }}">あなたのコメント</a>にいいねしました</p>
					<p class="d-inline-block text-start col-12 text-secondary mb-0">{{$notification->created_at->diffForHumans($carbon);}}</p>
				</div>
			@endif
		@endforeach
		<p class="mt-5">{{ $notifications->links() }}</p>
	</div>
</div>
@endsection
