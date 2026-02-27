<div class="modal fade" id="addNewDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addNewDocumentModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('operatorSubmitDocumentFile') }}"
                        enctype="multipart/form-data" id="operatorSubmitDocumentFile">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="documentName">Document Name</label>
                                    <input type="text" class="form-control" id="documentName" name="documentName"
                                        placeholder="Enter document name" required>
                                </div>

                                <div class="form-group">
                                    <label for="documentFile">Document File</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="documentFile"
                                                name="documentFile" accept="application/pdf">
                                            <label class="custom-file-label" for="documentFile">Attach File
                                                Here...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="showConfirmationModal('submitConfirm')"
                            class="btn btn-block btn-success">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



