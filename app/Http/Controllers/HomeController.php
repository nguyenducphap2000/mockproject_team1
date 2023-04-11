<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $man = Category::where('name', 'man')->first()->id;
        $women = Category::where('name', 'women')->first()->id;
        $kid = Category::where('name', 'kid')->first()->id;
        return view('index', [
            'man' => Product::where('category_id', $man)->orderBy('import_date', 'desc')->limit(3)->get(),
            'women' => Product::where('category_id', $women)->orderBy('import_date', 'desc')->limit(3)->get(),
            'kid' => Product::where('category_id', $kid)->orderBy('import_date', 'desc')->limit(3)->get()
        ]);
    }
}
