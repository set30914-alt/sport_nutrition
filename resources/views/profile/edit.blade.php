@extends('layouts.app')

@section('content')

<div class="app-container py-12">

    <h1 class="text-3xl font-extrabold text-white mb-6">
        Управління профілем
    </h1>

    {{-- Повідомлення --}}
    @if(session('success'))
        <div class="bg-lime-600 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-10">

        {{-- ПРОФІЛЬ --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">
            <h2 class="text-xl text-white font-bold mb-4">Особисті дані</h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block text-zinc-400 mb-1">Ім’я</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="input-dark mb-4">

                <label class="block text-zinc-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="input-dark mb-4">

                <button class="btn-accent px-6 py-2">Зберегти</button>
            </form>
        </div>

        {{-- ПАРОЛЬ --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">
            <h2 class="text-xl text-white font-bold mb-4">Змінити пароль</h2>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block text-zinc-400 mb-1">Поточний пароль</label>
                <input type="password" name="current_password"
                    class="input-dark mb-4">

                <label class="block text-zinc-400 mb-1">Новий пароль</label>
                <input type="password" name="password"
                    class="input-dark mb-4">

                <label class="block text-zinc-400 mb-1">Підтвердження паролю</label>
                <input type="password" name="password_confirmation"
                    class="input-dark mb-4">

                <button class="btn-accent px-6 py-2">Оновити пароль</button>
            </form>
        </div>

    </div>

</div>

@endsection
