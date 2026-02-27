@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Boarding Houses</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>




    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="uhrcBoardingHousesTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Boarding House Name</th>
                                <th>Operator Name</th>
                                <th>Sex Accepted</th>
                                <th>Type</th>
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
    <div class="modal fade" id="boardingHouseInfoModal" tabindex="-1" role="dialog"
        aria-labelledby="boardingHouseInfoModal" Label aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Boarding House Information</h4>

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
                                                            <h5 class="text-center">Boarding House Detail</h5>
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div class="d-flex flex-column justify-content-center h-100">
                                                                <input type="text" id="bhLatInfo" name="bhLatInfo"
                                                                    value="" hidden>
                                                                <input type="text" id="bhLngInfo" name="bhLngInfo"
                                                                    value="" hidden>
                                                                <h1 class="mb-0">
                                                                    <span id="bhInfoName">asdasd</span>
                                                                </h1>

                                                                <h5 id="bhInfoType" class="mb-1">asdasd</h5>
                                                                <h5 id="bhInfoSexAccepted" class="mb-1">asdsad</h5>
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
                                                            <h5 class="text-center">Operator Detail</h5>
                                                            <!-- Use flexbox to ensure text content spreads alongside the image -->
                                                            <div class="d-flex flex-column justify-content-center h-100">

                                                                <h1 class="mb-0">
                                                                    <span id="bhOpName">asdasd</span>
                                                                </h1>

                                                                <h5 id="bhOpGender" class="mb-1">asdasd</h5>
                                                                <h5 id="bhOpContact" class="mb-1">asdsad</h5>
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

    <div class="modal fade" id="boardingHouseTenantsModal" tabindex="-1" role="dialog"
        aria-labelledby="boardingHouseTenantsModal" Label aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tenants of <span id="boardingHouseName"></span></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="bhTenantsListTable" class="table table-hover table-bordered">
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
        function refreshBoardingHousesList() {
            $.ajax({
                url: "{{ route('assocFetchBoadingHouses') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    var table = $('#uhrcBoardingHousesTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(boardingHouses) {
                        var bhId = boardingHouses.id; // Assuming bhId is the ID of the boarding house
                        table.row.add([
                            boardingHouses.bhName,
                            boardingHouses.operatorFullname,
                            boardingHouses.bhSexAccepted,
                            boardingHouses.bhType,
                            boardingHouses.bhTenantCount + '/' + boardingHouses.bhBedCount,
                            '<a href="/uhrc-boarding-house-details/' + boardingHouses.bhId +
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
            $('#uhrcBoardingHousesTable').DataTable({
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
            refreshBoardingHousesList();

        });

        function showBhInfoModal(boardingHouseName, type, sexAccepted, longitude, latitude, opName, opSex, opContact) {
            $('#bhInfoName').text(boardingHouseName);
            $('#bhLatInfo').val(latitude);
            $('#bhLngInfo').val(longitude);
            $('#bhInfoType').text(type);
            $('#bhInfoSexAccepted').text(sexAccepted);

            $('#bhOpName').text(opName);
            $('#bhOpGender').text(opSex);
            $('#bhOpContact').text(opContact);

            $('#boardingHouseInfoModal').modal('show');

            addMarkerToMap(parseFloat(latitude), parseFloat(longitude));
        }

        function showBhTenantsModal(boardingHouseName, opFullname, bhId, opId) {
            console.log(bhId);
            $.ajax({
                url: "{{ route('uhrcFetchBoardingHouseTenants') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    bh_id: bhId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#bhTenantsListTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(bhTenants) {
                        table.row.add([
                            bhTenants.studentId,
                            bhTenants.fullName,
                            bhTenants.program,
                            bhTenants.college,
                        ]);
                    });

                    table.draw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#boardingHouseName').text(boardingHouseName);
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



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmzJia-D4-HHetyvJInWrJlJQ_piS7sbI&callback=initMap" async
        defer></script>
@endsection
