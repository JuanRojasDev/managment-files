<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Storage Secure')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  @livewireStyles
  <style>
    body{font-family:'Inter',sans-serif;background-color:#f9fafb;color:#111827;}
  </style>
</head>
<body>
  <div class="min-h-screen flex bg-gradient-to-br from-indigo-500 to-violet-600 text-white">
    @include('layouts.sidebar')
    <main class="flex-1 overflow-y-auto">
      <header class="bg-white/10 backdrop-blur-lg border-b border-white/20 px-6 py-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-white/90">@yield('page-title')</h2>
        <div class="flex items-center gap-3">
          <span class="text-sm text-indigo-100">{{ auth()->user()->email ?? '' }}</span>
          <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=6366F1&color=fff&rounded=true" class="w-9 h-9 rounded-full" alt="avatar">
        </div>
      </header>
      <div class="p-8">
        {{-- Support both traditional Blade sections and Livewire Volt page slot --}}
        @yield('content')
        @isset($slot)
          {!! $slot !!}
        @endisset
      </div>
    </main>
  </div>
  @livewireScripts
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>