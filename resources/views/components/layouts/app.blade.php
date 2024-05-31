<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 

        <title>{{ config('app.name') }}</title>
 
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    
        @filamentStyles
        @vite('resources/css/app.scss')
    </head>
 
    <body class="antialiased">
        {{ $slot }}
        @filamentScripts
        <script src="{{ asset('js/chart.min.js') }}"></script>
        @vite('resources/js/app.js')
        @stack('scripts')
@livewire('notifications')
    </body>
</html>