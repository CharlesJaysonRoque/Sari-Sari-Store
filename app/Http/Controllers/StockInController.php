<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockins = StockIn::paginate(10);
        $all_stockins = StockIn::all();
        return view('StockIn.inview', compact('stockins', 'all_stockins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('StockIn.increate', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,ID',
            'supplier_id' => 'required|exists:suppliers,ID',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        StockIn::create($data);

        return redirect()->route('stockin.index')->with('success', 'Stock-in record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockIn $stockIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockIn $stockin)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('StockIn.inedit', compact('stockin', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockIn $stockin)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,ID',
            'supplier_id' => 'required|exists:suppliers,ID',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockin->update($data);

        return redirect()->route('stockin.index')->with('success', 'Stock-in record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockIn $stockin)
    {
        $stockin->delete();

        return redirect()->route('stockin.index')->with('success', 'Stock-in record deleted successfully!');
    }
}
