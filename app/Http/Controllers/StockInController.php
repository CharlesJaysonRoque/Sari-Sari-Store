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
        $suppliers = Supplier::all();

        $sorted_stocks = \App\Models\Stocks::with('product')
            ->get()
            ->groupBy(fn($stock) =>
                $stock->product->category->title ?? 'Uncategorized'
            );

        return view(
            'StockIn.increate',
            compact('suppliers', 'sorted_stocks')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
            'cost_prices' => 'required|array',
            'selling_prices' => 'required|array',
        ]);

        foreach ($request->product_ids as $index => $productId)
        {
            StockIn::create([
                'supplier_id' => $request->supplier_id,
                'product_id' => $productId,
                'quantity' => $request->quantities[$index],
                'cost_price' => $request->cost_prices[$index],
                'selling_price' => $request->selling_prices[$index],
            ]);
        }

        return redirect()
            ->route('stockin.index')
            ->with('success', 'Stock In Added Successfully');
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
