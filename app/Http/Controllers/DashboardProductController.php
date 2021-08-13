<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['productGalleries', 'category'])
            ->where('users_id', Auth::user()->id)
            ->get();

        return view('pages.dashboard-products', [
            'products' => $products,
        ]);
    }

    public function details(Request $request, $id)
    {
        $product = Product::with(['productGalleries', 'user', 'category'])->firstOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard-products-create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }
}
