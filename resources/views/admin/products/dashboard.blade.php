@extends('layouts.app')

@section('content')

<div class="app-container py-12">

    {{-- заголовок --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white">Редагування товару</h1>
            <p class="text-zinc-400 text-sm mt-1">Оновіть дані товару</p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn-dark">
            ← Повернутися
        </a>
    </div>

    {{-- форма --}}
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-8 shadow-xl">

        <form action="{{ route('admin.products.update', $product) }}" 
              method="POST" enctype="multipart/form-data" 
              class="space-y-6">

            @csrf
            @method('PUT')

            {{-- назва --}}
            <div>
                <label class="form-label">Назва товару</label>
                <input type="text" name="name" class="filter-input"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            {{-- опис --}}
            <div>
                <label class="form-label">Опис</label>
                <textarea name="description" rows="4" class="filter-input"
                          required>{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- ціна --}}
            <div>
                <label class="form-label">Ціна (грн)</label>
                <input type="number" step="0.01" name="price"
                       class="filter-input"
                       value="{{ old('price', $product->price) }}" required>
            </div>

            {{-- категорія --}}
            <div>
                <label class="form-label">Категорія</label>
                <select name="category_id" class="filter-input" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- зображення --}}
            <div>
                <label class="form-label">Нове зображення (необовʼязково)</label>
                <input type="file" name="image" class="filter-input">

                <p class="text-zinc-400 text-sm mt-2">Поточне:</p>

                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-40 rounded-lg border border-zinc-700 mt-2">
                @else
                    <p class="text-zinc-500 text-sm">Немає зображення</p>
                @endif
            </div>

            {{-- кнопка --}}
            <button type="submit" class="btn-accent w-full py-3">
                Зберегти зміни
            </button>

        </form>

    </div>
</div>

@endsection
