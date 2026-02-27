@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fas fa-file mr-3"></i>Registration Page</h1>
                </div>
                <div class="col-md-6 mt-2">
                    <a href="{{ route('employeeApplicationFormPage') }}">
                        <button class="btn btn-success float-right" id="applicationButton">
                            Apply
                        </button>
                    </a>
                </div>
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
                                        <th>Request</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrationForms as $form)
                                            <tr>
                                                <td>Boarding House Application</td>
                                                <td>{{ $form->comment }}</td>
                                                @if ($form->status == 0)
                                                    <td class="status" data-status="pending" style="color: #ffc600">Pending
                                                    </td>
                                                @elseif($form->status == 1)
                                                    <td class="status" data-status="accepted" style="color: #02681e">
                                                        Accepted</td>
                                                @elseif($form->status == 2)
                                                    <td class="status" data-status="rejected" style="color:red">Rejected
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="/employee-document-submitted-details/{{ $form->id }}">
                                                        <button class="btn btn-success btn-sm">
                                                            <i class="fas fa-info"></i>
                                                        </button>
                                                    </a>
                                                </td>
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
    </section>

    <script>
        $(document).ready(function() {
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

            // Check for pending status
            var hasPending = false;
            $('#registrationRequestsTable .status').each(function() {
                if ($(this).data('status') === 'pending' || $(this).data('status') === 'accepted') {
                    hasPending = true;
                    return false; // break the loop
                }
            });

            if (hasPending) {
                $('#applicationButton').prop('disabled', true);
            }
        });
    </script>
@endsection
