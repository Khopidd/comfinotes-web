<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asset/css/admin/style-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/admin/style-comunity.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/admin/style-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/aset/color-pallete.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/aset/alert.css') }}">
    <link rel="icon" href="{{ asset('asset/image/logo-1.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
<x-sidebar-admin :PageTitle="$PageTitle" :PageSubtitle="$PageSubtitle" />
<x-alert />

    {{ $slot }}

<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('asset/js/action.js') }}"></script>
<script src="{{ asset('asset/js/button.js') }}"></script>
<script src="{{ asset('asset/js/popup.js') }}"></script>
<script src="{{ asset('asset/js/alert.js') }}"></script>
</body>
</html>
