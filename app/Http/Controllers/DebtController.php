<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debts = \App\Models\Transaction::with('customer')
            ->whereHas('paymentMethod', function ($q) {
                $q->where('method', 'Debt');
            })
            ->get()
            ->groupBy('customer_id');

        return view('Debts.index', compact('debts'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($customerId)
    {
        $transactions = \App\Models\Transaction::with([
            'product',
            'customer',
            'paymentMethod'
        ])
        ->where('customer_id', $customerId)
        ->whereHas('paymentMethod', function ($q) {
            $q->where('method', 'Debt');
        })
        ->get();

        return view('Debts.show', compact('transactions'));
    }

    public function pay($customerId)
    {
        $paidDebtId = \App\Models\PaymentMethod::where(
            'method',
            'Paid Debt'
        )->first()->id;

        \App\Models\Transaction::where(
            'customer_id',
            $customerId
        )
        ->whereHas('paymentMethod', function ($q) {
            $q->where('method', 'Debt');
        })
        ->update([
            'payment_method_id' => $paidDebtId
        ]);

        return redirect()
            ->route('debts.index')
            ->with('success', 'Debt paid successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
