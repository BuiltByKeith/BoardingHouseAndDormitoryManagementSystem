<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color:white">ASSOC</li>


            <li class="nav-item">
                <a href="{{ route('assocDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('assocBoardingHousesList') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Boarding Houses
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('assocNewInteractiveMap') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        Interactive Map
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('assocProfilePage', auth()->user()->employee->id) }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
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
