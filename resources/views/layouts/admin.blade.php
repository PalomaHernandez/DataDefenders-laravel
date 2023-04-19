<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

		@vite('resources/css/app.css')
	</head>
	<body class="antialiased">
		<div class="relative sm:flex h-screen bg-dots-darker bg-center bg-gray-100">
			<aside class="h-screen min-w-fit p-3 bg-sky-900">
				<nav class="flex flex-col">
					<a href="/" class="nav-item">Home</a>
					<a href="{{ route('departments.index') }}" class="nav-item">Departments</a>
				</nav>
			</aside>
			<div class="flex-grow h-screen p-6 lg:p-8">
				@yield('content')
			</div>
		</div>
	</body>
</html>
