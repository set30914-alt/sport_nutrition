<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Публічний доступ — тільки index
        $this->middleware(['auth', 'is_admin'])->except(['index']);
    }

    /*
    |--------------------------------------------------------------------------
    | ПУБЛІЧНИЙ СПИСОК КАТЕГОРІЙ
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: СПИСОК КАТЕГОРІЙ
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: СТВОРЕННЯ КАТЕГОРІЇ (FORM)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.categories.create');
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: ЗБЕРЕЖЕННЯ НОВОЇ КАТЕГОРІЇ
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable'],
        ]);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію успішно додано.');
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: РЕДАГУВАННЯ КАТЕГОРІЇ (FORM)
    |--------------------------------------------------------------------------
    */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: ОНОВЛЕННЯ КАТЕГОРІЇ
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable'],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію успішно оновлено.');
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: ВИДАЛЕННЯ КАТЕГОРІЇ
    |--------------------------------------------------------------------------
    */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію видалено.');
    }
}
