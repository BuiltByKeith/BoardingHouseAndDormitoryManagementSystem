<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color:white">DORM MANAGER</li>
            <li class="nav-item">
                <a href="{{ route('dormManagerDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dormManagerTenantList') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Tenants') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dormManagerRoomList') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('Rooms') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dormManagerBillings', auth()->user()->employee->dormManager->id) }}"
                    class="nav-link">
                    <i class="nav-icon fa-solid fa-money-bill-trend-up"></i>
                    <p>
                        Billing
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dormManagerTransactions', auth()->user()->employee->dormManager->id) }}"
                    class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Transactions
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dormManagerHistoryOfTenantList') }}" class="nav-link">
                    <i class="nav-icon fas fa-user-xmark"></i>
                    <p>
                        Tenant History
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dormManagerProfilePage', auth()->user()->employee->dormManager->id) }}"
                    class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>

            <br>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
