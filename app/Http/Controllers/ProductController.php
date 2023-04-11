<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.product-list', [
            'products' => $this->productObject->getAll(),
            'categories' => Category::all(),
            'sizes' => Size::all()
        ]);
    }

    public function singleProduct($id)
    {
        return view('single-product',[
            'product' => Product::where('id', $id)->first()
        ]);
    }

    public function indexForm()
    {
        return view('admin.add-product', ['categories' => Category::all(), 'sizes' => Size::all()]);
    }

    public function storeProduct(Request $request)
    {
        $check = $this->productObject->storeProduct($request);
        if (isset($check['error'])) {
            $request->flash();
            return Redirect::back()->withErrors($check['error']);
        }
        if ($check) {
            return Redirect::back()->with('createProductStatus', $check);
        } else {
            return Redirect::back()->with('createProductFail', true);
        }
    }

    public function deleteProduct($id)
    {
        $check = $this->productObject->deleteProduct($id);
        if ($check) {
            return Redirect::back()->with('disableNotify', $check);
        } else {
            return Redirect::back()->with('disableFail', true);
        }
    }

    public function updateProduct(Request $request)
    {
        $check = $this->productObject->updateProduct($request);
        if (isset($check['error'])) {
            $request->flash();
            return Redirect::back()->withErrors($check['error']);
        }
        if ($check) {
            return Redirect::back()->with('updateProductStatus', $check);
        } else {
            return Redirect::back()->with('updateProductFail', true);
        }
    }
    public function searchProduct(Request $request)
    {
        $request->flash();
        return view('admin.product-list', [
            'products' => $this->productObject->searchProduct($request->txtSearch)->paginate($this::PAGE),
            'categories' => Category::all(),
            'sizes' => Size::all()
        ]);
    }

    public function showProduct()
    {
        return view('products', [
            'products' => $this->productObject->getAll(),
            'categories' => Category::all(),
            'sizes' => Size::all()
        ]);
    }

    public function filterProduct(Request $request)
    {
        $request->flash();
        return view('products', [
            'products' => $this->productObject->filterProduct($request)->paginate(9),
            'categories' => Category::all(),
            'sizes' => Size::all()
        ]);
    }
}
