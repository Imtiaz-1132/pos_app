<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display all purchase orders.
     */
    public function index(Request $request)
    {
        $query = PurchaseOrder::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('reference_no', 'like', '%' . $search . '%')
                  ->orWhere('supplier', 'like', '%' . $search . '%');
            });
        }

        // Business Location filter
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Supplier filter
        if ($request->filled('supplier')) {
            $query->where('supplier', $request->supplier);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Shipping Status filter
        if ($request->filled('shipping_status')) {
            $query->where('shipping_status', $request->shipping_status);
        }

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('order_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('order_date', '<=', $request->date_to);
        }

        $purchaseOrders = $query
            ->latest('order_date')
            ->paginate(25)
            ->withQueryString();

        // Filter dropdown data
        $locations = PurchaseOrder::select('location')
            ->whereNotNull('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        $suppliers = PurchaseOrder::select('supplier')
            ->whereNotNull('supplier')
            ->distinct()
            ->orderBy('supplier')
            ->pluck('supplier');

        return view('purchase_orders.index', compact(
            'purchaseOrders',
            'locations',
            'suppliers'
        ));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('purchase_orders.create');
    }

    /**
     * Store purchase order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'reference_no' => 'required|string|max:255|unique:purchase_orders,reference_no',
            'location' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,completed,cancelled',
            'quantity_remaining' => 'required|integer|min:0',
            'shipping_status' => 'required|in:pending,partial,shipped,received',
            'added_by' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        PurchaseOrder::create($validated);

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Purchase Order created successfully.');
    }

    /**
     * Show a single purchase order.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.show', compact('purchaseOrder'));
    }

    /**
     * Show edit form.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.edit', compact('purchaseOrder'));
    }

    /**
     * Update purchase order.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'reference_no' => 'required|string|max:255|unique:purchase_orders,reference_no,' . $purchaseOrder->id,
            'location' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,completed,cancelled',
            'quantity_remaining' => 'required|integer|min:0',
            'shipping_status' => 'required|in:pending,partial,shipped,received',
            'added_by' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $purchaseOrder->update($validated);

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Purchase Order updated successfully.');
    }

    /**
     * Delete purchase order.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->with('success', 'Purchase Order deleted successfully.');
    }
}