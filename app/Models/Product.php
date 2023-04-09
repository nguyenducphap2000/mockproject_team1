<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'stock',
        'product_status',
        'import_date',
        'producer',
        'color',
        'category_id',
        'size_id',
    ];

    public function getAll()
    {
        return Product::paginate(9);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function validator($data, $method)
    {
        $rules =  [
            'productName' => ['required', 'string', 'max:255'],
            'manufacturerName' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'size' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:1'],
            'color' => ['required', 'string', 'max:255'],
        ];
        if ($method === 'store') {
            $rules['file'] = ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000'];
        } else {
            $rules['file'] = ['mimes:jpeg,jpg,png,gif', 'max:10000'];
        }
        $validate = Validator::make($data, $rules);
        return $validate;
    }

    public function deleteProduct($id)
    {
        $check = false;
        if (Product::where('id', $id)->exists()) {
            Product::where('id', $id)->delete();
            $check = true;
        }
        return $check;
    }

    public function storeProduct($request)
    {
        $validate = $this->validator($request->all(), 'store');
        $check = false;
        if ($validate->fails()) {
            return ['error' => $validate->errors()];
        } else {
            $file = $request->file('file');
            $path = time() . '_' . $request->productName . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/' . $path, file_get_contents($file));
            $this::create([
                'name' => $request->productName,
                'producer' => $request->manufacturerName,
                'category_id' => $request->category,
                'image' => $path,
                'color' => $request->color,
                'size_id' => $request->size,
                'price' => $request->price,
                'stock' => $request->stock,
                'import_date' => Carbon::now()
            ]);
            $check = true;
        }
        return $check;
    }
    public function updateProduct($request)
    {
        $validate = $this->validator($request->all(), 'update');
        $check = false;
        if ($validate->fails()) {
            return ['error' => $validate->errors()];
        } else {
            $data = [
                'name' => $request->productName,
                'producer' => $request->manufacturerName,
                'category_id' => $request->category,
                'color' => $request->color,
                'size_id' => $request->size,
                'price' => $request->price,
                'stock' => $request->stock,
                'import_date' => Carbon::now()
            ];
            if (isset($request->file)) {
                $file = $request->file('file');
                $path = time() . '_' . $request->productName . '.' . $file->getClientOriginalExtension();
                Storage::disk('local')->put('public/' . $path, file_get_contents($file));
                $data['image'] = $path;
            }
            $this::where('id', $request->productId)->update($data);
            $check = true;
        }
        return $check;
    }

    public function searchProduct($search)
    {
        return $this::where('name', 'like', '%' . $search . '%')
            ->orWhere('producer', 'like', '%' . $search . '%');
    }

    public function filterProduct($request)
    {
        if (
            $request->textSearch === null && $request->category === null
            && $request->size === null
        ) {
            return $this;
        } else {
            if ($request->textSearch !== null && $request->category !== null && $request->size === null) {
                return $this::where([
                    ['name', 'like', '%' . $request->textSearch . '%'],
                    ['category_id', '=', $request->category]
                ]);
            } else if ($request->textSearch !== null && $request->size !== null && $request->category === null) {
                return $this::where([
                    ['name', 'like', '%' . $request->textSearch . '%'],
                    ['size_id', '=', $request->size]
                ]);
            } else if ($request->category !== null && $request->size !== null && $request->textSearch === null) {
                return $this::where([
                    ['category_id', '=', $request->category],
                    ['size_id', '=', $request->size]
                ]);
            } else {
                if (
                    $request->textSearch !== null && $request->category !== null
                    && $request->size !== null
                ) {
                    return $this::where([
                        ['name', 'like', '%' . $request->textSearch . '%'],
                        ['category_id', '=', $request->category],
                        ['size_id', '=', $request->size]
                    ]);
                } else {
                    if (
                        $request->textSearch === null && $request->category === null
                        && $request->size !== null
                    ) {
                        return $this::where('size_id', '=', $request->size);
                    } else if (
                        $request->textSearch !== null && $request->category === null
                        && $request->size === null
                    ) {
                        return $this::where('name', 'like', '%' . $request->textSearch . '%');
                    } else {
                        return $this::where('category_id', '=', $request->category);
                    }
                }
            }
        }
        dd('not in condition');
    }
}
