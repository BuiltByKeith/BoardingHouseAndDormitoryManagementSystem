<div class="modal fade" id="assocPersonnelUpdateProfileModal{{$assocPersonnel->id}}" tabindex="-1" role="dialog" aria-labelledby="assocPersonnelUpdateProfileModal{{$assocPersonnel->id}}" Label aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update {{ $assocPersonnel->firstname }}'s Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('assocUpdateProfile') }}" enctype="multipart/form-data" id="assocPersonnelUpdateProfileForm">
                        @csrf
                        <div class="row">
                            <div class="text-center">
                                <p>Assoc Personnel Profile</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="" name="" value="{{ $assocPersonnel->id }}" hidden>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileFirstname">Firstname</label>
                                            <input type="text" class="form-control" id="editAssocProfileFirstname" name="editAssocProfileFirstname" placeholder="Enter First name" required value="{{ $assocPersonnel->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileMiddlename">Middlename</label>
                                            <input type="text" class="form-control" id="editAssocProfileMiddlename" name="editAssocProfileMiddlename" placeholder="Enter Middle name" required value="{{ $assocPersonnel->middlename }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileLastname">Lastname</label>
                                            <input type="text" class="form-control" id="editAssocProfileLastname" name="editAssocProfileLastname" placeholder="Enter Last name" required value="{{ $assocPersonnel->lastname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileExtname">Extname</label>
                                            <input type="text" class="form-control" id="editAssocProfileExtname" name="editAssocProfileExtname" placeholder="Enter Extension name" required value="{{ $assocPersonnel->extname }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileSex">Sex</label>
                                            <input type="text" class="form-control" id="editAssocProfileSex" name="editAssocProfileSex" placeholder="Enter contact number" required value="{{ $assocPersonnel->sex }}">
                                        </div>
                                    </div>
                                

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileContactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="editAssocProfileContactNumber" name="editAssocProfileContactNumber" placeholder="Enter contact number" required value="{{ $assocPersonnel->contact_no }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfileEmail">Email</label>
                                            <input type="text" class="form-control" id="editAssocProfileEmail" name="editAssocProfileEmail" placeholder="Enter Email" required value="{{ $assocPersonnel->user->email }}">
                                        </div>
                                    </div>
                               

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editAssocProfilePassword">Password</label>
                                            <input type="text" class="form-control" id="editAssocProfilePassword" name="editAssocProfilePassword" placeholder="Enter Password" required value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="button" onclick="showConfirmationModal('submitEditProfile')" class="btn btn-block btn-success">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-block btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal(action) {
            if (action == 'submitEditProfile') {
                $('#confirmationQuestion').text('Confirm profile edit?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#assocPersonnelUpdateProfileForm').submit();
                });
            }


        }
</script>