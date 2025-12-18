@extends('layouts.app')

@section('content')

<div class="app-container py-12">



    {{-- ОСНОВНИЙ БЛОК --}}
    <div class="flex flex-col lg:flex-row gap-10 bg-zinc-900 rounded-2xl border border-zinc-800 p-8 shadow-xl">

        {{-- Ліво: Фото товару --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-zinc-950 rounded-xl p-6">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-full max-h-[480px] object-contain rounded-xl drop-shadow-xl"
                     alt="{{ $product->name }}">
            @else
                <img src="{{ asset('images/no-image.png') }}"
                     class="w-full max-h-[480px] object-contain opacity-60 rounded-xl"
                     alt="no image">
            @endif
        </div>

        {{-- Право: Опис товару --}}
        <div class="flex-1 flex flex-col justify-between">

            {{-- Назва --}}
            <div>
                <span class="px-3 py-1 bg-zinc-800 text-zinc-300 text-xs rounded-lg">
                    {{ $product->category->name ?? 'Категорія' }}
                </span>

                <h1 class="text-4xl font-extrabold text-white mt-4">
                    {{ $product->name }}
                </h1>

                {{-- Ціна --}}
                <div class="mt-4">
                    <span class="text-lime-400 font-bold text-3xl">
                        {{ number_format($product->price, 2) }} ₴
                    </span>
                </div>

                {{-- Короткий опис --}}
                <p class="text-zinc-400 text-md mt-6 leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            {{-- Кнопки --}}
            <div class="mt-10 flex items-center gap-4">

                <form action="{{ route('cart.add', $product) }}" method="POST">
    @csrf
    <button class="btn-accent px-6 py-2 mt-4">
        🛒 Додати у кошик
    </button>
</form>




            </div>

        </div>
    </div>


    {{-- ========================= --}}
    {{-- СХОЖІ ТОВАРИ --}}
    {{-- ========================= --}}
    @php
        $similar = \App\Models\Product::where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->take(4)
                    ->get();
    @endphp

    @if ($similar->count() > 0)
    <div class="mt-16">

        <h2 class="text-2xl font-extrabold text-white mb-6 flex items-center gap-3">
            <span class="w-2 h-6 bg-lime-500 rounded"></span>
            Схожі товари
        </h2>

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

            @foreach($similar as $item)
                <a href="{{ route('products.show', $item) }}"
                   class="block bg-zinc-900 rounded-xl border border-zinc-800 p-5 hover:border-lime-500/40 transition">

                    {{-- Фото --}}
                    <div class="w-full h-48 bg-zinc-950 rounded-xl flex items-center justify-center mb-4">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 class="max-h-40 object-contain" alt="">
                        @else
                            <img src="{{ asset('images/no-image.png') }}"
                                 class="max-h-40 opacity-60" alt="">
                        @endif
                    </div>

                    {{-- Назва --}}
                    <h3 class="text-white font-semibold text-lg">
                        {{ $item->name }}
                    </h3>

                    {{-- Ціна --}}
                    <p class="text-lime-400 font-bold mt-2">
                        {{ number_format($item->price, 2) }} ₴
                    </p>

                </a>
            @endforeach

        </div>

    </div>
    @endif

</div>

@endsection
