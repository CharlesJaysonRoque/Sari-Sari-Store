<?php

namespace App\Http\Controllers;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentterms = PaymentTerm::paginate(10);
        $all_paymentterms = PaymentTerm::all();
        return view('PaymentTerm.termview', compact('paymentterms', 'all_paymentterms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('PaymentTerm.termcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'term' => 'required|string|max:255',
        ]);

        PaymentTerm::create($data);

        return redirect()->route('paymentterms.index')->with('success', 'Payment terms added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentTerm $paymentterm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentTerm $paymentterm)
    {
        return view('PaymentTerm.termedit', compact('paymentterm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentTerm $paymentterm)
    {
        $data = $request->validate([
            'term' => 'required|string|max:255',
        ]);

        $paymentterm->update($data);

        return redirect()->route('paymentterms.index')->with('success', 'Payment terms updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentTerm $paymentterm)
    {
        $paymentterm->delete();

        return redirect()->route('paymentterms.index')->with('success', 'Payment terms deleted successfully!');
    }
}
