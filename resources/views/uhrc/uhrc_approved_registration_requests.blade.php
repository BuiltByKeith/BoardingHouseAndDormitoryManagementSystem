@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8 mt-2">
                    <h1><i class="fa-solid fa-file mr-2"></i>Approved Requests</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="registrationRequestsTable">
                                    <thead>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Request</th>
                                        <th>Date Requested</th>

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
    </section>


    <script>
        function refreshRegistrationRequestTable(status) {
            $.ajax({
                url: "{{ route('uhrcFetchApprovedRegistrationRequests') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    status_id: status,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);

                    var table = $('#registrationRequestsTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(registrationRequest) {
                        table.row.add([
                            registrationRequest.employeeId,
                            registrationRequest.employeeFullName,
                            registrationRequest.request,
                            registrationRequest.dateRequested,

                            '<a href="/uhrc-employee-registration-request-detail/' +
                            registrationRequest.id +
                            '"><button class="btn btn-success btn-sm"><i class="fas fa-info"></i></button></a>'
                        ]);
                    });

                    table.draw(); // Redraw table
                },
                error: function(xhr, status, error) {

                    console.error(xhr.responseText);
                }
            });
        }


        $(document).ready(function() {

            refreshRegistrationRequestTable($('#registrationStatus').val());

            $('#registrationStatus').change(function() {
                var status = $(this).val();
                refreshRegistrationRequestTable(status);
            });

            $('#registrationRequestsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 5,

            });
        });
    </script>
@endsection
