<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\PaymentTerm;
use App\Models\Stocks;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::paginate(10);
        $all_transactions = Transaction::all();
        return view('Transaction.transactionview', compact('transactions', 'all_transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        $payment_methods = PaymentMethod::all();
        $payment_terms = PaymentTerm::all();
        $all_stocks = Stocks::all();
        $sorted_stocks = Stocks::with('product')
        ->get()
        ->sortBy('product.name')
        ->groupBy(function ($stock) {
            return $stock->product->category->title ?? 'Uncategorized';
        });
        return view('Transaction.transactioncreate', compact('products', 'customers', 'payment_methods', 'payment_terms', 'all_stocks', 'sorted_stocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_term_id' => 'required|exists:payment_terms,id',

            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',

            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $productIds = $data['product_ids'];
        $quantities = $data['quantities'];

        $grandTotal = 0;

        foreach ($productIds as $index => $productId) {

            $quantity = $quantities[$index] ?? 1;

            $product = Product::findOrFail($productId);

            $stock = $product->stocks()->latest()->first();

            if (!$stock) {
                continue; // or throw error if you want strict validation
            }

            $sellingPrice = $stock->selling_price;
            $total = $sellingPrice * $quantity;

            $grandTotal += $total;

            Transaction::create([
                'product_id' => $productId,
                'customer_id' => $data['customer_id'],
                'payment_method_id' => $data['payment_method_id'],
                'payment_term_id' => $data['payment_term_id'],
                'quantity' => $quantity,
                'selling_price' => $sellingPrice,
                'total' => $total,
            ]);
        }

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction added successfully! Total: ₱' . number_format($grandTotal, 2));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('Transaction.transactionedit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
            'payment_term_id' => 'required|integer|exists:payment_terms,id',
            'quantity' => 'required|integer|min:1',
            'selling_price' => 'required|decimal:2|min:0',
            'total' => 'required|decimal:2|min:0',
        ]);

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
