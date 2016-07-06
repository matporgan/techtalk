<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Tech Talk</title>

	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/libs.css">
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Add fancyBox main JS and CSS files -->
<!-- 	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" /> -->

	<script type="text/javascript" src="/js/app.js"></script>
	<script type="text/javascript" src="/js/libs.js"></script>
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
	<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
	<script src="https://npmcdn.com/masonry-layout@4.0.0/dist/masonry.pkgd.min.js"></script>
	<script src="https://npmcdn.com/imagesloaded@4.1.0/imagesloaded.pkgd.js"></script>
	<script src=""></script>

</head>
<body>

	@include('snippets.page-loading')

	@include('snippets.flash')

	@include('layouts.header')

	<main id="page" @if(Request::is('/')) class="home" @endif>
		@yield('content')
	</main>

	@include('layouts.footer')

	@include('layouts._js')

</div>

</body>

</html>
