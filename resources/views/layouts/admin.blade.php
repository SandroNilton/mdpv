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
  <body class="font-sans antialiased bg-[#F4F6F9] h-screen mx-auto flex justify-between" x-data="{ isSidebarOpen: $persist(false) }">
    <div x-show.in.out.opacity="isSidebarOpen" @click="isSidebarOpen = !isSidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-5 lg:hidden" style="backdrop-filter: blur(3px); display: none;"></div>
    <livewire:layout.admin.sidebar />
    <div class="flex flex-col flex-1 h-full overflow-scroll scroll">
      <livewire:layout.admin.navbar />
      <section class="px-2">
        {{ $slot }}
      </section>
    </div>
    <script src="https://kit.fontawesome.com/bcde58078b.js" crossorigin="anonymous"></script>
    @stack('js')
    @livewireScriptConfig 
  </body>
</html>
