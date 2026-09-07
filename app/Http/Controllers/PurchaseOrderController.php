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

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('reference_no', 'like', '%' . $search . '%')
                    ->orWhere('supplier', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('supplier')) {
            $query->where('supplier', $request->supplier);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('shipping_status')) {
            $query->where(
                'shipping_status',
                $request->shipping_status
            );
        }

        if ($request->filled('date_from')) {
            $query->whereDate(
                'order_date',
                '>=',
                $request->date_from
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'order_date',
                '<=',
                $request->date_to
            );
        }

        $purchaseOrders = $query
            ->latest('order_date')
            ->paginate(25)
            ->withQueryString();

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

        return view(
            'purchase_orders.index',
            compact(
                'purchaseOrders',
                'locations',
                'suppliers'
            )
        );
    }


    /**
     * Show Add Purchase Order form.
     */
    public function create()
    {
        return view('purchase_orders.create');
    }


    /**
     * Store Purchase Order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'order_date' =>
                'required|date',

            'reference_no' =>
                'required|string|max:255|unique:purchase_orders,reference_no',

            'location' =>
                'required|string|max:255',

            'supplier' =>
                'required|string|max:255',

            'pay_term' =>
                'nullable|string|max:255',

            'address' =>
                'nullable|string',

            'document' =>
                'nullable|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:5120',

            'items' =>
                'required|json',

            'shipping_details' =>
                'nullable|string',

            'shipping_address' =>
                'nullable|string',

            'shipping_charges' =>
                'nullable|numeric|min:0',

            'shipping_status' =>
                'required|in:pending,partial,shipped,received',

            'delivered_to' =>
                'nullable|string|max:255',

            'shipping_document' =>
                'nullable|file|mimes:pdf,csv,zip,doc,docx,jpeg,jpg,png|max:5120',

            'additional_expenses' =>
                'nullable|numeric|min:0',

            'order_total' =>
                'required|numeric|min:0',

            'notes' =>
                'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Process Products
        |--------------------------------------------------------------------------
        */

        $items = json_decode($request->items, true);

        if (!is_array($items) || count($items) === 0) {

            return back()
                ->withErrors([
                    'items' =>
                        'Please add at least one product.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Quantity
        |--------------------------------------------------------------------------
        */

        $quantityRemaining = 0;

        foreach ($items as $item) {

            $quantityRemaining +=
                (int) ($item['quantity'] ?? 0);
        }


        /*
        |--------------------------------------------------------------------------
        | Attach Document
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('document')) {

            $validated['document'] =
                $request->file('document')
                    ->store(
                        'purchase-orders/documents',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Shipping Document
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('shipping_document')) {

            $validated['shipping_document'] =
                $request->file('shipping_document')
                    ->store(
                        'purchase-orders/shipping',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Purchase Order Data
        |--------------------------------------------------------------------------
        */

        $validated['items'] =
            $items;

        $validated['quantity_remaining'] =
            $quantityRemaining;

        $validated['shipping_charges'] =
            $request->shipping_charges ?? 0;

        $validated['additional_expenses'] =
            $request->additional_expenses ?? 0;

        $validated['status'] =
            'pending';

        $validated['added_by'] =
            'Admin';


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        PurchaseOrder::create($validated);

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order created successfully.'
            );
    }


    /**
     * Export Purchase Orders to CSV.
     */
    public function exportCsv(Request $request)
    {
        $query = PurchaseOrder::query();

        $this->applyExportFilters($query, $request);

        $purchaseOrders = $query
            ->latest('order_date')
            ->get();

        $filename =
            'Purchase Order - Shop (' .
            now()->format('Y-m-d') .
            ').csv';

        $headers = [

            'Content-Type' =>
                'text/csv; charset=UTF-8',

            'Content-Disposition' =>
                'attachment; filename="' .
                $filename .
                '"',
        ];


        $callback = function () use ($purchaseOrders) {

            $file =
                fopen('php://output', 'w');


            /*
            |--------------------------------------------------------------------------
            | UTF-8 BOM
            |--------------------------------------------------------------------------
            */

            fprintf(
                $file,
                chr(0xEF) .
                chr(0xBB) .
                chr(0xBF)
            );


            /*
            |--------------------------------------------------------------------------
            | CSV Header
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [

                'Action',
                'Date',
                'Reference No',
                'Location',
                'Supplier',
                'Status',
                'Quantity Remaining',
                'Shipping Status',
                'Added By',

            ]);


            /*
            |--------------------------------------------------------------------------
            | CSV Data
            |--------------------------------------------------------------------------
            */

            foreach ($purchaseOrders as $purchaseOrder) {

                $status =
                    $this->getStatusLabel(
                        $purchaseOrder->status
                    );

                $shippingStatus =
                    $this->getShippingStatusLabel(
                        $purchaseOrder->shipping_status
                    );

                fputcsv($file, [

                    '',

                    $purchaseOrder->order_date
                        ? $purchaseOrder
                            ->order_date
                            ->format('d/m/Y')
                        : '',

                    $purchaseOrder->reference_no,

                    $purchaseOrder->location,

                    $purchaseOrder->supplier,

                    $status,

                    $purchaseOrder->quantity_remaining,

                    $shippingStatus,

                    $purchaseOrder->added_by ?? '-',

                ]);
            }

            fclose($file);
        };


        return response()->stream(
            $callback,
            200,
            $headers
        );
    }


    /**
     * Export Purchase Orders to Excel.
     *
     * This creates an Excel-compatible .xls file.
     */
    public function exportExcel(Request $request)
    {
        $query = PurchaseOrder::query();

        $this->applyExportFilters($query, $request);

        $purchaseOrders = $query
            ->latest('order_date')
            ->get();

        $filename =
            'Purchase Order - Shop.xls';


        return response()->streamDownload(
            function () use ($purchaseOrders) {

                echo '<html>';

                echo '<head>';

                echo '<meta http-equiv="Content-Type"
                        content="text/html;
                        charset=UTF-8">';

                echo '</head>';

                echo '<body>';

                echo '<table border="1"
                             cellspacing="0"
                             cellpadding="5">';


                /*
                |--------------------------------------------------------------------------
                | Excel Title
                |--------------------------------------------------------------------------
                */

                echo '<tr>';

                echo '<th colspan="9"
                           style="font-size:18px;
                                  font-weight:bold;">';

                echo 'Purchase Order - Shop';

                echo '</th>';

                echo '</tr>';


                /*
                |--------------------------------------------------------------------------
                | Empty Row
                |--------------------------------------------------------------------------
                */

                echo '<tr>';

                echo '<td colspan="9">&nbsp;</td>';

                echo '</tr>';


                /*
                |--------------------------------------------------------------------------
                | Table Header
                |--------------------------------------------------------------------------
                */

                echo '<tr>';

                echo '<th>Action</th>';
                echo '<th>Date</th>';
                echo '<th>Reference No</th>';
                echo '<th>Location</th>';
                echo '<th>Supplier</th>';
                echo '<th>Status</th>';
                echo '<th>Quantity Remaining</th>';
                echo '<th>Shipping Status</th>';
                echo '<th>Added By</th>';

                echo '</tr>';


                /*
                |--------------------------------------------------------------------------
                | Excel Data
                |--------------------------------------------------------------------------
                */

                foreach ($purchaseOrders as $purchaseOrder) {

                    $status =
                        $this->getStatusLabel(
                            $purchaseOrder->status
                        );

                    $shippingStatus =
                        $this->getShippingStatusLabel(
                            $purchaseOrder->shipping_status
                        );


                    echo '<tr>';


                    echo '<td>';

                    echo 'View / Edit / Delete';

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->order_date
                            ? $purchaseOrder
                                ->order_date
                                ->format('d/m/Y')
                            : ''
                    );

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->reference_no
                    );

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->location
                    );

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->supplier
                    );

                    echo '</td>';


                    echo '<td>';

                    echo e($status);

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->quantity_remaining
                    );

                    echo '</td>';


                    echo '<td>';

                    echo e($shippingStatus);

                    echo '</td>';


                    echo '<td>';

                    echo e(
                        $purchaseOrder->added_by ?? '-'
                    );

                    echo '</td>';


                    echo '</tr>';
                }


                echo '</table>';

                echo '</body>';

                echo '</html>';

            },

            $filename,

            [
                'Content-Type' =>
                    'application/vnd.ms-excel',

                'Content-Disposition' =>
                    'attachment; filename="' .
                    $filename .
                    '"',
            ]
        );
    }


    /**
     * Apply filters used by CSV and Excel exports.
     */
    private function applyExportFilters(
        $query,
        Request $request
    ) {
        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search =
                $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'reference_no',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'supplier',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'location',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Business Location
        |--------------------------------------------------------------------------
        */

        if ($request->filled('location')) {

            $query->where(
                'location',
                $request->location
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Supplier
        |--------------------------------------------------------------------------
        */

        if ($request->filled('supplier')) {

            $query->where(
                'supplier',
                $request->supplier
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Shipping Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('shipping_status')) {

            $query->where(
                'shipping_status',
                $request->shipping_status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {

            $query->whereDate(
                'order_date',
                '>=',
                $request->date_from
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {

            $query->whereDate(
                'order_date',
                '<=',
                $request->date_to
            );
        }

        return $query;
    }


    /**
     * Convert database status into display label.
     */
    private function getStatusLabel($status)
    {
        return match ($status) {

            'pending' =>
                'Ordered',

            'approved' =>
                'Approved',

            'completed' =>
                'Completed',

            'cancelled' =>
                'Cancelled',

            default =>
                ucfirst($status ?? ''),
        };
    }


    /**
     * Convert database shipping status into display label.
     */
    private function getShippingStatusLabel(
        $shippingStatus
    ) {
        return match ($shippingStatus) {

            'pending' =>
                'Ordered',

            'partial' =>
                'Packed',

            'shipped' =>
                'Shipped',

            'received' =>
                'Delivered',

            'cancelled' =>
                'Cancelled',

            default =>
                ucfirst($shippingStatus ?? ''),
        };
    }


    /**
     * Show a single purchase order.
     */
    public function show(
        PurchaseOrder $purchaseOrder
    ) {
        return view(
            'purchase_orders.show',
            compact('purchaseOrder')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(
        PurchaseOrder $purchaseOrder
    ) {
        return view(
            'purchase_orders.edit',
            compact('purchaseOrder')
        );
    }


    /**
     * Update purchase order.
     */
    public function update(
        Request $request,
        PurchaseOrder $purchaseOrder
    ) {
        $validated = $request->validate([

            'order_date' =>
                'required|date',

            'reference_no' =>
                'required|string|max:255|unique:purchase_orders,reference_no,' .
                $purchaseOrder->id,

            'location' =>
                'required|string|max:255',

            'supplier' =>
                'required|string|max:255',

            'pay_term' =>
                'nullable|string|max:255',

            'address' =>
                'nullable|string',

            'items' =>
                'required|json',

            'shipping_details' =>
                'nullable|string',

            'shipping_address' =>
                'nullable|string',

            'shipping_charges' =>
                'nullable|numeric|min:0',

            'shipping_status' =>
                'required|in:pending,partial,shipped,received',

            'delivered_to' =>
                'nullable|string|max:255',

            'additional_expenses' =>
                'nullable|numeric|min:0',

            'order_total' =>
                'required|numeric|min:0',

            'notes' =>
                'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Process Items
        |--------------------------------------------------------------------------
        */

        $items =
            json_decode(
                $request->items,
                true
            );


        if (!is_array($items) || count($items) === 0) {

            return back()
                ->withErrors([
                    'items' =>
                        'Please add at least one product.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Quantity
        |--------------------------------------------------------------------------
        */

        $quantityRemaining = 0;

        foreach ($items as $item) {

            $quantityRemaining +=
                (int) ($item['quantity'] ?? 0);
        }


        $validated['items'] =
            $items;

        $validated['quantity_remaining'] =
            $quantityRemaining;

        $validated['shipping_charges'] =
            $request->shipping_charges ?? 0;

        $validated['additional_expenses'] =
            $request->additional_expenses ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Attach Document
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('document')) {

            $validated['document'] =
                $request->file('document')
                    ->store(
                        'purchase-orders/documents',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Shipping Document
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('shipping_document')) {

            $validated['shipping_document'] =
                $request->file('shipping_document')
                    ->store(
                        'purchase-orders/shipping',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $purchaseOrder->update(
            $validated
        );


        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order updated successfully.'
            );
    }


    /**
     * Delete purchase order.
     */
    public function destroy(
        PurchaseOrder $purchaseOrder
    ) {
        $purchaseOrder->delete();

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order deleted successfully.'
            );
    }
}