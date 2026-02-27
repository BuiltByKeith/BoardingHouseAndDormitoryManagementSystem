@extends('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-user-xmark mr-3"></i>Tenant History List</h1>
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

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="tenantHistoryList" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Date In</th>
                                <th>Date Out</th>
                                <th>Reason</th>
                                <th>Clearance Status</th>

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
        function refreshTenantHistoryListTable(semId) {
            $.ajax({
                url: "{{ route('operatorFetchHistoryOfTenants') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    semester_id: semId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    var table = $('#tenantHistoryList').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(historyTenants) {
                        // table.row.add([
                        //     historyTenants.studentIdNumber,
                        //     historyTenants.studentTenantFullName,
                        //     historyTenants.dateIn,
                        //     historyTenants.dateOut,
                        //     historyTenants.clearanceStatus,
                        //     '<button class="btn btn-success btn-sm"><i class="fas fa-user"></i></button>'
                        // ]);
                        table.row.add([
                            historyTenants.bhHistoryTenantStudentId,
                            historyTenants.bhHistoryTenantFullName,
                            historyTenants.bhHistoryDateIn,
                            historyTenants.bhHistoryDateOut,
                            historyTenants.bhHistoryReason,
                            createToggleSwitch(historyTenants.bhHistoryId, historyTenants
                                .bhHistoryClearanceStatus),

                        ]);
                    });



                    table.draw();
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {

            var semesterId = $('#semesterId').val();

            $('#tenantHistoryList').DataTable({
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
            }).buttons().container().appendTo('#tenantHistoryList_wrapper .col-md-6:eq(0)');


            refreshTenantHistoryListTable(semesterId);

            $('#semesterId').change(function() {
                var semId = $(this).val();
                refreshTenantHistoryListTable(semId);
            });
        });

        function createToggleSwitch(bhTenantHistoryId, tenantStatus) {
            var defaultChecked = tenantStatus == 1 ? 'checked' :
                ''; // If tenant status is 1, set the toggle switch to 'checked'

            return `
        <form action="{{ route('operatorUpdateHistoryOfTenantClearanceStatus') }}" method="POST" id="operatorUpdateHistoryOfTenantClearanceStatus"> 
            @csrf
            <input type="hidden" id="bhHistoryOfTenantIdInput" name="bhHistoryOfTenantIdInput" value="${bhTenantHistoryId}">
            <input type="hidden" id="bhHistoryOfTenantToggleValueInput" name="bhHistoryOfTenantToggleValueInput" value="${tenantStatus}">
            <div class="form-group text-center">
                <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input tenant-toggle-switch" id="operatorToggleHistoryOfTenantClearanceStatusUpdate${bhTenantHistoryId}" name="tenant_toggle[]" data-student-id="${bhTenantHistoryId}" onchange="submitUpdateClearanceStatus(this)" ${defaultChecked}>
                    <label class="custom-control-label" for="operatorToggleHistoryOfTenantClearanceStatusUpdate${bhTenantHistoryId}"></label>
                </div>
            </div>
        </form>
    `;
        }

        function submitUpdateClearanceStatus(checkbox) {
            var bhTenantHistoryId = $(checkbox).data('student-id');
            var toggleValue = $(checkbox).is(':checked') ? 1 : 0;

            // Now you have studentIdNumber and toggleValue
            console.log('tenant history ID: ' + bhTenantHistoryId);
            console.log('Toggle Value: ' + toggleValue);

            $('#bhHistoryOfTenantIdInput').val(bhTenantHistoryId);
            $('#bhHistoryOfTenantToggleValueInput').val(toggleValue);

            $('#operatorUpdateHistoryOfTenantClearanceStatus').submit();

        }
    </script>
@endsection
