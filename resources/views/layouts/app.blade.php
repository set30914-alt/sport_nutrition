<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | IRON NUTRITION' : 'IRON NUTRITION' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app-shell">

<header class="app-header">
    <div class="app-header-inner">

        {{-- Логотип --}}
        <a href="{{ route('home') }}" class="logo-icon animate-fade-in-up">IN</a>

        {{-- Навігація --}}
        <nav class="hidden md:flex items-center gap-12 ml-6">
            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                Головна
            </a>

            <a href="{{ route('sales') }}"
               class="nav-link {{ request()->routeIs('sales') ? 'nav-link-active' : '' }}">
                Акції
            </a>

            <a href="{{ route('about') }}"
               class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">
                Про нас
            </a>
        </nav>

        {{-- Правий блок --}}
        <div class="flex items-center gap-4">

            {{-- Кошик --}}
            <a href="{{ route('cart.index') }}"
               class="nav-link relative {{ request()->routeIs('cart.index') ? 'nav-link-active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 inline-block mr-1"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 9m12-9l2 9m-6-9v9m0 0H9m3 0h3"/>
                </svg>

                Кошик

                @php
                    $count = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                @endphp

                @if($count > 0)
                    <span class="absolute -top-2 -right-3 bg-lime-500 text-black text-xs px-1.5 py-0.5 rounded-full font-bold shadow-md">
                        {{ $count }}
                    </span>
                @endif
            </a>

            {{-- ADMIN MENU --}}
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="relative">
                        <button onclick="toggleAdminMenu()"
                                class="text-lime-400 hover:text-white transition font-semibold">
                            Адмін ▾
                        </button>

                        <div id="adminMenu"
                             class="hidden absolute right-0 mt-2 w-52 bg-zinc-900 border border-zinc-800
                                    rounded-xl shadow-xl p-3 space-y-2">

                            <a href="{{ route('admin.products.index') }}"
                               class="block text-zinc-300 hover:text-white text-sm">
                                Меню товарів
                            </a>

                            <a href="{{ route('admin.categories.index') }}"
                               class="block text-zinc-300 hover:text-white text-sm">
                                Меню категорій
                            </a>

                            <a href="{{ route('admin.products.create') }}"
                               class="block text-zinc-300 hover:text-white text-sm">
                                ➕ Додати товар
                            </a>

                            <a href="{{ route('admin.categories.create') }}"
                               class="block text-zinc-300 hover:text-white text-sm">
                                ➕ Додати категорію
                            </a>
                        </div>
                    </div>
                @endif

                {{-- ПРОФІЛЬ --}}
                <a href="{{ route('profile.edit') }}"
                   class="text-zinc-300 hover:text-lime-400 text-sm font-semibold transition">
                    Профіль
                </a>

                <span class="text-zinc-500">|</span>

                {{-- Ім’я --}}
                <span class="text-zinc-400 text-sm">
                    {{ auth()->user()->name }}
                </span>

                {{-- Вихід --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-link hover:text-lime-400">
                        Вийти
                    </button>
                </form>

            @else
                <a href="{{ route('login.show') }}" class="nav-link">Вхід</a>
                <a href="{{ route('register.show') }}" class="btn-accent animate-fade-in">
                    Реєстрація
                </a>
            @endauth

        </div>

        {{-- Mobile menu btn --}}
        <button class="md:hidden text-zinc-300 hover:text-white transition" onclick="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                       d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    {{-- MOBILE MENU --}}
    <div id="mobileMenu" class="hidden md:hidden bg-black/95 border-b border-zinc-800 p-6 space-y-4">

        <a href="{{ route('home') }}" class="block nav-link">Головна</a>
        <a href="{{ route('sales') }}" class="block nav-link">Акції</a>
        <a href="{{ route('about') }}" class="block nav-link">Про нас</a>
        <a href="{{ route('cart.index') }}" class="block nav-link">Кошик</a>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.products.index') }}" class="block nav-link">Панель товарів</a>
                <a href="{{ route('admin.categories.index') }}" class="block nav-link">Панель категорій</a>
                <a href="{{ route('admin.products.create') }}" class="block nav-link">Додати товар</a>
                <a href="{{ route('admin.categories.create') }}" class="block nav-link">Додати категорію</a>
            @endif

            <a href="{{ route('profile.edit') }}" class="block nav-link">Профіль</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-dark w-full">Вийти</button>
            </form>

        @else
            <a href="{{ route('login.show') }}" class="block btn-dark">Вхід</a>
            <a href="{{ route('register.show') }}" class="block btn-accent text-center">Реєстрація</a>
        @endauth
    </div>

</header>

<main class="flex-1">
    @yield('content')
</main>

<footer class="app-container py-10 text-sm text-zinc-500 border-t border-zinc-800 mt-12">
    © {{ date('Y') }} <span class="text-lime-400 font-semibold">IRON NUTRITION</span>. Усі права захищені.
</footer>

<script>
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }

    function toggleAdminMenu() {
        document.getElementById('adminMenu').classList.toggle('hidden');
    }
</script>

</body>
</html>
