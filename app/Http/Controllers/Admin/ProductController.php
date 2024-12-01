<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('categories')->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('categories', function ($row) {
                    return $row->categories->pluck('title')->implode(', ');
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('products.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="' . route('products.destroy', $row->id) . '" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'qty' => 'required|in:100,50',
            'status' => 'required|in:active,inactive',

            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'status' => $request->status,
        ]);

        $product->categories()->sync($request->categories);


        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'qty' => 'required|in:100,50',
            'status' => 'required|in:active,inactive',
            'categories' => 'required|array',
        ]);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'status' => $request->status,
        ]);
        // dd( $product);
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');

    }
}
