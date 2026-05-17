<?php

namespace App\Http\Controllers;

use App\Models\BlockList;
use App\Models\Customer;
use App\Models\Violation;
use Illuminate\Http\Request;

class BlockListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blockLists = BlockList::paginate(10);
        $all_blocklist = BlockList::all();
        return view('BlockList.blocklistview', compact('blockLists', 'all_blocklist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $violations = Violation::all();
        return view('BlockList.blocklistcreate', compact('customers', 'violations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'violation_id' => 'required|integer|exists:violations,id',
        ]);

        BlockList::create($data);

        return redirect()->route('blocklist.index')->with('success', 'Customer has been successfully blocked!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlockList $blockList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlockList $blocklist)
    {
        $violations = Violation::all();
        return view('BlockList.blocklistedit', compact('blocklist', 'violations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlockList $blocklist)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'violation_id' => 'required|integer|exists:violations,id',
        ]);

        $blocklist->update($data);

        return redirect()->route('blocklist.index')->with('success', 'Blocklist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlockList $blocklist)
    {
        $blocklist->delete();

        return redirect()->route('blocklist.index')->with('success', 'Blocklist deleted successfully!');
    }
}
