<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color:white">OSA</li>
            <li class="nav-item">
                <a href="{{ route('osaDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('osaDormitories') }}" class="nav-link">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                        Dormitories
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('osaStudents') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Students
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('osaNewInteractiveMap') }}" class="nav-link">
                    <i class="nav-icon fas fa-map"></i>
                    <p>
                        Interactive Map
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('osaReporting') }}" class="nav-link">

                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Reporting
                    </p>

                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('osaProfilePage', auth()->user()->employee->id) }}" class="nav-link">
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
