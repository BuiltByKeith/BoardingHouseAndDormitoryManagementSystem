@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fas fa-file mr-3"></i>Submitted Document Details</h1>
                </div>
                <div class="col-sm-3 mt-2">
                    <ol class="breadcrumb justify-content-center">

                        <li class="breadcrumb-item active">
                            @if ($applicationFormDetail->status == 0)
                                <strong style="color: orange">PENDING</strong>
                            @elseif ($applicationFormDetail->status == 1)
                                <strong style="color: #02681e">ACCEPTED</strong>
                            @elseif ($applicationFormDetail->status == 2)
                                <strong style="color: red">REJECTED</strong>
                            @endif
                        </li>
                    </ol>
                </div>
                <div class="col-sm-3 mt-2">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item active">
                            <strong>{{ $applicationFormDetail->created_at->format('F d, Y') }}</strong>
                        </li>
                    </ol>
                </div>
            </div><!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-3">

                            <div class="card">
                                <div class="card-body text-center">
                                    @if ($applicationFormDetail->employee->sex == 0)
                                        <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                            class="img-circle img-fluid" style="width: 150px; height:auto;"
                                            id="imageProfileOfTenant">
                                    @elseif ($applicationFormDetail->employee->sex == 1)
                                        <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                            class="img-circle img-fluid" style="width: 150px; height:auto;"
                                            id="imageProfileOfTenant">
                                    @endif
                                    <h5 class="mt-2">
                                        {{ $applicationFormDetail->employee->firstname . ' ' . $applicationFormDetail->employee->middlename . ' ' . $applicationFormDetail->employee->lastname }}
                                    </h5>
                                    <p class="mt-0">{{ $applicationFormDetail->employee->employee_id }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex flex-column h-100">
                                <div class="card  mb-3 flex-grow-1">


                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <p class="text-center">
                                                Boarding House Information
                                            </p>
                                            <h2>{{ $applicationFormDetail->boarding_house_name }}</h2>
                                            <div class="" style="font-size: 16px;">

                                                @if ($applicationFormDetail->sex_accepted == 0)
                                                    <p><i class="fas fa-venus-mars mr-2"></i> Accepts: Female Boarders</p>
                                                @elseif ($applicationFormDetail->sex_accepted == 1)
                                                    <p><i class="fas fa-venus-mars mr-2"></i> Accepts: Male Boarders</p>
                                                @endif
                                                @if ($applicationFormDetail->lodging_type == 1)
                                                    <p><i class="fas fa-bed mr-2"></i> Bed Spacer</p>
                                                @elseif ($applicationFormDetail->lodging_type == 2)
                                                    <p><i class="fas fa-bed mr-2"></i> Pad</p>
                                                @endif
                                                <p><i class="fas fa-map mr-2"></i>
                                                    {{ $applicationFormDetail->complete_address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="map" style="height: 350px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($applicationFormDetail->documents as $formDetail)
                            <div class="col-md-6">
                                <div class="card card-success collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $formDetail->document_name }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                    class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="card-body" style="display: none;">
                                        <div style="width:100%; height:100vh;">
                                            <iframe src="{{ asset('storage/' . $formDetail->file_path) }}" frameborder="0"
                                                width="100%" height="100%"></iframe>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const boardingHouseLat = @json($applicationFormDetail->latitude);
        const boardingHouseLng = @json($applicationFormDetail->longitude);

        console.log(boardingHouseLat);
        console.log(boardingHouseLng);
        var greenIcon = L.icon({
            iconUrl: "{{ asset('images/marker_default.png') }}",
            iconSize: [48, 55],
            shadowSize: [50, 64],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });


        var map = L.map('map').setView([boardingHouseLat, boardingHouseLng], 16);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            center: [7.859448725237801, 125.05150566565007],
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        // Create a marker
        var marker = L.marker([boardingHouseLat, boardingHouseLng], {
            icon: greenIcon,
        }).addTo(map);
    </script>
@endsection
