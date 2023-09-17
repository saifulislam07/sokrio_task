<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_item;
use App\Models\StockSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();

        return view('backend.pages.inventory.create', get_defined_vars());
    }

    public function skucode(Request $request)
    {
        $productId = $request->productId;
        $skucode = Product::where('id', $productId)->first();
        return $skucode->SKU;
    }
    /**
     * Store a newly created resource in storage.
     */

    public function saveStore(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'department_id' => 'required',
                'challan_no' => 'required',
            ], [
                'name.department_id' => 'Department  field is required.',
                'SKU.challan_no' => 'Challan field is required.',
            ]);


            $productId = $request->proName;
            $qty = $request->qty;
            $SKU = $request->SKU;
            $totalQuantity = 0; // Initialize the total quantity
            for ($i = 0; $i < count($qty); $i++) {
                $quantity = $qty[$i];
                $totalQuantity += $quantity;
            }
            //department_id challan_no total_stock total_stock
            $stock = new Stock();
            $stock->challan_no = $request->challan_no;
            $stock->department_id = $request->department_id;
            $stock->total_stock = $totalQuantity;
            $stock->save();

            // increase stocksummary
            for ($i = 0; $i < count($productId); $i++) {
                // Create a new stock entry for each product
                $catId = Product::where('id', $productId[$i])->first();
                $stock_item = new Stock_item();
                $stock_item->stock_id = $stock->id;
                $stock_item->quantity = $qty[$i];
                $stock_item->SKU = $catId->SKU;
                $stock_item->product_id = $productId[$i];

                $stock_item->category_id = $catId->category_id;
                $stock_item->save();


                $checkProduct = StockSummary::where('product_id', $productId[$i])->first();
                if ($checkProduct) {
                    StockSummary::where('product_id', $productId[$i])->increment('quantity', $qty[$i]);
                } else {
                    $stockSummary = new StockSummary();
                    $stockSummary->category_id = $catId->category_id;
                    $stockSummary->product_id = $productId[$i];
                    $stockSummary->quantity = $qty[$i];
                    $stockSummary->save();
                }
            }

            session()->put('success', 'Stock Successfully Added.');
            return back();
        } catch (\Throwable $th) {
            session()->put('warning', 'Something Wrong, Please try again.');
            return back();
        }
    }


    public function store(Request $request)
    {
        try {
            $items = $request->input('stock_items');
            $totalQuantity = 0; // Initialize the total quantity
            foreach ($items as $itemData) {
                $quantity = $itemData['quantity'];
                $totalQuantity += $quantity;
            }
            //department_id challan_no total_stock total_stock
            $stock = new Stock();
            $stock->challan_no = $request->input('challan_no');
            $stock->department_id = $request->input('department_id');
            $stock->total_stock = $totalQuantity;
            $stock->save();

            // increase stocksummary

            foreach ($items as $itemData) {
                // Create a new stock entry for each product
                $stock_item = new Stock_item();
                $stock_item->stock_id = $stock->id;
                $stock_item->quantity = $itemData['quantity'];
                $stock_item->SKU = $itemData['SKU'];
                $stock_item->product_id = $itemData['product_id'];
                $stock_item->category_id = $itemData['category_id'];
                $stock_item->save();

                $checkProduct = StockSummary::where('product_id', $itemData['product_id'])->first();
                if ($checkProduct) {
                    StockSummary::where('product_id', $itemData['product_id'])->increment('quantity', $itemData['quantity']);
                } else {
                    $stockSummary = new StockSummary();
                    $stockSummary->category_id = $itemData['category_id'];
                    $stockSummary->product_id = $itemData['product_id'];
                    $stockSummary->quantity = $itemData['quantity'];
                    $stockSummary->save();
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Stock Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        $currentstock = StockSummary::with('product')->get();
        return view('backend.pages.inventory.currentstock', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
