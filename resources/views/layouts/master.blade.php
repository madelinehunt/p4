<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link href='/css/local.css' rel='stylesheet'>
    <link href='/css/nav.css' rel='stylesheet'>
    <link href='/css/tables.css' rel='stylesheet'>
    <link href='/css/forms.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div id="roundrect-container">
        @include('snippets.nav')

        @yield('splash')

        @yield('create_or_edit_form')

        @yield('list')

        @yield('weclome_content')
    </div>
</body>
