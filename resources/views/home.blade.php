@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- HERO SECTION --}}
{{-- ========================= --}}
<section class="hero-section relative overflow-hidden">

    <div class="absolute inset-0 bg-black/60 z-[1]"></div>

    <div class="absolute inset-0 bg-cover bg-center opacity-30 z-0"
         style="background-image: url('{{ asset('images/hero-gym.jpg') }}');">
    </div>

    <div class="hero-inner relative z-[2] animate-fade-up">

        <div class="space-y-5 max-w-xl">
            <span class="hero-badge">Нова колекція 2024</span>

            <h1 class="hero-title">
                ТВОЯ ЕНЕРГІЯ<br>
                <span class="hero-title-accent">ТВОЯ ПЕРЕМОГА</span>
            </h1>

            <p class="hero-subtitle">
                Преміальне спортивне харчування для максимальних результатів.
                Якість, якій довіряють професіонали.
            </p>

            <div class="hero-cta">
                <a href="#catalog"
                   class="btn-accent text-lg px-8 py-3 shadow-xl shadow-lime-500/20 hover:shadow-lime-500/40">
                    Переглянути товари →
                </a>
            </div>
        </div>

        <div class="hidden lg:flex justify-center items-center animate-slide-right">
            <img src="{{ asset('images/athlete.png') }}"
                 alt="Athlete"
                 class="w-[460px] max-w-none drop-shadow-[0_15px_30px_rgba(0,0,0,0.7)]
                        saturate-150 contrast-125 brightness-105 rounded-3xl border border-zinc-800">
        </div>

    </div>
</section>

<form method="GET" action="{{ route('home') }}"
      class="mb-10 bg-zinc-900 border border-zinc-800 p-6 rounded-2xl shadow-xl">

    <div class="grid md:grid-cols-4 gap-6">

        {{-- Пошук --}}
        <div>
            <label class="text-zinc-400 text-sm">Пошук</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Назва або опис..."
                   class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl px-3 py-2 focus:border-lime-500">
        </div>

        {{-- Категорія --}}
        <div>
            <label class="text-zinc-400 text-sm">Категорія</label>
            <select name="category"
                    class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl px-3 py-2 focus:border-lime-500">
                <option value="">Усі категорії</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Ціна від --}}
        <div>
            <label class="text-zinc-400 text-sm">Ціна від</label>
            <input type="number" name="price_from" value="{{ request('price_from') }}"
                   class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl px-3 py-2 focus:border-lime-500">
        </div>

        {{-- Ціна до --}}
        <div>
            <label class="text-zinc-400 text-sm">Ціна до</label>
            <input type="number" name="price_to" value="{{ request('price_to') }}"
                   class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl px-3 py-2 focus:border-lime-500">
        </div>

    </div>

    <div class="mt-6 flex justify-between">
        <button class="btn-accent px-6 py-2">Фільтрувати</button>

        <a href="{{ route('home') }}" class="text-zinc-400 hover:text-white text-sm">
            Скинути фільтри
        </a>
    </div>

</form>


{{-- ========================= --}}
{{-- PRODUCTS LIST WITH PAGINATION --}}
{{-- ========================= --}}
<section id="catalog" class="products-section animate-fade-in pt-6">

    @if ($products->count() > 0)

        <div class="space-y-6">

            @foreach ($products as $product)

                {{-- WIDE PRODUCT CARD --}}
                <div class="w-full bg-zinc-900 rounded-2xl border border-zinc-800 shadow-xl overflow-hidden
                            flex flex-col md:flex-row items-stretch hover:border-lime-500/40 transition duration-300">

                    {{-- LEFT TEXT --}}
                    <div class="flex-1 p-6 flex flex-col justify-between">

                        <div>
                            <span class="px-3 py-1 bg-zinc-800 text-zinc-300 text-xs rounded-lg">
                                {{ $product->category->name ?? 'Товар' }}
                            </span>

                            <h3 class="mt-3 text-2xl font-bold text-white">
                                {{ $product->name }}
                            </h3>

                            <p class="mt-2 text-zinc-400 text-sm leading-relaxed">
                                {{ Str::limit($product->description, 150) }}
                            </p>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <span class="text-lime-400 font-bold text-xl">
                                {{ number_format($product->price, 2) }} ₴
                            </span>

                            <a href="{{ route('products.show', $product) }}"
                               class="text-sm font-semibold text-lime-400 hover:text-white transition">
                                Детальніше →
                            </a>
                        </div>

                    </div>

                    {{-- IMAGE --}}
                    <div class="w-full md:w-2/5 bg-zinc-950 flex items-center justify-center p-4">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="max-h-56 w-auto object-contain rounded-xl"
                                 alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/no-image.png') }}"
                                 class="max-h-56 w-auto object-contain opacity-60 rounded-xl"
                                 alt="no image">
                        @endif
                    </div>

                </div>

            @endforeach

        </div>

        {{-- ========================= --}}
        {{-- BEAUTIFUL PAGINATION --}}
        {{-- ========================= --}}
        <div class="mt-10 flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>

    @else

        <p class="text-zinc-400 text-center py-16 text-lg">
            Товарів поки немає. Додайте перший товар у панелі адміністратора.
        </p>

    @endif

</section>

@endsection
