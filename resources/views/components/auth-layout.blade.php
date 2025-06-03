<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asset/css/auth/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/auth/forgot.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/auth/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/auth/verif.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/aset/color-pallete.css') }}">
    <link rel="icon" href="{{ asset('asset/image/logo-1.png') }}">
    <title>{{ $title }}</title>
</head>
<body>

    {{ $slot }}

<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>
</html>
