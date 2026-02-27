<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"
            style="overflow: hidden">
            <li class="nav-header" style="color:white">Admin</li>
            <li class="nav-item">
                <a href="{{ route('adminDashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('adminEmployeesList') }}" class="nav-link">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        {{ __('Employees') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                @php

                @endphp
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sliders"></i>
                    <p>
                        Academic Settings

                        <i class="fas fa-angle-down right"></i>
                        </span>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none; padding-left: 20px; overflow: hidden;">
                    <li class="nav-item">

                        <a href="{{ route('adminAcadYearsList') }} " class="nav-link">
                            <i class="fa-solid fa-calendar nav-icon"></i>
                            <p>Academic Year</p>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminSemestersList') }} " class="nav-link">
                            <i class="fa-solid fa-calendar nav-icon"></i>
                            <p>Semester</p>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('adminStudentsList') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-graduation-cap"></i>
                    <p>
                        Students
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('adminUsersList') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            <br>
            <li class="nav-item" style="border-top: 1px solid #ccc;">
                <br>
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Profile
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class=" nav-icon fas fa-sign-out-alt"></i>
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>

            <br>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
