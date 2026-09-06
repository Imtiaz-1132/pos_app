<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display all purchases.
     */
    public function index(Request $request)
    {
        $query = Purchase::query();

        // Search by Supplier or Reference No.
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('supplier', 'like', '%' . $search . '%')
                  ->orWhere('reference_no', 'like', '%' . $search . '%');

            });
        }

        // Payment Status Filter
        if ($request->filled('payment_status')) {

            $query->where(
                'payment_status',
                $request->payment_status
            );
        }

        // Date From Filter
        if ($request->filled('date_from')) {

            $query->whereDate(
                'purchase_date',
                '>=',
                $request->date_from
            );
        }

        // Date To Filter
        if ($request->filled('date_to')) {

            $query->whereDate(
                'purchase_date',
                '<=',
                $request->date_to
            );
        }

        // Get Purchases
        $purchases = $query
            ->latest('purchase_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'purchases.manage',
            compact('purchases')
        );
    }


    /**
     * Show Add Purchase form.
     */
    public function create()
    {
        return view('purchases.create');
    }


    /**
     * Store Purchase.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'supplier' =>
                'required|string|max:255',

            'reference_no' =>
                'required|string|max:255|unique:purchases,reference_no',

            'purchase_date' =>
                'required|date',

            'location' =>
                'required|string|max:255',

            'payment_status' =>
                'required|in:paid,partial,pending',

            'payment_method' =>
                'nullable|string|max:255',

            'total_amount' =>
                'required|numeric|min:0',

            'paid_amount' =>
                'required|numeric|min:0',

            'due_amount' =>
                'required|numeric|min:0',

            'document' =>
                'nullable|file|max:5120',

            'notes' =>
                'nullable|string',
        ]);


        // Upload Purchase Document
        if ($request->hasFile('document')) {

            $validated['document'] =
                $request->file('document')
                    ->store(
                        'purchase-documents',
                        'public'
                    );
        }


        // Create Purchase
        Purchase::create($validated);


        return redirect()
            ->route('purchases.manage')
            ->with(
                'success',
                'Purchase created successfully.'
            );
    }


    /**
     * Display Purchase Data.
     */
    public function viewData()
    {
        $purchases = Purchase::latest()
            ->paginate(10);

        return view(
            'purchases.view',
            compact('purchases')
        );
    }


    /**
     * Display Single Purchase.
     */
    public function show(Purchase $purchase)
    {
        return view(
            'purchases.show',
            compact('purchase')
        );
    }


    /**
     * Show Edit Purchase form.
     */
    public function edit(Purchase $purchase)
    {
        return view(
            'purchases.edit',
            compact('purchase')
        );
    }


    /**
     * Update Purchase.
     */
    public function update(
        Request $request,
        Purchase $purchase
    ) {

        $validated = $request->validate([

            'supplier' =>
                'required|string|max:255',

            'reference_no' =>
                'required|string|max:255|unique:purchases,reference_no,' . $purchase->id,

            'purchase_date' =>
                'required|date',

            'location' =>
                'required|string|max:255',

            'payment_status' =>
                'required|in:paid,partial,pending',

            'payment_method' =>
                'nullable|string|max:255',

            'total_amount' =>
                'required|numeric|min:0',

            'paid_amount' =>
                'required|numeric|min:0',

            'due_amount' =>
                'required|numeric|min:0',

            'document' =>
                'nullable|file|max:5120',

            'notes' =>
                'nullable|string',
        ]);


        // Upload New Purchase Document
        if ($request->hasFile('document')) {

            $validated['document'] =
                $request->file('document')
                    ->store(
                        'purchase-documents',
                        'public'
                    );
        }


        // Update Purchase
        $purchase->update($validated);


        return redirect()
            ->route('purchases.manage')
            ->with(
                'success',
                'Purchase updated successfully.'
            );
    }


    /**
     * Delete Purchase.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()
            ->route('purchases.manage')
            ->with(
                'success',
                'Purchase deleted successfully.'
            );
    }
}