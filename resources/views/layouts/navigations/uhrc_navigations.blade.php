<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header" style="color: white">UHRC</li>

            <li class="nav-item">
                <a href="{{ route('uhrcDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-house"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('uhrcBoardingHousesList') }}" class="nav-link">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                        Boarding Houses
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('uhrcDormitoriesList') }}" class="nav-link">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                        Dormitories
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('uhrcNewInteractiveMap') }}" class="nav-link">
                    <i class="nav-icon fas fa-map"></i>
                    <p>
                        Interactive Map
                    </p>
                </a>
            </li>

            <li class="nav-item">
                @php
                    $pendings = '';
                    if ($pendingRegistrationReqs->count() > 0) {
                        $pendings = $pendingRegistrationReqs->count();
                    } else {
                        $pendings = 0;
                    }
                @endphp
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder-open"></i>
                    <p>
                        Registrations

                        <i class="fas fa-angle-down right"></i>
                        <span class="badge badge-info right bg-danger">{{ $pendings ? $pendings : '' }}</span>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">

                        <a href="{{ route('uhrcPendingRegistrationRequests') }}" class="nav-link">
                            <i class="fa-solid fa-file-circle-exclamation nav-icon"></i>
                            <p>Pending</p>
                            <span class="badge badge-info right bg-danger">{{ $pendings ? $pendings : '' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('uhrcApprovedRegistrationRequests') }}" class="nav-link">
                            <i class="fa-solid fa-file-circle-check nav-icon"></i>
                            <p>Approved</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('uhrcRejectedRegistrationRequests') }}" class="nav-link">
                            <i class="fa-solid fa-file-circle-xmark nav-icon"></i>
                            <p>Rejected</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('uhrcReporting') }}" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Reporting
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('uhrcProfilePage', auth()->user()->employee->id) }}" class="nav-link">
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
