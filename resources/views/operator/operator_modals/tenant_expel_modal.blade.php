<div class="modal fade" id="operatorRemoveTenantModal" tabindex="-1" role="dialog"
    aria-labelledby="operatorRemoveTenantModal" Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove Tenant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <form action="{{ route('operatorRemoveTenant') }}" method="POST"
                                enctype="multipart/form-data" id="expelTenantForm">
                                @csrf
                                <div class="col-md-12 text-center">
                                    <input type="text" value="" id="bhRoomTenantId" name="bhRoomTenantId"
                                        hidden>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="operatorRemoveTenantReason">Reason</label>
                                        <select name="operatorRemoveTenantReason" id="operatorRemoveTenantReason"
                                            class="custom-select">
                                            <option value="" selected>Select a reason here ...</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Graduated">Graduated</option>
                                            <option value="Leave of Absence">Leave of Absence</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Comment or Feedback for this tenant?</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter comment..." style="height: 150px;" id="comment"
                                            name="comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-block btn-success"
                                        onclick="expelConfirmationModal()">Remove</button>
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
</div>

<div class="modal fade" id="expelTenantConfirmationModal" tabindex="-1" role="dialog"
    aria-labelledby="expelTenantConfirmationModal" Label aria-hidden="true">
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
                                    Confirm Expel?
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
                                    id="confirmExpel">Confirm</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function expelConfirmationModal() {
        $('#expelTenantConfirmationModal').modal('show');
        $('#confirmExpel').click(function() {
            $('#expelTenantForm').submit();
        });
    }
</script>
