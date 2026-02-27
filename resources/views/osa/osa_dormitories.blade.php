@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-city mr-2"></i> Dormitories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <a href="{{ route('osaRegisterNewDormitory') }}"><button class="btn btn-success float-right">Register
                            Dormitory</button></a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="osaDormsTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Dormitory Name</th>
                                <th>Dorm Manager</th>
                                <th>Gender Accepted</th>
                                <th>Vacancy</th>
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


    <script>
        function openRegistrationFormModal() {
            $('#osaRegisterNewDormitoryModal').modal('show');
        }
    </script>
    <script>
        function refreshDormitoriesList() {
            $.ajax({
                url: "{{ route('osaFetchDormitories') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#osaDormsTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(dormitories) {
                        table.row.add([
                            dormitories.dormitoryName,
                            dormitories.dormManagerFullName,
                            dormitories.dormSexAccepted,
                            dormitories.vacancy,
                            '<a href="osa-dormitory-details/' + dormitories.id +
                            '"><button class="btn btn-sm btn-success"><i class="fas fa-info"></i></button></a>',
                        ]);
                    });
                    table.draw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        function hideLoadingIndicator() {
            setTimeout(function() {
                $('#loadingIndicator').hide();
            }, 1000);
        }
        $(document).ready(function() {
            $('#osaDormsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 8,
            });
            refreshDormitoriesList();
        })
    </script>
@endsection
