@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="text-center mt-2">
                <h4>Register New Dormitory</h4>
            </div>
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                Registration Form
                            </div>

                            <form action="{{ route('osaDormRegistrationForm') }}" method="POST"
                                id="osaDormRegistrationForm">
                                @csrf
                                <div id="osaRegistrationEmpId">
                                    <div class="col-md-12">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="registerEmployeeIdVerification">
                                                        Employee ID of the Dorm Manager</label>
                                                    <div class="input-group">
                                                        <input type="text" name="registerEmployeeIdVerification"
                                                            id="registerEmployeeIdVerification" class="form-control"
                                                            required>
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-success"
                                                                onclick="verifyEmployeeId()">Verify</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="osaRegisterDormForm" hidden>
                                    <div class="col-md-12 mt-3">

                                        <div class="form-row">
                                            <div class="col-md-4">

                                                <div class="text-center">
                                                    <img src="" alt="user-avatar" class="img-circle img-fluid"
                                                        style="width: 150px; height:auto;" id="imageProfileOfTenant">

                                                    <p class="mt-0" id="employeeId"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="text" id="assignEmployeeId" name="assignEmployeeId"
                                                            hidden>

                                                        <div class="form-group">
                                                            <label for="assignEmployeeFullName">Assigned Employee
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                id="assignEmployeeFullName" name="assignEmployeeFullName"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="assignEmployeeSex">Gender</label>
                                                                    <input type="text" class="form-control"
                                                                        id="assignEmployeeSex" name="assignEmployeeSex"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="assignEmployeeContact">Contact</label>
                                                                    <input type="text" class="form-control"
                                                                        id="assignEmployeeContact"
                                                                        name="assignEmployeeContact" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" id="registerDormLat" name="registerDormLat" hidden>
                                        <input type="text" id="registerDormLng" name="registerDormLng" hidden>

                                        <div class="container-fluid">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="osaRegisterNewDormEmail">Email</label>
                                                        <input type="text" id="osaRegisterNewDormEmail"
                                                            name="osaRegisterNewDormEmail" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="osaRegisterNewDormPass">Password</label>
                                                        <input type="password" id="osaRegisterNewDormPass"
                                                            name="osaRegisterNewDormPass" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="osaRegisterNewDormRePass">Re-type Password</label>
                                                        <input type="password" id="osaRegisterNewDormRePass"
                                                            name="osaRegisterNewDormRePass" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Dormitory Name</label>
                                                        <input type="text" id="osaRegisterNewDormName"
                                                            name="osaRegisterNewDormName" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Gender Accepted</label>
                                                        <select name="osaRegisterNewDormGender"
                                                            id="osaRegisterNewDormGender" class="custom-select">
                                                            <option value="" selected>Select sex here</option>
                                                            <option value="0">Female</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Co-ed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-center"><strong>Location</strong></p>
                                            <div id="map" style="height:350px;">

                                            </div>
                                            <button type="button" class="btn btn-success btn-block mt-3"
                                                onclick="showConfirmationModal()">Submit</button>
                                            <button type="button" class="btn btn-default btn-block mt-2">Cancel</button>
                                        </div>




                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
                                        Confirm Adding of Dormitory?
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
                                        id="confirmationButton">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
            $('#confirmationButton').click(function() {
                $('#osaDormRegistrationForm').submit();
            });
        }
    </script>

    <script>
        $('#registerEmployeeIdVerification').keypress(function(event) {
            if (event.which == 13) {
                // Enter key is pressed
                verifyEmployeeId();
            }
        });
    </script>

    <script>
        function map() {
            // Initialize map globally
            var map = L.map('map').setView([7.859314546044553, 125.05152846605058], 16);
            L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                center: [7.859314546044553, 125.05152846605058],
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            // Initialize marker globally
            var greenIcon = L.icon({
                iconUrl: "{{ asset('images/marker_default.png') }}",
                iconSize: [48, 55],
                shadowSize: [50, 64],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            });

            var marker = L.marker([7.859314546044553, 125.05152846605058], {
                icon: greenIcon,
                draggable: true,
            }).addTo(map);

            // Function to update input fields
            function updateInputFields(latlng) {
                document.getElementById('registerDormLat').value = latlng.lat;
                document.getElementById('registerDormLng').value = latlng.lng;
            }

            // Initial update
            updateInputFields(marker.getLatLng());

            // Listen for dragend event on the marker
            marker.on('dragend', function(event) {
                updateInputFields(marker.getLatLng());
            });
        }
    </script>


    <script>
        function verifyEmployeeId() {
            var empId = $('#registerEmployeeIdVerification').val();
            console.log(empId);
            $.ajax({
                url: "{{ route('osaFetchEmployeeIdForRegistration') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    employee_id: empId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == 'Not Found') {
                        alert('Employee Not Found!');
                    } else {
                        console.log(response);
                        var employee = response[0];
                        $('#osaRegistrationEmpId').attr('hidden', 'hidden');
                        $('#osaRegisterDormForm').removeAttr('hidden');

                        $('#assignEmployeeId').val(employee.id);
                        $('#assignEmployeeFullName').val(employee.employeeFullName);
                        $('#assignEmployeeSex').val(employee.sex);
                        $('#assignEmployeeContact').val(employee.contactNo);
                        $('#employeeId').text(employee.empId);


                        if (employee.sex == 'Female') {
                            $('#imageProfileOfTenant').attr('src', "{{ asset('images/female_avatar.svg') }}");
                        } else {
                            $('#imageProfileOfTenant').attr('src', "{{ asset('images/male_avatar.svg') }}");
                        }
                        map();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
