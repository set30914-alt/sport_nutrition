@extends('layouts.app')

@section('content')

<div class="app-container py-12">

    {{-- Заголовок --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Панель категорій</h1>
            <p class="text-zinc-400 text-sm">Управління категоріями товарів</p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="btn-accent px-6 py-2">
            + Додати категорію
        </a>
    </div>

    {{-- Таблиця --}}
    <div class="overflow-x-auto border border-zinc-800 rounded-2xl bg-zinc-900/60 shadow-xl">

        <table class="w-full text-left text-sm">
            <thead class="bg-zinc-900 border-b border-zinc-800">
                <tr>
                    <th class="p-4 text-zinc-400">Назва</th>
                    <th class="p-4 text-zinc-400">Опис</th>
                    <th class="p-4 text-zinc-400 text-center">Дії</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b border-zinc-800 hover:bg-zinc-800/30 transition">

                        {{-- Назва --}}
                        <td class="p-4 font-semibold text-white">
                            {{ $category->name }}
                        </td>

                        {{-- Опис --}}
                        <td class="p-4 text-zinc-300 max-w-md">
                            {{ $category->description ?? '—' }}
                        </td>

                        {{-- Дії --}}
                        <td class="p-4 flex items-center justify-center gap-3">

                            {{-- Редагувати --}}
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="px-3 py-1.5 rounded-lg bg-zinc-800 border border-zinc-700 
                                      hover:border-lime-400 text-zinc-300 hover:text-white 
                                      transition text-xs">
                                Редагувати
                            </a>

                            {{-- Видалити --}}
                            <form action="{{ route('admin.categories.destroy', $category) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Видалити категорію?')">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1.5 rounded-lg bg-red-600 
                                               hover:bg-red-700 text-white text-xs">
                                    Видалити
                                </button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection
