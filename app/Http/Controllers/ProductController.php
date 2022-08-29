<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }
    public function index () {
        return view('product_management');
    }
}
