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
                        @include('dorm_manager.dorm_manager_modals.dorm_manager_add_room_modal')
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="dormRoomCardsContainer">

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dorm_manager.dorm_manager_modals.dorm_manager_room_details_modal')

    <script>
        function showAddRoomModal() {
            $('#dormManagerAddNewRoomModal').modal('show');
        }

        function showDormRoomDetailsModal(id, roomName, roomPrice, numberOfBeds) {
            console.log(id);
            $('#dormRoomNameInfo').text(roomName);
            $('#dormRoomPriceInfo').text(roomPrice);
            $('#dormRoomNoOfBedsInfo').text(numberOfBeds);
            $('#dormRoomNameForTenantTable').text(roomName);
            $.ajax({
                url: "{{ route('dormManagerFetchDormRoomTenants') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    room_id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {

                    console.log(data);
                    $('#dormRoomTenantsTable tbody').empty();
                    data.forEach(tenant => {
                        $('#dormRoomTenantsTable tbody').append(
                            `<tr>
                        <td>${tenant.tenantStudentIdNo}</td>
                        <td>${tenant.tenantFullname}</td>
                        <td>${tenant.tenantCourse}</td>
                    </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
            $('#dormRoomDetailsModal').modal('show');
            $('#dormRoomEditId').val(id);
        }

        function refreshDormitoryRooms() {
            $.ajax({
                url: "{{ route('dormManagerFetchDormRooms') }}",
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
                                    <a href="#" class="small-box-footer" onclick="showDormRoomDetailsModal('${roomDetails.id}', '${roomDetails.roomName}', '${roomDetails.roomPrice}', '${roomDetails.numberOfBeds}')">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>`;
                        // Append the room card HTML to a container div
                        $('#dormRoomCardsContainer').append(roomCardHTML);
                    });




                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
        }


        $(document).ready(function() {
            refreshDormitoryRooms();
        });
    </script>
@endsection
