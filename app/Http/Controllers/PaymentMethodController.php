<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::paginate(10);
        $all_paymentmethods = PaymentMethod::all();
        return view('PaymentMethod.methodview', compact('paymentMethods', 'all_paymentmethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('PaymentMethod.methodcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'method' => 'required|string|max:255',
        ]);

        PaymentMethod::create($data);

        return redirect()->route('paymentmethods.index')->with('success', 'Payment method added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentmethod)
    {
        return view('PaymentMethod.methodedit', compact('paymentmethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentmethod)
    {
        $data = $request->validate([
            'method' => 'required|string|max:255',
        ]);

        $paymentmethod->update($data);

        return redirect()->route('paymentmethods.index')->with('success', 'Payment method updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentmethod)
    {
        $paymentmethod->delete();

        return redirect()->route('paymentmethods.index')->with('success', 'Payment method deleted successfully!');
    }
}
