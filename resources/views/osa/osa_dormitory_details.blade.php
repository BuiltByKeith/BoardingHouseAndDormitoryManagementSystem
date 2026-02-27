@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-city mr-2"></i> Dormitory Details</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2>
                                    {{ $dormitory->dormitory_name }}
                                </h2>

                                @if ($dormitory->sex_accepted == 0)
                                    <h5>Accepts: Female Residents</h5>
                                @elseif ($dormitory->sex_accepted == 1)
                                    <h5>Accepts: Male Residents</h5>
                                @endif



                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column h-100">
                            <div class="card mb-3 flex-grow-1">
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="col-md-4">
                                            @if ($dormitory->dormManager->employee->sex == 0)
                                                <img src="{{ asset('images/female_avatar.svg') }}" alt=""
                                                    class="img img-fluid img-circle" width="125px" height="auto">
                                            @elseif($dormitory->dormManager->employee->sex == 1)
                                                <img src="{{ asset('images/male_avatar.svg') }}" alt=""
                                                    class="img img-fluid img-circle" width="125px" height="auto">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <h2>
                                                {{ $dormitory->dormManager->employee->firstname . ' ' . $dormitory->dormManager->employee->middlename . ' ' . $dormitory->dormManager->employee->lastname }}
                                            </h2>
                                            <h5>{{ $dormitory->dormManager->employee->contact_no }}</h5>
                                            @if ($dormitory->dormManager->employee->sex == 0)
                                                <h5>Female</h5>
                                            @elseif($dormitory->dormManager->employee->sex == 1)
                                                <h5>Male</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <p class="text-center"><strong>Tenants of {{ $dormitory->dormitory_name }}</strong></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dormTenantTableList">
                                        <thead>
                                            <th>Student ID</th>
                                            <th>Tenant Full Name</th>
                                            <th>Program</th>
                                            <th>College</th>
                                        </thead>
                                        <tbody>

                                            @if ($tenants != null)
                                                @foreach ($tenants as $tenant)
                                                    <tr>
                                                        <td>{{ $tenant->studentTenant->student_id }}</td>
                                                        <td>{{ $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname }}
                                                        </td>
                                                        <td>{{ $tenant->studentTenant->program->program_name }}</td>
                                                        <td>{{ $tenant->studentTenant->program->college->college_name }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">No tenants yet.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center"><strong>Location</strong></p>
                                <div id="map" style="height:500px;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#dormTenantTableList').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 8,
            });
        });
    </script>

    <script>
        const dormitoryMap = @json($dormitory);
        const bhLat = dormitoryMap.latitude;
        const bhLng = dormitoryMap.longitude;
        var greenIcon = L.icon({
            iconUrl: "{{ asset('images/marker_default.png') }}",
            iconSize: [48, 55],
            shadowSize: [50, 64],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });


        var map = L.map('map').setView([bhLat, bhLng], 16);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            center: [bhLat, bhLng],
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker = L.marker([bhLat, bhLng], {
            icon: greenIcon,
        }).addTo(map);
    </script>
@endsection
