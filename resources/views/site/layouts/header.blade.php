<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fashi | @yield('title')</title>
    <link rel="icon" href="{{ asset('site/img/filled_bow_tie_40px.png') }}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1-rc.1/css/select2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.0/nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/owl.theme.green.css') }}">
    @stack('css')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <style>
    .search-results {
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        width: 100%;
        background-color: white;
        z-index: 10;
        border-radius: 5px;
        }
        .search-item {
        padding: 10px;
        cursor: pointer;
        width: 100%;
        display: block;
        color: black;
        }

        .search-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
