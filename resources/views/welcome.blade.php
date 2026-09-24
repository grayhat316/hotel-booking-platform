<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ffffff;
            color: #4a5568;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px;
        }
        h1 {
            color: #2c3e50;
        }
        .links a {
            color: #3182ce;
            text-decoration: none;
            margin-right: 15px;
            font-weight: 600;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title m-b-md">
            <h1>Hotel Booking Platform</h1>
            <p class="lead">A robust booking system for hotels with accommodation, dining, conferencing, and outdoor activities.</p>
        </div>

        <div class="links">
            <a href="{{ url('/admin') }}">Admin Dashboard</a>
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://envoyer.laravel.com">Envoyer</a>
        </div>
    </div>
</body>
</html>