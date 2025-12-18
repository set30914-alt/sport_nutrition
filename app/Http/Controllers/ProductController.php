<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        // CRUD — лише admin
        $this->middleware(['auth', 'is_admin'])->except(['home', 'show', 'randomDiscount']);
    }

    /*
    |--------------------------------------------------------------------------
    | ГОЛОВНА СТОРІНКА (каталог із пагінацією)
    |--------------------------------------------------------------------------
    */
    public function home(Request $request)
{
    $categories = Category::orderBy('name')->get();

    $query = Product::with('category')->latest();

    // Пошук
    if ($request->filled('q')) {
        $query->where(function ($q2) use ($request) {
            $q2->where('name', 'like', '%' . $request->q . '%')
               ->orWhere('description', 'like', '%' . $request->q . '%');
        });
    }

    // Категорія
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Ціна ВІД
    if ($request->filled('price_from')) {
        $query->where('price', '>=', $request->price_from);
    }

    // Ціна ДО
    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // Пагінація 10 на сторінку
    $products = $query->paginate(10)->withQueryString();

    return view('home', compact('products', 'categories'));
}


    /*
    |--------------------------------------------------------------------------
    | АДМІН: СПИСОК ВСІХ ТОВАРІВ
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Product::with('category');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        $products = $query->orderBy('created_at', 'desc')
                          ->paginate(12)
                          ->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | ДЕТАЛЬНА СТОРІНКА ТОВАРУ
    |--------------------------------------------------------------------------
    */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: СТВОРЕННЯ ТОВАРУ
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'max:255'],
            'description' => ['required'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Товар успішно додано.');
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: РЕДАГУВАННЯ ТОВАРУ
    |--------------------------------------------------------------------------
    */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required', 'max:255'],
            'description' => ['required'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096']
        ]);

        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Товар успішно оновлено.');
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН: ВИДАЛЕННЯ ТОВАРУ
    |--------------------------------------------------------------------------
    */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Товар видалено.');
    }

    /*
    |--------------------------------------------------------------------------
    | АКЦІЇ: Рандомна знижка + рандомний товар
    |--------------------------------------------------------------------------
    */
    public function randomDiscount()
    {
        $discounts = [5, 10, 15, 20, 25, 30];
        $discount = $discounts[array_rand($discounts)];

        $product = Product::inRandomOrder()->first();

        $discounted_price = round($product->price - ($product->price * ($discount / 100)), 2);

        return response()->json([
            'discount' => $discount,
            'product' => [
                'name' => $product->name,
                'image' => asset('storage/' . $product->image),
                'old_price' => $product->price,
                'new_price' => $discounted_price,
                'id' => $product->id
            ]
        ]);
    }
}
