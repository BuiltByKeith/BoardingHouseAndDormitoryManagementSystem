@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-users mr-2"></i> Students</h1>
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

                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="osaStudentMasterList">
                                        <thead>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>College</th>
                                            <th>Course</th>
                                            <th>Clearance Status</th>
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
    </section>

    <script>
        function refreshOsaStudentMasterlist(semId) {
            $.ajax({
                url: "{{ route('osaFetchStudentMasterList') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    semester_id: semId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#osaStudentMasterList').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(students) {

                        var clearanceStatus = 'Pending'; // Default status
                        // Loop through the clearance statuses
                        if (students.clearanceStatus[0] != null) {
                            clearanceStatus = students.clearanceStatus[0].clearanceStatus;
                        }
                        var style = '';
                        if (clearanceStatus === 'Cleared') {
                            style = 'color: green; font-weight: bold;';
                        } else if (clearanceStatus === 'Uncleared') {
                            style = 'color: orange; font-weight: bold;';
                        } else {
                            style = 'font-weight: bold;';
                        }

                        table.row.add([
                            students.studentId,
                            students.studentFullName,
                            students.studentCollege,
                            students.studentCourse,
                            '<td style="' + style + '">' + clearanceStatus + '</td>',
                            '<a href="osa-student-profile/' + students.id +
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



        $(document).ready(function() {

            var semesterId = $('#semesterId').val();

            $('#osaStudentMasterList').DataTable({
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


            refreshOsaStudentMasterlist(semesterId);

            $('#semesterId').change(function() {
                var semId = $(this).val();
                refreshOsaStudentMasterlist(semId);
            });
        });
    </script>
@endsection
