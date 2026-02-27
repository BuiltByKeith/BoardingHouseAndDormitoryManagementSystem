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
                        <div class="form-inline">
                            <select name="semesterId" id="semesterId" class="form-control">
                                <option value="" selected>Current Semester</option>
                            </select>
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
                    <table id="studentOrgListTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Program</th>
                                <th>Room</th>
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

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            // Initialize the DataTable
            $('#studentOrgListTable').DataTable({
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
            }).buttons().container().appendTo('#studentOrgListTable_wrapper .col-md-6:eq(0)');
            // Call the function to fetch and populate data in the table
            refreshParticularTable();

            // Trigger to open the Add Organization Modal
            document.getElementById('addOrganizationButton').addEventListener('click', function() {
                $('#addOrganizationModal').modal('show');
            });

            // Trigger to open the Update Status Modal
            $('#disableAllOrgButton').click(function() {
                $('#disableAllOrgModal').modal('show');
            });


            // Open the confirmation modal when the "Update" button is clicked
            $('#openConfirmationModal').click(function() {
                $('#confirmationModal').modal('show');
            });

            // Submit the form if the confirmation is confirmed
            $('#confirmUpdate').click(function() {
                $('#updateAllStudentOrg').submit();
            });


            function refreshParticularTable() {
                $.ajax({
                    url: "{{ route('osaStudentOrgsList') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var table = $('#studentOrgListTable').DataTable();
                        var existingRows = table.rows().remove().draw(false);

                        data.forEach(function(studentOrgs, index) {
                            var type = '';
                            if (studentOrgs.type_of_org_id == 1) {
                                type = 'University Wide'
                            } else if (studentOrgs.type_of_org_id == 2) {
                                type = 'College Council'
                            } else if (studentOrgs.type_of_org_id == 3) {
                                type = 'Class'
                            } else if (studentOrgs.type_of_org_id == 4) {
                                type = 'Non-Class'
                            } else if (studentOrgs.type_of_org_id == 5) {
                                type = 'Greek'
                            } else {
                                type = ''
                            }

                            var status = '';
                            if (studentOrgs.registration_status == 0) {
                                status = 'Disabled'
                            } else if (studentOrgs.registration_status == 1) {
                                status = 'Enabled'
                            } else {
                                status = '';
                            }

                            var newRow = table.row.add([
                                studentOrgs.organization_name,
                                studentOrgs.accreditation_no,
                                type,
                                status,

                                `<a href="osa-organization-profile/` + studentOrgs.id +
                                `"><button type="button" class="btn btn-sm btn-success"><i class="fas fa-user"></i></button></a>`

                            ]).node();
                        });
                        table.draw();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script> --}}
@endsection
