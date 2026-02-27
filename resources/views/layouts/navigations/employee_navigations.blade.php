<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color:white">EMPLOYEE</li>
            <li class="nav-item">
                <a href="{{ route('employeeDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-house"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employeeRegistrationPage') }}" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        {{ __('Registration') }}
                    </p>
                </a>
            </li>

            <br>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
