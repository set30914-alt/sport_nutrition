@extends('layouts.app')

@section('content')

<div class="app-container py-12 max-w-xl mx-auto">

    <h1 class="text-3xl font-extrabold text-white mb-8">
        Редагувати категорію
    </h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- назва --}}
        <div>
            <label class="block text-sm text-zinc-300 mb-2">Назва категорії</label>
            <input type="text" name="name" required
                   class="filter-input"
                   value="{{ old('name', $category->name) }}">
        </div>

        {{-- опис --}}
        <div>
            <label class="block text-sm text-zinc-300 mb-2">Опис</label>
            <textarea name="description" rows="4" class="filter-input">{{ old('description', $category->description) }}</textarea>
        </div>

        <button class="btn-accent px-6 py-2 w-full">
            Оновити
        </button>

    </form>

</div>

@endsection
