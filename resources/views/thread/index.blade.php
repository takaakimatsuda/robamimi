@extends('layouts.app')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	<div class="mt-5 pt-2 text-left border-bottom">
		<p class="h4 fw-bold">{{$genre->detail}}</p>
	</div>
    <div class="row d-flex justify-content-center col-12">
		{{-- 投稿 --}}
		@foreach ($threads as $thread)
			<div class="col-1 text-end">
				@if (isset($thread->user->icon))
					<img class="icon rounded-circle mt-2" src="{{ $thread->user->icon }}">
				@else
					<i class="fas fa-user-circle fa-4x mt-2"></i>
				@endif
			</div>
			<div class="bg-white rounded-md p-2 col-8">
				{{-- スレッド --}}
				<p class="fw-bold d-inline-block mb-1 col-3 text-start fs-6">{{$thread->user->name}}</p>
				<p class="d-inline-block text-start col-4 text-secondary mb-0">{{$thread->created_at->format('m-d H:i');}}</p>
				<p class="mb-2 text-xl">{{$thread->title}}</p>
				@if ($thread->comments_count !== 0)
					<a class="fw-bold" href="{{ route('comment.index', ['id'=>$thread->id]) }}">{{$thread->comments_count}}件のコメント</a>
				@else
					<a class="fw-bold" href="{{ route('comment.index', ['id'=>$thread->id]) }}">コメントする</a>
				@endif
			</div>
			{{-- 削除 --}}
			<div class="mt-3 col-3">
				@if (Auth::id() == $thread->user_id)
				<form action="{{route('thread.delete', ['threadId'=>$thread->id])}}" method="POST">
						@method('DELETE')
						@csrf
						<button class="trash"><i class="fas fa-trash" type="submit"></i></button>
				</form>
				@endif
			</div>
		@endforeach
	</div>
	<p class="mt-5">{{ $threads->links() }}</p>
		<div class="text-start col-8">
			<form action="{{ route('thread.store', ['genre_id'=>$genre->id]) }}" method="POST">
				@csrf
				<div>
					<input type="text" class="form-control" name="title" placeholder="スレッドを作成する" autofocus/>
				</div>
				<div class="text-end mt-1 rounded">
					<button class="btn-success text-end rounded">送信</button>
				</div>
			</form>
		</div>
</div>
@endsection
