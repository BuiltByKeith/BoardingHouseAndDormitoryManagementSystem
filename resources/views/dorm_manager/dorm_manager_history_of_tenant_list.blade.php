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
                    <table id="dormTenantHistoryList" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Date In</th>
                                <th>Date Out</th>
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
        function refreshDormTenantHistoryListTable(semId) {
            $.ajax({
                url: "{{ route('dormManagerFetchHistoryOfTenantList') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    semester_id: semId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    var table = $('#dormTenantHistoryList').DataTable();
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
                            historyTenants.dormHistoryTenantStudentId,
                            historyTenants.dormHistoryTenantFullName,
                            historyTenants.dormHistoryDateIn,
                            historyTenants.dormHistoryDateOut,
                            createToggleSwitch(historyTenants.dormHistoryId, historyTenants
                                .dormHistoryClearanceStatus),
                           
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

            $('#dormTenantHistoryList').DataTable({
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
            }).buttons().container().appendTo('#dormTenantHistoryList_wrapper .col-md-6:eq(0)');


            refreshDormTenantHistoryListTable(semesterId);

            $('#semesterId').change(function() {
                var semId = $(this).val();
                refreshDormTenantHistoryListTable(semId);
            });
        });

        function createToggleSwitch(dormTenantHistoryId, tenantStatus) {
            var defaultChecked = tenantStatus == 1 ? 'checked' :
                ''; // If tenant status is 1, set the toggle switch to 'checked'

            return `
        <form action="{{ route('dormManagerUpdateHistoryOfTenantClearanceStatus') }}" method="POST" id="dormManagerUpdateHistoryOfTenantClearanceStatus"> 
            @csrf
            <input type="hidden" id="dormHistoryOfTenantIdInput" name="dormHistoryOfTenantIdInput" value="${dormTenantHistoryId}">
            <input type="hidden" id="dormHistoryOfTenantToggleValueInput" name="dormHistoryOfTenantToggleValueInput" value="${tenantStatus}">
            <div class="form-group text-center">
                <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input tenant-toggle-switch" id="dormManagerToggleHistoryOfTenantClearanceStatusUpdate${dormTenantHistoryId}" name="tenant_toggle[]" data-student-id="${dormTenantHistoryId}" onchange="submitUpdateClearanceStatus(this)" ${defaultChecked}>
                    <label class="custom-control-label" for="dormManagerToggleHistoryOfTenantClearanceStatusUpdate${dormTenantHistoryId}"></label>
                </div>
            </div>
        </form>
    `;
        }

        function submitUpdateClearanceStatus(checkbox) {
            var dormTenantHistoryId = $(checkbox).data('student-id');
            var toggleValue = $(checkbox).is(':checked') ? 1 : 0;

            // Now you have studentIdNumber and toggleValue
            console.log('tenant history ID: ' + dormTenantHistoryId);
            console.log('Toggle Value: ' + toggleValue);

            $('#dormHistoryOfTenantIdInput').val(dormTenantHistoryId);
            $('#dormHistoryOfTenantToggleValueInput').val(toggleValue);

            $('#dormManagerUpdateHistoryOfTenantClearanceStatus').submit();

        }
    </script>
@endsection
