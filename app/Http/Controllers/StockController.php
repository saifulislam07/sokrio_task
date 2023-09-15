<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_item;
use App\Models\StockSummary;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        //
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
