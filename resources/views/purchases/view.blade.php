@extends('layouts.app')

@section('title', 'View Purchase Data | POS App')
@section('page_label', 'View Purchase Data')

@section('content')

<div class="purchase-view-page">

    {{-- Page Title --}}
    <div class="page-title">
        Purchase Data
    </div>

    {{-- Add New --}}
    <div class="mb-2">
        <a href="{{ route('purchases.create') }}"
           class="btn btn-primary add-new-btn">
            <i class="bi bi-plus-lg"></i>
            Add New
        </a>
    </div>

    {{-- Search --}}
    <div class="search-section">

        <div class="search-label">
            <i class="bi bi-upc-scan"></i>
            Search by Reference No
        </div>

        <form method="GET"
              action="{{ route('purchases.view-data') }}"
              class="search-form">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Enter reference no to search">

            <button type="submit"
                    class="btn btn-primary search-btn">

                <i class="bi bi-search"></i>
                Search

            </button>

        </form>

        <div class="search-info">
            <i class="bi bi-info-circle-fill"></i>
            Enter reference number and click Search
        </div>

    </div>


    {{-- Purchase Table --}}
    <div class="table-responsive purchase-table-wrapper">

        <table class="table purchase-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Reference No</th>
                    <th>Purchase Date</th>
                    <th>Location</th>
                    <th>Payment Status</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($purchases as $purchase)

                    <tr>

                        <td>
                            {{ $purchase->id }}
                        </td>

                        <td>
                            {{ $purchase->supplier }}
                        </td>

                        <td>
                            {{ $purchase->reference_no }}
                        </td>

                        <td>
                            {{ $purchase->purchase_date->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $purchase->location }}
                        </td>

                        <td>

                            @if($purchase->payment_status == 'paid')

                                <span class="status-paid">
                                    Paid
                                </span>

                            @elseif($purchase->payment_status == 'partial')

                                <span class="status-partial">
                                    Partial
                                </span>

                            @else

                                <span class="status-pending">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ number_format($purchase->total_amount, 2) }}
                        </td>

                        <td>
                            {{ number_format($purchase->paid_amount, 2) }}
                        </td>

                        <td>
                            {{ number_format($purchase->due_amount, 2) }}
                        </td>

                        <td class="actions">

                            <a href="{{ route('purchases.show', $purchase) }}"
                               class="action-view"
                               title="View">

                                <i class="bi bi-eye"></i>

                            </a>

                            <a href="{{ route('purchases.edit', $purchase) }}"
                               class="action-edit"
                               title="Edit">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="{{ route('purchases.destroy', $purchase) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this purchase?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="action-delete"
                                        title="Delete">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    {{-- Empty State --}}
                    <tr>

                        <td colspan="10"
                            class="empty-state">

                            <div class="empty-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <div class="empty-title">
                                No records found
                            </div>

                            <div class="empty-message">
                                No purchase records found.
                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($purchases->hasPages())

        <div class="purchase-pagination">
            {{ $purchases->links() }}
        </div>

    @endif

</div>

@endsection