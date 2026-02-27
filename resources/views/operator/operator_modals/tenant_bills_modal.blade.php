<div class="modal fade" id="tenantBillsModal" tabindex="-1" role="dialog" aria-labelledby="tenantBillsModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bills of <span id="tenantBillFirstName"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="container">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Bills</strong></p>
                                    </div>

                                    <div class="col-md-6">
                                        <button class="btn btn-sm btn-success float-right"
                                            onclick="openGenerateBillModal()">
                                            Generate Bill
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="bhRoomTenantBillTable">
                                        <thead>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="" id="billInfoDiv" hidden>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="float-left">
                                                    <strong>
                                                        Bill Summary of <span id="billSummaryDateMonth"></span>
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group float-right">
                                                    <input type="text" name="billSummaryDetailStatus" disabled
                                                        id="billSummaryDetailStatus"
                                                        class="form-control form-control-sm">
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="openUpdateBillStatusModal()">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <div class="col-md-12 text-center">
                                                        <div class="d-flex flex-column justify-content-center h-100">
                                                            <h3 class="mb-1">
                                                                <span id="tenantBillInfoTenantName"></span>
                                                            </h3>
                                                            <h5 class="mb-3">
                                                                <span><i class="fas fa-bed"></i></span>
                                                                <span id="tenantBillInfoTenantRoomName"></span>
                                                            </h5>
                                                            <div class="text-left" id="tenantBillInfoBreakdownPart">
                                                                <!-- Breakdown part will be populated dynamically -->
                                                            </div>
                                                            <div class="text-center">
                                                                <p>Total bill: <strong><span
                                                                            id="tenantBillTotal"></span></strong></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="float-left">Bill Transactions</p>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-sm btn-success float-right"
                                                    onclick="openBillPaymentModal()">Pay</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-sm"
                                                    id="billDetailTransactionListTable">
                                                    <thead>
                                                        <th>Amount</th>
                                                        <th>Comment</th>
                                                        <th>Date Paid</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default float-right" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="generateBillModal" tabindex="-1" role="dialog" aria-labelledby="generateBillModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Generate Bill for <span id="generateBillTenantName"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <form action="{{ route('operatorGenerateTenantBill') }}" method="POST"
                            id="submitGenerateTenantBillForm" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 id="roomTenantGenerateBillRoomName"></h2>
                                        <h5><span id="roomTenantGenerateBillRoomPrice"></span></h5>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Select Month</label>
                                    <input type="date" class="form-control" id="generateTenantBillReportDate"
                                        name="generateTenantBillReportDate">
                                </div>

                                <input type="text" value="" id="generateBillTenantId"
                                    name="generateBillTenantId" hidden>

                                <div class="form-group">
                                    <label for="selectBillTemplate">Select Bill Template</label>
                                    <select name="selectBillTemplate" id="selectBillTemplate" class="form-control">
                                        <option value="" selected>Select a template</option>
                                        @foreach ($boardingHouseBillTemplates as $template)
                                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="templateDetailCardInfo" hidden>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h3 id="templateDetailNameCard"></h3>
                                                <p><u>Inclusions:</u></p>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hovered table-bordered"
                                                    id="templateDetailChargeTable">
                                                    <thead>
                                                        <th>Charge</th>
                                                        <th>Amount</th>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-block btn-success"
                                    onclick="openConfirmationModal('generateBill')">Generate</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-block btn-default">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tenantPayBillModal" tabindex="-1" role="dialog" aria-labelledby="tenantPayBillModal"
    Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay Bill of <span id="tenantPayBillFirstName"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="container">

                    <form action="{{ route('operatorSubmitPaymentForTenantBill') }}" method="POST"
                        enctype="multipart/form-data" id="operatorPayTenantBillForm">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <input type="text" class="form-group" id="operatorTenantBillId"
                                    name="operatorTenantBillId" hidden>

                                <div class="text-center">
                                    <h3>Total bill: <span id="operatorPayTenantBillTotalAmount"></span></h3>
                                </div>
                                <div class="form-group">
                                    <label for="operatorEnterAmountInputForPayment">Enter Amount</label>
                                    <input type="number" class="form-control"
                                        id="operatorEnterAmountInputForPayment"
                                        name="operatorEnterAmountInputForPayment" placeholder="₱">
                                </div>

                                <div class="form-group">
                                    <label for="operatorEnterCommentInputForPayment">Comment</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter comment here. Leave blank if not applicable."
                                        id="operatorEnterCommentInputForPayment" name="operatorEnterCommentInputForPayment"></textarea>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" onclick="openConfirmationModal('pay')"
                                    class="btn btn-block btn-success float-right">Submit</button>
                                <button type="button" class="btn btn-block btn-default float-right"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateTenantBillStatusModal" tabindex="-1" role="dialog"
    aria-labelledby="updateTenantBillStatusModal" Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update bill status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <form action="{{ route('operatorUpdateTenantBillStatus') }}" method="POST"
                        enctype="multipart/form-data" id="operatorUpdateTenantBillStatusForm">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <input type="text" class="form-group" id="operatorTenantUpdateBillStatusId"
                                    name="operatorTenantUpdateBillStatusId" hidden>
                                <div class="form-group">
                                    <label for="operatorSelectUpdateStatus">Select Status</label>
                                    <select name="operatorSelectUpdateStatus" id="operatorSelectUpdateStatus"
                                        class="form-control">
                                        <option value="" selected>Select status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Partial</option>
                                        <option value="2">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" onclick="openConfirmationModal('updateBillStatus')"
                                    class="btn btn-block btn-success float-right">Update</button>
                                <button type="button" class="btn btn-block btn-default float-right"
                                    data-dismiss="modal">Cancel</button>
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




<script>
    function openUpdateBillStatusModal() {
        $('#updateTenantBillStatusModal').modal('show');
    }
</script>

<script>
    function openBillPaymentModal() {
        $('#tenantPayBillModal').modal('show');
    }
</script>
<script>
    function openConfirmationModal(action) {
        if (action == 'pay') {
            $('#confirmationQuestion').text('Confirm submission of tenant bill payment?')
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#operatorPayTenantBillForm').submit();
            });
        } else if (action == 'generateBill') {
            $('#confirmationQuestion').text('Confirm generation of tenant bill?')
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#submitGenerateTenantBillForm').submit();
            });
        } else if (action == 'updateBillStatus') {
            $('#confirmationQuestion').text('Confirm update of tenant bill status?')
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#operatorUpdateTenantBillStatusForm').submit();
            });
        }
    }

    function openGenerateBillModal() {

        $('#generateBillModal').modal('show');
    }
</script>
<script>
    $(document).ready(function() {
        $('#selectBillTemplate').change(function() {
            var templateId = $(this).val();
            if (templateId !== "") {
                // Perform AJAX request to fetch details
                $.ajax({
                    url: "{{ route('operatorFetchTemplateDuringBilling') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        template_id: templateId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // Handle the response here
                        console.log(response);
                        var template = response[0]; // Access the first element of the array
                        $('#templateDetailNameCard').text(template.templateName);
                        var tableBody = $('#templateDetailChargeTable tbody').empty();
                        // Populate table with template details
                        template.templateDetails.forEach(detail => {
                            tableBody.append(
                                `<tr>
                                <td>${detail.chargeName}</td>
                                <td class="text-right">${detail.chargePrice}</td>
                            </tr>`
                            );
                        });
                        $('#templateDetailCardInfo').removeAttr('hidden');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
