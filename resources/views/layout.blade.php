<!DOCTYPE html>
<html>	
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="{{ asset('css/main.css')}}">

	<!--Google Fonts-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
	<!--Font Awesome Icons-->
	<script src="https://kit.fontawesome.com/66af6c845b.js" crossorigin="anonymous"></script>

	<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	
	<title>
		@yield("app-title", "Довідник книг")
	</title>
</head>
	
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 pt-3">
			<a class="navbar-brand" href="/">
				<i class="fas fa-book-open"></i>
				<span>@yield("app-title", "Довідник книг")</span>
			</a>

			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="/">Головна сторінка</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/authors">Автори</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/author/0/books">Книги</a>
					</li>
					@can('admin-panel')
						<li class="nav-item">
							<a class="nav-link" href="/admin/users">Адмін.панель</a>
						</li>
					@endcan
					<li class="nav-item">
						<a class="nav-link" href="/about">Про проект</a>
					</li>
					<li class="nav-item dropdown">
						<nav class="nav nav-masthead justify-content-center">
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
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<section class="main-content text-center">
		<div class="row justify-content-center p-0 m-0">
			<div class="col-md-9">
				<h4 class="text-center pb-3 pt-3"> @yield("page-title")</h4>
				@yield("page-content")
			</div>
		</div>
	</section>

	<footer class="bg-light text-center text-lg-start">
		<div class="text-center p-3">
			<p>© Довідник книг</p>
			<p>Laravel</p>
		</div>
    </footer>
</body>
</html>
