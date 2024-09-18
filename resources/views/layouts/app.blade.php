<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Powerhouse Industries :: @section('title') @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="plugin, utility"/>
    @show @section('meta_author')
        <meta name="author" content="Brian Etheridge"/>
    @show @section('meta_description')
        <meta name="description" content="Powerhouse Industries provide plugins and utilities to the masses"/>
    @show
        <meta property="og:title" content="Russ Etheridge">
        <meta property="og:image" content="/img/thumbs/armstrong_hv.jpg">
        <meta property="og:description" content="Powerhouse Industries provide plugins and utilities to the masses">

		<link href="{{ asset('css/site.css?v9') }}" rel="stylesheet">
        <script src="{{ asset('js/site.js?v7') }}"></script>

    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet" />
</head>
<body>


<div class="wrapper">

    @if (!Auth::guest())
        @include('partials.nav')
    @endif

    @include('partials.header')

    <div class="container-fluid">

        @yield('content')

    </div>

    <div class="row footer-row-container">
        <div style="color: #000; text-align: center;padding-top:80px;">&copy; {{ (new DateTime)->format('Y') }} Powerhouse Industries</div>
    </div>

</div>

@yield('global-scripts')
@yield('page-scripts')

</body>
</html>