@extends('layouts.app')

@section('content')

{{-- форма входу --}}
<div class="min-h-[70vh] flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-md bg-zinc-900/80 border border-zinc-800 rounded-2xl p-8 shadow-xl animate-fade-up">

        <h2 class="text-2xl font-bold text-center mb-6">
            Вхід до акаунту
        </h2>

        {{-- помилки --}}
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-400">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.perform') }}" class="space-y-5">
            @csrf

            {{-- email --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-zinc-300">Електронна пошта</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full input-dark"
                       required>
            </div>

            {{-- пароль --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-zinc-300">Пароль</label>
                <input type="password" name="password"
                       class="w-full input-dark"
                       required>
            </div>

            {{-- памʼять + реєстрація --}}
            <div class="flex items-center justify-between text-sm text-zinc-400">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded bg-zinc-800 border-zinc-700">
                    <span>Запам’ятати мене</span>
                </label>

                <a href="{{ route('register.show') }}" class="text-lime-400 hover:text-lime-300 transition">
                    Реєстрація
                </a>
            </div>

            {{-- кнопка --}}
            <button type="submit"
                    class="w-full btn-accent text-base py-3">
                Увійти
            </button>
        </form>

    </div>

</div>

@endsection
