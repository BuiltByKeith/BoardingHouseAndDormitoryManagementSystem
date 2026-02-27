<div class="modal fade" id="dormManagerAddNewRoomModal" tabindex="-1" role="dialog"
    aria-labelledby="dormManagerAddNewRoomModal" Label aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('dormManagerAddNewRoom') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="dormManagerDormRoomName">Room Name</label>
                                    <input type="text" class="form-control" id="dormManagerDormRoomName"
                                        name="dormManagerDormRoomName" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dormManagerDormRoomPrice">Room Price</label>
                                            <input type="text" class="form-control" id="dormManagerDormRoomPrice"
                                                name="dormManagerDormRoomPrice" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dormManagerDormRoomNoOfBeds">Number of Beds</label>
                                            <input type="text" class="form-control" id="dormManagerDormRoomNoOfBeds"
                                                name="dormManagerDormRoomNoOfBeds" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Add</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
