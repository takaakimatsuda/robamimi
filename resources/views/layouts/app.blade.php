<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	<script type="text/javascript"src="//code.typesquare.com/static/ZDbTe4IzCko%253D/ts106f.js"charset="utf-8"></script>
	<script src="https://kit.fontawesome.com/635e45e886.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Yuji+Boku&family=Yusei+Magic&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/layout.css') }}" rel="stylesheet">
	@yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
					<i class="fas fa-democrat"></i>{{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
						@guest
						@else
						<form action="{{route('thread.search')}}" method="GET">
							<div class="float-start">
								<input type="text" name="query" class="form-search" id="exampleFormSearchlInput1" placeholder="🔍  スレッドを検索する" required>
							</div>
						</form>
						@endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-block link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									@if (isset($login_user->icon))
										<img class="nav-icon" style="width: 40px; border-radius: 50%;" src="{{ $login_user->icon }}">
									@else
										<i class="nav-icon fas fa-user-circle fa-3x" style="opacity: 1.0;"></i>
									@endif
                                </a>

								<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('user.edit') }}" >
                                        ユーザー編集
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

				<div class="sidebar" >
					<ul>
						<li><a class="text-decoration-none link-dark" href="{{ route('home') }}"><span class="p-channel_sidebar__notification"><i class="fas fa-bell fa-lg"></i>お知らせ</span></a>
							@if (isset($unread_notifications) && $unread_notifications != 0)<span class="badge rounded-pill bg-info">{{$unread_notifications}}</span>
							@endif</li>
						<li><a class="text-decoration-none link-dark" href="{{ route('thread.index', ['genre'=>'eiga']) }}"><span class="p-channel_sidebar__cinema"><i class="fas fa-film fa-lg"></i>映画</span></a></li>
						<li><a class="text-decoration-none link-dark" href="{{ route('thread.index', ['genre'=>'anime']) }}"><span class="p-channel_sidebar__anime"><i class="fas fa-robot fa-lg"></i>アニメ</span></a></li>
						<li><a class="text-decoration-none link-dark" href="{{ route('thread.index', ['genre'=>'manga']) }}"><span class="p-channel_sidebar__manga"><i class="fas fa-book-reader fa-lg"></i>漫画</span></a></li>
						<li><a class="text-decoration-none link-dark" href="{{ route('thread.index', ['genre'=>'live']) }}"><span class="p-channel_sidebar__live"><i class="fas fa-microphone fa-lg"></i>LIVE</span></a></li>
						<li><a class="text-decoration-none link-dark" href="{{ route('rule.index') }}"><span class="p-channel_sidebar__rule"><i class="fas fa-question fa-lg"></i>利用ルール</span></a></li>
					</ul>
				</div>
        <main class="py-4">
			@yield('content')
        </main>
		</div>
		<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
