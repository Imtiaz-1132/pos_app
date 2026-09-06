@extends('layouts.app')

@section('title', 'Dashboard | POS App')
@section('page_label', 'Dashboard')

@section('content')

<div class="container-fluid px-0">

    {{-- Welcome Panel --}}
    <div class="welcome-panel mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Welcome to POS Dashboard
            </h2>

            <p class="mb-0 text-muted">
                Manage your purchases, sales, products and inventory from one place.
            </p>

        </div>


        {{-- New Purchase --}}
        <a href="{{ route('purchases.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-1"></i>
            New Purchase

        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        {{-- Sales --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon icon-blue">

                    <i class="bi bi-cash-stack"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Today's Sales
                    </div>

                    <div class="stat-value">
                        ৳ 0.00
                    </div>

                    <small class="text-success">
                        0% from yesterday
                    </small>

                </div>

            </div>

        </div>


        {{-- Today's Purchases --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon icon-green">

                    <i class="bi bi-bag-check"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Today's Purchases
                    </div>

                    <div class="stat-value">

                        ৳ {{ number_format((float) $todayPurchases, 2) }}

                    </div>

                    <small class="text-muted">

                        {{ $todayPurchaseCount }}
                        {{ $todayPurchaseCount == 1 ? 'purchase' : 'purchases' }}
                        today

                    </small>

                </div>

            </div>

        </div>


        {{-- Products --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon icon-orange">

                    <i class="bi bi-box-seam"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Total Products
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                    <small class="text-muted">
                        Products in inventory
                    </small>

                </div>

            </div>

        </div>


        {{-- Customers --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-icon icon-purple">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Customers
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                    <small class="text-muted">
                        Registered customers
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- Quick Actions + System Overview --}}
    <div class="row g-4">

        {{-- Quick Actions --}}
        <div class="col-xl-8">

            <div class="content-card h-100">

                <div class="card-header-custom">

                    <div>

                        <h5 class="mb-1">
                            Quick Actions
                        </h5>

                        <small class="text-muted">
                            Frequently used POS operations
                        </small>

                    </div>

                </div>


                <div class="row g-3 mt-1">


                    {{-- Purchase Data Manage --}}
                    <div class="col-md-6">

                        <a href="{{ route('purchases.manage') }}"
                           class="quick-action">

                            <span class="quick-icon">

                                <i class="bi bi-plus-circle"></i>

                            </span>

                            <span>

                                <strong>
                                    Purchase Data Manage
                                </strong>

                                <small>
                                    Create or edit purchase data
                                </small>

                            </span>

                            <i class="bi bi-chevron-right ms-auto"></i>

                        </a>

                    </div>


                    {{-- Purchase Order --}}
                    <div class="col-md-6">

                        <a href="{{ route('purchase-orders.index') }}"
                           class="quick-action">

                            <span class="quick-icon">

                                <i class="bi bi-file-earmark-plus"></i>

                            </span>

                            <span>

                                <strong>
                                    Purchase Order
                                </strong>

                                <small>
                                    Create a new purchase order
                                </small>

                            </span>

                            <i class="bi bi-chevron-right ms-auto"></i>

                        </a>

                    </div>


                    {{-- New Sale - Static --}}
                    <div class="col-md-6">

                        <a href="#"
                           class="quick-action">

                            <span class="quick-icon">

                                <i class="bi bi-cart-plus"></i>

                            </span>

                            <span>

                                <strong>
                                    New Sale
                                </strong>

                                <small>
                                    Process a customer sale
                                </small>

                            </span>

                            <i class="bi bi-chevron-right ms-auto"></i>

                        </a>

                    </div>


                    {{-- Add Product - Static --}}
                    <div class="col-md-6">

                        <a href="#"
                           class="quick-action">

                            <span class="quick-icon">

                                <i class="bi bi-box2-heart"></i>

                            </span>

                            <span>

                                <strong>
                                    Add Product
                                </strong>

                                <small>
                                    Add a product to inventory
                                </small>

                            </span>

                            <i class="bi bi-chevron-right ms-auto"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- System Overview --}}
        <div class="col-xl-4">

            <div class="content-card h-100">

                <div class="card-header-custom">

                    <div>

                        <h5 class="mb-1">
                            System Overview
                        </h5>

                        <small class="text-muted">
                            Current status
                        </small>

                    </div>

                </div>


                {{-- Application --}}
                <div class="overview-item">

                    <span>

                        <i class="bi bi-check-circle-fill text-success me-2"></i>

                        Application

                    </span>

                    <strong>
                        Online
                    </strong>

                </div>


                {{-- Database --}}
                <div class="overview-item">

                    <span>

                        <i class="bi bi-database-check text-primary me-2"></i>

                        Database

                    </span>

                    <strong>
                        Connected
                    </strong>

                </div>


                {{-- Low Stock - Static --}}
                <div class="overview-item">

                    <span>

                        <i class="bi bi-box-seam text-warning me-2"></i>

                        Low Stock

                    </span>

                    <strong>
                        0 items
                    </strong>

                </div>


                {{-- Pending Orders --}}
                <div class="overview-item">

                    <span>

                        <i class="bi bi-receipt text-info me-2"></i>

                        Pending Orders

                    </span>

                    <strong>

                        {{ $pendingOrders }}

                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- Recent Purchases --}}
    <div class="content-card mt-4">

        <div class="card-header-custom">

            <div>

                <h5 class="mb-1">
                    Recent Purchases
                </h5>

                <small class="text-muted">
                    Latest purchase transactions will appear here.
                </small>

            </div>


            {{-- View All --}}
            <a href="{{ route('purchases.view-data') }}"
               class="btn btn-sm btn-outline-primary">

                View All

            </a>

        </div>


        {{-- Recent Purchase Records --}}
        @if($recentPurchases->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th>
                                Date
                            </th>

                            <th>
                                Reference No.
                            </th>

                            <th>
                                Supplier
                            </th>

                            <th>
                                Payment Status
                            </th>

                            <th class="text-end">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($recentPurchases as $purchase)

                            <tr>

                                {{-- Date --}}
                                <td>

                                    {{ $purchase->purchase_date?->format('d M Y') }}

                                </td>


                                {{-- Reference --}}
                                <td>

                                    <a href="{{ route('purchases.show', $purchase) }}"
                                       class="text-decoration-none">

                                        {{ $purchase->reference_no }}

                                    </a>

                                </td>


                                {{-- Supplier --}}
                                <td>

                                    {{ $purchase->supplier }}

                                </td>


                                {{-- Payment Status --}}
                                <td>

                                    @if($purchase->payment_status === 'paid')

                                        <span class="badge bg-success">
                                            Paid
                                        </span>

                                    @elseif($purchase->payment_status === 'partial')

                                        <span class="badge bg-warning text-dark">
                                            Partial
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Pending
                                        </span>

                                    @endif

                                </td>


                                {{-- Amount --}}
                                <td class="text-end">

                                    <strong>

                                        ৳ {{ number_format((float) $purchase->total_amount, 2) }}

                                    </strong>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- Empty State --}}
            <div class="empty-state">

                <i class="bi bi-inbox"></i>

                <h6>
                    No purchase records yet
                </h6>

                <p class="text-muted mb-0">
                    Create your first purchase to see it here.
                </p>

                <div class="mt-3">

                    <a href="{{ route('purchases.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="bi bi-plus-lg me-1"></i>

                        Add Purchase

                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection 