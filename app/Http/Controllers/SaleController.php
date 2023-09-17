<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sales_item;
use App\Models\StockSummary;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = Unit::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();

        return view('backend.pages.sale.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */


    public function saveSale(Request $request)
    {

        try {

            // dd($request->all());
            $productId = $request->proName;
            $uniID = $request->uniid;
            $qty = $request->qty;
            $unitprice = $request->unitprice;
            $total = $request->total;


            $totalQuantity = 0; // Initialize the total quantity
            $totalUnitprice = 0; // Initialize the total unit parice
            $totalPayable = 0; // Initialize the total payable

            for ($i = 0; $i < count($qty); $i++) {
                $quantity = $qty[$i];
                $totalQuantity += $quantity;

                $unitprice = $unitprice[$i];
                $totalUnitprice += $unitprice;

                $total = $total[$i];
                $totalPayable += $total;
            }

            $sale = new Sale();


            $sale->total_quantity = $totalQuantity;
            $sale->total_sale_price = $totalUnitprice;
            $sale->total_payable = $totalPayable;
            $sale->grand_total = $totalPayable;
            $sale->pay = $request->paid_amount;
            $sale->remarks = $request->narration;
            $sale->due = $totalPayable - $request->paid_amount;
            $sale->save();


            for ($i = 0; $i < count($productId); $i++) {
                // Create a new stock entry for each product
                $catId = Product::where('id', $productId[$i])->first();
                $sale_item = new Sales_item();
                $sale_item->sale_id = $sale->id;
                $sale_item->category_id = $catId->category_id;
                $sale_item->unit_id = $uniID[$i];
                $sale_item->product_id = $productId[$i];
                $sale_item->quantity = $qty[$i];
                $sale_item->sale_price = $unitprice[$i];
                $sale_item->payable = $total[$i];
                $sale_item->save();


                $checkProduct = StockSummary::where('product_id', $productId[$i])->first();
                if ($checkProduct) {
                    StockSummary::where('product_id', $productId[$i])->decrement('quantity', $qty[$i]);
                } else {
                    $stockSummary = new StockSummary();
                    $stockSummary->category_id = $catId->category_id;
                    $stockSummary->product_id = $productId[$i];
                    $stockSummary->quantity = $qty[$i];
                    $stockSummary->save();
                }
            }


            session()->put('success', 'Sale Successfully Added.');
            return back();
        } catch (\Throwable $th) {
            session()->put('warning', 'Something Wrong, Please try again.');
            return back();
        }
    }


    public function store(Request $request)
    {

        try {
            $items = $request->input('sale_items');
            $totalQuantity = 0; // Initialize the total quantity
            $totalSalePrice = 0; // Initialize the total sale parice
            $totalPayable = 0; // Initialize the total payable
            $grandTotal = 0; // Initialize the grand total
            foreach ($items as $itemData) {
                $quantity = $itemData['quantity'];
                $totalQuantity += $quantity;

                $sale_price = $itemData['sale_price'];
                $totalSalePrice += $sale_price;

                $payable = $itemData['sale_price'] * $itemData['quantity'];

                $totalPayable += $payable;

                $grandTotal = $totalPayable;
            }

            $sale = new Sale();
            $sale->total_quantity = $totalQuantity;
            $sale->total_sale_price = $totalSalePrice;
            $sale->total_payable = $totalPayable;
            $sale->grand_total = $grandTotal;
            $sale->pay = $request->input('pay');
            $sale->due  = $grandTotal - $request->input('pay');
            $sale->remarks = $request->input('remarks');
            $sale->save();

            // deducted  stocksummary


            foreach ($items as $itemData) {
                // Create a new stock entry for each product
                $sale_item = new Sales_item();
                $sale_item->sale_id = $sale->id;
                $sale_item->unit_id = $itemData['unit_id'];
                $sale_item->quantity = $itemData['quantity'];
                $sale_item->payable = $itemData['sale_price'] * $itemData['quantity'];
                $sale_item->sale_price = $itemData['sale_price'];
                $sale_item->product_id = $itemData['product_id'];
                $sale_item->category_id = $itemData['category_id'];
                $sale_item->save();

                $checkProduct = StockSummary::where('product_id', $itemData['product_id'])->first();
                if ($checkProduct) {
                    StockSummary::where('product_id', $itemData['product_id'])->decrement('quantity', $itemData['quantity']);
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
                'message' => 'Sale Created Successfully',
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
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
