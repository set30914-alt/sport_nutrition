@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden py-20">

    {{-- Фон --}}
    <div class="absolute inset-0 bg-cover bg-center opacity-20"
         style="background-image: url('{{ asset('images/about-gym.jpg') }}');">
    </div>

    <div class="app-container relative z-10">
        

        {{-- Заголовок --}}
        <h1 class="text-4xl font-extrabold text-white mb-6 animate-fade-up flex items-center gap-3">
            <span class="w-2 h-10 bg-lime-500 rounded"></span>
            Про нас
        </h1>

        {{-- Перший блок --}}
        <div class="bg-zinc-900/70 border border-zinc-800 rounded-2xl p-8 mb-12 backdrop-blur-xl animate-fade-up">

            <h2 class="text-2xl font-bold text-white mb-4">Історія IRON NUTRITION</h2>

            <p class="text-zinc-400 leading-relaxed text-lg">
                IRON NUTRITION народився у 2020 році як маленький локальний магазин спортивного харчування,
                створений спортсменами для спортсменів. Ми починали з кількох видів протеїну та вітамінів,
                які особисто перевіряли на собі — якість була нашим головним принципом з першого дня.
            </p>

            <p class="text-zinc-400 leading-relaxed text-lg mt-4">
                Наше завдання — забезпечити атлетів України продуктами, яким вони можуть довіряти.
                Ми працюємо тільки з перевіреними брендами, тестуємо партії та гарантуємо, що кожен товар
                відповідає найвищим стандартам якості.
            </p>
        </div>

        {{-- Другий блок --}}
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="space-y-6 animate-fade-up">
                <p>

</p>
                <h2 class="text-3xl font-bold text-white">Наш шлях</h2>

                <p class="text-zinc-400 text-lg leading-relaxed">
                    За декілька років ми виросли з невеликої точки продажу до повноцінної онлайн-платформи,
                    яка пропонує широкий асортимент спортивного харчування, аксесуарів та товарів для здоров'я.
                </p>

                <ul class="space-y-3 text-zinc-300 text-lg">
                    <li>🏆 Більше 5 000 задоволених клієнтів</li>
                    <li>💪 Понад 300 різних продуктів</li>
                    <li>🚀 Швидка доставка по Україні</li>
                    <li>🔬 Перевірена якість кожної одиниці товару</li>
                </ul>
            </div>

            <div class="animate-slide-right">
                <img src="{{ asset('images/about-team.jpg') }}"
                     class="rounded-2xl border border-zinc-800 shadow-2xl object-cover w-full"
                     alt="Iron Nutrition Team">
            </div>

        </div>

        {{-- Наше бачення --}}
        <div class="mt-16 bg-zinc-900/70 border border-zinc-800 rounded-2xl p-8 backdrop-blur-xl animate-fade-up">
            <h2 class="text-3xl font-bold text-white mb-4">Наше бачення</h2>

            <p class="text-zinc-400 text-lg leading-relaxed">
                Ми віримо, що кожен може стати сильнішим — фізично, морально, духовно.
                Наша місія — підтримувати людей на їхньому шляху до ідеальної форми та здорового життя.
            </p>

            <p class="text-zinc-400 text-lg leading-relaxed mt-4">
                IRON NUTRITION — це не просто магазин. Це спільнота однодумців,
                які не зупиняються на досягнутому.
            </p>
        </div>

    </div>
</section>

@endsection
