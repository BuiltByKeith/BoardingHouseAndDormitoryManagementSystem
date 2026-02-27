<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color:white">OPERATOR</li>

            <li class="nav-item">
                <a href="{{ route('operatorDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-house"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('operatorTenantList') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Tenants') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('operatorRoomList') }}" class="nav-link">
                    <i class="nav-icon fas fa-bed"></i>
                    <p>
                        {{ __('Rooms') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('operatorBhBillings', auth()->user()->employee->operator->id) }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-money-bill-trend-up"></i>
                    <p>
                        Billing
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('operatorTransactions', auth()->user()->employee->operator->id) }}" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Transactions
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('operatorTenantHistoryList') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-xmark"></i>
                    <p>
                        Tenant History
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('operatorProfilePage', auth()->user()->employee->operator->id) }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
