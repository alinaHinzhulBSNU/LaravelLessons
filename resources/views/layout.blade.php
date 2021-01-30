<!DOCTYPE html>
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/cover.css')}}">

	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<title>
		@yield("app-title", "Довідник книг")
	</title>
</head>
<html>
<body class="text-center">
	<div class="cover-container d-flex p-3 mx-auto flex-column">
	<header class="masthead">
		<div class="inner">
			<h1 class="masthead-brand col-md-4" style="display: flex;">
				@yield("app-title", "Довідник книг")
			</h1>
			<nav class="nav nav-masthead justify-content-center">
				<a href="/" class="nav-link">Головна сторінка</a>
				<a href="/authors" class="nav-link">Автори</a>
				<a href="/author/0/books" class="nav-link">Книги</a>
				@can('admin-panel')
					<a href="/admin/users" class="nav-link">Адмін.панель</a>
				@endcan
				<a href="/about" class="nav-link">Про проект</a>
				<!--Authentication Links -->
				@guest
					<a class="nav-link" href="{{ route('login') }}">Логін</a>
					@if(Route::has('register'))
						<a class="nav-link" href="{{ route('register') }}">Реєстрація</a>
					@endif
				@else
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }}<span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
		            <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
				</div>
				@endguest
			</nav>
		</div>
	</header>
	<main role="main" class="inner cover">
		<h3 class="cover-heading"> @yield("page-title")</h3>
		@yield("page-content")
	</main>
	<footer class="mast mt-auto">
		<div class="inner">
			@yield("page-footer")
		</div>
	</footer>
	</div>
</body>
</html>
