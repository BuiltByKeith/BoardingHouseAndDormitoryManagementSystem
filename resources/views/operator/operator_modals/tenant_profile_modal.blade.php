<div class="modal fade" id="tenantInfoModal" tabindex="-1" role="dialog" aria-labelledby="tenantInfoModal" Label
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-11 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title">Tenant Information </h4>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-sm btn-success  float-right" id="editTenantButton"
                                onclick="editTenantInformation()">Edit</button>

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
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="card text-center" style="height: 400px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                Student Information
                                            </div>
                                            <div>
                                                <img src="" alt="user-avatar" class="img-circle img-fluid"
                                                    style="width: 150px; height:auto;" id="imageProfileOfTenant">
                                                <h5 id="tenantIdNumber" class="mt-2 mb-3"><span class="mr-2"><i
                                                            class="fa-solid fa-user"></i></span>ID Number
                                                </h5>
                                                <p style="font-size: 16px;" class="mt-2 mb-1"><strong><span
                                                            id="tenantCourse">Course</span></strong>
                                                </p>
                                                <p><span id="tenantCollege">College</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column h-100">
                                        <div class="card  mb-3 flex-grow-1">
                                            <div class="card-body">
                                                <div class="mb-3 text-center">
                                                    Personal Information
                                                </div>
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-md-12">
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div
                                                                class="d-flex flex-column justify-content-center h-100">
                                                                <input type="text" hidden value=""
                                                                    id="id" name="id">
                                                                <h2 class="mb-0"><span id="tenantFirstName"></span>
                                                                    <span id="tenantMiddleName"></span> <span
                                                                        id="tenantLastName"></span>
                                                                    <span id="tenantExtName"></span>
                                                                </h2>



                                                                <p class="mb-1"><span class="mr-2"><i
                                                                            class="fa-solid fa-venus-mars"></i></span><span
                                                                        id="tenantGenderSex"></span></p>
                                                                <p class="mb-1"><span class="mr-2"><i
                                                                            class="fa-solid fa-phone"></i></span>
                                                                    <span id="tenantContact"></span>
                                                                </p>
                                                                <p class="mb-1"><span class="mr-2"><i
                                                                            class="fa-solid fa-home"></i></span>
                                                                    <span id="tenantAddress"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card  mb-3 flex-grow-1">
                                            <div class="card-body">
                                                <div class="mb-3 text-center">
                                                    Guardian Information
                                                </div>
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-md-12">
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div
                                                                class="d-flex flex-column justify-content-center h-100">
                                                                <input type="text" hidden value=""
                                                                    id="id" name="id">
                                                                <h3 class="mb-2"><span
                                                                        id="tenantGuardianFullname"></span>
                                                                </h3>
                                                                <p class="mb-1"><span class="mr-2"><i
                                                                            class="fa-solid fa-phone"></i></span><span
                                                                        id="tenantGuardianContactNo"></span></p>
                                                                <p class="mb-1"><span class="mr-2"><i
                                                                            class="fa-solid fa-briefcase"></i></span><span
                                                                        id="tenantGuardianOccupation"></span></p>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('operator.operator_modals.update_tenant_profile_modal')

<script>
    function editTenantInformation() {
        $('#updateTenantInfoModal').modal('show');
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#editCollege').change(function(event) {
            var collegeId = this.value;

            $('#editProgram').html('');

            $.ajax({
                url: "{{ route('operatorApiFetchPrograms') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    college_id: collegeId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#editProgram').html('<option value=""> Select Program </option>');
                    $.each(response.programs, function(index, val) {
                        $('#editProgram').append(
                            '<option value="' + val.id +
                            '"> ' +
                            val.program_name + ' </option>');
                    });

                }
            })
        });



        $('#editRegion').change(function(event) {
            var regionId = this.value;

            $('#editProvince').html('');

            $.ajax({
                url: "{{ route('operatorApiFetchProvinces') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    region_id: regionId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#editProvince').html('<option value=""> Select Province </option>');
                    $.each(response.provinces, function(index, province) {
                        $('#editProvince').append(
                            '<option value="' + province.provCode +
                            '"> ' +
                            province.provDesc + ' </option>');
                    });

                }
            })
        });
        $('#editProvince').change(function(event) {
            var provinceId = this.value;
            $('#editCity').html('');
            $.ajax({
                url: "{{ route('operatorApiFetchCities') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    province_id: provinceId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#editCity').html(
                        '<option value=""> Select City/Municipality </option>');
                    $.each(response.cities, function(index, city) {
                        $('#editCity').append(
                            '<option value="' + city.citymunCode +
                            '"> ' +
                            city.citymunDesc + ' </option>');
                    });

                }
            })
        });
        $('#editCity').change(function(event) {
            var cityId = this.value;
            $('#editBarangay').html('');
            $.ajax({
                url: "{{ route('operatorApiFetchBarangays') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    city_id: cityId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#editBarangay').html('<option value=""> Select Barangay </option>');
                    $.each(response.barangays, function(index, brgy) {
                        $('#editBarangay').append(
                            '<option value="' + brgy.brgyCode +
                            '"> ' +
                            brgy.brgyDesc + ' </option>');
                    });

                }
            })
        });
    });
</script>
