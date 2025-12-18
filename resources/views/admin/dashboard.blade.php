@extends('layouts.app')

@section('content')
<div class="app-container py-16">

    <h1 class="text-3xl font-bold text-white mb-8">
        Адмін-панель
    </h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('products.index') }}"
           class="product-card p-6 text-center hover:border-lime-500/80">
            <h2 class="text-xl font-semibold mb-2">Товари</h2>
            <p class="text-zinc-400 text-sm">Перегляд, редагування, додавання</p>
        </a>

        <a href="{{ route('categories.index') }}"
           class="product-card p-6 text-center hover:border-lime-500/80">
            <h2 class="text-xl font-semibold mb-2">Категорії</h2>
            <p class="text-zinc-400 text-sm">Керування категоріями</p>
        </a>

        <a href="{{ route('products.create') }}"
           class="product-card p-6 text-center hover:border-lime-500/80">
            <h2 class="text-xl font-semibold mb-2">Додати товар</h2>
            <p class="text-zinc-400 text-sm">Створення нового товару</p>
        </a>

    </div>

</div>
@endsection
