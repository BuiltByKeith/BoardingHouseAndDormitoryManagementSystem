@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1><i class="fa-solid fa-file mr-2"></i>Registration Request Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-2 mt-2">
                    <ol class="breadcrumb justify-content-center">

                        <li class="breadcrumb-item active">
                            @if ($registrationReqDetails->status == 0)
                                <strong style="color: #ffc600">PENDING</strong>
                            @elseif ($registrationReqDetails->status == 1)
                                <strong style="color: #02681e">ACCEPTED</strong>
                            @elseif ($registrationReqDetails->status == 2)
                                <strong style="color: red">REJECTED</strong>
                            @endif
                        </li>
                    </ol>
                </div>
                <div class="col-sm-2 mt-2">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item active">
                            <strong>{{ $registrationReqDetails->created_at->format('F d, Y') }}</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-2 mt-2">
                    <ol class="breadcrumb float-sm-right">

                        <button class="btn btn-success" onclick="openUpdateStatusModal()">Update</button>
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
                                    @if ($registrationReqDetails->employee->sex == 0)
                                        <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                            class="img-circle img-fluid" style="width: 175px; height:auto;"
                                            id="imageProfileOfTenant">
                                    @elseif ($registrationReqDetails->employee->sex == 1)
                                        <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                            class="img-circle img-fluid" style="width: 175px; height:auto;"
                                            id="imageProfileOfTenant">
                                    @endif
                                    <h5 class="mt-2">
                                        {{ $registrationReqDetails->employee->firstname . ' ' . $registrationReqDetails->employee->middlename . ' ' . $registrationReqDetails->employee->lastname }}
                                    </h5>
                                    <p class="mt-0">{{ $registrationReqDetails->employee->employee_id }}</p>
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
                                            <h2>{{ $registrationReqDetails->boarding_house_name }}</h2>
                                            <div class="" style="font-size: 16px;">

                                                @if ($registrationReqDetails->sex_accepted == 0)
                                                    <p><i class="fas fa-venus-mars mr-2"></i> Accepts: Female Boarders</p>
                                                @elseif ($registrationReqDetails->sex_accepted == 1)
                                                    <p><i class="fas fa-venus-mars mr-2"></i> Accepts: Male Boarders</p>
                                                @endif
                                                @if ($registrationReqDetails->lodging_type == 1)
                                                    <p><i class="fas fa-bed mr-2"></i> Bed Spacer</p>
                                                @elseif ($registrationReqDetails->lodging_type == 2)
                                                    <p><i class="fas fa-bed mr-2"></i> Pad</p>
                                                @endif
                                                <p><i class="fas fa-map mr-2"></i>
                                                    {{ $registrationReqDetails->complete_address }}</p>
                                                <p><i class="fas fa-map mr-2"></i>
                                                    {{ $registrationReqDetails->classification }}</p>
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
                        @foreach ($registrationReqDetails->documents as $formDetail)
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

    <div class="modal fade" id="updateRegistrationRequestStatus" tabindex="-1" role="dialog"
        aria-labelledby="updateRegistrationRequestStatus" Label aria-hidden="true">
        <div class="modal-dialog modal-md" id="modalSize">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">

                    <!-- Step 1: Basic Information -->
                    <div class="container-fluid">
                        <form method="POST" action="{{ route('uhrcUpdateEmployeeRegistrationRequest') }}"
                            enctype="multipart/form-data" id="uhrcUpdateEmployeeRegistrationRequest">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12" id="columnSizeChange">
                                            <div class="form-group">
                                                <label for="documentName">Update Status</label>
                                                <select name="updateRegistrationRequestStatusSelect"
                                                    id="updateRegistrationRequestStatusSelect" class="custom-select">
                                                    @if ($registrationReqDetails->status == 0)
                                                        <option value="0">Pending</option>
                                                    @elseif($registrationReqDetails->status == 1)
                                                        <option value="1">Approv</option>
                                                    @elseif($registrationReqDetails->status == 2)
                                                        <option value="2">Reject</option>
                                                    @endif
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approve</option>
                                                    <option value="2">Reject</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="registrationFormDiv" hidden>
                                        <div class="text-center mt-3">
                                            Register Boarding House Operator
                                        </div>

                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="text-center">
                                                            @if ($registrationReqDetails->employee->sex == 0)
                                                                <img src="{{ asset('images/female_avatar.svg') }}"
                                                                    alt="user-avatar" class="img-circle img-fluid"
                                                                    style="width: 150px; height:auto;"
                                                                    id="imageProfileOfTenant">
                                                            @elseif ($registrationReqDetails->employee->sex == 1)
                                                                <img src="{{ asset('images/male_avatar.svg') }}"
                                                                    alt="user-avatar" class="img-circle img-fluid"
                                                                    style="width: 150px; height:auto;"
                                                                    id="imageProfileOfTenant">
                                                            @endif
                                                            <h5 class="mt-2">
                                                                {{ $registrationReqDetails->employee->firstname . ' ' . $registrationReqDetails->employee->middlename . ' ' . $registrationReqDetails->employee->lastname }}
                                                            </h5>
                                                            <p class="mt-0">
                                                                {{ $registrationReqDetails->employee->employee_id }}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <input type="text" id="approveRegistrationEmpId"
                                                                name="approveRegistrationEmpId" hidden
                                                                value="{{ $registrationReqDetails->employee->id }}">
                                                            <input type="text" id="approveRegistrationAppId"
                                                                name="approveRegistrationAppId" hidden
                                                                value="{{ $registrationReqDetails->id }}">
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Boarding House Name</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->boarding_house_name }}"
                                                                            disabled>
                                                                        <input type="text" hidden
                                                                            id="approveRegistrationBhName"
                                                                            name="approveRegistrationBhName"
                                                                            value="{{ $registrationReqDetails->boarding_house_name }}">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-row mt-0">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Gender Accepted</label>
                                                                        @if ($registrationReqDetails->sex_accepted == 0)
                                                                            <input type="text" class="form-control"
                                                                                value="Female" disabled>
                                                                            <input type="text" hidden
                                                                                id="approveRegistrationBhSex"
                                                                                name="approveRegistrationBhSex"
                                                                                value="0">
                                                                        @elseif ($registrationReqDetails->sex_accepted == 1)
                                                                            <input type="text" class="form-control"
                                                                                value="Male" disabled>
                                                                            <input type="text" hidden
                                                                                id="approveRegistrationBhSex"
                                                                                name="approveRegistrationBhSex"
                                                                                value="1">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Lodging Type</label>
                                                                        @if ($registrationReqDetails->lodging_type == 1)
                                                                            <input type="text" class="form-control"
                                                                                value="Bed Spacer" disabled>
                                                                            <input id="approveRegistrationBhType"
                                                                                name="approveRegistrationBhType"
                                                                                type="text" class="form-control"
                                                                                value="1" hidden>
                                                                        @elseif ($registrationReqDetails->lodging_type == 2)
                                                                            <input type="text" class="form-control"
                                                                                value="Pad" disabled>
                                                                            <input id="approveRegistrationBhType"
                                                                                name="approveRegistrationBhType"
                                                                                type="text" class="form-control"
                                                                                value="2" hidden>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Classification</label>
                                                                        <input id="approveRegistrationBhClass"
                                                                            name="approveRegistrationBhClass"
                                                                            type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->classification }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mt-0">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Latitude</label>

                                                                        <input type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->latitude }}"
                                                                            disabled>
                                                                        <input id="approveRegistrationBhLat"
                                                                            name="approveRegistrationBhLat" type="text"
                                                                            class="form-control"
                                                                            value="{{ $registrationReqDetails->latitude }}"
                                                                            hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Longitude</label>

                                                                        <input type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->longitude }}"
                                                                            disabled>
                                                                        <input id="approveRegistrationBhLng"
                                                                            name="approveRegistrationBhLng" type="text"
                                                                            class="form-control"
                                                                            value="{{ $registrationReqDetails->longitude }}"
                                                                            hidden>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">
                                                                            Complete Address
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->complete_address }}"
                                                                            disabled>
                                                                        <input id="approveRegistrationBhAddress"
                                                                            name="approveRegistrationBhAddress"
                                                                            type="text" class="form-control"
                                                                            value="{{ $registrationReqDetails->complete_address }}"
                                                                            hidden>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="" id="rejectRegistrationDiv" hidden>

                                        <div class="form-group">
                                            <label for="Comment">Comment</label>
                                            <textarea name="rejectRegistrationRequestComment" id="rejectRegistrationRequestComment" rows="3"
                                                class="form-control" placeholder="Please state the reason here on why you rejected the request..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="showConfirmationModal('submitConfirm')"
                                class="btn btn-block btn-success">Submit</button>
                            <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModal"
        Label aria-hidden="true">
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
                                        Confirm Profile Edit?
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
                                        id="confirmPayment">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showConfirmationModal(action) {
            $('#confirmationModal').modal('show');
            $('#confirmPayment').click(function() {
                $('#uhrcUpdateEmployeeRegistrationRequest').submit();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Event listener for select element
            $('#updateRegistrationRequestStatusSelect').change(function() {
                // Check if the selected value is "Approve"
                if ($(this).val() === "1") {
                    // Change modal size to xl
                    $('#registrationFormDiv').removeAttr('hidden');
                    $('#modalSize').removeClass('modal-dialog modal-md').addClass('modal-dialog modal-lg');
                    $('#columnSizeChange').removeClass('col-md-12').addClass('col-md-8');

                } else {
                    // If the selected value is not "Approve", revert modal size to md and hide the specific div
                    $('#registrationFormDiv').attr('hidden', 'hidden');
                    $('#modalSize').removeClass('modal-dialog modal-lg').addClass('modal-dialog modal-md');
                    $('#columnSizeChange').removeClass('col-md-8').addClass('col-md-12');
                }

                if ($(this).val() === "2") {
                    // Change modal size to xl
                    $('#rejectRegistrationDiv').removeAttr('hidden');


                } else {
                    // If the selected value is not "Approve", revert modal size to md and hide the specific div
                    $('#rejectRegistrationDiv').attr('hidden', 'hidden');

                }
            });
        });

        // Function to show modal
        function openUpdateStatusModal() {
            $('#updateRegistrationRequestStatus').modal('show');
        }
    </script>



    <script>
        const boardingHouseLat = @json($registrationReqDetails->latitude);
        const boardingHouseLng = @json($registrationReqDetails->longitude);

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
