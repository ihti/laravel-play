<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;

class ProductsController extends Controller
{

    public function index() {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $product->update($data);

        return response()->json($product);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete($id);

        return response()->json(['success' => true]);
    }
}
