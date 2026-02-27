@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-user mr-2"></i>Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <ol class="breadcrumb float-right">
                        <div class="form-inline ml-2">
                            <button type="button" class="btn  btn-success" onclick="showOperatorEditAccountModal()">Edit
                                Account</button>
                        </div>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column h-100">
                                <div class="card mb-3 flex-grow-1">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <h5 class="text-center">
                                                Boarding House
                                            </h5>
                                            <h2>
                                                <strong>
                                                    {{ $operatorProfile->boardingHouse->boarding_house_name }}
                                                </strong>
                                            </h2>
                                            @if ($operatorProfile->boardingHouse->sex_accepted == 0)
                                                <h5><i class="fas fa-venus-mars mr-3"></i>Accepts: Female Boarders</h5>
                                            @elseif($operatorProfile->boardingHouse->sex_accepted == 1)
                                                <h5><i class="fas fa-venus-mars mr-3"></i>Accepts: Male Boarders</h5>
                                            @else
                                                <h5></h5>
                                            @endif
                                            @if ($operatorProfile->boardingHouse->lodging_type == 1)
                                                <h5><i class="fas fa-bed mr-3"></i>Bed Spacer</h5>
                                            @elseif ($operatorProfile->boardingHouse->lodging_type == 2)
                                                <h5><i class="fas fa-bed mr-3"></i>Pad</h5>
                                            @endif
                                            <h5>{{ $operatorProfile->boardingHouse->classification }}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 flex-grow-1">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <h5 class="text-center">
                                                Operator
                                            </h5>
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    @if ($operatorProfile->employee->sex == 0)
                                                        <img src="{{ asset('images/female_avatar.svg') }}" alt=""
                                                            class="img img-fluid img-circle" width="100px" height="auto">
                                                    @elseif($operatorProfile->employee->sex == 1)
                                                        <img src="{{ asset('images/male_avatar.svg') }}" alt=""
                                                            class="img img-fluid img-circle" width="100px" height="auto">
                                                    @endif
                                                </div>
                                                <div class="col-md8">
                                                    <h3><strong>{{ $operatorProfile->employee->firstname }}
                                                            {{ $operatorProfile->employee->middlename }}
                                                            {{ $operatorProfile->employee->lastname }}</strong></h3>
                                                    <div class=" mt-3">
                                                        <h5><i class="fas fa-phone mr-3"></i>
                                                            {{ $operatorProfile->employee->contact_no }}</h5>
                                                        @if ($operatorProfile->employee->sex == 0)
                                                            <h5><i class="fas fa-venus-mars mr-3"></i> Female</h5>
                                                        @elseif($operatorProfile->employee->sex == 1)
                                                            <h5><i class="fas fa-venus-mars mr-3"></i> Male</h5>
                                                        @else
                                                            <h5><i class="fas fa-venus-mars mr-3"></i> </h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" style="height: 400px;">
                                <div class="card-header">
                                    <div class="float-left">
                                        Boarding House Images
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-success btn-sm" onclick="showUploadPhotoModal()">Upload a new
                                            photo</button>
                                    </div>
                                    @include('operator.operator_modals.upload_bh_photo_modal')
                                </div>

                                <div class="card-body">
                                    @if ($operatorProfile->boardingHouse->bhPhotos->count() == 0)
                                        <div class="text-center">
                                            No Photos Yet.
                                        </div>
                                    @else
                                        <div id="carouselExampleIndicators" class="carousel slide" style="height: 100%;"
                                            data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach ($operatorProfile->boardingHouse->bhPhotos as $index => $photo)
                                                    <li data-target="#carouselExampleIndicators"
                                                        data-slide-to="{{ $index }}"
                                                        @if ($index === 0) class="active" @endif></li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner" style="height: 100%;">
                                                @foreach ($operatorProfile->boardingHouse->bhPhotos as $index => $photo)
                                                    <div class="carousel-item @if ($index === 0) active @endif"
                                                        style="height: 100%;">
                                                        <div class="text-center mb-2">
                                                            <button class="btn btn-danger btn-sm btn-block"><i
                                                                    class="fas fa-trash"
                                                                    onclick="deleteBhPhoto({{ $photo->id }})"></i></button>
                                                        </div>
                                                        <img class="d-block w-100" style="object-fit: cover; height: 100%;"
                                                            src="{{ asset('storage/' . $photo->file_path) }}"
                                                            alt="Slide">

                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                role="button" data-slide="prev">
                                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                role="button" data-slide="next">
                                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                Location
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height: 350px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletePhotoConfirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="deletePhotoConfirmationModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="form-group d-flex align-items-center justify-content-center">
                                    <h5>Confirmation</h5>
                                </div>

                                <form action="{{ route('operatorDeleteBhPhoto') }}" method="post"
                                    id="operatorDeleteBhPhotoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="modal-body">
                                                <span id="confirmationQuestion">Are you sure you want to delete the
                                                    picure?</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" id="bhPhotoIdInput" name="bhPhotoIdInput" hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-default btn-block btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                        </div>
                                        <div class="col-md-6">

                                            <button type="submit"
                                                class="btn btn-success btn-block btn-sm">Confirm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="operatorEditAccountModal" tabindex="-1" role="dialog"
            aria-labelledby="operatorEditAccountModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Edit Account</h3>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <form action="{{ route('operatorUpdateAccountDetails') }}" method="post"
                                    id="operatorUpdateAccountDetailsForm">
                                    @csrf
                                    <div class="row">
                                        <input type="text" id="operatorEditAccountOperatorId"
                                            name="operatorEditAccountOperatorId"
                                            value="{{ $operatorProfile->employee->user->id }}" hidden>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="operatorEditAccountEmailField">Email</label>
                                                <input type="text"
                                                    value="{{ $operatorProfile->employee->user->email }}"
                                                    id="operatorEditAccountEmailField"
                                                    name="operatorEditAccountEmailField" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="operatorEditAccountOldPassField">Enter previous
                                                    password</label>
                                                <input type="password" value=""
                                                    id="operatorEditAccountOldPassField"
                                                    name="operatorEditAccountOldPassField" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="operatorEditAccountNewPassField">Enter new
                                                    password</label>
                                                <input type="password" value=""
                                                    id="operatorEditAccountNewPassField"
                                                    name="operatorEditAccountNewPassField" class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-success btn-block"
                                        onclick="showConfirmationModal('updateAccount')">Confirm</button>

                                    <button type="button" class="btn btn-default btn-block"
                                        data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="form-group d-flex align-items-center justify-content-center">
                                    <h5>Confirmation</h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <span id="confirmationQuestion"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-default btn-block btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6">

                                        <button type="button" class="btn btn-success btn-block btn-sm"
                                            id="confirmButton">Confirm</button>
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
        function showConfirmationModal(action) {
            if (action === 'uploadConfirm') {
                $('#confirmationQuestion').text('Confirm Upload Photo?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#operatorUploadBhPhoto').submit();
                });
            } else if (action === 'updateAccount') {
                $('#confirmationQuestion').text('Confirm editing your account?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#operatorUpdateAccountDetailsForm').submit();
                });
            }
        }
    </script>
    <script>
        function showOperatorEditAccountModal() {
            $('#operatorEditAccountModal').modal('show');
        }
    </script>
    <script>
        var greenIcon = L.icon({
            iconUrl: "{{ asset('images/marker_default.png') }}",
            iconSize: [48, 55],
            shadowSize: [50, 64],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });

        const boardingHouseMaps = @json($operatorProfile->boardingHouse);
        const bhLat = boardingHouseMaps.latitude;
        const bhLng = boardingHouseMaps.longitude;

        var map = L.map('map').setView([bhLat, bhLng], 16);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            center: [7.859700529760978, 125.05071376673064],
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker = L.marker([bhLat, bhLng], {
            icon: greenIcon,

        }).addTo(map);
    </script>

    <script>
        function showUploadPhotoModal() {
            $('#uploadBoardingHousePhoto').modal('show');
        }
    </script>

    <script>
        function deleteBhPhoto(photoId) {
            $('#bhPhotoIdInput').val(photoId);
            $('#deletePhotoConfirmationModal').modal('show');
        }
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
