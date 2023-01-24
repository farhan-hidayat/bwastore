<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view('pages.detail', compact('product'));
    }

    public function add(Request $request, $id)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
