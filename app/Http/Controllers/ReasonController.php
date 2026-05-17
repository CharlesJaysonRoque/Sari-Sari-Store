<?php

namespace App\Http\Controllers;

use App\Models\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reasons = Reason::paginate(10);
        $all_reasons = Reason::all();
        return view('Reason.reasonview', compact('reasons', 'all_reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Reason.reasoncreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Reason::create($data);

        return redirect()->route('reasons.index')->with('success', 'Reason added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reason $reason)
    {
        return view('Reason.reasonedit', compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reason $reason)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $reason->update($data);

        return redirect()->route('reasons.index')->with('success', 'Reason updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reason $reason)
    {
        $reason->delete();

        return redirect()->route('reasons.index')->with('success', 'Reason deleted successfully!');
    }
}
