<?php

namespace App\Http\Controllers;

use App\Models\PurchaseData;
use Illuminate\Http\Request;

class PurchaseDataController extends Controller
{
    /**
     * Display existing View Purchase Data page.
     */
    public function index()
    {
        $purchaseData = PurchaseData::latest()->paginate(10);

        return view('purchases.view-data', compact('purchaseData'));
    }


    /**
     * Display saved Purchase Data Manage records.
     * Old records first, newly added records get the next serial.
     */
    public function list()
    {
        $purchaseData = PurchaseData::orderBy('id', 'asc')->paginate(10);

        return view('purchase_data.list', compact('purchaseData'));
    }


    /**
     * Show Purchase Data entry form.
     */
    public function create()
    {
        return view('purchases.manage');
    }


    /**
     * Store new purchase data.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'address' => 'required|string',
            'telephone' => 'required|string|max:50',

            'nid_front' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            'date' => 'required|date',
            'date_of_birth' => 'required|date',

            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',

            'nid_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);


        // NID Front Upload
        if ($request->hasFile('nid_front')) {
            $validated['nid_front'] =
                $request->file('nid_front')
                    ->store('purchase-data/nid', 'public');
        }


        // NID Back Upload
        if ($request->hasFile('nid_back')) {
            $validated['nid_back'] =
                $request->file('nid_back')
                    ->store('purchase-data/nid', 'public');
        }


        PurchaseData::create($validated);


        return redirect()
            ->route('purchase-data.list')
            ->with('success', 'Purchase data saved successfully.');
    }


    /**
     * Show a single purchase data record.
     */
    public function show(PurchaseData $purchaseData)
    {
        return view('purchases.show-data', compact('purchaseData'));
    }


    /**
     * Show edit form.
     */
    public function edit(PurchaseData $purchaseData)
    {
        return view('purchases.edit-data', compact('purchaseData'));
    }


    /**
     * Update purchase data.
     */
    public function update(
        Request $request,
        PurchaseData $purchaseData
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'address' => 'required|string',
            'telephone' => 'required|string|max:50',

            'nid_front' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            'date' => 'required|date',
            'date_of_birth' => 'required|date',

            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',

            'nid_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);


        // Replace NID Front if new file uploaded
        if ($request->hasFile('nid_front')) {
            $validated['nid_front'] =
                $request->file('nid_front')
                    ->store('purchase-data/nid', 'public');
        }


        // Replace NID Back if new file uploaded
        if ($request->hasFile('nid_back')) {
            $validated['nid_back'] =
                $request->file('nid_back')
                    ->store('purchase-data/nid', 'public');
        }


        $purchaseData->update($validated);


        return redirect()
            ->route('purchase-data.list')
            ->with('success', 'Purchase data updated successfully.');
    }


    /**
     * Delete purchase data.
     */
    public function destroy(PurchaseData $purchaseData)
    {
        $purchaseData->delete();

        return redirect()
            ->route('purchase-data.list')
            ->with('success', 'Purchase data deleted successfully.');
    }
}