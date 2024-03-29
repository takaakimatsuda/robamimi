@extends('layouts.app')
@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="mt-5 pb-3 row d-flex justify-content-start border-bottom col-12">
		<div class="col-1 mt-2 text-end">
					@if (isset($thread->user->icon))
						<img class="icon rounded-circle mt-2" src="{{ $thread->user->icon }}">
					@else
						<i class="fas fa-user-circle fa-4x"></i>
					@endif
		</div>
		<div class="bg-white rounded-md p-2 col-8">
			{{-- スレッド --}}
			<p class="fw-bold d-inline-block mb-1 col-3 text-start fs-6">{{$thread->user->name}}</p>
			<p class="d-inline-block text-start col-4 text-secondary mb-0">{{$thread->created_at->format('m-d H:i');}}</p>
			<p class="text-xl">{{$thread->title}}</p>
			<a class="fw-bold" href="{{ route('thread.index', ['genre' => $genre->name]) }}">スレッドに戻る</a>
		</div>
	</div>
		<div class="row d-flex justify-content-center col-12">
		{{-- 投稿 --}}
		@foreach ($comments as $comment)
			<div class="col-1 mt-2 text-end">
				@if (isset($comment->user->icon))
					<img class="icon rounded-circle" src="{{ $comment->user->icon }}">
				@else
					<i class="fas fa-user-circle fa-4x"></i>
				@endif
			</div>
			<div class="bg-white rounded-md p-2 col-8">
				{{-- スレッド --}}
				<p class="fw-bold d-inline-block col-3 text-start fs-6 mb-1">{{$comment->user->name}}</p>
				<p class="d-inline-block text-start col-4 text-secondary mb-0">{{$comment->created_at->format('m-d H:i');}}</p>
				<p class="comment-text text-xl">{{$comment->contents}}</p>
				{{-- いいね機能 --}}
				<like-component :comment={{$comment}} :likes_count={{$comment->likes_count}}></like-component>
			</div>
			{{-- 削除 --}}
			<div class="mt-3 col-3">
				@if (Auth::id() == $comment->user_id)
				<form action="{{ route('comment.delete', ['commentId' => $comment->id]) }}" method="POST">
					@method('DELETE')
					@csrf
					<button class="trash"><i class="fas fa-trash" type="submit"></i></button>
				</form>
				@endif
			</div>
		@endforeach
		</div>
	<p class="mt-5">{{ $comments->links() }}</p>
	<div class="text-center col-9 mt-3">
		<form action="{{ route('comment.store',['thread_id' => $id]) }}" method="POST">
			@csrf
			<div>
				<textarea type="text" rows="3" class="form-control" name="contents" placeholder="コメントを作成する"></textarea>
			</div>
			<div class="text-end mt-1 rounded">
				<button class="btn-success text-end rounded">送信</button>
			</div>
		</form>
	</div>
</div>
@endsection
