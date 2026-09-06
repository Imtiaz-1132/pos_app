@extends('layouts.app')

@section('title', 'Purchase Order | POS App')
@section('page_label', 'Purchase Order')

@section('content')

<div class="container-fluid purchase-order-page">

    {{-- PAGE TITLE --}}
    <div class="purchase-order-title">
        Purchase Order
    </div>


    {{-- FILTER SECTION --}}
    <div class="po-filter-card">

        <div class="po-filter-header">
            <i class="bi bi-funnel-fill"></i>
            Filters
        </div>

        <div class="po-filter-body">

            <form method="GET"
                  action="{{ route('purchase-orders.index') }}">

                <div class="row g-4">

                    {{-- BUSINESS LOCATION --}}
                    <div class="col-md-3">

                        <label class="po-label">
                            Business Location:
                        </label>

                        <select name="location"
                                class="form-select po-select">

                            <option value="">
                                All
                            </option>

                            @foreach($locations as $location)

                                <option value="{{ $location }}"
                                    {{ request('location') == $location ? 'selected' : '' }}>

                                    {{ $location }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- SUPPLIER --}}
                    <div class="col-md-3">

                        <label class="po-label">
                            Supplier:
                        </label>

                        <select name="supplier"
                                class="form-select po-select">

                            <option value="">
                                All
                            </option>

                            @foreach($suppliers as $supplier)

                                <option value="{{ $supplier }}"
                                    {{ request('supplier') == $supplier ? 'selected' : '' }}>

                                    {{ $supplier }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-3">

                        <label class="po-label">
                            Status:
                        </label>

                        <select name="status"
                                class="form-select po-select">

                            <option value="">
                                All
                            </option>

                            <option value="pending"
                                {{ request('status') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="approved"
                                {{ request('status') == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="completed"
                                {{ request('status') == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="cancelled"
                                {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                    </div>


                    {{-- SHIPPING STATUS --}}
                    <div class="col-md-3">

                        <label class="po-label">
                            Shipping Status:
                        </label>

                        <select name="shipping_status"
                                class="form-select po-select">

                            <option value="">
                                All
                            </option>

                            <option value="pending"
                                {{ request('shipping_status') == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="partial"
                                {{ request('shipping_status') == 'partial' ? 'selected' : '' }}>
                                Partial
                            </option>

                            <option value="shipped"
                                {{ request('shipping_status') == 'shipped' ? 'selected' : '' }}>
                                Shipped
                            </option>

                            <option value="received"
                                {{ request('shipping_status') == 'received' ? 'selected' : '' }}>
                                Received
                            </option>

                        </select>

                    </div>


                    {{-- DATE FROM --}}
                    <div class="col-md-3">

                        <label class="po-label">
                            Date Range:
                        </label>

                        <div class="row g-2">

                            <div class="col-6">

                                <input type="date"
                                       name="date_from"
                                       value="{{ request('date_from') }}"
                                       class="form-control">

                            </div>

                            <div class="col-6">

                                <input type="date"
                                       name="date_to"
                                       value="{{ request('date_to') }}"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FILTER BUTTONS --}}
                <div class="mt-3">

                    <button type="submit"
                            class="btn btn-primary btn-sm">

                        <i class="bi bi-search me-1"></i>
                        Filter

                    </button>

                    <a href="{{ route('purchase-orders.index') }}"
                       class="btn btn-secondary btn-sm">

                        <i class="bi bi-arrow-clockwise me-1"></i>
                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLE CARD --}}
    <div class="po-table-card">

        {{-- TABLE HEADER --}}
        <div class="po-table-header">

            <span>
                All purchase orders
            </span>

            <a href="{{ route('purchase-orders.create') }}"
               class="btn btn-primary btn-sm">

                <i class="bi bi-plus-lg"></i>
                Add

            </a>

        </div>


        {{-- TABLE CONTROLS --}}
        <div class="po-table-controls">

            <div class="d-flex align-items-center gap-2">

                <span>Show</span>

                <select class="form-select form-select-sm"
                        style="width:70px;">

                    <option>25</option>
                    <option>50</option>
                    <option>100</option>

                </select>

                <span>entries</span>

            </div>


            <div class="d-flex gap-1 flex-wrap">

                <button type="button"
                        class="btn btn-light btn-sm border">

                    <i class="bi bi-file-earmark-text"></i>
                    Export to CSV

                </button>

                <button type="button"
                        class="btn btn-light btn-sm border">

                    <i class="bi bi-file-earmark-excel"></i>
                    Export to Excel

                </button>

                <button type="button"
                        class="btn btn-light btn-sm border">

                    <i class="bi bi-printer"></i>
                    Print

                </button>

                <button type="button"
                        class="btn btn-light btn-sm border">

                    <i class="bi bi-layout-three-columns"></i>
                    Column visibility

                </button>

                <button type="button"
                        class="btn btn-light btn-sm border">

                    <i class="bi bi-file-earmark-pdf"></i>
                    Export to PDF

                </button>

            </div>


            {{-- SEARCH --}}
            <form method="GET"
                  action="{{ route('purchase-orders.index') }}"
                  class="ms-auto">

                {{-- Keep filters when searching --}}
                <input type="hidden"
                       name="location"
                       value="{{ request('location') }}">

                <input type="hidden"
                       name="supplier"
                       value="{{ request('supplier') }}">

                <input type="hidden"
                       name="status"
                       value="{{ request('status') }}">

                <input type="hidden"
                       name="shipping_status"
                       value="{{ request('shipping_status') }}">

                <input type="hidden"
                       name="date_from"
                       value="{{ request('date_from') }}">

                <input type="hidden"
                       name="date_to"
                       value="{{ request('date_to') }}">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control form-control-sm"
                       placeholder="Search ..."
                       style="width:150px;">

            </form>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover po-table mb-0">

                <thead>

                    <tr>

                        <th>Action</th>

                        <th>Date</th>

                        <th>Reference No</th>

                        <th>Location</th>

                        <th>Supplier</th>

                        <th>Status</th>

                        <th>Quantity Remaining</th>

                        <th>Shipping Status</th>

                        <th>Added By</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($purchaseOrders as $purchaseOrder)

                        <tr>

                            {{-- ACTION --}}
                            <td>

                                <div class="btn-group btn-group-sm">

                                    <a href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                       class="btn btn-outline-primary"
                                       title="View">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
                                       class="btn btn-outline-warning"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form action="{{ route('purchase-orders.destroy', $purchaseOrder) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this purchase order?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger"
                                                title="Delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>


                            {{-- DATE --}}
                            <td>
                                {{ $purchaseOrder->order_date?->format('d/m/Y') }}
                            </td>


                            {{-- REFERENCE --}}
                            <td>
                                {{ $purchaseOrder->reference_no }}
                            </td>


                            {{-- LOCATION --}}
                            <td>
                                {{ $purchaseOrder->location }}
                            </td>


                            {{-- SUPPLIER --}}
                            <td>
                                {{ $purchaseOrder->supplier }}
                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($purchaseOrder->status === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @elseif($purchaseOrder->status === 'approved')

                                    <span class="badge bg-info">
                                        Approved
                                    </span>

                                @elseif($purchaseOrder->status === 'completed')

                                    <span class="badge bg-success">
                                        Completed
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>

                                @endif

                            </td>


                            {{-- QUANTITY --}}
                            <td>
                                {{ $purchaseOrder->quantity_remaining }}
                            </td>


                            {{-- SHIPPING STATUS --}}
                            <td>

                                @if($purchaseOrder->shipping_status === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @elseif($purchaseOrder->shipping_status === 'partial')

                                    <span class="badge bg-info">
                                        Partial
                                    </span>

                                @elseif($purchaseOrder->shipping_status === 'shipped')

                                    <span class="badge bg-primary">
                                        Shipped
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Received
                                    </span>

                                @endif

                            </td>


                            {{-- ADDED BY --}}
                            <td>
                                {{ $purchaseOrder->added_by ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-4">

                                <span class="text-muted">
                                    No data available in table
                                </span>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- FOOTER --}}
        <div class="po-table-footer">

            <div class="text-muted">

                Showing
                {{ $purchaseOrders->firstItem() ?? 0 }}
                to
                {{ $purchaseOrders->lastItem() ?? 0 }}
                of
                {{ $purchaseOrders->total() }}
                entries

            </div>


            <div>

                {{ $purchaseOrders->links() }}

            </div>

        </div>

    </div>

</div>

@endsection