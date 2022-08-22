<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct(Category::class);
    }
    public function index () {
        return view('category.index');
    }
}
