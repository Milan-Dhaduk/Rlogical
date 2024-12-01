<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class FrontController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('frontend.products.index', compact('products'));
    }

    public function detailsView(Product $product,$id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.products.show', compact('product'));
    }
}
