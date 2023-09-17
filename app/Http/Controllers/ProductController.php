<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function addProduct()
    {
        $brand = Brand::select('id', 'name')->get();
        $category = Category::select('id', 'name')->get();
        return view('backend.pages.product.create', get_defined_vars());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            //Validated
            $validate = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'sku' => 'required',
                    'brand_id' => 'required',
                    'category_id' => 'required',
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }


            // dd($request->all());
            $product = Product::create([
                'name' => $request->name,
                'SKU' => $request->sku,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'usp' => $request->usp,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'product Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'SKU' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Product Name field is required.',
            'SKU.required' => 'SKU  field is required.',
            'brand_id.required' => 'Brand field is required.',
            'category_id.required' => 'Category field is required.',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'SKU' => $request->SKU,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'USP' => $request->USP,
        ]);
        session()->put('success', 'Product Successfully Created.');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
