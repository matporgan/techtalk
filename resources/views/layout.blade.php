<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Tech Talk</title>

	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/libs.css">
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Add fancyBox main JS and CSS files -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
	
	<script type="text/javascript" src="/js/libs.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</head>
<body>

@include('includes.header')

<main>
	<div class="container">
		@yield('content')
	</div>
</main>

@include('includes.footer')

</body>
</html>