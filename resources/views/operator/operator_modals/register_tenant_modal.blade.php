<style>
    .nav-pills .nav-link.active {
        background-color: white;
        color: #02681e;
        font-weight: bold;
        border-radius: 0%;
        border-bottom: 3px solid #02681e;
        /* Add underline effect */
    }
</style>

<div class="modal fade" id="registerTenantModal" tabindex="-1" role="dialog" aria-labelledby="registerTenantModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register Tenant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <div class="modal-body">
                <div id="searchTenantDiv">
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-6 align-items-center">
                                <div class="form-group text-center">
                                    <label for="studentIdSearchField">Search to verify student</label>
                                    <input type="text" name="studentIdSearchField" id="studentIdSearchField"
                                        class="form-control" placeholder="Input valid student ID number here...">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-default float-right" onclick="verifyStudentId()">Verify</button>
                    </div>
                </div>
                <div id="registerTenantDiv" hidden>
                    <!-- Navigation Panel -->
                    <ul class="nav nav-pills justify-content-center  mb-3" id="pageNav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#page1">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page2">Personal Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page3">Guardian Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page4">Room Assignment</a>
                        </li>

                    </ul>
                    <!-- Step 1: Basic Information -->
                    <div class="container">
                        <div class="container-fluid">
                            <form id="registerNewTenant" method="POST"
                                action="{{ route('operatorRegisterNewTenant') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="page" id="page1">

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="alert alert-danger alert-dismissible mt-3">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">×</button>
                                                <h5><i class="icon fas fa-exclamation-triangle"></i> Student Not
                                                    Found!
                                                </h5>
                                                It seems that the student <span id="warningStudentId"></span> does not
                                                exist on our database. Please
                                                click
                                                next to proceed to registration form.
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-default next-page float-right">Next</button>
                                </div>
                                <div class="page" id="page2" style="display: none;">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center">Basic Information</p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group text-center">
                                                                <label for="tenantStudentId">Student ID
                                                                    Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="studentId" name="studentId" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantIe">Institutional
                                                                    Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="tenantIe" name="tenantIe" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantFirstname">First Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="tenantFirstname" name="tenantFirstname" required
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantMiddlename">Middle Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="tenantMiddlename" name="tenantMiddlename"
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantLastname">Last Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="tenantLastname" name="tenantLastname" required
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantExtname">Ext. Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="tenantExtname" name="tenantExtname"
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="row">


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantContactNo">Contact
                                                                    Number</label>
                                                                <input type="tel" class="form-control"
                                                                    id="tenantContactNo" name="tenantContactNo"
                                                                    pattern="[0-9]{10,11}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tenantSex">Gender</label>
                                                                <select name="tenantSex" id="tenantSex"
                                                                    class="form-control">
                                                                    @if (auth()->user()->employee->operator->boardingHouse->sex_accepted == 0)
                                                                        <option value="" selected>Select
                                                                            Gender
                                                                        </option>
                                                                        <option value="0">Female</option>
                                                                    @elseif(auth()->user()->employee->operator->boardingHouse->sex_accepted == 1)
                                                                        <option value="1">Male</option>
                                                                    @endif


                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">


                                            <p class="text-center">College and Course</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="college">College</label>
                                                        <select name="college" id="college" class="form-control"
                                                            required>
                                                            <option value="" selected>Select College
                                                            </option>
                                                            @foreach ($colleges as $college)
                                                                <option value="{{ $college->id }}">
                                                                    {{ $college->college_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="program">Program</label>
                                                        <select name="program" id="program" class="form-control"
                                                            required>
                                                            <option value="" selected>Select Program
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <br>
                                            <p class="text-center">Permanent Address</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="region">Region</label>
                                                        <select name="region" id="region" class="form-control"
                                                            required>
                                                            <option value="" selected>Select Region
                                                            </option>
                                                            @foreach ($regions as $region)
                                                                <option value="{{ $region->regCode }}">
                                                                    {{ $region->regDesc }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="province">Province</label>
                                                        <select name="province" id="province" class="form-control"
                                                            required>
                                                            <option value="" selected>Select Province
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="city">City/Municipality</label>
                                                        <select name="city" id="city" class="form-control"
                                                            required>
                                                            <option value="" selected>Select
                                                                City/Municipality
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="barangay">Barangay</label>
                                                        <select name="barangay" id="barangay" class="form-control"
                                                            required>
                                                            <option value="" selected>Select Barangay
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="street">Street</label>
                                                <input type="text" class="form-control" id="street"
                                                    name="street" required pattern="[A-Za-z\s]+">
                                            </div>

                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-default next-page float-right">Next</button>
                                    <button type="button"
                                        class="btn btn-default prev-page float-right ">Previous</button>
                                </div>
                                <div class="page" id="page3" style="display: none;">
                                    <!-- Step 2: Additional Details -->
                                    <div class="container-fluid">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianFirstname">First Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="guardianFirstname" name="guardianFirstname"
                                                                    required pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianMiddlename">Middle Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="guardianMiddlename" name="guardianMiddlename"
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianLastname">Last Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="guardianLastname" name="guardianLastname"
                                                                    required pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianExtname">Ext. Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="guardianExtname" name="guardianExtname"
                                                                    pattern="[A-Za-z\s]+">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianContactNo">Contact
                                                                    Number</label>
                                                                <input type="tel" class="form-control"
                                                                    id="guardianContactNo" name="guardianContactNo"
                                                                    required pattern="[0-9]{10,11}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardianSex">Gender</label>
                                                                <select name="guardianSex" id="guardianSex"
                                                                    class="form-control" required>
                                                                    <option value="" selected>Select
                                                                        Gender
                                                                    </option>
                                                                    <option value="0">Female</option>
                                                                    <option value="1">Male</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="guardianOccupation">Occupation</label>
                                                            <input type="text" id="guardianOccupation"
                                                                name="guardianOccupation" class="form-control"
                                                                required pattern="[A-Za-z\s]+">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button"
                                            class="btn btn-default next-page float-right">Next</button>
                                        <button type="button"
                                            class="btn btn-default prev-page float-right ">Previous</button>
                                    </div>
                                </div>
                                <div class="page" id="page4" style="display: none;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group text-center">
                                                            <label for="roomAssignment">Select Room</label>
                                                            <select name="roomAssignment" id="roomAssignment"
                                                                class="form-control" required>
                                                                <option value="" selected>Please select a
                                                                    room to assign
                                                                </option>
                                                                @foreach ($boardingHouseRooms as $room)
                                                                    @php
                                                                        $bhRoomBedCount = $room->number_of_beds;
                                                                        $bhRoomTenantCount = $room->roomStudentTenants
                                                                            ->where('isActive', 1)
                                                                            ->count();
                                                                    @endphp
                                                                    @if ($bhRoomBedCount > $bhRoomTenantCount)
                                                                        <option value="{{ $room->id }}">
                                                                            {{ $room->room_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group text-center">
                                                            <label for="" class="">Room
                                                                information</label>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div id="newTenantDisplayRoomInformation" hidden>
                                                                        <div class="row">
                                                                            <div class="container-fluid">
                                                                                <div class="col-md-12 text-center">
                                                                                    <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                                                    <div
                                                                                        class="d-flex flex-column justify-content-center h-100">
                                                                                        <input type="text" hidden
                                                                                            value=""
                                                                                            id="id"
                                                                                            name="id">
                                                                                        <h2 class="mb-0">
                                                                                            <span
                                                                                                id="newTenantRoomName"></span>
                                                                                        </h2>

                                                                                        <h5 class="mb-1">
                                                                                            <span class="mr-2"><i
                                                                                                    class="fa-solid fa-peso-sign"></i>
                                                                                                <span
                                                                                                    id="newTenantRoomPrice"></span></span>
                                                                                        </h5>
                                                                                        <p class="mb-1"><span
                                                                                                class="mr-2"><i
                                                                                                    class="fa-solid fa-bed"></i></span><span>Vacancy:
                                                                                            </span><span
                                                                                                id="newTenantNumberOfTenants"></span>
                                                                                            / <span
                                                                                                id="newTenantNumberOfBeds"></span>
                                                                                        </p>
                                                                                        <p class="mb-1 mt-3">
                                                                                            Tenants on this room
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-hover table-bordered"
                                                                                id="newTenantsRoomTenantsTable">
                                                                                <thead>

                                                                                    <th>Full name</th>
                                                                                    <th>Course</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>


                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success float-right"
                                            id="submitForm">Submit</button>
                                        <button type="button"
                                            class="btn btn-default prev-page float-right ">Previous</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div id="showExistingTenant" hidden>
                    <ul class="nav nav-pills justify-content-center  mb-3" id="pageNav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#page1">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page2">Personal Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page3">Room Assignment</a>
                        </li>

                    </ul>
                    <form action="{{ route('operatorRegisterExistingTenant') }}" method="post">
                        @csrf
                        <input type="text" id="registerExistingTenantId" name="registerExistingTenantId" hidden>
                        <div class="col-md-12">
                            <div class="page" id="page1">
                                <div class="row">
                                    <div class="text-center">
                                        <div class="alert alert-success alert-dismissible mt-3">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Existing Student Found
                                            </h5>
                                            It seems that the student <span id="successFindStudentId"></span> exists on
                                            our
                                            database. Please click next to proceed to student information and room
                                            assignment form.
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-default next-page float-right">Next</button>
                            </div>
                            <div class="page" id="page2" style="display: none;">

                                <div class="" id="operatorTenantRegistrationErrorAlert" style="display: none;">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <div class="text-center">
                                            <h5><i class="icon fas fa-ban"></i> Oops!</h5>
                                            It seems that this student cannot be registered to your dormitory due
                                            to gender restrictions, currently resididing from other
                                            residence, or is uncleared from previous residence.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-center">


                                                    <img src="" alt="user-avatar"
                                                        class="img-circle img-fluid"
                                                        style="width: 150px; height:auto;"
                                                        id="imageProfileOfTenantRegistration">

                                                    <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                    <div class="d-flex flex-column justify-content-center h-100">


                                                        <h5 class="mt-2"><span id="registerTenantStudentId"></span>
                                                        </h5>
                                                        <p class="mt-2 mb-0"
                                                            style="font-size: 16px; font-weight:bold;"><span
                                                                id="registerTenantCourse">BS in
                                                                Information Technology</span></p>
                                                        <p class="mb-0"><span id="registerTenantCollege">College of
                                                                Information Sciences and Computing</span></p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <h3 class=""><span id="registerTenantFullname"></span>
                                                    </h3>

                                                    <p class="mb-0"><span class="mr-2"><i
                                                                class="fa-solid fa-venus-mars"></i></span><span>
                                                        </span><span id="registerTenantGender"></span></p>
                                                    <p class="mb-0"><span class="mr-2"><i
                                                                class="fa-solid fa-phone"></i></span><span>
                                                        </span><span id="registerTenantContactNo"></span>
                                                    </p>
                                                    <p class="mb-0"><span class="mr-2"><i
                                                                class="fa-solid fa-envelope"></i></span><span>
                                                        </span><span id="registerTenantIe"></span></p>
                                                    <p class="mb-0"><span class="mr-2"><i
                                                                class="fa-solid fa-house"></i></span><span>
                                                        </span><span id="registerTenantAddress"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-center">Tenant History</p>

                                        <table class="table table-hover table-bordered"
                                            id="studentTenantHistoryTable">
                                            <thead>
                                                <tr>
                                                    <th>Boarding House</th>
                                                    <th>Operator</th>
                                                    <th>Date In</th>
                                                    <th>Date Out</th>
                                                    <th>Reason</th>
                                                    <th>Clearance</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="" id="navButtons" style="display: none;">
                                    <div>
                                        <button type="button"
                                            class="btn btn-default next-page float-right">Next</button>
                                        <button type="button"
                                            class="btn btn-default prev-page float-right ">Previous</button>
                                    </div>
                                </div>
                                <div class="" id="closeButtonIfError" style="display: none;">
                                    <button type="button" class="btn btn-default float-right"
                                        data-dismiss="modal">Close</button>
                                </div>

                            </div>
                            <div class="page" id="page3" style="display: none;">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group text-center">
                                                        <label for="existingTenantRoomAssignment">Select Room</label>
                                                        <select name="existingTenantRoomAssignment"
                                                            id="existingTenantRoomAssignment" class="form-control"
                                                            required>
                                                            <option value="" selected>Please select a
                                                                room to assign
                                                            </option>
                                                            @foreach ($boardingHouseRooms as $room)
                                                                @php
                                                                    $bhRoomBedCount = $room->number_of_beds;
                                                                    $bhRoomTenantCount = $room->roomStudentTenants
                                                                        ->where('isActive', 1)
                                                                        ->count();
                                                                @endphp
                                                                @if ($bhRoomBedCount > $bhRoomTenantCount)
                                                                    <option value="{{ $room->id }}">
                                                                        {{ $room->room_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group text-center">
                                                        <label for="" class="">Room
                                                            information</label>
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div id="existingTenantDisplayRoomInformation" hidden>
                                                                    <div class="row">
                                                                        <div class="container-fluid">
                                                                            <div class="col-md-12 text-center">
                                                                                <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                                                <div
                                                                                    class="d-flex flex-column justify-content-center h-100">
                                                                                    <input type="text" hidden
                                                                                        value="" id="id"
                                                                                        name="id">
                                                                                    <h2 class="mb-0">
                                                                                        <span
                                                                                            id="existingTenantRoomName"></span>
                                                                                    </h2>

                                                                                    <h5 class="mb-1">
                                                                                        <span class="mr-2"><i
                                                                                                class="fa-solid fa-peso-sign"></i>
                                                                                            <span
                                                                                                id="existingTenantRoomPrice"></span></span>
                                                                                    </h5>
                                                                                    <p class="mb-1"><span
                                                                                            class="mr-2"><i
                                                                                                class="fa-solid fa-bed"></i></span><span>Vacancy:
                                                                                        </span><span
                                                                                            id="existingTenantNumberOfTenants"></span>
                                                                                        / <span
                                                                                            id="existingTenantNumberOfBeds"></span>
                                                                                    </p>
                                                                                    <p class="mb-1 mt-3">
                                                                                        Tenants on this room
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class="table table-sm table-hover table-bordered"
                                                                            id="existingTenantsRoomTenantsTable">
                                                                            <thead>

                                                                                <th>Full name</th>
                                                                                <th>Course</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>


                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right"
                                        id="submitForm">Submit</button>
                                    <button type="button"
                                        class="btn btn-default prev-page float-right ">Previous</button>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#studentIdSearchField').keypress(function(event) {
        if (event.which == 13) {
            // Enter key is pressed
            verifyStudentId();
        }
    });
    document.getElementById('roomAssignment').addEventListener('change', function() {
        var roomId = this.value; // Get the selected room ID

        // Make an AJAX request to fetch room information
        $.ajax({
            url: "{{ route('operatorFetchRoomsForTenantAssigning') }}",
            type: "POST",
            data: {
                room_id: roomId,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response);

                response.forEach(roomInfo => {

                    $('#newTenantDisplayRoomInformation').removeAttr('hidden');
                    $('#newTenantRoomName').text(roomInfo.roomName);
                    $('#newTenantRoomPrice').text(roomInfo.roomPrice);
                    $('#newTenantNumberOfTenants').text(roomInfo.bhRoomTenantCount);
                    $('#newTenantNumberOfBeds').text(roomInfo.numberOfBeds);



                    if (roomInfo.bhRoomTenants != null && roomInfo.bhRoomTenants > 0) {
                        $('#newTenantsRoomTenantsTable tbody').empty();
                        roomInfo.bhRoomTenants.forEach(tenant => {
                            $('#newTenantsRoomTenantsTable tbody').append(
                                `<tr>
                                <td>${tenant.studentFullname}</td>
                                <td>${tenant.studentCourse}</td>
                            
                        </tr>`
                            );
                        });
                    } else {
                        $('#newTenantsRoomTenantsTable tbody').empty();
                        $('#newTenantsRoomTenantsTable').append(
                            `<tr>
                                <td colspan="2">No tenants on this room yet.</td>
                            </tr>`
                        );
                    }

                });
            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });

    });

    document.getElementById('existingTenantRoomAssignment').addEventListener('change', function() {
        var roomId = this.value; // Get the selected room ID

        // Make an AJAX request to fetch room information
        $.ajax({
            url: "{{ route('operatorFetchRoomsForTenantAssigning') }}",
            type: "POST",
            data: {
                room_id: roomId,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response);

                response.forEach(roomInfo => {

                    $('#existingTenantDisplayRoomInformation').removeAttr('hidden');
                    $('#existingTenantRoomName').text(roomInfo.roomName);
                    $('#existingTenantRoomPrice').text(roomInfo.roomPrice);
                    $('#existingTenantNumberOfTenants').text(roomInfo.bhRoomTenantCount);
                    $('#existingTenantNumberOfBeds').text(roomInfo.numberOfBeds);


                    // Populate table with tenants
                    if (roomInfo.bhRoomTenants != null && roomInfo.bhRoomTenants.length >
                        0) {
                        $('#existingTenantsRoomTenantsTable tbody').empty();
                        roomInfo.bhRoomTenants.forEach(tenant => {
                            $('#existingTenantsRoomTenantsTable tbody').append(
                                `<tr>
                                    <td>${tenant.studentFullname}</td>
                                    <td>${tenant.studentCourse}</td>
                                </tr>`
                            );
                        });
                    } else {
                        $('#existingTenantsRoomTenantsTable tbody').empty();
                        $('#existingTenantsRoomTenantsTable').append(
                            `<tr>
                                <td colspan="2">No tenants on this room yet.</td>
                            </tr>`
                        );
                    }

                });
            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });

    });
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('addNewOrg');
        const pages = document.querySelectorAll('.page');
        const nextPageButtons = document.querySelectorAll('.next-page');
        const prevPageButtons = document.querySelectorAll('.prev-page');

        nextPageButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (validatePage(this.closest('.page'))) {
                    nextPage(this.closest('.page'));
                }
            });
        });

        prevPageButtons.forEach(button => {
            button.addEventListener('click', function() {
                prevPage(this.closest('.page'));
            });
        });

        function nextPage(currentPage) {
            const nextPage = currentPage.nextElementSibling;
            currentPage.style.display = 'none';
            nextPage.style.display = 'block';
            updatePageNav(nextPage.id);
        }

        function prevPage(currentPage) {
            const prevPage = currentPage.previousElementSibling;
            currentPage.style.display = 'none';
            prevPage.style.display = 'block';
            updatePageNav(prevPage.id);
        }

        // Update navigation panel to indicate current page
        function updatePageNav(pageId) {
            const pageNavLinks = document.querySelectorAll('#pageNav .nav-link');
            pageNavLinks.forEach(link => {
                if (link.getAttribute('href').slice(1) === pageId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        function validatePage(page) {
            const inputs = page.querySelectorAll('input[required]');
            const selects = page.querySelectorAll('select[required]');
            let isValid = true;
            inputs.forEach(input => {
                const errorMessageId = input.id + '-error';
                let errorMessage = document.getElementById(errorMessageId);
                if (!input.validity.valid) {
                    if (!errorMessage) {
                        errorMessage = document.createElement('div');
                        errorMessage.id = errorMessageId;
                        errorMessage.className = 'text-danger';
                        if (input.validity.valueMissing) {
                            errorMessage.textContent = 'Please fill out this field.';
                        } else if (input.validity.typeMismatch && input.type === 'email') {
                            errorMessage.textContent = 'Please enter a valid email address.';
                        } else {
                            errorMessage.textContent = 'Please enter a valid value.';
                        }
                        input.parentNode.appendChild(errorMessage);
                    }
                    isValid = false;
                } else {
                    if (errorMessage) {
                        errorMessage.parentNode.removeChild(errorMessage);
                    }
                }
            });
            selects.forEach(select => {
                const errorMessageId = select.id + '-error';
                let errorMessage = document.getElementById(errorMessageId);
                if (!select.validity.valid) {
                    if (!errorMessage) {
                        errorMessage = document.createElement('div');
                        errorMessage.id = errorMessageId;
                        errorMessage.className = 'text-danger';
                        if (select.validity.valueMissing) {
                            errorMessage.textContent = 'Please fill out this field.';
                        } else if (select.validity.typeMismatch && select.type === 'email') {
                            errorMessage.textContent = 'Please enter a valid email address.';
                        } else {
                            errorMessage.textContent = 'Please enter a valid value.';
                        }
                        select.parentNode.appendChild(errorMessage);
                    }
                    isValid = false;
                } else {
                    if (errorMessage) {
                        errorMessage.parentNode.removeChild(errorMessage);
                    }
                }

            });
            return isValid;
        }

        form.addEventListener('submit', function(event) {
            $('#registerNewTenant').submit();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#college').change(function(event) {
            var collegeId = this.value;

            $('#program').html('');

            $.ajax({
                url: "{{ route('operatorApiFetchPrograms') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    college_id: collegeId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#program').html('<option value=""> Select Program </option>');
                    $.each(response.programs, function(index, val) {
                        $('#program').append(
                            '<option value="' + val.id +
                            '"> ' +
                            val.program_name + ' </option>');
                    });

                }
            })
        });



        $('#region').change(function(event) {
            var regionId = this.value;

            $('#province').html('');

            $.ajax({
                url: "{{ route('operatorApiFetchProvinces') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    region_id: regionId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#province').html('<option value=""> Select Province </option>');
                    $.each(response.provinces, function(index, province) {
                        $('#province').append(
                            '<option value="' + province.provCode +
                            '"> ' +
                            province.provDesc + ' </option>');
                    });

                }
            })
        });
        $('#province').change(function(event) {
            var provinceId = this.value;
            $('#city').html('');
            $.ajax({
                url: "{{ route('operatorApiFetchCities') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    province_id: provinceId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#city').html(
                        '<option value=""> Select City/Municipality </option>');
                    $.each(response.cities, function(index, city) {
                        $('#city').append(
                            '<option value="' + city.citymunCode +
                            '"> ' +
                            city.citymunDesc + ' </option>');
                    });

                }
            })
        });
        $('#city').change(function(event) {
            var cityId = this.value;
            $('#barangay').html('');
            $.ajax({
                url: "{{ route('operatorApiFetchBarangays') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    city_id: cityId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#barangay').html('<option value=""> Select Barangay </option>');
                    $.each(response.barangays, function(index, brgy) {
                        $('#barangay').append(
                            '<option value="' + brgy.brgyCode +
                            '"> ' +
                            brgy.brgyDesc + ' </option>');
                    });

                }
            })
        });
    });
</script>


<script>
    function verifyStudentId() {
        var searchStudentId = $('#studentIdSearchField').val();

        $.ajax({
            url: "{{ route('operatorFetchStudentTenants') }}",
            type: "POST",
            data: {
                studentId: searchStudentId,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.status == 'Not Found') {
                    console.log('Not Found');
                    $('#registerTenantDiv').removeAttr('hidden');
                    $('#warningStudentId').text($('#studentIdSearchField').val());
                    $('#searchTenantDiv').attr('hidden', 'hidden');
                    $('#studentId').val($('#studentIdSearchField').val())
                } else {
                    console.log(response);
                    $('#searchTenantDiv').attr('hidden', 'hidden');
                    $('#showExistingTenant').removeAttr('hidden');
                    $('#successFindStudentId').text($('#studentIdSearchField').val());
                    $('#registerTenantFullname').text(response.tenantFullname);
                    $('#registerTenantStudentId').text(response.tenantStudentId);
                    $('#registerTenantGender').text(response.tenantSex);
                    $('#registerTenantContactNo').text(response.tenantContactNo);
                    $('#registerTenantIe').text(response.tenantIe);
                    $('#registerTenantAddress').text(response.tenantAddress);
                    $('#registerExistingTenantId').val(response.tenantId);
                    if (response.tenantSex == 'Male') {
                        $('#imageProfileOfTenantRegistration').attr('src',
                            "{{ asset('images/male_avatar.svg') }}");
                    } else if (response.tenantSex == 'Female') {
                        $('#imageProfileOfTenantRegistration').attr('src',
                            "{{ asset('images/female_avatar.svg') }}");
                    } else {
                        $('#imageProfileOfTenantRegistration').attr('src', "");
                    }

                    if (response.tenantExist == true || response.sexId !==
                        {{ auth()->user()->employee->operator->boardingHouse->sex_accepted }} || response
                        .tenantUncleared == true) {
                        document.getElementById('operatorTenantRegistrationErrorAlert').style.display =
                            'block';
                        document.getElementById('closeButtonIfError').style.display = 'block';
                        document.getElementById('navButtons').style.display = 'none';
                    } else {
                        document.getElementById('operatorTenantRegistrationErrorAlert').style.display =
                            'none';
                        document.getElementById('closeButtonIfError').style.display = 'none';
                        document.getElementById('navButtons').style.display = 'block';
                    }

                    // if (response.sexId ===
                    //     {{ auth()->user()->employee->operator->boardingHouse->sex_accepted }}) {

                    //     document.getElementById('operatorRegisterExistingTenantGenderError').style.display =
                    //         'none';
                    //     document.getElementById('closeButtonIfError').style.display = 'none';
                    //     document.getElementById('navButtons').style.display = 'block';
                    // } else {
                    //     document.getElementById('operatorRegisterExistingTenantGenderError').style.display =
                    //         'block';
                    //     document.getElementById('closeButtonIfError').style.display = 'block';
                    //     document.getElementById('navButtons').style.display = 'none';
                    // }



                    if (response.tenantHistory.length > 0) {
                        var tableBody = $('#studentTenantHistoryTable tbody')
                            .empty(); // Select the table body
                        response.tenantHistory.forEach(history => {
                            $('#studentTenantHistoryTable tbody').append(
                                `<tr>
                    <td>${history.bhName}</td>
                    <td>${history.bhOperatorName}</td>  
                    <td>${history.dateIn}</td>  
                    <td>${history.dateOut}</td>  
                    <td>${history.reason}</td>  
                    <td>${history.clearanceStatus}</td>  
                </tr>`
                            );
                        });
                    } else {
                        var tableBody = $('#studentTenantHistoryTable tbody')
                            .empty();
                        $('#studentTenantHistoryTable').append(
                            `<tr>
                                <td colspan="5" class="text-center">No history yet.</td>   
                            </tr>`
                        );
                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
            }
        });
    }
</script>
