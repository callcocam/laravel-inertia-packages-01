<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel-Admin</title>
     @routes
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(mix('_dist/admin/css/app.css')) }}">    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('_dist/admin/images/logo/favicon.png') }}">
</head>
    <body>
     @call
     <script src="{{ mix('/_dist/admin/js/app.js') }}" defer></script>
    </body>
</html>
