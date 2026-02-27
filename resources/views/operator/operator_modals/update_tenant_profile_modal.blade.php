<div class="modal fade" id="updateTenantInfoModal" tabindex="-1" role="dialog" aria-labelledby="updateTenantInfoModal"
    Label aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-11 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title">Edit Tenant Information</h4>
                        </div>

                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <form action="{{ route('operatorEditTenantInformation') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="text-center mb-3">Tenant Profile</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" hidden value="" id="editTenantId"
                                                    name="editTenantId">
                                                    <input type="text" hidden value="" id="editRoomTenantId"
                                                    name="editRoomTenantId">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantFirstName">First Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editTenantFirstName" name="editTenantFirstName"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantMiddleName">Middle Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editTenantMiddleName" name="editTenantMiddleName"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantLastName">Last Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editTenantLastName" name="editTenantLastName"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantExtName">Ext. Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editTenantExtName" name="editTenantExtName">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantContactNo">Contact Number</label>
                                                            <input type="text" class="form-control"
                                                                id="editTenantContactNo" name="editTenantContactNo"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantRoom">Room</label>
                                                            <select name="editTenantRoom" id="editTenantRoom"
                                                                class="form-control">

                                                                @foreach ($rooms as $room)
                                                                    <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantCollege">College</label>
                                                            <select name="editTenantCollege" id="editTenantCollege"
                                                                class="form-control">
                                                                <option value="" selected>Select College
                                                                </option>
                                                                @foreach ($colleges as $college)
                                                                    <option value="{{ $college->id }}">
                                                                        {{ $college->college_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editTenantProgram">Program</label>
                                                            <select name="editTenantProgram" id="editTenantProgram"
                                                                class="form-control">
                                                                <option value="" selected>Select Gender
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="editTenantPermanentAddress">Permanent Address</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantPermanentAddress"
                                                        name="editTenantPermanentAddress" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center mb-3">Guardian Profile</div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianFirstName">First Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianFirstName"
                                                                name="editGuardianFirstName" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianMiddleName">Middle Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianMiddleName"
                                                                name="editGuardianMiddleName" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianLastName">Last Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianLastName" name="editGuardianLastName"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianExtName">Ext. Name</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianExtName" name="editGuardianExtName">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianContactNo">Contact Number</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianContactNo"
                                                                name="editGuardianContactNo" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="editGuardianOccupation">Occupation</label>
                                                            <input type="text" class="form-control"
                                                                id="editGuardianOccupation"
                                                                name="editGuardianOccupation" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-success">Update</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-block btn-default">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#editTenantCollege').change(function(event) {
            var collegeId = this.value;

            $('#editTenantProgram').html('');

            $.ajax({
                url: "{{ route('operatorApiFetchPrograms') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    college_id: collegeId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#editTenantProgram').html(
                        '<option value=""> Select Program </option>');
                    $.each(response.programs, function(index, val) {
                        $('#editTenantProgram').append(
                            '<option value="' + val.id +
                            '"> ' +
                            val.program_name + ' </option>');
                    });

                }
            })
        });
    });
</script>
