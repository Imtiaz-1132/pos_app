@extends('layouts.app')

@section('title', 'Add Purchase | POS App')
@section('page_label', 'Add Purchase')

@section('content')

<div class="container-fluid">

    {{-- PAGE TITLE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1" style="color:#243b6b;">
                Add Purchase
            </h4>

            <small class="text-muted">
                Create a new purchase transaction
            </small>
        </div>

        <a href="{{ route('purchases.manage') }}"
           class="btn btn-secondary btn-sm">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </a>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- PURCHASE FORM --}}
    <div class="content-card">

        <div class="card-header-custom mb-4">

            <div>

                <h5 class="mb-1">
                    Purchase Information
                </h5>

                <small class="text-muted">
                    Enter purchase details below
                </small>

            </div>

        </div>


        <form method="POST"
              action="{{ route('purchases.store') }}"
              enctype="multipart/form-data">

            @csrf


            <div class="row g-4">


                {{-- SUPPLIER --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Supplier <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="supplier"
                           value="{{ old('supplier') }}"
                           class="form-control"
                           placeholder="Enter supplier name"
                           required>

                </div>


                {{-- REFERENCE NUMBER --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Reference No <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="reference_no"
                           value="{{ old('reference_no') }}"
                           class="form-control"
                           placeholder="Enter reference number"
                           required>

                </div>


                {{-- PURCHASE DATE --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Purchase Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="purchase_date"
                           value="{{ old('purchase_date', date('Y-m-d')) }}"
                           class="form-control"
                           required>

                </div>


                {{-- LOCATION --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Business Location <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="location"
                           value="{{ old('location') }}"
                           class="form-control"
                           placeholder="Enter business location"
                           required>

                </div>


                {{-- PAYMENT STATUS --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Payment Status <span class="text-danger">*</span>
                    </label>

                    <select name="payment_status"
                            class="form-select"
                            required>

                        <option value="">
                            Select payment status
                        </option>

                        <option value="paid"
                            {{ old('payment_status') == 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                        <option value="partial"
                            {{ old('payment_status') == 'partial' ? 'selected' : '' }}>
                            Partial
                        </option>

                        <option value="pending"
                            {{ old('payment_status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                    </select>

                </div>


                {{-- PAYMENT METHOD --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Payment Method
                    </label>

                    <select name="payment_method"
                            class="form-select">

                        <option value="">
                            Select payment method
                        </option>

                        <option value="Cash"
                            {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="Bank Transfer"
                            {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>
                            Bank Transfer
                        </option>

                        <option value="Card"
                            {{ old('payment_method') == 'Card' ? 'selected' : '' }}>
                            Card
                        </option>

                        <option value="Mobile Banking"
                            {{ old('payment_method') == 'Mobile Banking' ? 'selected' : '' }}>
                            Mobile Banking
                        </option>

                    </select>

                </div>


                {{-- DOCUMENT --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Purchase Document
                    </label>

                    <input type="file"
                           name="document"
                           class="form-control">

                    <small class="text-muted">
                        Maximum file size: 5 MB
                    </small>

                </div>


                {{-- TOTAL AMOUNT --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Total Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="total_amount"
                           value="{{ old('total_amount', 0) }}"
                           class="form-control"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           required>

                </div>


                {{-- PAID AMOUNT --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Paid Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="paid_amount"
                           value="{{ old('paid_amount', 0) }}"
                           class="form-control"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           required>

                </div>


                {{-- DUE AMOUNT --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Due Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="due_amount"
                           value="{{ old('due_amount', 0) }}"
                           class="form-control"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           required>

                </div>


                {{-- NOTES --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Notes
                    </label>

                    <textarea name="notes"
                              rows="4"
                              class="form-control"
                              placeholder="Enter additional notes">{{ old('notes') }}</textarea>

                </div>


            </div>


            {{-- BUTTONS --}}
            <div class="mt-4 pt-3 border-top">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-check-lg me-1"></i>
                    Save Purchase

                </button>


                <a href="{{ route('purchases.manage') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection