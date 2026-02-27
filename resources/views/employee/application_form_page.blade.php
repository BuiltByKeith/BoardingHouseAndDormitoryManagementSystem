@extends('layouts.app')
@section('styles')
    <style>
        .nav-pills .nav-link.active {
            background-color: white;
            color: #02681e;
            font-weight: bold;
            border-radius: 0%;
            border-bottom: 3px solid #02681e;
            /* Add underline effect */
        }
    </style>
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <h3 class="text-center">Boarding House Application Form</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div id="registerTenantDiv">
                                    <!-- Navigation Panel -->
                                    <ul class="nav nav-pills justify-content-center  mb-3" id="pageNav">

                                        <li class="nav-item">
                                            <a class="nav-link active" href="#page1">Boarding House Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#page2">Document Submission</a>
                                        </li>


                                    </ul>
                                    <!-- Step 1: Basic Information -->
                                    <div class="container-fluid">
                                        <form id="requestBhRegistrationForm" method="POST"
                                            action="{{ route('submitEmployeeApplicationFormForBh') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="page" id="page1" style="margin-top: 35px">
                                                <div class="form-group">
                                                    <label for="">Boarding House Name</label>
                                                    <input type="text" name="registerBhName" id="registerBhName"
                                                        class="form-control" placeholder="Enter boarding house name here..">
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="registerBhSexAccepted">Sex Accepted</label>
                                                            <select name="registerBhSexAccepted" id="registerBhSexAccepted"
                                                                class="custom-select">
                                                                <option value="" selected>Select sex accepted
                                                                    here...
                                                                </option>
                                                                <option value="1">Male</option>
                                                                <option value="0">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="registerBhLodgingType">Lodging Type</label>
                                                            <select name="registerBhLodgingType" id="registerBhLodgingType"
                                                                class="custom-select">
                                                                <option value="" selected>Select lodging type
                                                                    here...
                                                                </option>
                                                                <option value="1">Bed Spacer</option>
                                                                <option value="2">Pad</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="registerBhClass">Classification</label>
                                                            <select name="registerBhClass" id="registerBhClass"
                                                                class="custom-select">
                                                                <option value="" selected>Select boarding house
                                                                    classification...
                                                                </option>
                                                                <option value="Private">Private</option>
                                                                <option value="Government">Government</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerBhRegion">Region</label>
                                                            <select name="registerBhRegion" id="registerBhRegion"
                                                                class="form-control">
                                                                <option value="" selected>Select a region</option>
                                                                @foreach ($regions as $region)
                                                                    <option value="{{ $region->regCode }}">
                                                                        {{ $region->regDesc }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerBhProvince">Province</label>
                                                            <select name="registerBhProvince" id="registerBhProvince"
                                                                class="form-control">
                                                                <option value="" selected>Select a Province</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerBhCity">City</label>
                                                            <select name="registerBhCity" id="registerBhCity"
                                                                class="form-control">
                                                                <option value="" selected>Select a City/Municipality
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerBhBarangay">Barangay</label>
                                                            <select name="registerBhBarangay" id="registerBhBarangay"
                                                                class="form-control">
                                                                <option value="" selected>Select a Barangay</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="registerBhStreet">Street</label>
                                                    <input type="text" class="form-control" id="registerBhStreet"
                                                        name="registerBhStreet">
                                                </div>
                                                <div class="text-center">
                                                    <p>Location</p>
                                                </div>

                                                <input type="text" id="registerBhLongitude" name="registerBhLongitude"
                                                    hidden>
                                                <input type="text" id="registerBhLatitude" name="registerBhLatitude"
                                                    hidden>

                                                {{-- MAP HERE --}}

                                                <div id="map" style="height:350px;" class="mb-3">

                                                </div>

                                                <button type="button"
                                                    class="btn btn-default next-page float-right">Next</button>

                                            </div>


                                            <div class="page" id="page2" style="display: none; margin-top: 35px;">
                                                <!-- Step 2: Additional Details -->

                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerHousingContract">Housing Contract
                                                                Document</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="registerHousingContract"
                                                                        name="registerHousingContract"
                                                                        accept="application/pdf">
                                                                    <label class="custom-file-label"
                                                                        for="registerHousingContract">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="registerPermit">Permit to Accept Lodgers
                                                                Document</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="registerPermit" name="registerPermit"
                                                                        accept="application/pdf">
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">Choose
                                                                        file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-success float-right"
                                                    onclick="openConfirmationModal()">Submit</button>
                                                <button type="button"
                                                    class="btn btn-default prev-page float-right mr-2">Previous</button>


                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('confirmation_modal')

    <script>
        function openConfirmationModal() {
            $('#confirmationQuestion').text('Are you sure that the data provided on the form are correct and true?');
            $('#confirmationModal').modal('show');
            $('#confirmButton').click(function() {
                $('#requestBhRegistrationForm').submit();
            });
        }
    </script>

    <script>
        var greenIcon = L.icon({
            iconUrl: "images/marker_default.png",
            iconSize: [48, 55],
            shadowSize: [50, 64],
            iconAnchor: [22, 94],
            shadowAnchor: [4, 62],
            popupAnchor: [-3, -76]
        });


        var map = L.map('map').setView([7.859448725237801, 125.05150566565007], 16);
        L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            center: [7.859448725237801, 125.05150566565007],
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        // Create a marker
        var marker = L.marker([7.858874809915204, 125.05249271857431], {
            icon: greenIcon,
            draggable: true // Make the marker draggable
        }).addTo(map);

        // Function to update input fields
        function updateInputFields(latlng) {
            document.getElementById('registerBhLatitude').value = latlng.lat;
            document.getElementById('registerBhLongitude').value = latlng.lng;
        }

        // Initial update
        updateInputFields(marker.getLatLng());

        // Listen for dragend event on the marker
        marker.on('dragend', function(event) {
            updateInputFields(marker.getLatLng());
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('addNewOrg');
            const pages = document.querySelectorAll('.page');
            const nextPageButtons = document.querySelectorAll('.next-page');
            const prevPageButtons = document.querySelectorAll('.prev-page');

            nextPageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (validatePage(this.closest('.page'))) {
                        nextPage(this.closest('.page'));
                    }
                });
            });

            prevPageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    prevPage(this.closest('.page'));
                });
            });

            function nextPage(currentPage) {
                const nextPage = currentPage.nextElementSibling;
                currentPage.style.display = 'none';
                nextPage.style.display = 'block';
                updatePageNav(nextPage.id);
            }

            function prevPage(currentPage) {
                const prevPage = currentPage.previousElementSibling;
                currentPage.style.display = 'none';
                prevPage.style.display = 'block';
                updatePageNav(prevPage.id);
            }

            // Update navigation panel to indicate current page
            function updatePageNav(pageId) {
                const pageNavLinks = document.querySelectorAll('#pageNav .nav-link');
                pageNavLinks.forEach(link => {
                    if (link.getAttribute('href').slice(1) === pageId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }

            function validatePage(page) {
                const inputs = page.querySelectorAll('input[required]');
                const selects = page.querySelectorAll('select[required]');
                let isValid = true;
                inputs.forEach(input => {
                    const errorMessageId = input.id + '-error';
                    let errorMessage = document.getElementById(errorMessageId);
                    if (!input.validity.valid) {
                        if (!errorMessage) {
                            errorMessage = document.createElement('div');
                            errorMessage.id = errorMessageId;
                            errorMessage.className = 'text-danger';
                            if (input.validity.valueMissing) {
                                errorMessage.textContent = 'Please fill out this field.';
                            } else if (input.validity.typeMismatch && input.type === 'email') {
                                errorMessage.textContent = 'Please enter a valid email address.';
                            } else {
                                errorMessage.textContent = 'Please enter a valid value.';
                            }
                            input.parentNode.appendChild(errorMessage);
                        }
                        isValid = false;
                    } else {
                        if (errorMessage) {
                            errorMessage.parentNode.removeChild(errorMessage);
                        }
                    }
                });
                selects.forEach(select => {
                    const errorMessageId = select.id + '-error';
                    let errorMessage = document.getElementById(errorMessageId);
                    if (!select.validity.valid) {
                        if (!errorMessage) {
                            errorMessage = document.createElement('div');
                            errorMessage.id = errorMessageId;
                            errorMessage.className = 'text-danger';
                            if (select.validity.valueMissing) {
                                errorMessage.textContent = 'Please fill out this field.';
                            } else if (select.validity.typeMismatch && select.type === 'email') {
                                errorMessage.textContent = 'Please enter a valid email address.';
                            } else {
                                errorMessage.textContent = 'Please enter a valid value.';
                            }
                            select.parentNode.appendChild(errorMessage);
                        }
                        isValid = false;
                    } else {
                        if (errorMessage) {
                            errorMessage.parentNode.removeChild(errorMessage);
                        }
                    }

                });
                return isValid;
            }

            form.addEventListener('submit', function(event) {
                $('#registerNewTenant').submit();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#registerBhRegion').change(function(event) {
                var regionId = this.value;

                $('#registerBhProvince').html('');

                $.ajax({
                    url: "{{ route('operatorApiFetchProvinces') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        region_id: regionId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#registerBhProvince').html(
                            '<option value=""> Select Province </option>');
                        $.each(response.provinces, function(index, province) {
                            $('#registerBhProvince').append(
                                '<option value="' + province.provCode +
                                '"> ' +
                                province.provDesc + ' </option>');
                        });

                    }
                })
            });
            $('#registerBhProvince').change(function(event) {
                var provinceId = this.value;
                $('#registerBhCity').html('');
                $.ajax({
                    url: "{{ route('operatorApiFetchCities') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        province_id: provinceId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#registerBhCity').html(
                            '<option value=""> Select City/Municipality </option>');
                        $.each(response.cities, function(index, city) {
                            $('#registerBhCity').append(
                                '<option value="' + city.citymunCode +
                                '"> ' +
                                city.citymunDesc + ' </option>');
                        });

                    }
                })
            });
            $('#registerBhCity').change(function(event) {
                var cityId = this.value;
                $('#registerBhBarangay').html('');
                $.ajax({
                    url: "{{ route('operatorApiFetchBarangays') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        city_id: cityId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#registerBhBarangay').html(
                            '<option value=""> Select Barangay </option>');
                        $.each(response.barangays, function(index, brgy) {
                            $('#registerBhBarangay').append(
                                '<option value="' + brgy.brgyCode +
                                '"> ' +
                                brgy.brgyDesc + ' </option>');
                        });

                    }
                })
            });
        });
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
