@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-user mr-3"></i>Profile</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column h-100">
                                <div class="card mb-3 flex-grow-1">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <h5 class="text-center">
                                                Dormitory
                                            </h5>
                                            <h2>
                                                <strong>
                                                    {{ $dormManager->dormitory->dormitory_name }}
                                                </strong>
                                            </h2>
                                            @if ($dormManager->dormitory->sex_accepted == 0)
                                                <h5><i class="fas fa-venus-mars mr-3"></i>Accepts: Female Boarders</h5>
                                            @elseif($dormManager->dormitory->sex_accepted == 1)
                                                <h5><i class="fas fa-venus-mars mr-3"></i>Accepts: Male Boarders</h5>
                                            @else
                                                <h5></h5>
                                            @endif
                                            @if ($dormManager->dormitory->lodging_type == 1)
                                                <h5><i class="fas fa-bed mr-3"></i>Bed Spacer</h5>
                                            @elseif ($dormManager->dormitory->lodging_type == 2)
                                                <h5><i class="fas fa-bed mr-3"></i>Pad</h5>
                                            @endif

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
                                                    @if ($dormManager->employee->sex == 0)
                                                        <img src="{{ asset('images/female_avatar.svg') }}" alt=""
                                                            class="img img-fluid img-circle">
                                                    @elseif ($dormManager->employee->sex == 1)
                                                        <img src="{{ asset('images/male_avatar.svg') }}" alt=""
                                                            class="img img-fluid img-circle">
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <h3><i class="fas fa-user mr-3"></i><strong>{{ $dormManager->employee->firstname }}
                                                            {{ $dormManager->employee->middlename }}
                                                            {{ $dormManager->employee->lastname }}</strong></h3>
                                                    <div class=" mt-3">
                                                        <h5><i class="fas fa-phone mr-3"></i>
                                                            {{ $dormManager->employee->contact_no }}</h5>
                                                        @if ($dormManager->employee->sex == 0)
                                                            <h5><i class="fas fa-venus-mars mr-3"></i> Female</h5>
                                                        @elseif($dormManager->employee->sex == 1)
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
                                        Dormitory Images
                                    </div>
                                    <div class="float-right">
                                        <button class="btn btn-success btn-sm" onclick="showUploadPhotoModal()">Upload a new
                                            photo</button>
                                    </div>
                                    {{-- @include('operator.operator_modals.upload_bh_photo_modal') --}}
                                </div>

                                <div class="card-body">
                                    @if ($dormManager->dormitory->dormPhotos->count() == 0)
                                        <div class="text-center">
                                            No Photos Yet.
                                        </div>
                                    @else
                                        <div id="carouselExampleIndicators" class="carousel slide" style="height: 100%;"
                                            data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach ($dormManager->dormitory->dormPhotos as $index => $photo)
                                                    <li data-target="#carouselExampleIndicators"
                                                        data-slide-to="{{ $index }}"
                                                        @if ($index === 0) class="active" @endif></li>
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner" style="height: 100%;">
                                                @foreach ($dormManager->dormitory->dormPhotos as $index => $photo)
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

                                    <form action="{{ route('dormManagerDeleteBhPhoto') }}" method="post"
                                        id="dormManagerDeleteBhPhoto">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="modal-body">
                                                    <span id="confirmationQuestion">Are you sure you want to delete the
                                                        picure?</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="text" id="dormPhotoIdInput" name="dormPhotoIdInput" hidden>
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
            <div class="modal fade" id="uploadDormitoryPhoto" tabindex="-1" role="dialog"
                aria-labelledby="uploadDormitoryPhoto" Label aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Dormitory Photo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <!-- Step 1: Basic Information -->
                            <div class="container-fluid">
                                <form method="POST" action="{{ route('dormManagerUploadBhPhoto') }}"
                                    enctype="multipart/form-data" id="dormManagerUploadBhPhoto">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label for="uploadDormPhoto">Upload a picture here</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="uploadDormPhoto" name="uploadDormPhoto"
                                                            accept="image/png, image/gif, image/jpeg">
                                                        <label class="custom-file-label" for="uploadBhPhoto">Attach Image
                                                            Here...</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" onclick="showConfirmationModal()"
                                        class="btn btn-block btn-success">Upload</button>
                                    <button type="button" data-dismiss="modal"
                                        class="btn btn-block btn-default">Cancel</button>
                                </form>
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
        function deleteBhPhoto(photoId) {
            $('#dormPhotoIdInput').val(photoId);
            $('#deletePhotoConfirmationModal').modal('show');
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

        const dormitoryMaps = @json($dormManager->dormitory);
        const bhLat = dormitoryMaps.latitude;
        const bhLng = dormitoryMaps.longitude;

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
            $('#uploadDormitoryPhoto').modal('show');
        }

        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#dormManagerUploadBhPhoto').submit();
            });
        }
    </script>
@endsection
