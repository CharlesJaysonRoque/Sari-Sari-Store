<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violations = Violation::paginate(10);
        $all_violations = Violation::all();
        return view('Violation.violationview', compact('violations', 'all_violations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Violation.violationcreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        Violation::create($data);

        return redirect()->route('violations.index')->with('success', 'Violation added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Violation $violation)
    {
        return view('Violation.violationshow', compact('violation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Violation $violation)
    {
        return view('Violation.violationedit', compact('violation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Violation $violation)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $violation->update($data);

        return redirect()->route('violations.index')->with('success', 'Violation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();

        return redirect()->route('violations.index')->with('success', 'Violation deleted successfully!');
    }
}
