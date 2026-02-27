<div class="modal fade" id="osaPersonnelUpdateProfileModal{{$osaPersonnel->id}}" tabindex="-1" role="dialog" aria-labelledby="osaPersonnelUpdateProfileModal{{$osaPersonnel->id}}" Label aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update {{ $osaPersonnel->firstname }}'s Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <!-- Step 1: Basic Information -->
                <div class="container-fluid">
                    <form method="POST" action="{{ route('osaUpdateProfile') }}" enctype="multipart/form-data" id="osaPersonnelUpdateProfileForm">
                        @csrf
                        <div class="row">
                            <div class="text-center">
                                <p>Osa Personnel Profile</p>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="" name="" value="{{ $osaPersonnel->id }}" hidden>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileFirstname">Firstname</label>
                                            <input type="text" class="form-control" id="editOsaProfileFirstname" name="editOsaProfileFirstname" placeholder="Enter First name" required value="{{ $osaPersonnel->firstname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileMiddlename">Middlename</label>
                                            <input type="text" class="form-control" id="editOsaProfileMiddlename" name="editOsaProfileMiddlename" placeholder="Enter Middle name" required value="{{ $osaPersonnel->middlename }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileLastname">Lastname</label>
                                            <input type="text" class="form-control" id="editOsaProfileLastname" name="editOsaProfileLastname" placeholder="Enter Last name" required value="{{ $osaPersonnel->lastname }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileExtname">Extname</label>
                                            <input type="text" class="form-control" id="editOsaProfileExtname" name="editOsaProfileExtname" placeholder="Enter Extension name" required value="{{ $osaPersonnel->extname }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileSex">Sex</label>
                                            <input type="text" class="form-control" id="editOsaProfileSex" name="editOsaProfileSex" placeholder="Enter contact number" required value="{{ $osaPersonnel->sex }}">
                                        </div>
                                    </div>
                                

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileContactNumber">Contact Number</label>
                                            <input type="text" class="form-control" id="editOsaProfileContactNumber" name="editOsaProfileContactNumber" placeholder="Enter contact number" required value="{{ $osaPersonnel->contact_no }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfileEmail">Email</label>
                                            <input type="text" class="form-control" id="editOsaProfileEmail" name="editOsaProfileEmail" placeholder="Enter Email" required value="{{ $osaPersonnel->user->email }}">
                                        </div>
                                    </div>
                               

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editOsaProfilePassword">Password</label>
                                            <input type="text" class="form-control" id="editOsaProfilePassword" name="editOsaProfilePassword" placeholder="Enter Password" required value="">
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
                    $('#osaPersonnelUpdateProfileForm').submit();
                });
            }


        }
</script>