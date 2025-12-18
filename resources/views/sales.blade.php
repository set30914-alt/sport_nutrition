@extends('layouts.app')

@section('content')

<div class="app-container py-16 min-h-screen flex flex-col items-center justify-center bg-zinc-900">

    <h1 class="text-4xl font-bold text-center text-white mb-4">
        🎉 Акційна рулетка!
    </h1>

    <p class="text-center text-zinc-400 mb-12 max-w-lg">
        Натисни "GO", щоб отримати випадкову знижку на обраний нами товар.
    </p>

    <div class="relative w-[360px] h-[360px] mb-12 p-3 rounded-full bg-zinc-800 border-2 border-zinc-700 shadow-[0_0_50px_-10px_rgba(163,230,53,0.3)]">

        <div class="absolute top-[-25px] left-1/2 -translate-x-1/2 z-20 drop-shadow-md">
            <svg width="46" height="46" viewBox="0 0 40 40" fill="none">
                <path d="M20 40L0 0H40L20 40Z" fill="url(#arrowGrad)"/>
                <defs>
                    <linearGradient id="arrowGrad" x1="20" y1="0" x2="20" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#ecfccb"/>
                        <stop offset="1" stop-color="#84cc16"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <button id="spinBtn" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 w-24 h-24 bg-white rounded-full border-[8px] border-zinc-800 shadow-[0_0_15px_rgba(0,0,0,0.5)] flex items-center justify-center cursor-pointer hover:scale-105 transition-transform duration-200 group">
            <span class="font-black text-2xl text-zinc-800 group-hover:text-lime-600 transition-colors">GO</span>
        </button>

        <div id="wheelWrapper" class="w-full h-full rounded-full overflow-hidden transition-transform duration-[4000ms] ease-[cubic-bezier(0.25,0.1,0.25,1)] relative" style="transform: rotate(0deg);">
            
            <svg viewBox="0 0 100 100" class="w-full h-full transform -rotate-90">
                <defs>
                    <linearGradient id="darkGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color:#3f3f46" />
                        <stop offset="100%" style="stop-color:#18181b" />
                    </linearGradient>
                    <linearGradient id="limeGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color:#d9f99d" />
                        <stop offset="100%" style="stop-color:#84cc16" />
                    </linearGradient>
                    <filter id="innerShadow" x="-20%" y="-20%" width="140%" height="140%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="2" result="blur"/>
                        <feOffset dx="1" dy="1"/>
                        <feComposite in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1"/>
                        <feFlood flood-color="black" flood-opacity="0.3"/>
                        <feComposite in2="blur" operator="in"/>
                        <feComposite in2="SourceGraphic" operator="over"/>
                    </filter>
                </defs>

                <circle cx="50" cy="50" r="49.5" fill="none" stroke="#27272a" stroke-width="1"/>

                <g>
                    <path d="M50 50 L100 50 A50 50 0 0 1 75 93.3 Z" fill="url(#darkGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="white" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(30 50 50)">5%</text>
                </g>

                <g>
                    <path d="M50 50 L75 93.3 A50 50 0 0 1 25 93.3 Z" fill="url(#limeGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="#1a2e05" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(90 50 50)">10%</text>
                </g>

                <g>
                    <path d="M50 50 L25 93.3 A50 50 0 0 1 0 50 Z" fill="url(#darkGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="white" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(150 50 50)">15%</text>
                </g>

                <g>
                    <path d="M50 50 L0 50 A50 50 0 0 1 25 6.7 Z" fill="url(#limeGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="#1a2e05" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(210 50 50)">20%</text>
                </g>

                <g>
                    <path d="M50 50 L25 6.7 A50 50 0 0 1 75 6.7 Z" fill="url(#darkGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="white" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(270 50 50)">25%</text>
                </g>

                <g>
                    <path d="M50 50 L75 6.7 A50 50 0 0 1 100 50 Z" fill="url(#limeGrad)" stroke="#27272a" stroke-width="0.3" />
                    <text x="75" y="50" fill="#1a2e05" font-size="7" font-weight="900" text-anchor="middle" dominant-baseline="middle" transform="rotate(330 50 50)">30%</text>
                </g>

            </svg>
        </div>
    </div>

    <div id="resultBox" class="mt-4 text-center hidden opacity-0 transition-opacity duration-1000 bg-zinc-800 p-6 rounded-xl border border-zinc-700 shadow-2xl max-w-md w-full">
        <h2 class="text-3xl font-bold text-lime-400 mb-2" id="discountText"></h2>
        <div class="h-px w-full bg-zinc-600 my-4"></div>
        <p class="text-zinc-300 text-lg" id="productText"></p>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wheel = document.getElementById('wheelWrapper');
        const spinBtn = document.getElementById('spinBtn');
        const resultBox = document.getElementById('resultBox');
        const discountText = document.getElementById('discountText');
        const productText = document.getElementById('productText');

        // Масив значень (порядок по годинниковій стрілці в SVG)
        const segments = [5, 10, 15, 20, 25, 30]; 
        
        let spinning = false;

        spinBtn.addEventListener("click", function () {
            if (spinning) return;
            spinning = true;
            spinBtn.disabled = true;
            
            resultBox.classList.add('hidden', 'opacity-0');
            resultBox.classList.remove('opacity-100');

            // Випадковий вибір
            const winningIndex = Math.floor(Math.random() * segments.length);
            const winningDiscount = segments[winningIndex];

            // Розрахунок кута
            const sectorAngle = 360 / segments.length; // 60
            const fullSpins = 5; 
            
            // Щоб сектор став під стрілку (верх):
            // Оскільки SVG повернуто на -90, а 0 градусів у нас праворуч,
            // а перший сектор (індекс 0) займає 0-60 градусів...
            // Центр першого сектора = 30 град.
            // Щоб поставити 30 град на верх (де зараз фактично 0 через CSS rotate), треба...
            
            // Простіша логіка: 
            // Індекс 0 (5%) -> кут зупинки має бути таким, щоб сектор 1 був зверху.
            // Формула: (Spins * 360) + (360 - (Index * 60)) - 30 (половина сектора)
            // RandomOffset додає трохи "життя" (не завжди ідеально центр)
            const randomOffset = Math.floor(Math.random() * 20) - 10; 
            const stopAngle = (360 * fullSpins) + (360 - (winningIndex * sectorAngle)) - (sectorAngle / 2) + randomOffset;

            wheel.style.transform = `rotate(${stopAngle}deg)`;

            setTimeout(() => {
                // Запит на бекенд (імітація або реальний)
                fetch("/api/random-product")
                    .then(res => res.json())
                    .then(product => {
                        let newPrice = (product.price - (product.price * winningDiscount / 100)).toFixed(2);

                        resultBox.classList.remove("hidden");
                        setTimeout(() => resultBox.classList.add("opacity-100"), 50);

                        discountText.innerText = `Знижка -${winningDiscount}%!`;
                        productText.innerHTML = `
                            <div class="flex flex-col gap-2">
                                <span class="text-white font-medium">${product.name}</span>
                                <div class="text-sm text-zinc-500 line-through">${product.price} ₴</div>
                                <div class="text-3xl font-bold text-white">${newPrice} <span class="text-sm text-lime-400">₴</span></div>
                                <a href="/product/${product.id}" class="mt-4 inline-block bg-lime-500 hover:bg-lime-600 text-black font-bold py-2 px-4 rounded transition-colors">
                                    Купити зі знижкою
                                </a>
                            </div>
                        `;
                    })
                    .catch(err => {
                        console.error(err);
                        // Фолбек якщо немає бекенду
                        discountText.innerText = `Знижка -${winningDiscount}%!`;
                        resultBox.classList.remove("hidden");
                        setTimeout(() => resultBox.classList.add("opacity-100"), 50);
                    })
                    .finally(() => {
                        spinning = false;
                        spinBtn.disabled = false;
                    });

            }, 4000);
        });
    });
</script>
@endsection