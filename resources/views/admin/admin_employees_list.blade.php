@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-3">
                    <h1 class="m-0"><i class="fa-solid fa-briefcase mr-2"></i>Employees</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-3">
                    <button class="btn btn-success float-right" onclick="showAddEmployeeModal()">Add Employee</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-bordered" id="adminEmployeesListTable">
                                        <thead>
                                            <th>Employee Id</th>
                                            <th>Employee Name</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="addNewEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addNewEmployeeModal"
            Label aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">

                        <!-- Step 1: Basic Information -->
                        <div class="container-fluid">
                            <form method="POST" action="{{ route('adminAddNewEmployee') }}" enctype="multipart/form-data"
                                id="adminAddNewEmployeeForm">
                                @csrf

                                <div class="text-center mb-3">
                                    <h5>Employee Information</h5>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="adminAddEmployeeId">Employee ID</label>
                                                <input type="text" id="adminAddEmployeeId" name="adminAddEmployeeId"
                                                    class="form-control" placeholder="Enter Employee ID" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeFirstname">First Name</label>
                                            <input type="text" class="form-control" id="adminAddEmployeeFirstname"
                                                name="adminAddEmployeeFirstname" placeholder="Enter firstname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeMiddlename">Middle Name</label>
                                            <input type="text" class="form-control" id="adminAddEmployeeMiddlename"
                                                name="adminAddEmployeeMiddlename" placeholder="Enter middle name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeLastname">Last Name</label>
                                            <input type="text" class="form-control" id="adminAddEmployeeLastname"
                                                name="adminAddEmployeeLastname" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeExtname">Extension Name</label>
                                            <input type="text" class="form-control" id="adminAddEmployeeExtname"
                                                name="adminAddEmployeeExtname" placeholder="Enter extension name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeSex">Sex</label>
                                            <select name="adminAddEmployeeSex" id="adminAddEmployeeSex"
                                                class="custom-select" required>
                                                <option value="" selected>Select a gender</option>
                                                <option value="0">Female</option>
                                                <option value="1">Male</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminAddEmployeeContactNo">Contact Number</label>
                                            <input type="text" class="form-control" id="adminAddEmployeeContactNo"
                                                name="adminAddEmployeeContactNo" placeholder="Enter contact information"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" onclick="showConfirmationModal()"
                                    class="btn btn-block btn-success">Submit</button>
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

                        <div class="container-fluid">
                            <div class="text-center">
                                <h5>Confirmation</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal-body">
                                        <span id="confirmationQuestion"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
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
        <div class="modal fade" id="employeeDetailsModal" tabindex="-1" role="dialog"
            aria-labelledby="employeeDetailsModal" Label aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">

                        <!-- Step 1: Basic Information -->
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <img src="" alt="" class="img img-fluid img-circle"
                                                        width="120px" height="auto" id="employeeDetailsProfileImg">

                                                </div>
                                                <div class="text-center mt-3">
                                                    <span id="employeeDetailsEmployeeId"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <h3 id="employeeDetailsEmployeeFullName">Employee name</h3>
                                                    <h5 id="employeeDetailsEmployeeSex">Employee Sex</h5>
                                                    <h5 id="employeeDetailsEmployeeContact">Employee Contact</h5>
                                                </div>
                                            </div>
                                        </div>
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
        function showAddEmployeeModal() {
            $('#addNewEmployeeModal').modal('show');
        }

        function showConfirmationModal() {
            $('#confirmationQuestion').text('Confirm adding of new employee?')
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#adminAddNewEmployeeForm').submit();
            });
        }

        function showEmployeeDetailModal(employeeId, employeeFullName, employeeSex, employeeContactNo) {
            if (employeeSex == 'Female') {
                $('#employeeDetailsProfileImg').attr('src', "{{ asset('images/female_avatar.svg') }}");
            } else if (employeeSex == 'Male') {
                $('#employeeDetailsProfileImg').attr('src', "{{ asset('images/male_avatar.svg') }}");
            } else {
                $('#employeeDetailsProfileImg').attr('src', "");
            }
            $('#employeeDetailsEmployeeId').text(employeeId);
            $('#employeeDetailsEmployeeFullName').text(employeeFullName);
            $('#employeeDetailsEmployeeSex').text(employeeSex);
            $('#employeeDetailsEmployeeContact').text(employeeContactNo);
            $('#employeeDetailsModal').modal('show');
        }
    </script>

    <script>
        function refreshAdminEmployeesListTable() {
            $.ajax({
                url: "{{ route('adminFetchEmployeesList') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#adminEmployeesListTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(employees) {
                        table.row.add([
                            employees.employeeId,
                            employees.employeeFullName,
                            `<button class="btn btn-success btn-sm" onclick="showEmployeeDetailModal('${employees.employeeId}', '${employees.employeeFullName}', '${employees.employeeSex}', '${employees.employeeContactNo}')"><i class="fas fa-user"></i></button>`,
                        ]);
                    });

                    table.draw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <script>
        refreshAdminEmployeesListTable();
        $(document).ready(function() {
            $('#adminEmployeesListTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 10,
            });
        });
    </script>
@endsection
