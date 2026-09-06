<aside class="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-shop"></i>
        </div>

        <div>
            <div class="brand-title">POS APP</div>
            <small>Point of Sale</small>
        </div>
    </div>


    <nav class="sidebar-nav">

        {{-- MAIN --}}
        <div class="nav-section">MAIN</div>

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>

        </a>


        {{-- PURCHASES --}}
        <div class="nav-section">PURCHASES</div>


        {{-- Purchase Data Manage --}}
        <a href="{{ route('purchases.manage') }}"
           class="nav-link {{ request()->routeIs('purchases.manage') ? 'active' : '' }}">

            <i class="bi bi-pencil-square"></i>
            <span>Purchase Data Manage</span>

        </a>


        {{-- View Purchase Data --}}
        <a href="{{ route('purchases.view-data') }}"
           class="nav-link {{ request()->routeIs('purchases.view-data') ? 'active' : '' }}">

            <i class="bi bi-eye"></i>
            <span>View Purchase Data</span>

        </a>


        {{-- Purchase Order --}}
        <a href="{{ route('purchase-orders.index') }}"
           class="nav-link {{ request()->routeIs('purchase-orders.*') ? 'active' : '' }}">

            <i class="bi bi-file-earmark-text"></i>
            <span>Purchase Order</span>

        </a>


        {{-- List Purchases --}}
        <a href="{{ route('purchases.manage') }}"
           class="nav-link">

            <i class="bi bi-list-ul"></i>
            <span>List Purchases</span>

        </a>


        {{-- Add Purchase --}}
        <a href="{{ route('purchases.create') }}"
           class="nav-link {{ request()->routeIs('purchases.create') ? 'active' : '' }}">

            <i class="bi bi-plus-square"></i>
            <span>Add Purchase</span>

        </a>


        {{-- List Purchase Return --}}
        <a href="#"
           class="nav-link">

            <i class="bi bi-arrow-return-left"></i>
            <span>List Purchase Return</span>

        </a>


        {{-- File Upload --}}
        <a href="#"
           class="nav-link">

            <i class="bi bi-upload"></i>
            <span>File Upload</span>

        </a>


        {{-- SALES & INVENTORY --}}
        <div class="nav-section">SALES & INVENTORY</div>


        {{-- Sales --}}
        <a href="#" class="nav-link">
            <i class="bi bi-cart3"></i>
            <span>Sales</span>
        </a>


        {{-- Products --}}
        <a href="#" class="nav-link">
            <i class="bi bi-box-seam"></i>
            <span>Products</span>
        </a>


        {{-- Customers --}}
        <a href="#" class="nav-link">
            <i class="bi bi-people"></i>
            <span>Customers</span>
        </a>


        {{-- Suppliers --}}
        <a href="#" class="nav-link">
            <i class="bi bi-truck"></i>
            <span>Suppliers</span>
        </a>


        {{-- Inventory --}}
        <a href="#" class="nav-link">
            <i class="bi bi-boxes"></i>
            <span>Inventory</span>
        </a>


        {{-- REPORTS --}}
        <div class="nav-section">REPORTS</div>


        {{-- Reports --}}
        <a href="#" class="nav-link">
            <i class="bi bi-bar-chart"></i>
            <span>Reports</span>
        </a>


        {{-- Settings --}}
        <a href="#" class="nav-link">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>

    </nav>

</aside>