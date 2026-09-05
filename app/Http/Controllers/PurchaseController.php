<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // Purchase Data Manage
    public function index()
    {
        $purchases = Purchase::latest()->paginate(10);

        return view('purchases.manage', compact('purchases'));
    }


    // Add Purchase
    public function create()
    {
        return view('purchases.create');
    }


    // Store Purchase
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier' => 'required|string|max:255',
            'reference_no' => 'required|string|max:255|unique:purchases,reference_no',
            'purchase_date' => 'required|date',
            'location' => 'required|string|max:255',
            'payment_status' => 'required|in:paid,partial,pending',
            'payment_method' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'document' => 'nullable|file|max:5120',
            'notes' => 'nullable|string',
        ]);

        // Upload document
        if ($request->hasFile('document')) {

            $validated['document'] = $request
                ->file('document')
                ->store('purchase-documents', 'public');

        }

        Purchase::create($validated);

        return redirect()
            ->route('purchases.manage')
            ->with('success', 'Purchase created successfully.');
    }


    // View Purchase Data
    public function viewData()
    {
        $purchases = Purchase::latest()->paginate(10);

        return view('purchases.view', compact('purchases'));
    }


    // View Single Purchase
    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }


    // Edit Purchase
    public function edit(Purchase $purchase)
    {
        return view('purchases.edit', compact('purchase'));
    }


    // Update Purchase
    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'supplier' => 'required|string|max:255',
            'reference_no' => 'required|string|max:255|unique:purchases,reference_no,' . $purchase->id,
            'purchase_date' => 'required|date',
            'location' => 'required|string|max:255',
            'payment_status' => 'required|in:paid,partial,pending',
            'payment_method' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'document' => 'nullable|file|max:5120',
            'notes' => 'nullable|string',
        ]);

        // Upload new document
        if ($request->hasFile('document')) {

            $validated['document'] = $request
                ->file('document')
                ->store('purchase-documents', 'public');

        }

        $purchase->update($validated);

        return redirect()
            ->route('purchases.manage')
            ->with('success', 'Purchase updated successfully.');
    }


    // Delete Purchase
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()
            ->route('purchases.manage')
            ->with('success', 'Purchase deleted successfully.');
    }
}