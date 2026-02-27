@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-door-open mr-2"></i>Rooms</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <ol class="breadcrumb float-right">
                        <div class="form-inline ml-2">
                            <button onclick="showAddRoomModal()" class="btn btn-block btn-success">Add Room</button>
                        </div>
                        @include('operator.operator_modals.add_new_room_modal')
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="roomCardsContainer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('operator.operator_modals.room_details_modal')


    <script>
        function showAddRoomModal() {
            $('#addNewRoomModal').modal('show');
        }

        function openRoomTenantInfoModal(id, idNumber, firstName, middleName, lastName, program, college, sex,
            contactNo, address) {
            $('#roomTenantFirstName').text(firstName);
            $('#roomTenantMiddleName').text(middleName);
            $('#roomTenantLastName').text(lastName);
            $('#roomTenantIdNumber').text(idNumber);
            $('#roomTenantCollege').text(college);
            $('#roomTenantCourse').text(program);
            $('#roomTenantSex').text(sex);
            $('#roomTenantContact').text(contactNo);
            $('#roomTenantAddress').text(address);
            $('#tenantInformationModal').modal('show');
        }

        function showRoomDetailsModal(id, roomName, roomPrice, numberOfBeds) {
            console.log(roomName);
            $('#infoRoomName').text(roomName);
            $('#infoRoomPrice').text(roomPrice);
            $('#infoNumberOfBeds').text(numberOfBeds);
            $('#tableNameOfRoom').text(roomName);
            $.ajax({
                url: "{{ route('operatorFetchTenantsOnRoom') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    room_id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    $('#tenantOnRoomTable tbody').empty();
                    data.forEach(tenant => {
                        $('#tenantOnRoomTable tbody').append(
                            `<tr>
                                <td>${tenant.tenantFullname}</td>
                                <td>${tenant.tenantCourse}</td>
                                <td><button class="btn btn-sm btn-success" onclick="openRoomTenantInfoModal('${tenant.id}',
                                     '${tenant.tenantStudentIdNo}', 
                                     '${tenant.tenantFirstname}', 
                                     '${tenant.tenantMiddlename}', 
                                     '${tenant.tenantLastname}', 
                                     '${tenant.tenantCourse}', 
                                     '${tenant.tenantCollege}', 
                                     '${tenant.tenantSex}', 
                                     '${tenant.tenantContactNo}', 
                                     '${tenant.tenantAddress}')"><i class="fas fa-user"></i></button></td>
                            </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
            $('#bhRoomEditId').val(id);
            $('#roomDetailsModal').modal('show');
            $('#operatorRoomEditId').val(id);
        }

        function refreshBoardingHouseRooms() {
            $.ajax({
                url: "{{ route('operatorFetchBhRooms') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    data.forEach(function(roomDetails) {
                        var roomCardHTML = `
                            <div class="col-md-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>${roomDetails.roomName}</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fas fa-door-open"></i>
                                    </div>
                                    <a href="#" class="small-box-footer" onclick="showRoomDetailsModal('${roomDetails.id}', '${roomDetails.roomName}', '${roomDetails.roomPrice}', '${roomDetails.numberOfBeds}')">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>`;
                        // Append the room card HTML to a container div
                        $('#roomCardsContainer').append(roomCardHTML);
                    });




                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
        }


        $(document).ready(function() {
            refreshBoardingHouseRooms();
        });
    </script>
@endsection
