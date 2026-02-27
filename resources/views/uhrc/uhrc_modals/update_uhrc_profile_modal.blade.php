<div class="modal fade" id="uhrcPersonnelUpdateProfileModal{{$uhrcPersonnel->id}}" tabindex="-1" role="dialog" aria-labelledby="uhrcPersonnelUpdateProfileModal{{$uhrcPersonnel->id}}" Label aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update {{ $uhrcPersonnel->firstname }}'s Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('uhrcUpdateProfile') }}" enctype="multipart/form-data" id="uhrcPersonnelUpdateProfileForm">
                        @csrf
                        <div class="row">
                            <div class="text-center">
                                <p>Osa Personnel Profile</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="" name="" value="{{ $uhrcPersonnel->id }}" hidden>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileFirstname">Firstname</label>
                                            <input type="text" class="form-control" id="editUhrcProfileFirstname" name="editUhrcProfileFirstname" placeholder="Enter First name" required value="{{ $uhrcPersonnel->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileMiddlename">Middlename</label>
                                            <input type="text" class="form-control" id="editUhrcProfileMiddlename" name="editUhrcProfileMiddlename" placeholder="Enter Middle name" required value="{{ $uhrcPersonnel->middlename }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileLastname">Lastname</label>
                                            <input type="text" class="form-control" id="editUhrcProfileLastname" name="editUhrcProfileLastname" placeholder="Enter Last name" required value="{{ $uhrcPersonnel->lastname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileExtname">Extname</label>
                                            <input type="text" class="form-control" id="editUhrcProfileExtname" name="editUhrcProfileExtname" placeholder="Enter Extension name" required value="{{ $uhrcPersonnel->extname }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileSex">Sex</label>
                                            <input type="text" class="form-control" id="editUhrcProfileSex" name="editUhrcProfileSex" placeholder="Enter contact number" required value="{{ $uhrcPersonnel->sex }}">
                                        </div>
                                    </div>
                                

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileContactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="editUhrcProfileContactNumber" name="editUhrcProfileContactNumber" placeholder="Enter contact number" required value="{{ $uhrcPersonnel->contact_no }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfileEmail">Email</label>
                                            <input type="text" class="form-control" id="editUhrcProfileEmail" name="editUhrcProfileEmail" placeholder="Enter Email" required value="{{ $uhrcPersonnel->user->email }}">
                                        </div>
                                    </div>
                               

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editUhrcProfilePassword">Password</label>
                                            <input type="text" class="form-control" id="editUhrcProfilePassword" name="editUhrcProfilePassword" placeholder="Enter Password" required value="">
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
                    $('#uhrcPersonnelUpdateProfileForm').submit();
                });
            }


        }
</script>