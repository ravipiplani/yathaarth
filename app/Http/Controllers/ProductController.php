<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::active()
            ->with('variations:id,product_id,weight,unit_price,box_quantity,box_price')
            ->select('id', 'name', 'code', 'tax_rate')->get();
        return response()->json([
            'data' => $products
        ]);
    }

    public function show(Product $product) {
        return response()->json([
            'data' => $product->load('variations:id,product_id,weight,unit_price,box_quantity,box_price')->only(['id', 'name', 'code', 'tax_rate', 'variations'])
        ]);
    }
}
