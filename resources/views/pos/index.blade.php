@extends('layouts.app')

@section('title', 'POS | POS App')
@section('page_label', 'POS')

@section('content')

<div class="pos-screen">

    {{-- TOP POS BAR --}}
    <div class="pos-topbar">

        <div class="pos-location">
            <strong>Location:</strong>

            <select>
                <option>Royal Japan (Shin001)</option>
            </select>
        </div>

        <div class="pos-top-actions">

            <button class="pos-orange-btn">
                <i class="bi bi-plus-circle"></i>
            </button>

            <button class="pos-orange-btn">
                <i class="bi bi-pause-fill"></i>
            </button>

            <button class="pos-orange-btn">
                <i class="bi bi-calculator"></i>
            </button>

            <button class="pos-orange-btn">
                <i class="bi bi-briefcase-fill"></i>
            </button>

            <button class="pos-orange-btn">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>

    </div>


    {{-- MAIN POS AREA --}}
    <div class="pos-main">

        {{-- LEFT CART AREA --}}
        <div class="pos-cart-area">


            {{-- CUSTOMER + PRODUCT SEARCH --}}
            <div class="pos-search-row">

                <div class="customer-search">

                    <span class="search-icon">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    <input type="text"
                           placeholder="Enter Customer name / phone">

                    <button>
                        <i class="bi bi-plus-circle-fill"></i>
                    </button>

                </div>


                <div class="product-search">

                    <button class="search-product-btn">
                        <i class="bi bi-search"></i>
                    </button>

                    <input type="text"
                           placeholder="Enter Product name / SKU / Scan bar code">

                    <button>
                        <i class="bi bi-plus-circle-fill"></i>
                    </button>

                </div>

            </div>


            {{-- CUSTOMER TYPE --}}
            <select class="pos-default-select">

                <option>
                    Default
                </option>

            </select>


            {{-- SERVICE STAFF --}}
            <select class="pos-staff-select">

                <option>
                    Select service staff
                </option>

            </select>


            {{-- CART TABLE --}}
            <div class="pos-cart-table">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Product
                            </th>

                            <th>
                                Quantity
                            </th>

                            <th>
                                IMEI
                            </th>

                            <th>
                                Subtotal
                            </th>

                            <th>
                                ×
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div>


            {{-- CART TOTAL --}}
            <div class="pos-cart-summary">

                <div>
                    <strong>Items:</strong>
                    <span>0.00</span>
                </div>

                <div>
                    <strong>Total:</strong>
                    <span>0.00</span>
                </div>

            </div>


            {{-- PAYMENT BUTTONS --}}
            <div class="pos-payment-bar">

                <button class="payment-btn draft">
                    <i class="bi bi-pencil-square"></i>
                    Draft
                </button>

                <button class="payment-btn quotation">
                    <i class="bi bi-file-earmark-text"></i>
                    Quotation
                </button>

                <button class="payment-btn suspend">
                    <i class="bi bi-pause-fill"></i>
                    Suspend
                </button>

                <button class="payment-btn credit">
                    <i class="bi bi-check-lg"></i>
                    Credit Sale
                </button>

                <button class="payment-btn card">
                    <i class="bi bi-credit-card-fill"></i>
                    Card
                </button>

                <button class="payment-btn multiple">
                    <i class="bi bi-credit-card-2-front"></i>
                    Multiple Pay
                </button>

                <button class="payment-btn cash">
                    <i class="bi bi-cash"></i>
                    Cash
                </button>

                <button class="payment-btn cancel">
                    <i class="bi bi-x-lg"></i>
                    Cancel
                </button>


                <div class="total-payable">

                    <small>
                        Total
                        <br>
                        Payable
                    </small>

                    <strong>
                        0.00
                    </strong>

                </div>

            </div>

        </div>


        {{-- RIGHT PRODUCT AREA --}}
        <div class="pos-products-area">


            {{-- FILTERS --}}
            <div class="pos-product-filters">

                <select>
                    <option>
                        All Categories
                    </option>
                </select>

                <select>
                    <option>
                        All Brands
                    </option>
                </select>

            </div>


            {{-- PRODUCTS --}}
            <div class="product-grid">


                @php

                    $products = [
                        'Accessories 1 (1000)',
                        'Accessories 2 (1500)',
                        'iPhone 11 Black 128GB (04)',
                        'iPhone 11 Black 128GB (05)',
                        'iPhone 11 Black 128GB (01)',
                        'iPhone 11 Green 128GB (03)',
                        'iPhone 11 Pro Max Gold... (13)',
                        'iPhone 11 Pro Max Gold... (11)',
                        'iPhone 11 Pro Max... (14)',
                        'iPhone 11 Pro Max... (15)',
                        'iPhone 11 Pro Max... (09)',
                        'iPhone 11 Pro Max Silver... (16)',
                        'iPhone 11 Pro Max Spa... (18)',
                        'iPhone 11 Pro Max Spa... (12)',
                        'iPhone 11 Pro Max Spa... (10)',
                        'iPhone 11 Pro Midnight... (07)',
                        'Product 17',
                        'Product 18',
                        'Product 19',
                        'Product 20'
                    ];

                @endphp


                @foreach($products as $product)

                    <button class="product-card">

                        <div class="product-image">

                            <i class="bi bi-image"></i>

                        </div>

                        <div class="product-name">

                            {{ $product }}

                        </div>

                    </button>

                @endforeach

            </div>


            {{-- RECENT TRANSACTIONS --}}
            <button class="recent-transactions">

                <i class="bi bi-clock-history"></i>

                Recent Transactions

            </button>

        </div>

    </div>

</div>

@endsection