<div class="modal fade" id="roomDetailsModal" tabindex="-1" role="dialog" aria-labelledby="roomDetailsModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Room Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="col-md-12 text-center">
                                                <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                <div class="d-flex flex-column justify-content-center h-100">
                                                    <input type="text" hidden value="" id="id"
                                                        name="id">
                                                    <h2 class="mb-0"><span id="infoRoomName"></span>
                                                    </h2>

                                                    <h5 class="mb-1"><span class="mr-2"><i
                                                                class="fa-solid fa-peso-sign"></i></span> <span
                                                            id="infoRoomPrice"></span>
                                                    </h5>
                                                    <p class="mb-1"><span class="mr-2"><i
                                                                class="fa-solid fa-bed"></i></span><span>Number
                                                            of Beds:
                                                        </span><span id="infoNumberOfBeds"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" id="bhRoomEditId" name="bhRoomEditId" hidden>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button class="btn btn-sm btn-success" id="openEditTenantModalButton"
                                            onclick="openEditTenantModal($('#bhRoomEditId').val())">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">


                            <p class="text-center">Tenants of <span id="tableNameOfRoom"></span></p>

                            <table id="tenantOnRoomTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr>

                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <button type="button" class="btn btn-default btn-block" onclick=""
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tenantInformationModal" tabindex="-1" role="dialog"
    aria-labelledby="tenantInformationModal" Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tenant Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                            <div class="d-flex flex-column justify-content-center h-100">
                                                <input type="text" hidden value="" id="id"
                                                    name="id">
                                                <h2 class="mb-0"><span id="roomTenantFirstName"></span> <span
                                                        id="roomTenantMiddleName"></span> <span
                                                        id="roomTenantLastName"></span>
                                                    <span id="roomTenantExtName"></span>
                                                </h2>

                                                <h5 id="roomTenantIdNumber" class="mb-1"><span class="mr-2"><i
                                                            class="fa-solid fa-user"></i></span></h5>
                                                <p class="mb-1"><span class="mr-2"><i
                                                            class="fa-solid fa-school"></i></span><span
                                                        id="roomTenantCollege"></span>, <span
                                                        id="roomTenantCourse"></span></p>
                                                <p class="mb-1"><span class="mr-2"><i
                                                            class="fa-solid fa-venus-mars"></i></span><span
                                                        id="roomTenantSex"></span></p>
                                                <p class="mb-1"><span class="mr-2"><i
                                                            class="fa-solid fa-phone"></i></span>
                                                    <span id="roomTenantContact"></span>
                                                </p>
                                                <p class="mb-1"><span class="mr-2"><i
                                                            class="fa-solid fa-home"></i></span>
                                                    <span id="roomTenantAddress"></span>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editRoomDetailModal" tabindex="-1" role="dialog"
    aria-labelledby="editRoomDetailModal" Label aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Room Details</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('operatorUpdateRoomDetail') }}" method="POST"
                        enctype="multipart/form-data" id="updateRoomDetailForm">
                        @csrf
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="operatorRoomEditId" name="operatorRoomEditId"
                                            hidden>
                                        <div class="form-group">
                                            <label for="operatorEditRoomName">Room Name</label>
                                            <input type="text" id="operatorEditRoomName"
                                                name="operatorEditRoomName" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="operatorEditRoomNoOfBeds">Number of Beds</label>
                                            <input type="number" id="operatorEditRoomNoOfBeds"
                                                name="operatorEditRoomNoOfBeds" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="operatorEditRoomPrice">Room Price</label>
                                            <input type="number" id="operatorEditRoomPrice"
                                                name="operatorEditRoomPrice" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="text-center mb-2">Price History</div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover table-bordered"
                                                id="editRoomInfoRoomPriceHistoryTable">
                                                <thead>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-block btn-success"
                                        onclick="openConfirmationModal()">Update</button>
                                    <button type="button" data-dismiss="modal"
                                        class="btn btn-block btn-default">Close</button>
                                </div>
                            </div>
                        </div>
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
                                    <span id="confirmationQuestion">Are you sure you want to edit the room details?</span>
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

<script>
    function openConfirmationModal() {
        $('#confirmationModal').modal('show');
        $('#confirmButton').click(function() {
            $('#updateRoomDetailForm').submit();
        });
    }
</script>

<script>
    function openEditTenantModal(id) {
        console.log(id);
        $.ajax({
            url: "{{ route('operatorFetchRoomDetailsForEditing') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                room_id: id,
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log(data);
                var roomInfo = data[0];

                $('#operatorEditRoomName').val(roomInfo.roomName);
                $('#operatorEditRoomNoOfBeds').val(roomInfo.numberOfBeds);
                $('#operatorEditRoomPrice').val(roomInfo.currentPrice);

                if (roomInfo.roomPriceHistory != null && roomInfo.roomPriceHistory.length > 0) {
                    var tableBody = $('#editRoomInfoRoomPriceHistoryTable tbody').empty();
                    roomInfo.roomPriceHistory.forEach(price => {
                        $('#editRoomInfoRoomPriceHistoryTable tbody').append(
                            `<tr>
                                <td>${price.amount}</td>  
                                <td>${price.status}</td>  
                                <td>${price.dateStart}</td>  
                                <td>${price.dateEnd}</td>  
                            </tr>`
                        );
                    });
                } else {
                    var tableBody = $('#editRoomInfoRoomPriceHistoryTable tbody').empty();
                    $('#editRoomInfoRoomPriceHistoryTable tbody').append(
                        `<tr>
                                <td colspan="4" class="text-center">No history yet.</td>      
                            </tr>`
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
        $('#editRoomDetailModal').modal('show');
    }

    function openTenantInfoModal(id, studentId, firstname, middlename, lastname, extname, program, college, sex,
        contact,
        address) {

        $('#tenantFirstName').text(firstname);
        $('#tenantMiddleName').text(middlename);
        $('#tenantLastName').text(lastname);
        if (extname == null) {
            $('#tenantExtName').text('');
        }
        $('#tenantIdNumber').text(studentId);
        $('#tenantCollege').text(college);
        $('#tenantCourse').text(program);
        $('#tenantContact').text(contact);
        if (sex == 0) {
            $('#tenantSex').text('Female');
        } else if (sex == 1) {
            $('#tenantSex').text('Male');
        } else {
            $('#tenantSex').text('');
        }

        $('#tenantAddress').text(address);
        $('#tenantInformationModal').modal('show');

    }
</script>
