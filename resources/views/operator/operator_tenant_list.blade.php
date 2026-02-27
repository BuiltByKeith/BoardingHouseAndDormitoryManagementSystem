@extends('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-users mr-2"></i>Tenant List</h1>
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
                        <div class="form-inline ml-2">
                            <button data-toggle="modal" type="button" data-toggle="modal" id="addTenantButton"
                                class="btn btn-block btn-success">Register Tenant</button>

                        </div>
                        @include('operator.operator_modals.register_tenant_modal')
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="studentTenantList" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>
                                <th>Program</th>
                                <th>Room</th>
                                <th>Clearance</th>
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




    @include('operator.operator_modals.tenant_profile_modal')
    @include('operator.operator_modals.tenant_history_modal')
    @include('operator.operator_modals.tenant_expel_modal')
    @include('operator.operator_modals.tenant_bills_modal')

    <script>
        function refreshTenantListTable(semesterId) {
            // showLoadingIndicator();
            console.log(semesterId);
            $.ajax({
                url: "{{ route('operatorFetchTenantList') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    semester_id: semesterId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    var table = $('#studentTenantList').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(studentTenants) {

                        table.row.add([
                            studentTenants.studentIdNumber,
                            studentTenants.firstName + ' ' + studentTenants.middleName + ' ' +
                            studentTenants.lastName,
                            studentTenants.program,
                            studentTenants.room,
                            createToggleSwitch(studentTenants.bhRoomTenantId, studentTenants
                                .tenantStatus),
                            '<button type="button" onclick="openTenantInfoModal(\'' +
                            studentTenants.studentTenantId + "', '" +
                            studentTenants.bhRoomTenantId + "', '" +
                            studentTenants.studentIdNumber + "', '" +
                            studentTenants.tenantRoomName + "', '" +
                            studentTenants.tenantRoomId + "', '" +
                            studentTenants.firstName + "', '" +
                            studentTenants.middleName + "', '" +
                            studentTenants.lastName + "', '" +
                            studentTenants.extName + "', '" +
                            studentTenants.program + "', '" +
                            studentTenants.college + "', '" +
                            studentTenants.programId + "', '" +
                            studentTenants.collegeId + "', '" +
                            studentTenants.sex + "', '" +
                            studentTenants.contactNo + "', '" +
                            studentTenants.address + "', '" +
                            studentTenants.tenantGuardianFullname + "', '" +
                            studentTenants.tenantGuardianFirstname + "', '" +
                            studentTenants.tenantGuardianMiddlename + "', '" +
                            studentTenants.tenantGuardianLastname + "', '" +
                            studentTenants.tenantGuardianExtname + "', '" +
                            studentTenants.tenantGuardianContactNo + "', '" +
                            studentTenants.tenantGuardianOccupation +
                            "')" +
                            '" class="btn btn-sm btn-success" title="Tenant Information"><i class="fa-solid fa-user"></i></button>' +
                            ' ' +
                            '<button type="button" onclick="openTenantBillsModal(\'' +
                            studentTenants.bhRoomTenantId + "', '" +
                            studentTenants.firstName + "', '" +
                            studentTenants.room + "', '" +
                            studentTenants.roomPrice +
                            "')" +
                            '" class="btn btn-sm btn-success mr-1" title="Tenant History"><i class="fa-solid fa-file-invoice"></i></button>' +
                            '<button type="button" onclick="openTenantHistoryModal(\'' +
                            studentTenants.studentTenantId + "', '" +
                            studentTenants.firstName +
                            "')" +
                            '" class="btn btn-sm btn-success mr-1" title="Tenant History"><i class="fa-solid fa-list"></i></button>' +


                            '<button class="btn btn-danger btn-sm" onclick="showRemoveTenantModal(' +
                            studentTenants.bhRoomTenantId +
                            ')"><i class="fas fa-right-from-bracket"></i></button>'

                        ]);
                    });



                    table.draw(); // Redraw table
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
        }

        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        // Function to hide loading indicator
        function hideLoadingIndicator() {
            setTimeout(function() {
                $('#loadingIndicator').hide();
            }, 1000);
        }

        $('#addTenantButton').click(function() {
            $('#registerTenantModal').modal('show');
        });

        $(document).ready(function() {

            var semesterId = $('#semesterId').val();


            // Initialize the DataTable
            $('#studentTenantList').DataTable({
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
            }).buttons().container().appendTo('#studentTenantList_wrapper .col-md-6:eq(0)');


            // Call the function to fetch and populate data in the table
            refreshTenantListTable(semesterId);

            $('#semesterId').change(function() {
                var semId = $(this).val();
                refreshTenantListTable(semId);
            });

        });


        function openTenantInfoModal(id, roomTenantId, idNumber, roomName, roomId, firstName, middleName, lastName, extName,
            program,
            college, programId,
            collegeId, sex,
            contactNo, address, guardianFullname, guardianFirstname, guardianMiddlename, guardianLastname, guardianExtname,
            guardianContactNo, guardianOccupation) {

            // Tenant Profile

            $('#id').text(id);
            $('#tenantFirstName').text(firstName);
            $('#tenantMiddleName').text(middleName);
            $('#tenantLastName').text(lastName);
            if (extName == null) {
                $('#tenantExtName').text('');
            }
            $('#tenantIdNumber').text(idNumber);
            $('#tenantCollege').text(college);
            $('#tenantCourse').text(program);
            $('#tenantContact').text(contactNo);
            $('#tenantGenderSex').text(sex);
            $('#tenantAddress').text(address);
            $('#tenantGuardianFullname').text(guardianFullname);
            $('#tenantGuardianContactNo').text(guardianContactNo);
            $('#tenantGuardianOccupation').text(guardianOccupation);
            if (sex == 'Male') {
                $('#imageProfileOfTenant').attr('src', "{{ asset('images/male_avatar.svg') }}");
            } else if (sex == 'Female') {
                $('#imageProfileOfTenant').attr('src', "{{ asset('images/female_avatar.svg') }}");
            } else {
                $('#imageProfileOfTenant').attr('src', "");
            }



            $('#tenantInfoModal').modal('show');

            // Tenant Edit Profile

            $('#editTenantId').val(id);
            $('#editRoomTenantId').val(roomTenantId)
            $('#editTenantFirstName').val(firstName);
            $('#editTenantMiddleName').val(middleName);
            $('#editTenantLastName').val(lastName);
            $('#editTenantExtName').val(extName);
            $('#editTenantContactNo').val(contactNo);

            var collegeOption = $('#editTenantCollege option:selected');
            collegeOption.val(collegeId);
            collegeOption.text(college);

            var programOption = $('#editTenantProgram option:selected');
            programOption.val(programId);
            programOption.text(program);

            var roomOption = $('#editTenantRoom option:selected');
            roomOption.val(roomId);
            roomOption.text(roomName);

            $('#editTenantPermanentAddress').val(address);

            $('#editGuardianFirstName').val(guardianFirstname);
            $('#editGuardianMiddleName').val(guardianMiddlename);
            $('#editGuardianLastName').val(guardianLastname);
            $('#editGuardianExtName').val(guardianExtname);
            $('#editGuardianContactNo').val(guardianContactNo);
            $('#editGuardianOccupation').val(guardianOccupation);

        }

        function openTenantBillsModal(studentId, firstname, room, roomPrice) {

            $.ajax({
                url: "{{ route('operatorFetchStudentTenantBills') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    student_id: studentId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);


                    if (data != null && data.length > 0) {
                        var tableBody = $('#bhRoomTenantBillTable tbody').empty(); // Select the table body
                        data.forEach(bill => {
                            $('#bhRoomTenantBillTable tbody').append(
                                `<tr>
                                <td>${bill.billMonth}</td>  
                                <td>${bill.totalBill}</td>  
                                <td>${bill.paymentStatus}</td>  
                                <td><button class="btn btn-success btn-sm" onclick="viewBillDetails('${bill.id}')">View details</button></td>  
                            </tr>`
                            );

                        });
                    } else {
                        var tableBody = $('#bhRoomTenantBillTable tbody').empty(); // Select the table body

                        $('#bhRoomTenantBillTable tbody').append(
                            `<tr>
                                <td colspan="4" class="text-center">No bills yet.</td>  
                            </tr>`
                        );


                    }


                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            $('#roomTenantGenerateBillRoomName').text(room);

            $('#roomTenantGenerateBillRoomPrice').text(roomPrice);
            $('#generateBillTenantId').val(studentId);
            $('#generateBillTenantName').text(firstname);
            $('#tenantBillFirstName').text(firstname);
            $('#tenantBillsModal').modal('show');
            $('#tenantPayBillFirstName').text(firstname);
        }

        function viewBillDetails(billId) {

            $.ajax({
                url: "{{ route('operatorFetchTenantBillChargeDetail') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    bill_id: billId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var bill = data[0];
                    // Update tenant name and room name
                    $('#tenantBillInfoTenantName').text(bill.billOfTenantFullName);
                    $('#tenantBillInfoTenantRoomName').text(bill.bhRoomNameOfTenant);

                    // Build breakdown part HTML
                    // Build breakdown part HTML
                    var breakdownHTML = '';
                    bill.tenantBillTemplate.forEach(function(item) {
                        breakdownHTML +=
                            `${item.chargeName} Rate: <strong class="float-right">${item.chargePrice}</strong><br>`;
                    });
                    breakdownHTML +=
                        `<p>Room Rate: <strong class="float-right">${bill.bhRoomPriceOfTenant}</strong></p>`;
                    $('#tenantBillInfoBreakdownPart').html(breakdownHTML);



                    if (bill.billPaymentTransactions != null && bill.billPaymentTransactions.length > 0) {
                        var tableBody = $('#billDetailTransactionListTable tbody').empty();
                        bill.billPaymentTransactions.forEach(function(bill) {
                            $('#billDetailTransactionListTable tbody').append(
                                `<tr>
                                <td class="text-right">${bill.amount}</td>  
                                <td>${bill.comment}</td>  
                                <td>${bill.datePaid}</td>   
                            </tr>`
                            );
                        });
                    } else {
                        var tableBody = $('#billDetailTransactionListTable tbody').empty();
                        $('#billDetailTransactionListTable tbody').append(
                            `<tr>
                                <td colspan="3" class="text-center">No transactions yet.</td>   
                            </tr>`
                        );
                    }


                    // Update total bill
                    $('#tenantBillTotal').text(bill.totalBill);
                    $('#operatorPayTenantBillTotalAmount').text(bill.totalBill);
                    $('#billInfoDiv').removeAttr('hidden');
                    $('#billSummaryDateMonth').text(bill.billDate);
                    $('#billSummaryDetailStatus').val(bill.paymentStatus);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            $('#operatorTenantBillId').val(billId);

            $('#operatorTenantUpdateBillStatusId').val(billId);
        }

        $('#tenantBillsModal').on('hidden.bs.modal', function() {
            // Reset modal content
            $('#roomTenantGenerateBillRoomName').text('');
            $('#roomTenantGenerateBillRoomPrice').text('');
            $('#generateBillTenantId').val('');
            $('#generateBillTenantName').text('');
            $('#tenantBillFirstName').text('');
            // Reset bill details content
            $('#tenantBillInfoTenantName').text('');
            $('#tenantBillInfoTenantRoomName').text('');
            $('#tenantBillInfoBreakdownPart').html('');
            $('#tenantBillTotal').text('');
            $('#billInfoDiv').attr('hidden', 'hidden');
        });

        function openTenantHistoryModal(id, firstName) {
            $.ajax({
                url: "{{ route('operatorFetchStudentTenantHistory') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    tenant_id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);

                    var tableBody = $('#tenantHistoryTable tbody').empty(); // Select the table body
                    data.forEach(history => {
                        $('#tenantHistoryTable tbody').append(
                            `<tr>
                    <td>${history.bhName}</td>
                    <td>${history.bhOperatorName}</td>  
                    <td>${history.dateIn}</td>  
                    <td>${history.dateOut}</td>  
                    <td>${history.reason}</td>  
                    <td>${history.clearanceStatus}</td>  
                </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#tenantHistoryName').text(firstName);

            $('#tenantHistoryModal').modal('show');
        }



        function showRemoveTenantModal(id) {
            $('#bhRoomTenantId').val(id);
            $('#operatorRemoveTenantModal').modal('show');
        }

        function createToggleSwitch(bhRoomTenantId, tenantStatus) {
            var defaultChecked = tenantStatus == 1 ? 'checked' :
                ''; // If tenant status is 1, set the toggle switch to 'checked'

            return `
        <form action="{{ route('operatorUpdateBhRoomTenantClearanceStatus') }}" method="POST" id="dormManagerDormRoomTenantUpdateClearanceStatusForm"> 
            @csrf
            <input type="hidden" id="bhRoomTenantIdInput" name="bhRoomTenantIdInput" value="${bhRoomTenantId}">
            <input type="hidden" id="bhRoomTenantToggleValueInput" name="bhRoomTenantToggleValueInput" value="${tenantStatus}">
            <div class="form-group text-center">
                <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input tenant-toggle-switch" id="dormManagerToggleClearanceStatusUpdate${bhRoomTenantId}" name="tenant_toggle[]" data-student-id="${bhRoomTenantId}" onchange="submitUpdateClearanceStatus(this)" ${defaultChecked}>
                    <label class="custom-control-label" for="dormManagerToggleClearanceStatusUpdate${bhRoomTenantId}"></label>
                </div>
            </div>
        </form>
    `;
        }

        function submitUpdateClearanceStatus(checkbox) {
            var bhRoomTenantId = $(checkbox).data('student-id');
            var toggleValue = $(checkbox).is(':checked') ? 1 : 0;

            // Now you have studentIdNumber and toggleValue
            console.log('Student Tenant ID: ' + bhRoomTenantId);
            console.log('Toggle Value: ' + toggleValue);

            $('#bhRoomTenantIdInput').val(bhRoomTenantId);
            $('#bhRoomTenantToggleValueInput').val(toggleValue);

            $('#dormManagerDormRoomTenantUpdateClearanceStatusForm').submit();

        }
    </script>
@endsection
