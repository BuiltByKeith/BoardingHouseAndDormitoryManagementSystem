@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-calendar mr-2"></i>Academic Semester</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <button class="btn btn-success float-right" onclick="showAddSemesterModal()">Add Semester</button>
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
                                    <table class="table table-hover table-bordered" id="adminSemestersListTable">
                                        <thead>
                                            <th>Semester</th>
                                            <th>Academic Year</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($semesters as $semester)
                                                <tr>
                                                    <td>{{ $semester->description }}</td>
                                                    <td>{{ $semester->acadYear->description }}</td>
                                                    <td><button class="btn btn-sm btn-success"><i
                                                                class="fas fa-info"></i></button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addNewSemesterModal" tabindex="-1" role="dialog" aria-labelledby="addNewSemesterModal"
            Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Semester</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">

                        <!-- Step 1: Basic Information -->
                        <div class="container-fluid">
                            <form method="POST" action="{{ route('adminAddNewSemester') }}"
                                enctype="multipart/form-data" id="adminAddNewSemesterForm">
                                @csrf

                                <div class="row">
                                    <div class="form-group">
                                        <label for="adminAddNewSemesterAcadYearId">Academic Year</label>
                                        <select name="adminAddNewSemesterAcadYearId" id="adminAddNewSemesterAcadYearId"
                                            class="custom-select">
                                            <option value="" selected>Select an Academic Year</option>
                                            @foreach ($acadYears as $acadYear)
                                                <option value="{{ $acadYear->id }}">{{ $acadYear->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="adminAddNewAcadYearDesciption">Semester Name</label>
                                        <input type="text" class="form-control" id="adminAddNewAcadYearDesciption"
                                            name="adminAddNewAcadYearDesciption"
                                            placeholder="Enter semester name e.g. 1st Semester">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-block btn-default">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" onclick="showConfirmationModal()"
                                            class="btn btn-block btn-success">Submit</button>
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
    </section>
    <script>
        function showAddSemesterModal() {
            $('#addNewSemesterModal').modal('show');
        }

        function showConfirmationModal() {
            $('#confirmationQuestion').text('Confirm adding of new Semester?');
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#adminAddNewSemesterForm').submit();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#adminSemestersListTable').DataTable({
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
