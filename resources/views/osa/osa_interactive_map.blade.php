<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMU | BDMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Bootstrap 5 JS -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



    {{-- Toaster --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    @vite(['resources/sass/app.scss'])

    <!-- Your custom styles -->

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- DataTables & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    {{-- Font Awesome Icons JS Plugins --}}
    <script src="{{ asset('fontawesome-free-6.5.1-web/js/all.min.js') }}"></script>

    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-yellow">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        {{ Auth::user()->employee->firstname }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-3">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/cmulogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" style="color:white"><strong>CMU | BDMS</strong></span>
            </a>

            @foreach (auth()->user()->roles as $role)
            @include('layouts.navigations.' . $role->role_name . '_navigations')
            @endforeach
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <div id="loadingIndicator" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); z-index: 9999;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                        <div class="row">
                            <div class="spinner-grow ml-1" role="status" style="color:#ffc600">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1 text-warning" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" role="status" style="color: #919f02">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" role="status" style="color: #02681e">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow ml-1" role="status" style="color: #00491e">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <div class="container-fluid ml-3 mr-3">
                        <div class="row mb-2">
                            <div class="col-sm-6 mt-2">
                                <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Interactive Map</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6 mt-2">
                                <ol class="breadcrumb float-right">
                                    <div class="input-group">

                                        <div class="input-group">
                                            <select class="custom-select" id="filterType">
                                                <option value="">Filter By:</option>
                                                <option value="boardingHouse">Boarding House</option>
                                                <option value="dormitory">Dormitory</option>
                                            </select>


                                            <!-- Filter for Dormitories -->
                                            <div class="input-group" id="filterDormitory" style="display: none;">
                                                <!-- Include the same classes or styles as the rest of the filters -->
                                                <select class="custom-select" id="filterByDorms">
                                                    <option value="">Filter By:</option>
                                                    <option value="Sex">Sex</option>
                                                </select>
                                                <select class="custom-select" id="filterSelectDorms" style="display: none;">
                                                    <option value="">Select Filter</option>
                                                </select>
                                                <input type="text" class="form-control filterInput" id="searchDorms" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button id="searchBtnDorms" class="btn btn-success form-control filterBtn"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>

                                            <!-- Filter for Boarding Houses -->
                                            <div class="input-group" id="filterBoardingHouse" style="display: none;">
                                                <!-- Include the same classes or styles as the rest of the filters -->
                                                <select class="custom-select" id="filterBy">
                                                    <option value="">Filter By:</option>
                                                    <option value="Sex">Sex</option>
                                                    <option value="HousingType">Housing Type</option>
                                                </select>
                                                <select class="custom-select" id="filterSelect" style="display: none;">
                                                    <option value="">Select Filter</option>
                                                </select>
                                                <input type="text" class="form-control filterInput" id="searchBh" placeholder="Search Boarding Houses">
                                                <div class="input-group-append">
                                                    <button id="searchBtnBh" class="btn btn-success form-control filterBtn"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>

                            </ol>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>




            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Map container -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" id="mapSizeFormat">
                                            <div id="map" style="height: 750px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dormitory List -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Dormitories List</h5>
                                    <div id="dormList" style="height: 320px;  overflow:auto">
                                        <!-- List view content will be dynamically generated here -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5>Boarding Houses List</h5>
                                    <div id="boardingHouseList" style="height: 330px;  overflow:auto">
                                        <!-- List view content will be dynamically generated here -->
                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>
                </div>

                <!-- Dormitory Information Offcanvas -->
                <div class="offcanvas offcanvas-end" style="width: 70vmin;" tabindex="-1" id="dormMoreInfoOffCanvas" aria-labelledby="dormMoreInfoOffCanvas">
                    <div class="offcanvas-header bg-yellow">
                        <h5 id="dormMoreInfoOffCanvasTitle">Dormitory Information</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Carousel -->
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/sampleBh.jpg" class="d-block w-100" alt="Carousel Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/sampleBh2.jpg" class="d-block w-100" alt="Carousel Image 2">
                                </div>
                                <!-- Add more carousel items as needed -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p class="text-center">Dormitory</p>
                            <h3 class="text-center"> <strong><span id="ocDormName"></span></strong></h3>
                            <p class="text-center"><img src="{{ asset('images/male_avatar.svg') }}" alt="" style="width: 80px; height: 80px;"></p>
                            <h5 class="text-center"> <strong><span id="ocDmName"></span></strong></h5>
                            <p class="text-center">Dorm Manager</p>
                            <h5><i class="fas fa-venus-mars mr-2"></i>Accepts: <span id="ocDormGenderAccepted"></span> Boarders</h5>
                            <h5>Occupancy: <strong><span id="ocDormTenantCount"></span></strong> / <strong><span id="ocDormBedCount"></span></strong></h5>
                        </div>


                    </div>
                </div>

                <!-- Boarding House Information Offcanvas -->
                <div class="offcanvas offcanvas-end" style="width: 70vmin;" tabindex="-1" id="bhMoreInfoOffCanvas" aria-labelledby="bhMoreInfoOffCanvas">
                    <div class="offcanvas-header bg-yellow">
                        <h5 id="bhMoreInfoOffCanvasTitle">Boarding House Information</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <!-- Carousel -->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('images/sampleBh.jpg') }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('images/sampleBh2.jpg') }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('images/sampleBh.jpg') }}" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="col-md-12">
                            <p class="text-center">Boarding House</p>
                            <h3 class="text-center"> <strong><span id="ocBhName"></span></strong></h3>
                            <p class="text-center"><img src="{{ asset('images/male_avatar.svg') }}" alt="" style="width: 80px; height: 80px;"></p>
                            <h5 class="text-center"> <strong><span id="ocOperatorName"></span></strong></h5>
                            <p class="text-center">Operator</p>
                            <h5><i class="fas fa-bed mr-2"></i><span id="ocBhType"></span></h5>
                            <h5><i class="fas fa-venus-mars mr-2"></i>Accepts: <span id="ocBhGenderAccepted"></span> Boarders</h5>
                            <h5>Occupancy: <strong><span id="ocBhTenantCount"></span></strong> / <strong><span id="ocBhBedCount"></span></strong></h5>
                        </div>


                    </div>
                </div>



            </section>

            <script>
                var greenIcon = L.icon({
                    iconUrl: "images/marker_default.png",
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var dormIcon = L.icon({
                    iconUrl: 'images/marker_dorm.png',
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var selectedSex = "";
                var selectedHousingType = "";
                var maleIcon = L.icon({
                    iconUrl: 'images/marker_male.png',
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });
                var femaleIcon = L.icon({
                    iconUrl: 'images/marker_female.png',
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });

                var BedSpacerIcon = L.icon({
                    iconUrl: 'images/marker_bedspacer.png',
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });
                var PodIcon = L.icon({
                    iconUrl: 'images/marker_pod.png',
                    iconSize: [28, 35],
                    shadowSize: [50, 64],
                    iconAnchor: [22, 94],
                    shadowAnchor: [4, 62],
                    popupAnchor: [-3, -76]
                });
                let useIcon = null
                var map = L.map('map').setView([7.859700529760978, 125.05071376673064], 15);
                L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {

                    center: [7.859700529760978, 125.05071376673064],
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']

                }).addTo(map);
                setTimeout(() => {
                    map.panTo(new L.LatLng(7.859700529760978, 125.05071376673064));
                });

                fetchBoardingHouses();
                fetchDormitories();



                $(document).ready(function() {
                    $('#filterType').change(function() {
                        var filterType = $(this).val();
                        if (filterType === "boardingHouse") {
                            $('#filterBoardingHouse').show();
                            $('#filterDormitory').hide();
                        } else if (filterType === "dormitory") {
                            $('#filterDormitory').show();
                            $('#filterBoardingHouse').hide();
                        } else {
                            $('#filterDormitory').hide();
                            $('#filterBoardingHouse').hide();
                        }
                    });

                    // Rest of your existing JavaScript code for filterDorms and filterBoardingHouse functions
                });

                // Add event listener to the filter dropdowns
                $('#filterByDorms').change(function() {
                    const dormitoryMaps = @json($dormitories);
                    dormitoryMaps.forEach(function(element) {
                     
                        if (element.dormLat && element.dormLng) {
                            var marker = L.marker([element.dormLat, element.dormLng], {
                                icon: dormIcon
                            }).addTo(map);
                        }
                    });

                    selectedSex = ""
                    useIcon = dormIcon

                    var filterType = $(this).val();
                    $('#filterSelectDorms').html('<option value="">Select Filter</option>'); // Reset filter options
                    if (filterType === "Sex") {
                        // Populate sex filter options
                        $('#filterSelectDorms').html('<option value="">Select Filter</option>'); // Reset filter options
                        $('#filterSelectDorms').append('<option value="Male">Male</option>');
                        $('#filterSelectDorms').append('<option value="Female">Female</option>');
                    } else if (filterType === "") {
                        // Hide filterSelect when no option is selected in filterBy
                        $('#filterSelectDorms').hide();
                        fetchDormitories()
                        map.setView([7.859700529760978, 125.05071376673064], 15);
                    }

                    // Show filterSelect when an option is selected in filterBy
                    if (filterType !== "") {
                        $('#filterSelectDorms').show();
                    }
                });

                // Add event listener to the filter select dropdown
                $('#filterSelectDorms').change(function() {
                    console.log("Filter Select dropdown changed");

                    var filterValue = $(this).val();
                    console.log("Filter Value:", filterValue);
                    if ($('#filterByDorms').val() === "Sex") {
                        selectedSex = filterValue;
                    }

                    fetchDormitories();
                });

                // Add event listener to the search button
                $('#searchBtn').click(function() {
                    var searchQuery = document.getElementById('searchDorms').value;
                    fetchDormitories(searchQuery);
                });

                // Add event listener to the search input for Enter key press
                $('#searchDorms').on('keypress', function(event) {
                    if (event.which === 13) { // Check if the key pressed is "Enter" (key code 13)
                        console.log('Enter key pressed');
                        var searchQuery = $(this).val();
                        fetchDormitories(searchQuery);
                    }
                });

                // Add event listener to the search input for input changes
                var input = document.getElementById("searchDorms");
                input.addEventListener("input", function() {
                    // Get the input value
                    var inputValue = input.value.trim(); // Trim whitespace from input value

                    // Check if the input value is empty
                    if (inputValue === "") {
                        // Check if both filter dropdowns are empty
                        if (selectedSex === "") {
                            fetchDormitories(); // Reset to default data
                            map.setView([7.859700529760978, 125.05071376673064], 15); // Zoom out the map
                        } else {
                            // Fetch boarding houses with empty search query
                            fetchDormitories("");
                        }
                    }
                });



                function searchDataDorms(value) {
                    var listView = document.getElementById('dormList');
                    var listContent = '';
                    value.forEach(function(dormitory) {
                        // Customize the list item based on your data structure
                        const escapedDormName = dormitory.dormName.replace(/'/g, "\\'");
                        listContent += '<li class="list-group-item d-flex justify-content-between">' + dormitory.dormName + '<button id="profileBtn" class="btn btn-success btn-sm" onclick="openMoreInfoCanvasDorm(\'' +
                            escapedDormName + '\', \'' + dormitory.dormSexAccepted + '\', \'' + dormitory.dmFullname + '\', \'' +
                            dormitory.dormSexAccepted + '\', \'' + dormitory.dmContact + '\', \'' + dormitory.dormTenantCount + '\', \'' + dormitory.dormBedCount +
                            '\', \'' + dormitory.dormLat + '\', \'' + dormitory.dormLng +
                            '\')"><i class="fas fa-info"></i></button>' + '</li>';
                        // Add more details as needed
                        if (dormitory.dormLat && dormitory.dormLng) {
                            let icon = null
                            if (selectedSex !== '') {
                                if (selectedSex === "Male") {
                                    icon = maleIcon
                                    console.log('Male')
                                } else if (selectedSex === "Female") {
                                    icon = femaleIcon
                                    console.log('Female')
                                }
                            } else {
                                icon = dormIcon
                            }
                            console.log('dormitory:-----', dormitory)
                            var marker = L.marker([dormitory.dormLat, dormitory.dormLng], {
                                icon: icon
                            }).addTo(map);
                            const escapedDormName = dormitory.dormName.replace(/'/g, "\'");
                            const dormName = dormitory.dormName.replace(`'`, `\\'`);
                            const dormSexAccepted = dormitory.dormSexAccepted
                            const dmFullname = dormitory.dmFullname
                            const dmContact = dormitory.dmContact
                            const dormTenantCount = dormitory.dormTenantCount;
                            const dormBedCount = dormitory.dormBedCount;
                            infoWindowContent =
                                '<div class="info_content">' +
                                `<h5>${escapedDormName}  </h5>` +
                                // Use template literals for variable interpolation
                                `<p><img src="{{ asset('images/male_avatar.svg') }}" alt="" style="width: 60px; height: 60px;"> ${dormitory.dmFname} ${dormitory.dmMname} ${dormitory.dmLname}</p>` +
                                `<p>Accepts: ${dormitory.dormSexAccepted} Boarders</p>` +
                                `<p>Occupancy: ${dormitory.dormTenantCount} / ${dormitory.dormBedCount}</p>` +
                                `<p>Contact: ${dmContact}</p>` +
                                '<button id="profileBtn" class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvasDorm(\'' +
                                dormName + '\', \'' + dormSexAccepted + '\', \'' + dmFullname + '\', \'' +
                                dormitory.dmSex + '\', \'' + dmContact + '\', \'' + dormTenantCount + '\', \'' + dormBedCount +
                                '\')">More Info</button>' +
                                '</div>';
                            // Bind popup content to the marker
                            marker.bindPopup(infoWindowContent);
                            // Update the content of the list view
                            listView.innerHTML = listContent;
                        }
                    });
                }
                // Function to fetch dormitory based on search query, category, and sex filter
                function fetchDormitories(searchQuery) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Make an AJAX request to fetch dormitory based on search query, category, and sex filter
                    $.ajax({
                        url: 'osa-fetch-dormitories-map',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                        },
                        data: {
                            search_query: searchQuery,
                            sex_filter: selectedSex,

                        },
                        success: function(response) {
                            console.log('Received response from server:', response);
                            searchDataDorms(response);
                            updateMarkersAndViewDorm(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching boarding houses:', error);
                            toastr.error('Failed to fetch boarding houses. Please try again later.');
                        }
                    });
                }

                function updateMarkersAndViewDorm(data) {
                    // Clear existing markers
                    map.eachLayer(function(layer) {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });
                    var bounds = []; // Array to hold the bounds of all markers
                    // Update map markers
                    data.forEach(function(element) {
                        if (element.dormLat && element.dormLng) {
                            let icon = null;
                            if (selectedSex === "Male") {
                                icon = maleIcon;
                            } else if (selectedSex === "Female") {
                                icon = femaleIcon;
                            } else {
                                if (selectedHousingType === "1") {
                                    icon = BedSpacerIcon;
                                } else if (selectedHousingType === "2") {
                                    icon = PodIcon;
                                }
                            }
                            if (!icon) {
                                icon = dormIcon; // Default icon
                            }
                            var marker = L.marker([element.dormLat, element.dormLng], {
                                icon: icon
                            }).addTo(map);
                            // Add marker to bounds
                            bounds.push([element.dormLat, element.dormLng]);
                            console.log('element: ', element.dmFname)
                            const escapedDormName = element.dormName.replace(/'/g, "");
                            const dmFirstname = element.dmFname
                            const dmMiddlename = element.dmMname
                            const dmLastname = element.dmLname
                            infoWindowContent =
                                '<div class="info_content">' +
                                `<h5>${element.dormName}</h5>` +
                                `<p>${dmFirstname} ${dmMiddlename} ${dmLastname}</p>` +
                                `<p>${element.dormSexAccepted}'s Boarding House</p>` +
                                '<button id="profileBtn" class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvasDorm(\'' +
                                element.dormName.replace(`'`, `sshabbyy`) + '\', \'' + element.dormSexAccepted + '\', \'' + element.dmFullname + '\', \'' +
                                element.dmSex + '\', \'' + element.fmContact + '\', \'' + element.dormTenantCount + '\', \'' + element.dormBedCount +
                                '\', \'' + element.dormLat + '\', \'' + element.dormLng +
                                '\')">More Info</button>';
                            // Bind popup content to the marker
                            // marker.bindPopup(infoWindowContent).openPopup();
                        }
                    });
                    // Check if all filters are empty
                    var filtersEmpty = $('#filterByDorms').val() === "" && $('#filterSelectDorms').val() === "" && $('#searchDorms').val() === "";
                    // If there are markers and filters are not selected or search box is empty, zoom out the map
                    if (bounds.length > 0 && filtersEmpty) {
                        map.fitBounds(bounds);
                    } else {
                        // Otherwise, if there are markers, fit the map to their bounds
                        if (bounds.length > 0) {
                            map.fitBounds(bounds);
                        }
                    }
                    // Update list view
                    $('#dormList').empty();
                    searchDataDorms(data)
                    data.forEach(function(element) {
                        console.log('dormitoryList: ', element)
                    });

                }

                function openMoreInfoCanvasDorm(dormName, dormSexAccepted, dmFullname, dmSex, dmContactNo, dormTenantCount, dormBedCount, dormLat, dormLng) {
                    // console.log('Open More Info Canvas Function Called:');
                    $('#ocDormName').text(dormName.replace(`sshabbyy`, `'s`));
                    $('#ocDormGenderAccepted').text(dormSexAccepted);
                    $('#ocDormTenantCount').text(dormTenantCount);
                    $('#ocDormBedCount').text(dormBedCount);
                    $('#ocDmName').text(dmFullname);
                    $('#ocDmSex').text(dmSex);
                    $('#ocDmContactNo').text(dmContactNo);
                    $('#dormMoreInfoOffCanvas').offcanvas('show');
                    // Check if coordinates are provided
                    if (dormLat !== undefined && dormLng !== undefined) {

                        // Set map view to marker's coordinates and appropriate zoom level
                        let icon = null
                        if (selectedSex !== '') {
                            if (selectedSex === "Male") {
                                icon = maleIcon
                                console.log('Male')
                            } else if (selectedSex === "Female") {
                                icon = femaleIcon
                                console.log('Female')
                            }
                        } else {
                            icon = dormIcon
                        }
                        var marker = L.marker([dormLat, dormLng], {
                            icon: icon
                        }).addTo(map);
                        var infoWindowContent =
                            '<div class="info_content">' +
                            '<h5>' + dormName + '</h5>' +
                            '<p>' + '<img src="{{ asset("images/male_avatar.svg") }}" alt="" style="width: 60px; height: 60px;"> ' + dmFullname + '</p>' +
                            '<p>' + 'Accepts: ' + dormSexAccepted + " Boarders</p>" +
                            '<p>' + 'Occupancy: ' + dormTenantCount + ' / ' + dormBedCount + "</p>" +
                            '<p>' + 'Contact: ' + dmContactNo + "</p>" +
                            '<button class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvasDorm(\'' +
                            dormName.replace(`'s`, 'sshabbyy') + '\', \'' + dormSexAccepted + '\', \'' +
                            dmFullname + '\', \'' +
                            dmSex + '\', \'' + dmContactNo + '\', \'' + dormTenantCount + '\', \'' + dormBedCount +
                            '\')">More Info</button>' +
                            '</div>';
                        marker.bindPopup(infoWindowContent).openPopup();
                    } else {
                        console.error('Invalid marker coordinates:', dormLat, dormLng);
                    }
                    // Add event listener to close the offcanvas and zoom out when closed
                    $('#dormMoreInfoOffCanvas').on('hidden.bs.offcanvas', function() {
                        // Zoom out to initial map view
                        map.setView([7.859700529760978, 125.05071376673064], 15);
                    });
                }

                //BOARDING HOUSE MAP FETCH
                // Add event listener to the filter dropdowns
                $('#filterBy').change(function() {
                    const boardingHouseMaps = @json($boardingHouses);
                    boardingHouseMaps.forEach(function(element) {
                        console.log("Boarding Houses:", boardingHouseMaps);
                        // Check if both latitude and longitude are present
                        if (element.bhLat && element.bhLng) {
                            var marker = L.marker([element.bhLat, element.bhLng], {
                                icon: greenIcon
                            }).addTo(map);
                        }
                    });

                    selectedSex = ""
                    selectedHousingType = ""
                    useIcon = greenIcon
                    console.log(useIcon)

                    var filterType = $(this).val();
                    $('#filterSelect').html('<option value="">Select Filter</option>'); // Reset filter options
                    if (filterType === "Sex") {
                        // Populate sex filter options
                        $('#filterSelect').html('<option value="">Select Filter</option>'); // Reset filter options
                        $('#filterSelect').append('<option value="Male">Male</option>');
                        $('#filterSelect').append('<option value="Female">Female</option>');
                    } else if (filterType === "HousingType") {
                        // Populate housing type filter options
                        $('#filterSelect').html('<option value="">Select Filter</option>'); // Reset filter options
                        $('#filterSelect').append('<option value="1">Bed Spacer</option>');
                        $('#filterSelect').append('<option value="2">Pad</option>');
                    } else if (filterType === "") {
                        // Hide filterSelect when no option is selected in filterBy
                        $('#filterSelect').hide();
                        fetchBoardingHouses()
                        map.setView([7.859700529760978, 125.05071376673064], 15);
                    }

                    // Show filterSelect when an option is selected in filterBy
                    if (filterType !== "") {
                        $('#filterSelect').show();
                    }
                });

                // Add event listener to the filter select dropdown
                $('#filterSelect').change(function() {
                    console.log("Filter Select dropdown changed");

                    var filterValue = $(this).val();
                    console.log("Filter Value:", filterValue);
                    if ($('#filterBy').val() === "Sex") {
                        selectedSex = filterValue;
                    }

                    if ($('#filterBy').val() === "HousingType") {
                        selectedHousingType = filterValue;
                    }

                    fetchBoardingHouses();
                });

                // Add event listener to the search button
                $('#searchBtn').click(function() {
                    var searchQuery = document.getElementById('searchBh').value;
                    fetchBoardingHouses(searchQuery);
                });

                // Add event listener to the search input for Enter key press
                $('#searchBh').on('keypress', function(event) {
                    if (event.which === 13) { // Check if the key pressed is "Enter" (key code 13)
                        console.log('Enter key pressed');
                        var searchQuery = $(this).val();
                        fetchBoardingHouses(searchQuery);
                    }
                });

                // Add event listener to the search input for input changes
                var input = document.getElementById("searchBh");
                input.addEventListener("input", function() {
                    // Get the input value
                    var inputValue = input.value.trim(); // Trim whitespace from input value

                    // Check if the input value is empty
                    if (inputValue === "") {
                        // Check if both filter dropdowns are empty
                        if (selectedSex === "" && selectedHousingType === "") {
                            fetchBoardingHouses(); // Reset to default data
                            map.setView([7.859700529760978, 125.05071376673064], 15); // Zoom out the map
                        } else {
                            // Fetch boarding houses with empty search query
                            fetchBoardingHouses("");
                        }
                    }
                });



                function searchData(value) {
                    var listView = document.getElementById('boardingHouseList');
                    var listContent = '';
                    value.forEach(function(boardingHouse) {
                        // Customize the list item based on your data structure
                        const escapedBhName = boardingHouse.bhName.replace(/'/g, "\\'");
                        listContent += '<li class="list-group-item d-flex justify-content-between">' + boardingHouse.bhName + '<button id="profileBtn" class="btn btn-success btn-sm" onclick="openMoreInfoCanvas(\'' +
                            escapedBhName + '\', \'' + boardingHouse.bhType + '\', \'' + boardingHouse.bhSexAccepted + '\', \'' + boardingHouse.operatorFullname + '\', \'' +
                            boardingHouse.bhSexAccepted + '\', \'' + boardingHouse.operatorContact + '\', \'' + boardingHouse.bhTenantCount + '\', \'' + boardingHouse.bhBedCount +
                            '\', \'' + boardingHouse.bhLat + '\', \'' + boardingHouse.bhLng +
                            '\')"><i class="fas fa-info"></i></button>' + '</li>';
                        // Add more details as needed
                        if (boardingHouse.bhLat && boardingHouse.bhLng) {
                            let icon = null
                            if (selectedSex !== '') {
                                if (selectedSex === "Male") {
                                    icon = maleIcon
                                    console.log('Male')
                                } else if (selectedSex === "Female") {
                                    icon = femaleIcon
                                    console.log('Female')
                                }
                            } else if (selectedHousingType != '') {
                                if (selectedHousingType === "1") {
                                    icon = BedSpacerIcon
                                    console.log('BedSpacerIcon')
                                } else if (selectedHousingType === "2") {
                                    icon = PodIcon
                                    console.log('PodIcon')
                                }
                            } else {
                                icon = greenIcon
                            }
                      
                            var marker = L.marker([boardingHouse.bhLat, boardingHouse.bhLng], {
                                icon: icon
                            }).addTo(map);
                            const escapedBhName = boardingHouse.bhName.replace(/'/g, "\'");
                            const bhName = boardingHouse.bhName.replace(`'`, `\\'`);
                            const bhType = boardingHouse.bhType
                            const bhSexAccepted = boardingHouse.bhSexAccepted
                            const opFullname = boardingHouse.operatorFullname
                            const opContactNo = boardingHouse.operatorContact
                            const tenantCount = boardingHouse.bhTenantCount
                            const bedCount = boardingHouse.bhBedCount
                            infoWindowContent =
                                '<div class="info_content">' +
                                `<h5>${escapedBhName}  </h5>` +
                                // Use template literals for variable interpolation
                                `<p><img src="{{ asset('images/male_avatar.svg') }}" alt="" style="width: 60px; height: 60px;"> ${boardingHouse.operatorFname} ${boardingHouse.operatorMname} ${boardingHouse.operatorLname}</p>` +
                                `<p>Accepts: ${boardingHouse.bhSexAccepted} Boarders</p>` +
                                `<p>Occupancy: ${boardingHouse.bhTenantCount} / ${boardingHouse.bhBedCount}</p>` +
                                `<p>Contact: ${opContactNo}</p>` +
                                '<button id="profileBtn" class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvas(\'' +
                                bhName + '\', \'' + bhType + '\', \'' + bhSexAccepted + '\', \'' + opFullname + '\', \'' +
                                bhSexAccepted + '\', \'' + opContactNo + '\', \'' + tenantCount + '\', \'' + bedCount +
                                '\')">More Info</button>' +
                                '</div>';
                            // Bind popup content to the marker
                            marker.bindPopup(infoWindowContent);
                            // Update the content of the list view
                            listView.innerHTML = listContent;
                        }
                    });
                }
                // Function to fetch boarding houses based on search query, category, and sex filter
                function fetchBoardingHouses(searchQuery) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    // Make an AJAX request to fetch boarding houses based on search query, category, and sex filter
                    $.ajax({
                        url: 'osa-fetch-boarding-houses',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                        },
                        data: {
                            search_query: searchQuery,
                            sex_filter: selectedSex,
                            housing_type_filter: selectedHousingType
                        },
                        success: function(response) {
                            console.log('Received response from server:', response);
                            searchData(response);
                            updateMarkersAndView(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching boarding houses:', error);
                            toastr.error('Failed to fetch boarding houses. Please try again later.');
                        }
                    });
                }

                function updateMarkersAndView(data) {
                    // Clear existing markers
                    map.eachLayer(function(layer) {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });
                    var bounds = []; // Array to hold the bounds of all markers
                    // Update map markers
                    data.forEach(function(element) {
                        if (element.bhLat && element.bhLng) {
                            let icon = null;
                            if (selectedSex === "Male") {
                                icon = maleIcon;
                            } else if (selectedSex === "Female") {
                                icon = femaleIcon;
                            } else {
                                if (selectedHousingType === "1") {
                                    icon = BedSpacerIcon;
                                } else if (selectedHousingType === "2") {
                                    icon = PodIcon;
                                }
                            }
                            if (!icon) {
                                icon = greenIcon; // Default icon
                            }
                            var marker = L.marker([element.bhLat, element.bhLng], {
                                icon: icon
                            }).addTo(map);
                            // Add marker to bounds
                            bounds.push([element.bhLat, element.bhLng]);
                            console.log('element: ', element.operatorFname)
                            const escapedBhName = element.bhName.replace(/'/g, "");
                            const opFirstname = element.operatorFname
                            const opMiddlename = element.operatorMname
                            const opLastname = element.operatorLname
                            infoWindowContent =
                                '<div class="info_content">' +
                                `<h5>${element.bhName}</h5>` +
                                `<p>${opFirstname} ${opMiddlename} ${opLastname}</p>` +
                                `<p>${element.bhSexAccepted}'s Boarding House</p>` +
                                '<button id="profileBtn" class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvas(\'' +
                                element.bhName.replace(`'`, `sshabbyy`) + '\', \'' + element.bhType + '\', \'' + element.bhSexAccepted + '\', \'' + element.operatorFullname + '\', \'' +
                                element.bhSexAccepted + '\', \'' + element.operatorContact + '\', \'' + element.bhTenantCount + '\', \'' + element.bhBedCount +
                                '\', \'' + element.bhLat + '\', \'' + element.bhLng +
                                '\')">More Info</button>';
                            // Bind popup content to the marker
                            // marker.bindPopup(infoWindowContent).openPopup();
                        }
                    });
                    // Check if all filters are empty
                    var filtersEmpty = $('#filterBy').val() === "" && $('#filterSelect').val() === "" && $('#searchBh').val() === "";
                    // If there are markers and filters are not selected or search box is empty, zoom out the map
                    if (bounds.length > 0 && filtersEmpty) {
                        map.fitBounds(bounds);
                    } else {
                        // Otherwise, if there are markers, fit the map to their bounds
                        if (bounds.length > 0) {
                            map.fitBounds(bounds);
                        }
                    }
                    // Update list view
                    $('#boardingHouseList').empty();
                    searchData(data)
                    data.forEach(function(element) {
                        console.log('boardingHouseList: ', element)
              
                    });

                }

                function openMoreInfoCanvas(bhName, bhType, bhSexAccepted, opFullname, opSex, opContactNo, tenantCount, bedCount, bhLat, bhLng) {
                    // console.log('Open More Info Canvas Function Called:');
                    $('#ocBhName').text(bhName.replace(`sshabbyy`, `'s`));
                    $('#ocBhType').text(bhType);
                    $('#ocBhGenderAccepted').text(bhSexAccepted);
                    $('#ocBhTenantCount').text(tenantCount);
                    $('#ocBhBedCount').text(bedCount);
                    $('#ocOperatorName').text(opFullname);
                    $('#ocOpSex').text(opSex);
                    $('#ocOpContactNo').text(opContactNo);
                    $('#bhMoreInfoOffCanvas').offcanvas('show');
                    // Check if coordinates are provided
                    if (bhLat !== undefined && bhLng !== undefined) {
                        console.log('Zooming to marker coordinates:', bhLat, bhLng);
                        // Set map view to marker's coordinates and appropriate zoom level
                        let icon = null
                        if (selectedSex !== '') {
                            if (selectedSex === "Male") {
                                icon = maleIcon
                                console.log('Male')
                            } else if (selectedSex === "Female") {
                                icon = femaleIcon
                                console.log('Female')
                            }
                        } else if (selectedHousingType != '') {
                            if (selectedHousingType === "1") {
                                icon = BedSpacerIcon
                                console.log('BedSpacerIcon')
                            } else if (selectedHousingType === "2") {
                                icon = PodIcon
                                console.log('PodIcon')
                            }
                        } else {
                            icon = greenIcon
                        }
                        var marker = L.marker([bhLat, bhLng], {
                            icon: icon
                        }).addTo(map);
                        var infoWindowContent =
                            '<div class="info_content">' +
                            '<h5>' + bhName + '</h5>' +
                            '<p>' + '<img src="{{ asset("images/male_avatar.svg") }}" alt="" style="width: 60px; height: 60px;"> ' + opFullname + '</p>' +
                            '<p>' + 'Accepts: ' + bhSexAccepted + " Boarders</p>" +
                            '<p>' + 'Occupancy: ' + tenantCount + ' / ' + bedCount + "</p>" +
                            '<p>' + 'Contact: ' + opContactNo + "</p>" +
                            '<button class="btn btn-block btn-success btn-sm" onclick="openMoreInfoCanvas(\'' +
                            bhName.replace(`'s`, 'sshabbyy') + '\', \'' + bhType + '\', \'' + bhSexAccepted + '\', \'' + opFullname + '\', \'' +
                            bhSexAccepted + '\', \'' + opContactNo + '\', \'' + tenantCount + '\', \'' + bedCount +
                            '\')">More Info</button>' +
                            '</div>';
                        marker.bindPopup(infoWindowContent).openPopup();
                    } else {
                        console.error('Invalid marker coordinates:', bhLat, bhLng);
                    }
                    // Add event listener to close the offcanvas and zoom out when closed
                    $('#bhMoreInfoOffCanvas').on('hidden.bs.offcanvas', function() {
                        // Zoom out to initial map view
                        map.setView([7.859700529760978, 125.05071376673064], 15);
                    });
                }
            </script>

            <!-- <script async
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8rlfEG9wu6xJaKgcNKp-9_Y0BxxX22bs&loading=async&callback=initMap">
            </script> -->
            <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmzJia-D4-HHetyvJInWrJlJQ_piS7sbI&callback=initMap" async
                defer></script> -->

        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">

        <!-- Default to the left -->
        <strong> <a href="https://cmu.edu.ph" target="_blank" style="color: #02681e">CENTRAL MINDANAO UNIVERSITY
            </a>| Software Development
            Department Interns 2023-2024.</strong> All
        rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Toaster JS -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    @if (Session::has('success'))
    <script>
        toastr.option = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{ Session::get('success') }}", 'Success!', {
            timeOut: 12000
        });
    </script>
    @elseif (Session::has('error'))
    <script>
        toastr.option = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ Session::get('error') }}", 'Error!', {
            timeOut: 12000
        });
    </script>
    @endif
    @yield('scripts')
</body>

</html>