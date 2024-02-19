<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
    @livewireStyles
  </head>
  <body class="font-sans antialiased text-[#1D1D1B]">
    <div class="flex flex-wrap w-full">
      <div class="flex flex-col w-full h-screen overflow-y-scroll md:w-5/12 lg:w-4/12 xl:w-3/12 scroll">
        <div class="flex justify-center pt-11 md:-mb-24 md:justify-start md:pl-12">
          <a href="/">
            <x-application-logo class="h-12"></x-application-logo>
          </a>
        </div>
        <div class="flex flex-col justify-center px-6 my-auto sm:px-24 md:justify-start md:px-8 lg:px-12">
          {{ $slot }}
        </div>
      </div>
      <div class="hidden pointer-events-none select-none md:block md:w-7/12 lg:w-8/12 xl:w-9/12">
        <x-slide></x-slide>
      </div>
    </div>
    @stack('js')
    @livewireScriptConfig
  </body>
</html>
