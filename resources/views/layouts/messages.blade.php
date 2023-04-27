@if(session()->has('success'))
	<div class="p-6">
		<div class="alert alert-success">
			<div class="alert-header">
				<i class="fa-solid fa-check-circle"></i>
				<p>Success!</p>
			</div>
			<div class="alert-body">
				<p>{{ session('success') }}</p>
			</div>
		</div>
	</div>
@endif
@if($errors->any())
	<div class="p-6">
		<div class="alert alert-danger">
			<div class="alert-header">
				<i class="fa-solid fa-triangle-exclamation"></i>
				<p>Oh no! We have found some errors with your request!</p>
			</div>
			<div class="alert-body">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		</div>
	</div>
@endif