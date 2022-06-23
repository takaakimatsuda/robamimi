@extends('layouts.app')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	<div class="mt-5 pt-2 text-left border-bottom">
		<p class="h4 fw-bold">スレッド検索</p>
	</div>
    <div class="row d-flex justify-content-center col-12">
		{{-- 投稿 --}}
		@foreach ($threads as $thread)
			<div class="col-1 text-end">
				@if (isset($thread->user->icon))
					<img class="icon rounded-circle" src="{{ $thread->user->icon }}">
				@else
					<i class="fas fa-user-circle fa-4x mt-2"></i>
				@endif
			</div>
			<div class="bg-white rounded-md p-2 col-11">
				{{-- スレッド --}}
				<p class="fw-bold d-inline-block mb-1 col-1 text-start fs-6">{{$thread->user->name}}</p>
				<p class="d-inline-block text-start col-4 text-secondary mb-0">{{$thread->created_at->format('m-d H:i');}}</p>
				<p class="mb-2 text-xl">{{$thread->title}}</p>
				@if ($thread->comments_count !== 0)
					<a class="fw-bold" href="{{ route('comment.index', ['id'=>$thread->id]) }}">{{$thread->comments_count}}件のコメント</a>
				@else
					<a class="fw-bold" href="{{ route('comment.index', ['id'=>$thread->id]) }}">コメントする</a>
				@endif
			</div>
		@endforeach
	</div>
</div>
@endsection
