@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-calendar mr-2"></i>Academic year</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <button class="btn btn-success float-right" onclick="showAddAcadYearModal()">Add Academic Year</button>
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
                                    <table class="table table-hover table-bordered" id="adminAcadYearsListTable">
                                        <thead>
                                            <th>Acadamic Year</th>

                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($acadYears as $acadYear)
                                                <tr>
                                                    <td>{{ $acadYear->description }}</td>
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
        <div class="modal fade" id="addNewAcadYearModal" tabindex="-1" role="dialog" aria-labelledby="addNewAcadYearModal"
            Label aria-hidden="true">
            <div class="modal-dialog modal-md">
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
                            <form method="POST" action="{{ route('adminAddNewAcademicYear') }}"
                                enctype="multipart/form-data" id="adminAddNewAcadYearForm">
                                @csrf

                                <div class="row">
                                    <div class="form-group">
                                        <label for="adminAddNewAcadYearDesciption">Academic Year Name</label>
                                        <input type="text" class="form-control" id="adminAddNewAcadYearDesciption"
                                            name="adminAddNewAcadYearDesciption"
                                            placeholder="Enter academic year name e.g. AY 2023-2024">
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
        function showAddAcadYearModal() {
            $('#addNewAcadYearModal').modal('show');
        }

        function showConfirmationModal() {
            $('#confirmationQuestion').text('Confirm adding of new Academic Year?');
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#adminAddNewAcadYearForm').submit();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#adminAcadYearsListTable').DataTable({
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
