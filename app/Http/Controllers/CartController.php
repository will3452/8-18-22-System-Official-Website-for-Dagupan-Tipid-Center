<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function __construct()
    {
        parent::__construct(CartItem::class);
    }
    public function index (Request $request) {
        return view('cart');
    }

    public function addToCart (Request $request, $id) {
        $product = Product::find($id);
        return view('add-to-cart', compact('product'));
    }

    public function itemIsInCart (Request $request, $id) {
        return $this->model::whereProductId($id)->whereUserId(auth()->id())->exists();
    }

    public function destroy (Request $request, $id) {
        $model = ($this->model)::whereProductId($id)->whereUserId(auth()->id())->first();
        $model->delete();
        return 1;
    }

}
