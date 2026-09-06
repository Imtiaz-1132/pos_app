<header class="topbar-custom">

    {{-- LEFT SIDE --}}
    <div class="topbar-left">

        {{-- Sidebar Toggle --}}
        <button type="button"
                class="navbar-menu-btn sidebar-toggle"
                title="Menu">

            <i class="bi bi-list"></i>

        </button>


        {{-- Quick Add --}}
        <a href="{{ route('purchases.create') }}"
           class="navbar-action-btn"
           title="Add Purchase">

            <i class="bi bi-plus-circle"></i>

        </a>


        {{-- Calculator --}}
        <button type="button"
                class="navbar-action-btn"
                title="Calculator">

            <i class="bi bi-calculator"></i>

        </button>


        {{-- POS --}}
        <a href="{{ route('pos') }}"
           class="navbar-pos-btn"
           title="POS">

            <i class="bi bi-grid-fill"></i>
            <span>POS</span>

        </a>


        {{-- Payment / Transactions --}}
        <a href="{{ route('purchases.view-data') }}"
           class="navbar-action-btn"
           title="Transactions">

            <i class="bi bi-cash-stack"></i>

        </a>

    </div>


    {{-- RIGHT SIDE --}}
    <div class="topbar-right">


        {{-- DATE --}}
        <div class="navbar-date">

            {{ now()->format('d/m/Y') }}

        </div>


        {{-- NOTIFICATION --}}
        <button type="button"
                class="navbar-notification"
                title="Notifications">

            <i class="bi bi-bell-fill"></i>

            <span class="notification-dot"></span>

        </button>


        {{-- USER --}}
        <div class="navbar-user">

            <div class="navbar-avatar">
                A
            </div>

            <div class="navbar-user-info">

                <strong>
                    Admin
                </strong>

                <small>
                    Administrator
                </small>

            </div>

        </div>

    </div>

</header>