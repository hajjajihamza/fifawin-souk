<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->orderByDesc('created_at');

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        return view('index', [
            'categories' => Category::all(),
            'products' => $query->paginate(12)->withQueryString(),
        ]);
    }


}
