@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ml-3 mr-3">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Boarding House Details</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                    <div class="card-body text-center p-4 mt-5">
                                        <h2>{{ $boardingHouseInfo->boarding_house_name }}</h2>
                                        @if ($boardingHouseInfo->lodging_type == 1)
                                            <h5><i class="fas fa-bed mr-2"></i> Bed Spacer</h5>
                                        @elseif($boardingHouseInfo->lodging_type == 2)
                                            <h5><i class="fas fa-bed mr-2"></i> Pad</h5>
                                        @endif
                                        @if ($boardingHouseInfo->sex_accepted == 0)
                                            <h5><i class="fas fa-venus-mars mr-2"></i> Accepts: Female Boarders</h5>
                                        @elseif ($boardingHouseInfo->sex_accepted == 1)
                                            <h5><i class="fas fa-venus-mars mr-2"></i> Accepts: Male Boarders</h5>
                                        @endif
                                        <h5>Class: {{ $boardingHouseInfo->classification }}</h5>
                                        @php
                                            $totalTenantCount = 0;
                                            $totalRoomCount = 0;
                                            foreach ($boardingHouseInfo->boardingHouseRooms as $room) {
                                                $totalTenantCount += $room->roomStudentTenants
                                                    ->where('isActive', 1)
                                                    ->count();
                                                $totalRoomCount += $room->number_of_beds;
                                            }
                                        @endphp
                                        <h5>Occupancy: {{ $totalTenantCount }} / {{ $totalRoomCount }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 d-flex flex-column justify-content-center align-items-center p-4">
                                    <div class="card-body text-center">
                                        @if ($boardingHouseInfo->operator->employee->sex == 0)
                                            <img src="{{ asset('images/female_avatar.svg') }}" alt=""
                                                style="width: 100px; height: 100px;">
                                        @elseif($boardingHouseInfo->operator->employee->sex == 1)
                                            <img src="{{ asset('images/male_avatar.svg') }}" alt=""
                                                style="width: 100px; height: 100px;">
                                        @endif
                                        <h2>{{ $boardingHouseInfo->operator->employee->firstname . ' ' . $boardingHouseInfo->operator->employee->middlename . ' ' . $boardingHouseInfo->operator->employee->lastname }}
                                        </h2>
                                        <h5>{{ $boardingHouseInfo->operator->employee->contact_no }}</h5>
                                        @if ($boardingHouseInfo->operator->employee->sex == 0)
                                            <h5>Female</h5>
                                        @elseif($boardingHouseInfo->operator->employee->sex == 1)
                                            <h5>Male</h5>
                                        @endif
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
        </div>
    </section>

    <script>
        const boardingHouseMaps = @json($boardingHouseInfo);
        const bhLat = boardingHouseMaps.latitude;
        const bhLng = boardingHouseMaps.longitude;
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
