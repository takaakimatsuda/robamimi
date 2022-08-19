@extends('layouts.app')
<link href="{{ asset('css/rule.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<div class="card p-5">
			<h2 class="rule-title">ロバミミ　３つのルール</h2>
			<div class="rule-text-top text-start mt-5 fw-5 fs-3">
				<ol>
					<li>スレッドに対するコメントはその投稿のスレッド内で収めること</li>
					<li>各カテゴリーの主旨に沿った投稿をすること</li>
					<li>人が嫌がる書き込みはしないこと</li>
				</ol>
			</div>
			<div class="rule-text-bottom mt-5 fs-4">
				<p>ルールを守れない方は、予告なく退去して頂くことがあります。</p>
				<p>ロバミミを楽しく使って頂くため、よろしくお願いします！</p>
			</div>
		</div>
	</div>
</div>
@endsection
