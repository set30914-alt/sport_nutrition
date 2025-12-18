@extends('layouts.app')

@section('content')

<div class="app-container py-12">

    {{-- Заголовок --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Редагування товару</h1>
            <p class="text-zinc-400 text-sm">
                Ви редагуєте: <span class="text-lime-400">{{ $product->name }}</span>
            </p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="btn-outline px-6 py-2">
            ← Повернутись до списку
        </a>
    </div>


    {{-- Форма --}}
    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 shadow-xl">

        <form action="{{ route('admin.products.update', $product) }}"
              method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf
            @method('PUT')


            {{-- Назва --}}
            <div>
                <label class="form-label">Назва товару</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="form-input" required>
            </div>


            {{-- Категорія --}}
            <div>
                <label class="form-label">Категорія</label>
                <select name="category_id" class="form-input" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Опис --}}
            <div>
                <label class="form-label">Опис</label>
                <textarea name="description" rows="5" class="form-input" required>{{ old('description', $product->description) }}</textarea>
            </div>


            {{-- Ціна --}}
            <div>
                <label class="form-label">Ціна (₴)</label>
                <input type="number" step="0.01" name="price"
                       value="{{ old('price', $product->price) }}"
                       class="form-input" required>
            </div>


            {{-- Фото --}}
            <div>
                <label class="form-label">Фото товару</label>

                @if($product->image)
                    <p class="text-zinc-400 mb-2 text-sm">Поточне фото:</p>
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-40 h-40 object-contain rounded-xl border border-zinc-700 mb-4">
                @endif

                <input type="file" name="image" class="form-input">
                <p class="text-xs text-zinc-500 mt-1">Формати: jpg, jpeg, png, webp. Макс: 4MB</p>
            </div>


            {{-- Кнопки --}}
            <div class="flex items-center justify-between pt-6 border-t border-zinc-800">

                <button type="submit"
                        class="btn-accent px-8 py-2">
                    💾 Оновити товар
                </button>

                <form action="{{ route('admin.products.destroy', $product) }}"
                      method="POST"
                      onsubmit="return confirm('Ви впевнені, що хочете видалити цей товар?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn-danger px-6 py-2">
                        🗑 Видалити
                    </button>
                </form>

            </div>

        </form>

    </div>
</div>

@endsection
