<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tech Talk</title>
	<link rel="stylesheet" href="/css/app.css">
</head>

<body>
	<header class="row">
		@include('includes.header')
	</header>

	<div class="container">
		<div if="main" class="row">
			@yield('content')
		</div>
	</div>
	
	<footer class="row">
		@include('includes.footer')
	</footer>
</body>
</html>