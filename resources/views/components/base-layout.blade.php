<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest jQuery (1.11.1) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('modalsonly/js/bootstrap.min.js') }}"></script>    
    


    <title>{{ config('app.name') }} {{ isset($title) ? (' - ' . $title) : '' }}</title>
    <link rel="stylesheet" href="{{ asset('modalsonly/css/bootstrap.min.css') }}">
    

    @livewireStyles
    @livewireScripts
    @filamentStyles
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>

{{$slot}}
@filamentScripts
<script src="{{ asset('js/chart.min.js') }}"></script>
@stack('scripts')

@livewire('notifications')
</body>
</html>
