<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productObject = null;
    private const PAGE = 10;
    public function __construct()
    {
        $this->productObject = $this->getInstance();
    }

    public function getInstance()
    {
        if ($this->productObject === null) {
            $userObject = new Product();
            return $userObject;
        }
        return $this->productObject;
    }

    public function index()
    {
        return view('admin.product-list', ['products' => $this->productObject->getAll()]);
    }
}
