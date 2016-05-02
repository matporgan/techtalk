<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Tech Talk</title>

	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/libs.css">
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

	<script type="text/javascript" src="/js/libs.js"></script>
</head>

<body>
	@include('includes.header')

	<div class="container">
		<div if="main" class="row">
			@yield('content')
		</div>
	</div>

	@include('includes.footer')
</body>
</html>