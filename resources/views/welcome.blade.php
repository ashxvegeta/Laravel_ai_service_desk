<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AI Service Desk') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-[#0a0a0a] dark:via-[#111] dark:to-[#161615] text-slate-900 dark:text-slate-100 flex flex-col">

<!-- Header -->
<header class="w-full max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <div class="text-lg font-semibold tracking-tight">
        🤖 AI Service Desk
    </div>

    @if (Route::has('login'))
        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-5 py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-sm font-medium shadow hover:opacity-90 transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium border border-slate-300 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-5 py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-sm font-medium shadow hover:opacity-90 transition">
                        Get Started
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>

<!-- Hero Section -->
<main class="flex-1 flex items-center justify-center px-6">
    <div class="max-w-3xl text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 rounded-full bg-slate-100 dark:bg-slate-800 text-sm text-slate-600 dark:text-slate-300">
            ✨ Powered by AI
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6">
            Smarter Support with <br class="hidden sm:block"> <span class="bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">AI Service Desk</span>
        </h1>

        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto mb-10">
            Automate ticket resolution, get instant answers, and deliver faster support experiences using AI-powered workflows.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('login') }}"
               class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-black text-white dark:bg-white dark:text-black font-medium shadow-lg hover:scale-[1.02] transition">
                🚀 Launch Dashboard
            </a>

            <a href="#"
               class="w-full sm:w-auto px-8 py-3 rounded-2xl border border-slate-300 dark:border-slate-600 font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                📘 Learn More
            </a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="py-6 text-center text-sm text-slate-500 dark:text-slate-400">
    © {{ date('Y') }} AI Service Desk. Built with Laravel & ❤️
</footer>

</body>
</html>
