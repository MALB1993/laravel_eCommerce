<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

        {{-- styles --}}
		<link href="{{ asset('/home/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('/home/css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset('/home/css/style.css') }}" rel="stylesheet">

        {{-- title --}}
        <title> {{ env('APP_NAME') }} - @yield('title')</title>

        @yield('stylesheet')
	</head>

	<body>

        {{-- navbar --}}
		@include('home.sections.nav')

        {{-- hero section for index page --}}
        @if (url()->current() === route('home.index'))
            @include('home.sections.hero')
        @endif

        {{-- content --}}
		@yield('content')

        {{-- footer --}}
        @include('home.sections.footer')

        {{-- javascripts --}}
		<script src="{{ asset('/home/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('/home/js/tiny-slider.js') }}"></script>
		<script src="{{ asset('/home/js/custom.js') }}"></script>

        @yield('javascript')
	</body>

</html>
