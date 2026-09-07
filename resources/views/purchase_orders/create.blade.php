@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-3">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Add Purchase Order</h4>
            <small class="text-muted">Create a new purchase order</small>
        </div>

        <a href="{{ route('purchase-orders.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('purchase-orders.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="purchaseOrderForm">

        @csrf

        {{-- Supplier Information --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-person-vcard me-2"></i>
                    Supplier Information
                </h6>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- Supplier --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Supplier <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <input type="text"
                                   name="supplier"
                                   class="form-control"
                                   placeholder="Enter supplier name"
                                   value="{{ old('supplier') }}"
                                   required>

                            <button type="button"
                                    class="btn btn-outline-primary"
                                    id="addSupplierBtn">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Reference --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Reference No <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="reference_no"
                               class="form-control"
                               placeholder="Enter reference number"
                               value="{{ old('reference_no') }}"
                               required>
                    </div>

                    {{-- Address --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Address
                        </label>

                        <textarea name="address"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Supplier address">{{ old('address') }}</textarea>
                    </div>

                    {{-- Order Date --}}
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Order Date <span class="text-danger">*</span>
                            </label>

                            <input type="datetime-local"
                                   name="order_date"
                                   class="form-control"
                                   value="{{ old('order_date', now()->format('Y-m-d\TH:i')) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Business Location <span class="text-danger">*</span>
                            </label>

                            <select name="location"
                                    class="form-select"
                                    required>

                                <option value="">Please Select</option>

                                <option value="Main Branch"
                                    {{ old('location') == 'Main Branch' ? 'selected' : '' }}>
                                    Main Branch
                                </option>

                                <option value="Dhaka Branch"
                                    {{ old('location') == 'Dhaka Branch' ? 'selected' : '' }}>
                                    Dhaka Branch
                                </option>

                                <option value="Chattogram Branch"
                                    {{ old('location') == 'Chattogram Branch' ? 'selected' : '' }}>
                                    Chattogram Branch
                                </option>

                            </select>
                        </div>

                    </div>

                    {{-- Pay Term --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Pay Term
                        </label>

                        <div class="input-group">

                            <input type="number"
                                   name="pay_term"
                                   class="form-control"
                                   placeholder="0"
                                   min="0"
                                   value="{{ old('pay_term') }}">

                            <select class="form-select"
                                    style="max-width: 130px;">
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                            </select>

                        </div>

                    </div>

                    {{-- Document --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Attach Document
                        </label>

                        <input type="file"
                               name="document"
                               class="form-control"
                               accept=".pdf,.csv,.zip,.doc,.docx,.jpg,.jpeg,.png">

                        <small class="text-muted">
                            Maximum file size: 5MB
                        </small>

                    </div>

                </div>

            </div>
        </div>


        {{-- Product Section --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="mb-0 fw-bold">
                        <i class="bi bi-box-seam me-2"></i>
                        Products
                    </h6>

                    <button type="button"
                            class="btn btn-sm btn-outline-primary"
                            id="addProductBtn">

                        <i class="bi bi-plus-lg"></i>
                        Add new product

                    </button>

                </div>

            </div>

            <div class="card-body">

                {{-- Product Search --}}
                <div class="input-group mb-4">

                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                           id="productSearch"
                           class="form-control"
                           placeholder="Enter Product name / SKU / Scan bar code">

                    <button type="button"
                            class="btn btn-primary"
                            id="searchProductBtn">

                        Search

                    </button>

                </div>


                {{-- Product Table --}}
                <div class="table-responsive">

                    <table class="table table-bordered align-middle"
                           id="productTable">

                        <thead class="table-light">

                            <tr>

                                <th width="50">#</th>

                                <th>
                                    Product Name
                                </th>

                                <th width="130">
                                    Order Quantity
                                </th>

                                <th width="180">
                                    Unit Cost
                                    <small class="d-block text-muted">
                                        Before Discount
                                    </small>
                                </th>

                                <th width="150">
                                    Discount %
                                </th>

                                <th width="180">
                                    Unit Cost
                                    <small class="d-block text-muted">
                                        Before Tax
                                    </small>
                                </th>

                                <th width="150">
                                    Line Total
                                </th>

                                <th width="60"></th>

                            </tr>

                        </thead>

                        <tbody id="productTableBody">

                            <tr id="emptyProductRow">

                                <td colspan="8"
                                    class="text-center text-muted py-5">

                                    <i class="bi bi-box-seam fs-2 d-block mb-2"></i>

                                    No products added yet.

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                {{-- Product Totals --}}
                <div class="row justify-content-end mt-3">

                    <div class="col-md-5">

                        <div class="d-flex justify-content-between border-bottom py-2">

                            <span class="fw-semibold">
                                Total Items
                            </span>

                            <span id="totalItems">
                                0
                            </span>

                        </div>

                        <div class="d-flex justify-content-between py-2">

                            <span class="fw-bold">
                                Net Total Amount
                            </span>

                            <span class="fw-bold"
                                  id="netTotal">
                                ¥0.00
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Shipping Details --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-truck me-2"></i>
                    Shipping Details
                </h6>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- Shipping Details --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Shipping Details
                        </label>

                        <textarea name="shipping_details"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Enter shipping details">{{ old('shipping_details') }}</textarea>

                    </div>

                    {{-- Shipping Address --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Shipping Address
                        </label>

                        <textarea name="shipping_address"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Enter shipping address">{{ old('shipping_address') }}</textarea>

                    </div>

                    {{-- Shipping Charges --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Shipping Charges
                        </label>

                        <input type="number"
                               name="shipping_charges"
                               id="shippingCharges"
                               class="form-control"
                               value="{{ old('shipping_charges', 0) }}"
                               min="0"
                               step="0.01">

                    </div>

                    {{-- Shipping Status --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Shipping Status
                        </label>

                        <select name="shipping_status"
                                class="form-select">

                            <option value="pending">
                                Pending
                            </option>

                            <option value="partial">
                                Partial
                            </option>

                            <option value="shipped">
                                Shipped
                            </option>

                            <option value="received">
                                Received
                            </option>

                        </select>

                    </div>

                    {{-- Delivered To --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Delivered To
                        </label>

                        <input type="text"
                               name="delivered_to"
                               class="form-control"
                               placeholder="Delivered person / department"
                               value="{{ old('delivered_to') }}">

                    </div>

                    {{-- Shipping Document --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Shipping Documents
                        </label>

                        <input type="file"
                               name="shipping_document"
                               class="form-control"
                               accept=".pdf,.csv,.zip,.doc,.docx,.jpg,.jpeg,.png">

                    </div>

                </div>

            </div>

        </div>


        {{-- Additional Expenses --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h6 class="fw-bold mb-0">
                        Additional Expenses
                    </h6>

                    <button type="button"
                            class="btn btn-outline-secondary btn-sm"
                            id="addExpenseBtn">

                        <i class="bi bi-plus-lg"></i>
                        Add additional expenses

                    </button>

                </div>


                <div id="expenseArea"
                     style="display:none;">

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">
                                Additional Expenses
                            </label>

                            <input type="number"
                                   name="additional_expenses"
                                   id="additionalExpenses"
                                   class="form-control"
                                   value="{{ old('additional_expenses', 0) }}"
                                   min="0"
                                   step="0.01">

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Order Summary --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <div class="row justify-content-end">

                    <div class="col-md-5">

                        <div class="d-flex justify-content-between py-2">

                            <span>
                                Net Total Amount
                            </span>

                            <span id="summaryNet">
                                ¥0.00
                            </span>

                        </div>

                        <div class="d-flex justify-content-between py-2">

                            <span>
                                Shipping Charges
                            </span>

                            <span id="summaryShipping">
                                ¥0.00
                            </span>

                        </div>

                        <div class="d-flex justify-content-between py-2">

                            <span>
                                Additional Expenses
                            </span>

                            <span id="summaryExpenses">
                                ¥0.00
                            </span>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">

                            <h5 class="fw-bold">
                                Order Total
                            </h5>

                            <h5 class="fw-bold"
                                id="orderTotalDisplay">
                                ¥0.00
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Notes --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white py-3">

                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-journal-text me-2"></i>
                    Additional Notes
                </h6>

            </div>

            <div class="card-body">

                <textarea name="notes"
                          class="form-control"
                          rows="4"
                          placeholder="Enter additional notes">{{ old('notes') }}</textarea>

            </div>

        </div>


        {{-- Hidden Items --}}
        <input type="hidden"
               name="items"
               id="itemsInput">

        <input type="hidden"
               name="order_total"
               id="orderTotalInput"
               value="0">


        {{-- Save --}}
        <div class="d-flex justify-content-end gap-2 mb-5">

            <a href="{{ route('purchase-orders.index') }}"
               class="btn btn-light border px-4">

                Cancel

            </a>

            <button type="submit"
                    class="btn btn-primary px-5">

                <i class="bi bi-check-lg me-1"></i>
                Save Purchase Order

            </button>

        </div>

    </form>

</div>


{{-- Custom CSS --}}
<style>

    .card {
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 1px solid #eee;
    }

    .form-control,
    .form-select {
        min-height: 42px;
        border-radius: 6px;
    }

    textarea.form-control {
        min-height: auto;
    }

    .table th {
        font-size: 13px;
        vertical-align: middle;
    }

    .table td {
        font-size: 14px;
    }

    .btn {
        border-radius: 6px;
    }

    .product-row input {
        font-size: 13px;
    }

    .line-total {
        font-weight: 600;
        white-space: nowrap;
    }

</style>


{{-- JavaScript --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    let products = [];

    const productSearch =
        document.getElementById('productSearch');

    const productTableBody =
        document.getElementById('productTableBody');

    const itemsInput =
        document.getElementById('itemsInput');

    const totalItems =
        document.getElementById('totalItems');

    const netTotal =
        document.getElementById('netTotal');

    const summaryNet =
        document.getElementById('summaryNet');

    const shippingCharges =
        document.getElementById('shippingCharges');

    const additionalExpenses =
        document.getElementById('additionalExpenses');

    const summaryShipping =
        document.getElementById('summaryShipping');

    const summaryExpenses =
        document.getElementById('summaryExpenses');

    const orderTotalDisplay =
        document.getElementById('orderTotalDisplay');

    const orderTotalInput =
        document.getElementById('orderTotalInput');


    /*
    |--------------------------------------------------------------------------
    | Currency Formatter
    |--------------------------------------------------------------------------
    */

    function currency(value) {

        return '¥' + Number(value || 0)
            .toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

    }


    /*
    |--------------------------------------------------------------------------
    | Add Product
    |--------------------------------------------------------------------------
    */

    function addProduct(name) {

        if (!name || !name.trim()) {
            alert('Please enter a product name.');
            return;
        }

        products.push({

            name: name.trim(),

            quantity: 1,

            unit_cost: 0,

            discount: 0,

            unit_cost_before_tax: 0,

            line_total: 0

        });

        productSearch.value = '';

        renderProducts();

    }


    /*
    |--------------------------------------------------------------------------
    | Render Products
    |--------------------------------------------------------------------------
    */

    function renderProducts() {

        productTableBody.innerHTML = '';

        if (products.length === 0) {

            productTableBody.innerHTML = `

                <tr>

                    <td colspan="8"
                        class="text-center text-muted py-5">

                        <i class="bi bi-box-seam fs-2 d-block mb-2"></i>

                        No products added yet.

                    </td>

                </tr>

            `;

            calculateTotals();

            return;

        }


        products.forEach(function (product, index) {

            calculateProduct(product);


            const row =
                document.createElement('tr');

            row.className = 'product-row';


            row.innerHTML = `

                <td>
                    ${index + 1}
                </td>

                <td>

                    <input type="text"
                           class="form-control"
                           value="${escapeHtml(product.name)}"
                           data-field="name"
                           data-index="${index}">

                </td>

                <td>

                    <input type="number"
                           class="form-control"
                           value="${product.quantity}"
                           min="1"
                           step="1"
                           data-field="quantity"
                           data-index="${index}">

                </td>

                <td>

                    <input type="number"
                           class="form-control"
                           value="${product.unit_cost}"
                           min="0"
                           step="0.01"
                           data-field="unit_cost"
                           data-index="${index}">

                </td>

                <td>

                    <input type="number"
                           class="form-control"
                           value="${product.discount}"
                           min="0"
                           max="100"
                           step="0.01"
                           data-field="discount"
                           data-index="${index}">

                </td>

                <td>

                    <input type="number"
                           class="form-control"
                           value="${product.unit_cost_before_tax.toFixed(2)}"
                           readonly>

                </td>

                <td class="line-total">

                    ${currency(product.line_total)}

                </td>

                <td class="text-center">

                    <button type="button"
                            class="btn btn-sm btn-outline-danger remove-product"
                            data-index="${index}">

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            `;

            productTableBody.appendChild(row);

        });


        calculateTotals();

    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Product
    |--------------------------------------------------------------------------
    */

    function calculateProduct(product) {

        const quantity =
            Number(product.quantity || 0);

        const unitCost =
            Number(product.unit_cost || 0);

        const discount =
            Number(product.discount || 0);


        const discountAmount =
            unitCost * discount / 100;


        product.unit_cost_before_tax =
            unitCost - discountAmount;


        product.line_total =
            product.unit_cost_before_tax * quantity;

    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Totals
    |--------------------------------------------------------------------------
    */

    function calculateTotals() {

        let itemCount = 0;

        let total = 0;


        products.forEach(function (product) {

            calculateProduct(product);

            itemCount += Number(product.quantity || 0);

            total += Number(product.line_total || 0);

        });


        const shipping =
            Number(shippingCharges.value || 0);

        const expenses =
            Number(additionalExpenses.value || 0);


        const orderTotal =
            total + shipping + expenses;


        totalItems.textContent =
            itemCount;


        netTotal.textContent =
            currency(total);


        summaryNet.textContent =
            currency(total);


        summaryShipping.textContent =
            currency(shipping);


        summaryExpenses.textContent =
            currency(expenses);


        orderTotalDisplay.textContent =
            currency(orderTotal);


        orderTotalInput.value =
            orderTotal.toFixed(2);


        itemsInput.value =
            JSON.stringify(products);

    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text;

        return div.innerHTML;

    }


    /*
    |--------------------------------------------------------------------------
    | Product Search / Enter
    |--------------------------------------------------------------------------
    */

    productSearch.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                addProduct(productSearch.value);

            }

        }
    );


    document
        .getElementById('searchProductBtn')
        .addEventListener('click', function () {

            addProduct(productSearch.value);

        });


    /*
    |--------------------------------------------------------------------------
    | Add New Product
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('addProductBtn')
        .addEventListener('click', function () {

            const name =
                prompt('Enter new product name:');

            if (name) {

                addProduct(name);

            }

        });


    /*
    |--------------------------------------------------------------------------
    | Product Inputs
    |--------------------------------------------------------------------------
    */

    productTableBody.addEventListener(
        'input',
        function (event) {

            const field =
                event.target.dataset.field;

            const index =
                event.target.dataset.index;


            if (field === undefined ||
                index === undefined) {

                return;

            }


            products[index][field] =
                event.target.value;


            renderProducts();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove Product
    |--------------------------------------------------------------------------
    */

    productTableBody.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest('.remove-product');


            if (!button) {
                return;
            }


            const index =
                button.dataset.index;


            products.splice(index, 1);

            renderProducts();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Shipping / Expense Calculation
    |--------------------------------------------------------------------------
    */

    shippingCharges.addEventListener(
        'input',
        calculateTotals
    );


    additionalExpenses.addEventListener(
        'input',
        calculateTotals
    );


    /*
    |--------------------------------------------------------------------------
    | Additional Expense Toggle
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('addExpenseBtn')
        .addEventListener('click', function () {

            const area =
                document.getElementById('expenseArea');


            if (area.style.display === 'none') {

                area.style.display = 'block';

                this.innerHTML =
                    '<i class="bi bi-dash-lg"></i> Hide additional expenses';

            } else {

                area.style.display = 'none';

                this.innerHTML =
                    '<i class="bi bi-plus-lg"></i> Add additional expenses';

            }

        });


    /*
    |--------------------------------------------------------------------------
    | Supplier Button
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('addSupplierBtn')
        .addEventListener('click', function () {

            const supplier =
                prompt('Enter supplier name:');


            if (supplier) {

                document.querySelector(
                    'input[name="supplier"]'
                ).value = supplier;

            }

        });


    /*
    |--------------------------------------------------------------------------
    | Form Validation
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('purchaseOrderForm')
        .addEventListener('submit', function (event) {

            if (products.length === 0) {

                event.preventDefault();

                alert(
                    'Please add at least one product before saving the Purchase Order.'
                );

                productSearch.focus();

                return;

            }


            calculateTotals();

        });


    /*
    |--------------------------------------------------------------------------
    | Initial Render
    |--------------------------------------------------------------------------
    */

    renderProducts();

});

</script>

@endsection