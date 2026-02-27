@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-user mr-3"></i>Student Profile</h1>
                </div><!-- /.col -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-warning btn float-right"
                        onclick="showUpdateStudentClearanceStatus()">Update</button>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-4">

                            <div class="card text-center">
                                <div class="card-body">

                                    <div>
                                        @if ($student->sex == 0)
                                            <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;"
                                                id="imageProfileOfTenant">
                                        @else
                                            <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;"
                                                id="imageProfileOfTenant">
                                        @endif

                                        <h5 class="mt-2">{{ $student->student_id }}</h5>
                                        <input type="text" hidden id="studentId" name="studentId"
                                            value="{{ $student->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-column h-100">
                                <div class="card  mb-3 flex-grow-1">
                                    <div class="card-body">

                                        <div class="row align-items-center">
                                            <div class="container-fluid">
                                                <div class="col-md-12">
                                                    <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                    <div class="d-flex flex-column justify-content-center h-100">
                                                        <h2>{{ $student->firstname . ' ' . $student->middlename . ' ' . $student->lastname }}
                                                        </h2>
                                                        @if ($student->sex == 1)
                                                            <h5><span class="mr-2"><i
                                                                        class="fa-solid fa-venus-mars"></i></span>Male</h5>
                                                        @else
                                                            <p><span class="mr-2"><i
                                                                        class="fa-solid fa-venus-mars"></i></span>Female</p>
                                                        @endif
                                                        <h5><span class="mr-2"><i
                                                                    class="fa-solid fa-phone"></i></span>{{ $student->contact_no }}
                                                        </h5>
                                                        <h5><span class="mr-2"><i
                                                                    class="fa-solid fa-home"></i></span>{{ $student->permanent_address }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-center">
                                        Student Clearance History
                                    </p>
                                    <table class="table table-hover table-bordered" id="osaStudentClearanceHistory">
                                        <thead>
                                            <th>Student Full name</th>
                                            <th>Semester</th>
                                            <th>Clearance Status</th>

                                        </thead>
                                        <tbody>
                                            @if ($student->clearances->count() <= 0)
                                                <tr>
                                                    <td colspan="3" class="text-center">No Clearances Yet.</td>
                                                </tr>
                                            @else
                                                @foreach ($student->clearances->sortByDesc('created_at') as $clearance)
                                                    <tr>
                                                        <td>{{ $clearance->studentTenant->firstname }}</td>
                                                        <td>{{ $clearance->semester->description }}</td>
                                                        @if ($clearance->clearance_status == 0)
                                                            <td style="color:orange; font-weight:bold;">Uncleared</td>
                                                        @elseif($clearance->clearance_status == 1)
                                                            <td style="color: #02681e; font-weight:bold;">Cleared</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-bordered"
                                        id="osaStudentTenantLodgingHistoryTable">
                                        <thead>
                                            <th>Boarding House | Dorm Name</th>
                                            <th>Operator | Manager Name</th>
                                            <th>Date Start</th>
                                            <th>Date End</th>
                                            <th>Clearance Status</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($student->studentTenantHistory->sortByDesc('created_at') as $history)
                                                @if ($history->boardingHouse == null)
                                                    <tr>
                                                        <td>{{ $history->dormitory->dormitory_name }}</td>
                                                        <td>{{ $history->dormitory->dormManager->employee->firstname }}
                                                        </td>
                                                        <td>{{ $history->date_in ? Carbon\Carbon::parse($history->date_in)->format('F d, Y') : '' }}
                                                        </td>
                                                        <td>{{ $history->date_out ? Carbon\Carbon::parse($history->date_out)->format('F d, Y') : 'Currently Residing' }}
                                                        </td>
                                                        @if ($history->clearance_status == 0)
                                                            <td style="color:orange; font-weight:bold;">Uncleared</td>
                                                        @elseif ($history->clearance_status == 1)
                                                            <td style="color:#02681e; font-weight:bold;">Cleared</td>
                                                        @endif
                                                    </tr>
                                                @elseif ($history->dormitory == null)
                                                    <tr>
                                                        <td>{{ $history->boardingHouse->boarding_house_name }}</td>
                                                        <td>{{ $history->boardingHouse->operator->employee->firstname }}
                                                        </td>
                                                        <td>{{ $history->date_in ? Carbon\Carbon::parse($history->date_in)->format('F/d/Y') : 'Currently Residing' }}
                                                        </td>
                                                        <td>{{ $history->date_out ? Carbon\Carbon::parse($history->date_out)->format('F/d/Y') : 'Currently Residing' }}
                                                        </td>
                                                        @if ($history->clearance_status == 0)
                                                            <td style="color:orange; font-weight:bold;">Uncleared</td>
                                                        @elseif ($history->clearance_status == 1)
                                                            <td style="color:#02681e; font-weight:bold;">Cleared</td>
                                                        @endif
                                                @endif
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

        <div class="modal fade" id="updateStudentClearanceStatusModal" tabindex="-1" role="dialog"
            aria-labelledby="updateStudentClearanceStatusModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="POST" action="{{ route('osaSubmitUpdateTenantClearanceStatus') }}"
                                enctype="multipart/form-data" id="osaSubmitUpdateStudentClearanceForm">
                                @csrf
                                <div class="row">

                                    <input type="text" id="osaUpdateStudentClearanceStatusId"
                                        name="osaUpdateStudentClearanceStatusId" value="{{ $student->id }}" hidden>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="osaUpdateStudentClearanceStatusSemester">Semester</label>
                                            <select name="osaUpdateStudentClearanceStatusSemester"
                                                id="osaUpdateStudentClearanceStatusSemester" class="custom-select">
                                                <option value="" selected>Select a semester to clear</option>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}">{{ $semester->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="osaUpdateStudentClearanceStatus">Status</label>
                                            <select name="osaUpdateStudentClearanceStatus"
                                                id="osaUpdateStudentClearanceStatus" class="custom-select">
                                                <option value="" selected>Select status</option>
                                                <option value="0">Uncleared</option>
                                                <option value="1">Cleared</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button type="button" onclick="showConfirmationModal('submitEditProfile')"
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
                        <div class="container">
                            <div class="container-fluid">
                                <div class="form-group d-flex align-items-center justify-content-center">
                                    <h5>Confirmation</h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <span id="confirmationQuestion"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
        </div>


    </section>


    <script>
        function showUpdateStudentClearanceStatus() {
            $('#updateStudentClearanceStatusModal').modal('show');
        }

        function showConfirmationModal(action) {
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#osaSubmitUpdateStudentClearanceForm').submit();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#osaStudentTenantLodgingHistoryTable').DataTable({
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
        });
    </script>
@endsection
