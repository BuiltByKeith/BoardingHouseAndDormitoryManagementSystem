@extends('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-users mr-2"></i>Tenant List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <ol class="breadcrumb float-right">
                        <div class="input-group-prepend">
                            <select class="custom-select mr-2" id="semesterId" name="semesterId">
                                <option value="{{ $currentSemester->id }}" selected>{{ $currentSemester->description }}
                                    {{ $currentSemester->acadYear->description }}
                                </option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->description }}
                                        {{ $semester->acadYear->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-inline ml-2">
                            <button data-toggle="modal" type="button" data-toggle="modal" id="addTenantButton"
                                class="btn btn-block btn-success">Register Tenant</button>
                        </div>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="dormitoryTenantList" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Program</th>
                                <th>Room</th>
                                <th>Clearance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @include('dorm_manager.dorm_manager_modals.dorm_manager_add_tenant_modal')

    <div class="modal fade" id="dormManagerRemoveTenantModal" tabindex="-1" role="dialog"
        aria-labelledby="dormManagerRemoveTenantModal" Label aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Tenant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">

                    <!-- Step 1: Basic Information -->
                    <div class="container-fluid">
                        <form method="POST" action="{{ route('dormManagerRemoveTenant') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="dormManagerTenantId" name="dormManagerTenantId" hidden>
                                    <div class="form-group">
                                        <label for="dormManagerReasonForRemoveTenant">Reason for removing</label>
                                        <select name="dormManagerReasonForRemoveTenant"
                                            id="dormManagerReasonForRemoveTenant" class="custom-select" required>
                                            <option value="" selected>Select reason here ...</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Graduated">Graduated</option>
                                            <option value="Leave of Absence">Leave of Absence</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Comment</label>
                                        <textarea name="dormManagerCommentForRemoveTenant" id="dormManagerCommentForRemoveTenant" rows="3"
                                            class="form-control" placeholder="State your comment for this tenant here ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-danger">Remove</button>
                            <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function showRemoveTenantModal(dormTenantId) {
            $('#dormManagerTenantId').val(dormTenantId);
            $('#dormManagerRemoveTenantModal').modal('show');
        }
    </script>


    <script>
        function refreshDormTenantListTable(semesterId) {
            showLoadingIndicator();
            console.log(semesterId);
            $.ajax({
                url: "{{ route('dormManagerFetchTenantList') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    semester_id: semesterId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    hideLoadingIndicator();
                    console.log(data);
                    var table = $('#dormitoryTenantList').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(dormitoryTenants) {
                        table.row.add([
                            dormitoryTenants.studentId,
                            dormitoryTenants.studentFullName,
                            dormitoryTenants.studentProgram,
                            dormitoryTenants.dormRoomTenantRoom,
                            createToggleSwitch(dormitoryTenants.dormRoomTenantId,
                                dormitoryTenants
                                .statusId),
                            '<a href="dorm-mananger-tenant-profile/' + dormitoryTenants
                            .dormRoomTenantId +
                            '"><button class="btn btn-sm btn-success"><i class="fas fa-user"></i></button></a> ' +
                            '<button class="btn btn-sm btn-danger" onclick="showRemoveTenantModal(' +
                            dormitoryTenants.dormRoomTenantId +
                            ')"><i class="fas fa-right-from-bracket"></i></button>'
                        ]);
                    });

                    table.draw(); // Redraw table
                },
                error: function(xhr, status, error) {
                    hideLoadingIndicator();
                    console.error(xhr.responseText);
                }
            });
        }

        function createToggleSwitch(dormRoomTenantId, tenantStatus) {
            var defaultChecked = tenantStatus == 1 ? 'checked' :
                ''; // If tenant status is 1, set the toggle switch to 'checked'

            return `
        <form action="{{ route('dormManagerUpdateBhRoomTenantClearanceStatus') }}" method="POST" id="dormManagerUpdateBhRoomTenantClearanceStatus"> 
            @csrf
            <input type="hidden" id="dormRoomTenantIdInput" name="dormRoomTenantIdInput" value="${dormRoomTenantId}">
            <input type="hidden" id="dormRoomTenantToggleValueInput" name="dormRoomTenantToggleValueInput" value="${tenantStatus}">
            <div class="form-group text-center">
                <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input tenant-toggle-switch" id="operatorToggleClearanceStatusUpdate${dormRoomTenantId}" name="tenant_toggle[]" data-student-id="${dormRoomTenantId}" onchange="submitUpdateClearanceStatus(this)" ${defaultChecked}>
                    <label class="custom-control-label" for="operatorToggleClearanceStatusUpdate${dormRoomTenantId}"></label>
                </div>
            </div>
        </form>
    `;
        }

        function submitUpdateClearanceStatus(checkbox) {
            var dormRoomTenantId = $(checkbox).data('student-id');
            var toggleValue = $(checkbox).is(':checked') ? 1 : 0;

            // Now you have studentIdNumber and toggleValue
            console.log('Student Tenant ID: ' + dormRoomTenantId);
            console.log('Toggle Value: ' + toggleValue);

            $('#dormRoomTenantIdInput').val(dormRoomTenantId);
            $('#dormRoomTenantToggleValueInput').val(toggleValue);

            $('#dormManagerUpdateBhRoomTenantClearanceStatus').submit();

        }

        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        // Function to hide loading indicator
        function hideLoadingIndicator() {
            setTimeout(function() {
                $('#loadingIndicator').hide();
            }, 1000);
        }


        $('#addTenantButton').click(function() {
            $('#registerTenantModal').modal('show');
        });



        $(document).ready(function() {

            var semesterId = $('#semesterId').val();


            // Initialize the DataTable
            $('#dormitoryTenantList').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 8,
                buttons: ['copy', 'print', 'pdf', 'colvis'],
            }).buttons().container().appendTo('#dormitoryTenantList_wrapper .col-md-6:eq(0)');


            // Call the function to fetch and populate data in the table
            refreshDormTenantListTable(semesterId);

            $('#semesterId').change(function() {
                var semId = $(this).val();
                refreshDormTenantListTable(semId);
            });

        });
    </script>
@endsection
