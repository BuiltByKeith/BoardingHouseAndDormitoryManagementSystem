<div class="modal fade" id="uploadBoardingHousePhoto" tabindex="-1" role="dialog"
    aria-labelledby="uploadBoardingHousePhoto" Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Boarding House Photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('operatorUploadBhPhoto') }}" enctype="multipart/form-data"
                        id="operatorUploadBhPhoto">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="uploadBhPhoto">Upload a picture here</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="uploadBhPhoto"
                                                name="uploadBhPhoto" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" for="uploadBhPhoto">Attach Image
                                                Here...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="showConfirmationModal('uploadConfirm')"
                            class="btn btn-block btn-success">Upload</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
