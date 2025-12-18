@extends('layouts.app')

@section('content')

<div class="app-container py-12 max-w-xl mx-auto">

    <h1 class="text-3xl font-extrabold text-white mb-8">Створити категорію</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- назва --}}
        <div>
            <label class="block text-sm text-zinc-300 mb-2">Назва категорії</label>
            <input type="text" name="name" required
                   class="filter-input"
                   value="{{ old('name') }}">
        </div>

        {{-- опис --}}
        <div>
            <label class="block text-sm text-zinc-300 mb-2">Опис (необов'язково)</label>
            <textarea name="description" rows="4" class="filter-input">{{ old('description') }}</textarea>
        </div>

        <button class="btn-accent px-6 py-2 w-full">
            Створити
        </button>

    </form>

</div>

@endsection
