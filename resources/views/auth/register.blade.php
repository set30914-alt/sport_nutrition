@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-16">

    <div class="w-full max-w-md bg-zinc-900/80 border border-zinc-800 rounded-2xl p-8 shadow-2xl animate-fade-up">

        <h2 class="text-3xl font-extrabold text-center mb-6 text-white tracking-tight">
            Створити акаунт
        </h2>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-500 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.perform') }}" class="space-y-5">
            @csrf

            {{-- ім’я --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Ім’я</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="filter-input"
                       required>
            </div>

            {{-- email --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Електронна пошта</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="filter-input"
                       required>
            </div>

            {{-- пароль --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Пароль</label>
                <input type="password" name="password"
                       class="filter-input"
                       required>
            </div>

            {{-- підтвердження --}}
            <div>
                <label class="block mb-2 text-sm text-zinc-300">Підтвердження паролю</label>
                <input type="password" name="password_confirmation"
                       class="filter-input"
                       required>
            </div>

            {{-- продавець --}}
            {{-- role --}}
<div class="flex items-center gap-2">
    <input type="checkbox" name="is_seller"
           class="rounded bg-zinc-900 border-zinc-700 text-lime-500 focus:ring-lime-500">
    <label class="text-sm text-zinc-300">Продавець</label>
</div>


            {{-- кнопка --}}
            <button type="submit"
                    class="btn-accent w-full py-3 rounded-xl text-lg font-semibold">
                Зареєструватися
            </button>

            <p class="text-center text-sm text-zinc-400 mt-3">
                Вже є акаунт?
                <a href="{{ route('login.show') }}" class="text-lime-400 hover:underline">
                    Увійти
                </a>
            </p>

        </form>

    </div>

</div>
@endsection
