<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\Product;
use App\Models\Reason;
use App\Models\Transaction;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockouts = StockOut::paginate(10);
        $all_stockouts = StockOut::all();
        return view('StockOut.outview', compact('stockouts', 'all_stockouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $reasons = Reason::all();
        $transactions = Transaction::all();
        return view('StockOut.outcreate', compact('products', 'reasons', 'transactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,ID',
            'reason_id' => 'required|integer|exists:reasons,id',
            'quantity' => 'required|integer|min:1',
            'transaction_id' => 'nullable|integer|exists:transactions,ID',
        ]);

        StockOut::create($data);

        return redirect()->route('stockout.index')->with('success', 'Stock-out record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockOut $stockOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOut $stockout)
    {
        $products = Product::all();
        $reasons = Reason::all();
        return view('StockOut.outedit', compact('stockout', 'products', 'reasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockOut $stockout)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,ID',
            'reason_id' => 'required|integer|exists:reasons,id',
            'quantity' => 'required|integer|min:1',
            'transaction_id' => 'nullable|integer|exists:transactions,ID',
        ]);

        $stockout->update($data);

        return redirect()->route('stockout.index')->with('success', 'Stock-out record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockOut $stockout)
    {
        $stockout->delete();

        return redirect()->route('stockout.index')->with('success', 'Stock-out record deleted successfully!');
    }
}
