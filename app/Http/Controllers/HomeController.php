<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(8)
            ->get();
        
        $categories = Category::withCount('products')->get();

        return view('user.home', compact('featuredProducts', 'categories'));
    }
}
