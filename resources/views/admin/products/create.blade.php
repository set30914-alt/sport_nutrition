@extends('layouts.app')

@section('content')

<div class="app-container py-12">
    
    {{-- Заголовок --}}
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-2xl font-extrabold text-white">Додати новий товар</h1>

 
    </div>

    {{-- Форма --}}
    <div class="bg-zinc-900/80 border border-zinc-800 rounded-2xl p-8 shadow-xl max-w-3xl mx-auto">

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/20 text-red-400 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Назва --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Назва товару</label>
                <input type="text" name="name" value="{{ old('name') }}" class="filter-input" required>
            </div>

            {{-- Категорія --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Категорія</label>
                <select name="category_id" class="filter-input" required>
                    <option value="">Оберіть категорію</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Ціна --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Ціна (₴)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="filter-input" required>
            </div>

            {{-- Фото --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Зображення товару</label>

                <input type="file" name="image"
                       class="block w-full text-sm text-zinc-300 border border-zinc-700 rounded-xl cursor-pointer bg-zinc-900 focus:outline-none">

                <p class="text-xs text-zinc-500 mt-1">
                    Дозволені формати: JPG, JPEG, PNG. Максимум 2MB.
                </p>
            </div>

            {{-- Опис --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Опис товару</label>
                <textarea name="description" rows="5" class="filter-input" required>{{ old('description') }}</textarea>
            </div>

            {{-- Кнопка --}}
            <button class="btn-accent w-full py-3 text-black font-semibold rounded-xl">
                Додати товар
            </button>

        </form>

    </div>
</div>

@endsection
