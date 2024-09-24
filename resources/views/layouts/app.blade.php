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

    <div id="cookie-warning" class="cookie-warning">
        <p>This website uses cookies to ensure you get the best experience on our website.
        </p>
        <button id="close-warning">Ok, got it!</button>
    </div>
</div>

@yield('global-scripts')
@yield('page-scripts')

<script type="text/javascript">
    // Delete the cookie for testing purposes
    //document.cookie = "cookieWarningAccepted=; Max-Age=0; path=/;";
    document.addEventListener("DOMContentLoaded", function () {
        const cookieWarning = document.getElementById('cookie-warning');
        const closeBtn = document.getElementById('close-warning');
        // Function to set a cookie
        function setCookie(name, value, days) {
            const d = new Date();
            d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        // Function to check if a cookie exists
        function checkCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length); // Trim whitespace
                if (c.indexOf(nameEQ) == 0) return true; // Cookie found
            }
            return false; // Cookie not found
        }

        // Check if the cookie warning has been accepted
        if (!checkCookie("cookieWarningAccepted")) {
            // Show the cookie warning with a slide-in effect
            setTimeout(function() {
                cookieWarning.classList.add('show');
            }, 500); // Delay before showing
        }

        // Hide the cookie warning when the button is clicked
        closeBtn.addEventListener('click', function () {
            cookieWarning.classList.remove('show');
            // Optionally hide it after a short delay
            setTimeout(function() {
                cookieWarning.style.display = 'none';
            }, 500); // Wait for the transition to end
            // Set a cookie to remember that the user accepted the cookie warning
            setCookie("cookieWarningAccepted", "true", 30); // Cookie expires in 30 days
        });
    });
</script>
</body>
</html>