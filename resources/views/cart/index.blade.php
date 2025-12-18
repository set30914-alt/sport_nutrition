@extends('layouts.app')

@section('content')
<div class="app-container py-12">

    <h1 class="text-3xl font-extrabold text-white mb-8">🛒 Ваш кошик</h1>

    @if(!$cart || count($cart) === 0)
        <p class="text-zinc-400 text-lg">Кошик порожній.</p>
        <a href="{{ route('home') }}" class="btn-accent mt-4 inline-block px-6 py-2">
            Перейти до каталогу
        </a>
    @endif

    <div class="space-y-6">
        @php $total = 0; @endphp

        @foreach($cart as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp

            <div class="flex items-center justify-between bg-zinc-900 p-4 rounded-xl border border-zinc-800">

                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-20 h-20 object-cover rounded-lg">

                    <div>
                        <h3 class="text-white font-bold">{{ $item['name'] }}</h3>
                        <p class="text-zinc-400">{{ $item['price'] }} ₴</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">

                    {{-- Кількість --}}
                    <form action="{{ route('cart.update', $id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                               min="1"
                               class="w-14 px-1 py-1 bg-zinc-800 border border-zinc-700 text-center rounded text-white">
                        <button class="text-lime-400 text-sm">Оновити</button>
                    </form>

                    {{-- Видалити --}}
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="text-red-400 hover:text-red-300 text-sm">Видалити</button>
                    </form>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-10 text-right">
        <h2 class="text-2xl text-white mb-4">
            Разом: <span class="text-lime-400">{{ number_format($total, 2) }} ₴</span>
        </h2>

        <form action="{{ route('cart.clear') }}" method="POST" class="inline">
            @csrf
            <button class="btn-dark px-6 py-2">Очистити кошик</button>
        </form>

    </div>

</div>
@endsection
