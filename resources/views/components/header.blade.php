<div class="flex items-center gap-8 border-b p-6 lg:p-8 shadow z-10">
	<div class="flex-grow flex flex-col items-start gap-2">
		<p class="my-super-title">{{ $title }}</p>
		<div class="text-gray-500 flex items-center gap-6">{{ $description }}</div>
	</div>
	<div>
		{{ $buttons }}
	</div>
	<div class="dropdown">
		<a class="dropdown-header">
			<i class="fa-solid fa-user"></i>
		</a>
		<nav class="dropdown-menu">
			@auth
				<a href="{{ route('users.index') }}" class="dropdown-link">My account</a>
				<a href="{{ route('logout') }}" class="dropdown-link text-red-500">
					Logout
					<i class="fa-solid fa-sign-out"></i>
				</a>
			@else
				<a href="{{ route('login') }}" class="dropdown-link">
					Login
					<i class="fa-solid fa-sign-in"></i>
				</a>
			@endauth
		</nav>
	</div>
</div>