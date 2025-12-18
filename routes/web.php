<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Головна сторінка
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'home'])->name('home');


/*
|--------------------------------------------------------------------------
| Аутентифікація
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.perform');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register.show');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.perform');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Публічний перегляд товару
|--------------------------------------------------------------------------
*/

Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('products.show');



/*
|--------------------------------------------------------------------------
| Профіль користувача (лише для авторизованих)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');


    /*
    |--------------------------------------------------------------------------
    | Кошик
    |--------------------------------------------------------------------------
    */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});



/*
|--------------------------------------------------------------------------
| Про нас / Акції
|--------------------------------------------------------------------------
*/

Route::get('/about', fn() => view('about'))->name('about');
Route::get('/sales', fn() => view('sales'))->name('sales');

Route::get('/random-discount-product', [ProductController::class, 'randomDiscount'])
    ->name('random.discount');


/*
|--------------------------------------------------------------------------
| Адмін-панель (доступ тільки admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ТОВАРИ
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // КАТЕГОРІЇ
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

