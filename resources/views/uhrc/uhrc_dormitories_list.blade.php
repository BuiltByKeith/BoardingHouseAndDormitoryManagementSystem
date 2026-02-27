D@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Dormitories</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>




    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="uhrcDormitoriesTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Dormitory Name</th>
                                <th>Dorm Manager Name</th>
                                <th>Sex Accepted</th>
                                <th>Vacancy</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dormitoryInfoModal" tabindex="-1" role="dialog"
        aria-labelledby="dormitoryInfoModal" Label aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Dormitory Information</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-md-12">
                                                            <h5 class="text-center">Dormitory Detail</h5>
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div class="d-flex flex-column justify-content-center h-100">
                                                                <input type="text" id="dormLatInfo" name="dormLatInfo"
                                                                    value="" hidden>
                                                                <input type="text" id="dormLngInfo" name="dormLngInfo"
                                                                    value="" hidden>
                                                                <h1 class="mb-0">
                                                                    <span id="dormInfoName">asdasd</span>
                                                                </h1>
                                                                <h5 id="dormInfoSexAccepted" class="mb-1">asdsad</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="col-md-12">
                                                            <h5 class="text-center">Dorm Manager Detail</h5>
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div class="d-flex flex-column justify-content-center h-100">

                                                                <h1 class="mb-0">
                                                                    <span id="dormDmName">asdasd</span>
                                                                </h1>

                                                                <h5 id="dormDmGender" class="mb-1">asdasd</h5>
                                                                <h5 id="dormDmContact" class="mb-1">asdsad</h5>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center">Location</h5>
                                                <div id="map" style="height: 500px"></div>

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

    <div class="modal fade" id="dormitoryTenantsModal" tabindex="-1" role="dialog"
        aria-labelledby="dormitoryTenantsModal" Label aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tenants of <span id="dormitoryName"></span></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="dormTenantsListTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Student Name</th>
                                            <th>Program</th>
                                            <th>College</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function refreshDormitoriesList() {
            $.ajax({
                url: "{{ route('uhrcFetchDormitories') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    var table = $('#uhrcDormitoriesTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(dormitories) {
                        var dormId = dormitories.id; // Assuming bhId is the ID of the boarding house
                        table.row.add([
                            dormitories.dormName,
                            dormitories.dmFullname,
                            dormitories.dormSexAccepted,
                            dormitories.dormTenantCount + '/' + dormitories.dormBedCount,
                            '<a href="/uhrc-dormitory-details/' + dormitories.dormId +
                            '"><button class="btn btn-success btn-sm"><i class="fas fa-list"></i></button></a>'
                        ]);
                    });

                    table.draw(); // Redraw table
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
        }


        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        // Function to hide loading indicator
        function hideLoadingIndicator() {
            setTimeout(function() {
                $('#loadingIndicator').hide();
            }, 1000);
        }
        $(document).ready(function() {

            // Initialize the DataTable
            $('#uhrcDormitoriesTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 8,

            });

            $('#bhTenantsListTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 5,

            });


            // Call the function to fetch and populate data in the table
            refreshDormitoriesList();

        });

        function showBhInfoModal(dormitoryName, sexAccepted, longitude, latitude, dmName, dmSex, dmContact) {
            $('#dormInfoName').text(boardingHouseName);
            $('#dormLatInfo').val(latitude);
            $('#dormLngInfo').val(longitude);
            $('#dormInfoType').text(type);
            $('#dormInfoSexAccepted').text(sexAccepted);

            $('#dormDmName').text(dmName);
            $('#dormDmGender').text(dmSex);
            $('#dormDmContact').text(dmContact);

            $('#boardingHouseInfoModal').modal('show');

            addMarkerToMap(parseFloat(latitude), parseFloat(longitude));
        }

        function showBhTenantsModal(dormitoryName, dmFullname, dormId, dmId) {
            console.log(bhId);
            $.ajax({
                url: "{{ route('uhrcFetchDormitoryTenants') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    dorm_id: dormId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#dormTenantsListTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(dormTenants) {
                        table.row.add([
                            dormTenants.studentId,
                            dormTenants.fullName,
                            dormTenants.program,
                            dormTenants.college,
                        ]);
                    });

                    table.draw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#dormitoryName').text(dormitoryName);
            $('#boardingHouseTenantsModal').modal('show');
        }

        function addMarkerToMap(lat, lng) {
            clearMarkers(); // Remove any existing markers
            const myLatLng = {
                lat: lat,
                lng: lng
            };
            const marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
            map.setCenter(myLatLng); // Center the map on the marker

            // Calculate an appropriate zoom level based on the distance you want the map to zoom in
            const zoomLevel = 18; // Adjust this value as needed
            map.setZoom(zoomLevel);

            markers.push(marker); // Save the marker reference
        }


        function clearMarkers() {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null); // Remove the marker from the map
            }
            markers = []; // Reset the markers array
        }

        $('#boardingHouseInfoModal').on('hidden.bs.modal', function() {
            clearMarkers(); // Remove the marker when the modal is closed
        });
    </script>

    <script>
        let map;
        let markers = [];

        function initMap() {


            let lat = 7.8592;
            let lng = 125.0515;



            const myLatLng = {
                lat: lat,
                lng: lng
            };
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

        }
    </script>



    <script src="https://maps.googleapis.com/maps/api/js?key=yourKeyHere=initMap" async
        defer></script>
@endsection
