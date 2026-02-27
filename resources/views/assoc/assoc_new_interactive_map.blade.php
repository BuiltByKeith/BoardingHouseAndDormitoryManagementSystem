<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMU | BDMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



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
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
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
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
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
                <img src="{{ asset('images/cmulogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" style="color:white"><strong>CMU | BDMS</strong></span>
            </a>

            @foreach (auth()->user()->roles as $role)
                @include('layouts.navigations.' . $role->role_name . '_navigations')
            @endforeach
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                <div id="loadingIndicator"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); z-index: 9999;">
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
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
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-4 mt-3">
                                <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Interactive Map</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-8 mt-3">
                                <ol class="breadcrumb float-right">
                                    <div class="input-group">


                                        <div class="input-group">
                                            <select class="custom-select" id="parentFilter">
                                                <option value="0" selected>Filter By:</option>
                                                <option value="1">Boarding House</option>
                                                <option value="2">Dormitory</option>
                                            </select>

                                            <div id="filterSection" style="display: none;">
                                                <div class="input-group">
                                                    <select class="custom-select" id="filterBy">
                                                        <option value="">Filter By:</option>
                                                    </select>
                                                    <select class="custom-select" id="filterByDorms"
                                                        style="display:none;">
                                                        <option value="">Filter By:</option>
                                                    </select>
                                                    <select class="custom-select" id="filterSelect">
                                                        <option value="">Select Filter</option>
                                                    </select>
                                                    <select class="custom-select" id="filterSelectDorms"
                                                        style="display:none;">
                                                        <option value="">Select Filter</option>
                                                    </select>
                                                    <input type="text" class="form-control" id="searchBh"
                                                        placeholder="Search">
                                                    <div class="input-group-append">
                                                        <button id="searchBtn"
                                                            class="btn btn-success form-control">Search</button>
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
                        <div class="form-row">
                            <!-- Map container -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-12" id="map">
                                            <div id="map" style="height: 750px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="boardingHouseMoreInfoCanvas">
                        <div class="offcanvas offcanvas-end" style="width: 80vmin;" tabindex="-1"
                            id="boardingHouseMoreInfoCanvas" aria-labelledby="boardingHouseMoreInfoCanvas">
                            <div class="offcanvas-header bg-yellow">
                                <h5 id="uhrcInteractiveMapMoreInfoCanvasTitle">Boarding House Information</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <!-- Carousel -->
                                <div id="boardingHouseCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" id="bhCarouselInner">
                                        <!-- Dynamic content will be inserted here -->

                                    </div>
                                    <a class="carousel-control-prev" href="#boardingHouseCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#boardingHouseCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="col-md-12">

                                    <h3 class="text-center mt-3"><strong><span
                                                id="moreInfoCanvasBhName"></span></strong>
                                    </h3>
                                    <div class="text-center">
                                        <img src="" alt="" style="width: 80px; height: 80px;"
                                            id="moreInfoCanvasOperatorProfileImg">
                                    </div>

                                    <h5 class="text-center"> <strong><span
                                                id="moreInfoCanvasOperatorName"></span></strong>
                                    </h5>
                                    <div class="text-center">
                                        Operator
                                    </div>
                                    <div class="mt-3">
                                        <h5><strong>Lodging Type: </strong><span id="moreInfoCanvasBhType"></span></h5>
                                        <h5><strong>Class: </strong><span id="moreInfoCanvasBhClass"></span>
                                        </h5>
                                        <h5><strong>Accepts: </strong> <span id="moreInfoCanvasBhGender"></span>
                                        </h5>
                                        <h5><strong>Occupancy: </strong><span id="moreInfoCanvasTenantCount"></span> /
                                            <span id="moreInfoCanvasBedCount"></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dormitoryMoreInfoCanvas">
                        <div class="offcanvas offcanvas-end" style="width: 80vmin;" tabindex="-1"
                            id="dormitoryMoreInfoCanvas" aria-labelledby="dormitoryMoreInfoCanvas">
                            <div class="offcanvas-header bg-yellow">
                                <h5 id="uhrcInteractiveMapMoreInfoCanvasTitle">Dormitory Information</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <!-- Carousel -->
                                <div id="dormitoryCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" id="dormCarouselInner">
                                        <!-- Dynamic content will be inserted here -->
                                    </div>
                                    <a class="carousel-control-prev" href="#dormitoryCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#dormitoryCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="col-md-12">

                                    <h3 class="text-center mt-3"><strong><span
                                                id="moreInfoCanvasDormName"></span></strong>
                                    </h3>
                                    <div class="text-center">
                                        <img src="" alt="" style="width: 80px; height: 80px;"
                                            id="moreInfoCanvasDormManagerProfileImg">
                                    </div>

                                    <h5 class="text-center"> <strong><span
                                                id="moreInfoCanvasDormManagerName"></span></strong>
                                    </h5>

                                    <div class="mt-3">
                                        <h5><strong>Accepts: </strong><span id="moreInfoCanvasDormSex"></span>
                                        </h5>
                                        <h5><strong>Occupancy: </strong><span
                                                id="moreInfoCanvasDormTenantCount"></span> /
                                            <span id="moreInfoCanvasDormBedCount"></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <script>
            var maleIcon = L.icon({
                iconUrl: 'images/marker_male.png',
                iconSize: [38, 45],
                shadowSize: [50, 64],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            });
            var femaleIcon = L.icon({
                iconUrl: 'images/marker_female.png',
                iconSize: [38, 45],
                shadowSize: [50, 64],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            });

            var map = L.map('map').setView([7.859700529760978, 125.05071376673064], 15);
            L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {

                center: [7.859700529760978, 125.05071376673064],
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']

            }).addTo(map);


            setTimeout(() => {
                map.panTo(new L.LatLng(7.859700529760978, 125.05071376673064));
            });


            function bhInfoWindow(id, bhName, operatorName, operatorContact, bhGenderAccepted, operatorSex, bhTenantCount,
                bhBedCount, bhType, bhClass, bhPhotos) {
                const avatarImg = operatorSex == 0 ?
                    '<img src="{{ asset('images/female_avatar.svg ') }}" alt="" style="width: 60px; height: 60px;" class="mr-3">' :
                    '<img src="{{ asset('images/male_avatar.svg ') }}" alt="" style="width: 60px; height: 60px;" class="mr-3">';

                const genderAcceptance = bhGenderAccepted == 0 ? 'Female Boarders' : 'Male Boarders';

                return `
                    <div>
                        <h5 class="text-center">${bhName}</h5>
                        <p>${avatarImg} ${operatorName}</p>
                        <p><strong>Contact:</strong> ${operatorContact}</p>
                        <p><strong>Accepts:</strong> ${genderAcceptance}</p>
                        <p><strong>Occupancy:</strong> ${bhTenantCount} / ${bhBedCount}</p>
                        <button class="btn btn-sm btn-success btn-block" onclick="showBhInfoCanvas('${id}', '${bhName.replace(/'/g, "\\'")}', '${operatorName}', '${operatorContact}', ${bhGenderAccepted}, '${operatorSex}', '${bhTenantCount}', '${bhBedCount}', '${bhType}', '${bhClass}', '${bhPhotos}')">More Info</button>
                    </div>
                    `;
            }

            function dormInfoWindow(id, dormName, dormManagerName, dormManagerContact, dormGenderAccepted, dormManagerSex,
                dormTenantCount, dormBedCount, dormPhotos) {
                const avatarImg = dormManagerSex == 0 ?
                    '<img src="{{ asset('images/female_avatar.svg ') }}" alt="" style="width: 60px; height: 60px;" class="mr-3">' :
                    '<img src="{{ asset('images/male_avatar.svg ') }}" alt="" style="width: 60px; height: 60px;" class="mr-3">';

                const genderAcceptance = dormGenderAccepted == 0 ? 'Female Boarders' : 'Male Boarders';

                return `
                    <div>
                        <h5 class="text-center">${dormName}</h5>
                        <p>${avatarImg} ${dormManagerName}</p>
                        <p><strong>Contact:</strong> ${dormManagerContact}</p>
                        <p><strong>Accepts:</strong> ${genderAcceptance}</p>
                        <p><strong>Occupancy:</strong> ${dormTenantCount} / ${dormBedCount}</p>
                        <button class="btn btn-sm btn-success btn-block" onclick="showDormInfoCanvas('${id}', '${dormName.replace(/'/g, "\\'")}', '${dormManagerName}', '${dormManagerContact}', ${dormGenderAccepted}, '${dormManagerSex}', '${dormTenantCount}', '${dormBedCount}', '${dormPhotos}')">More Info</button>
                    </div>
                    `;
            }

            function createCarouselItems(photos) {
                let carouselItems = '';
                photos.forEach((photo, index) => {
                    const activeClass = index === 0 ? 'active' : '';
                    carouselItems += `
            <div class="carousel-item ${activeClass}">
                <img class="d-block w-100" src="${photo}" alt="Slide ${index + 1}">
            </div>
        `;
                });
                return carouselItems;
            }

            function showBhInfoCanvas(id, bhName, operatorName, operatorContact, bhGenderAccepted, operatorSex, bhTenantCount,
                bhBedCount, bhType, bhClass, bhPhotos) {

                $.ajax({
                    url: "{{ route('uhrcFetchBoardingHousePhotos') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        bh_id: id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        // hideLoadingIndicator()
                        console.log(data);

                        let carouselInnerHtml = '';
                        if (data.length <= 0) {
                            carouselInnerHtml = `
                                <div class="carousel-item active" style="height: 300px;">
                                    <img class="d-block w-100" style="object-fit: cover; height: 100%;" src="{{ asset('images/cmugate.jpg') }}" alt="Default Photo">
                                </div>
                            `;
                        } else {
                            data.forEach((photo, index) => {
                                console.log(photo.filePath);
                                carouselInnerHtml += `
                                    <div class="carousel-item ${index === 0 ? 'active' : ''}" style="height: 300px;">
                                        <img class="d-block w-100" style="object-fit: cover; height: 100%;" src="{{ asset('storage/${photo.filePath}') }}" alt="Photo ${index + 1}">
                                    </div>
                                `;
                            });
                        }



                        $('#bhCarouselInner').html(carouselInnerHtml);
                    },

                    error: function(xhr, status, error) {
                        // hideLoadingIndicator()
                        console.error(xhr.responseText);
                    }
                });
                $('#moreInfoCanvasBhName').text(bhName);
                if (operatorSex == 0) {
                    $('#moreInfoCanvasOperatorProfileImg').attr('src', "{{ asset('images/female_avatar.svg') }}")
                } else if (operatorSex == 1) {
                    $('#moreInfoCanvasOperatorProfileImg').attr('src', "{{ asset('images/male_avatar.svg') }}")
                } else {
                    $('#moreInfoCanvasOperatorProfileImg').attr('src', "")
                }
                $('#moreInfoCanvasOperatorName').text(operatorName);

                if (bhType == 1) {
                    $('#moreInfoCanvasBhType').text('Bed Spacer');
                } else if (bhType == 2) {
                    $('#moreInfoCanvasBhType').text('Pad');
                } else {
                    $('#moreInfoCanvasBhType').text('');
                }
                $('#moreInfoCanvasBhClass').text(bhClass);

                if (bhGenderAccepted == 0) {
                    $('#moreInfoCanvasBhGender').text('Female Lodgers');
                } else if (bhGenderAccepted == 1) {
                    $('#moreInfoCanvasBhGender').text('Male Lodgers');
                } else {
                    $('#moreInfoCanvasBhGender').text('');
                }
                $('#moreInfoCanvasTenantCount').text(bhTenantCount);
                $('#moreInfoCanvasBedCount').text(bhBedCount);

                $('#boardingHouseMoreInfoCanvas').offcanvas('show');
            }

            function showDormInfoCanvas(id, dormName, dormManagerName, dormManagerContact, dormGenderAccepted, dormManagerSex,
                dormTenantCount, dormBedCount, dormPhotos) {
                $.ajax({
                    url: "{{ route('uhrcFetchDormitoryPhotos') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        dorm_id: id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        // hideLoadingIndicator()
                        console.log(data);

                        let carouselInnerHtml = '';
                        if (data.length <= 0) {
                            carouselInnerHtml = `
                                <div class="carousel-item active" style="height: 300px;">
                                    <img class="d-block w-100" style="object-fit: cover; height: 100%;" src="{{ asset('images/cmugate.jpg') }}" alt="Default Photo">
                                </div>
                            `;
                        } else {
                            data.forEach((photo, index) => {
                                console.log(photo.filePath);
                                carouselInnerHtml += `
                                    <div class="carousel-item ${index === 0 ? 'active' : ''}" style="height: 300px;">
                                        <img class="d-block w-100" style="object-fit: cover; height: 100%;" src="{{ asset('storage/${photo.filePath}') }}" alt="Photo ${index + 1}">
                                    </div>
                                `;
                            });
                        }



                        $('#dormCarouselInner').html(carouselInnerHtml);
                    },

                    error: function(xhr, status, error) {
                        // hideLoadingIndicator()
                        console.error(xhr.responseText);
                    }
                });
                $('#moreInfoCanvasDormName').text(dormName);

                if (dormManagerSex == 0) {
                    $('#moreInfoCanvasDormManagerProfileImg').attr('src', "{{ asset('images/female_avatar.svg') }}");
                } else if (dormManagerSex == 1) {
                    $('#moreInfoCanvasDormManagerProfileImg').attr('src', "{{ asset('images/male_avatar.svg') }}");

                } else {
                    $('#moreInfoCanvasDormManagerProfileImg').attr('src', "");

                }
                $('#moreInfoCanvasDormManagerName').text(dormManagerName);
                if (dormGenderAccepted == 0) {
                    $('#moreInfoCanvasDormSex').text('Female Boarders');
                } else if (dormGenderAccepted == 1) {
                    $('#moreInfoCanvasDormSex').text('Male Boarders');
                } else {
                    $('#moreInfoCanvasDormSex').text('');
                }
                $('#moreInfoCanvasDormTenantCount').text(dormTenantCount);
                $('#moreInfoCanvasDormBedCount').text(dormBedCount);
                $('#dormitoryMoreInfoCanvas').offcanvas('show');
            }

            var boardingHousesData = [];
            var dormitoriesData = [];
            var map; // Assuming the map is initialized somewhere in your code

            function fetchBoardingHouses() {
                $.ajax({
                    url: "{{ route('uhrcFetchBoardingHouseForInteractiveMap') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        boardingHousesData = data;
                        updateMapMarkers(boardingHousesData, 'boardingHouse');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function fetchDormitories() {
                $.ajax({
                    url: "{{ route('uhrcFetchDormitoriesForInteractiveMap') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        dormitoriesData = data;
                        updateMapMarkers(dormitoriesData, 'dormitory');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function updateMapMarkers(data, type) {
                data.forEach(function(item) {
                    var lat = item.latitude;
                    var lon = item.longitude;
                    var icon = (item[type + 'Sex'] == 0) ? femaleIcon : maleIcon;

                    if (type === 'boardingHouse') {
                        L.marker([lat, lon], {
                                icon: icon
                            })
                            .addTo(map)
                            .bindPopup(bhInfoWindow(item.id, item.boardingHouseName,
                                item.bhOperatorFullName, item.bhOperatorContact,
                                item.boardingHouseSex, item.bhOperatorSex,
                                item.bhTenantCount, item.bhBedCount,
                                item.boardingHouseType, item.boardingHouseClass,
                                item.bhPhotos));
                    } else {
                        L.marker([lat, lon], {
                                icon: icon
                            })
                            .addTo(map)
                            .bindPopup(dormInfoWindow(item.id, item.dormitoryName, item.dormManagerFullName,
                                item.dormManagerContact, item.dormitorySex,
                                item.dormManagerSex, item.dormTenantCount,
                                item.dormBedCount, item.dormPhotos));
                    }
                });
            }

            function filterData() {
                var parentFilter = $('#parentFilter').val();
                var filterType = $('#filterBy').val() || $('#filterByDorms').val();
                var filterValue = $('#filterSelect').val() || $('#filterSelectDorms').val();
                var searchTerm = $('#searchBh').val().toLowerCase();

                var filteredBoardingHouses = boardingHousesData;
                var filteredDormitories = dormitoriesData;

                if (filterType && filterValue) {
                    if (parentFilter == 1 || parentFilter == 0) {
                        filteredBoardingHouses = boardingHousesData.filter(function(item) {
                            var matchesFilter = true;
                            if (filterType === 'Sex') {
                                matchesFilter = item.boardingHouseSex == filterValue;
                            } else if (filterType === 'lodge') {
                                matchesFilter = item.boardingHouseType == filterValue;
                            } else if (filterType === 'class') {
                                matchesFilter = item.boardingHouseClass == filterValue;
                            }
                            return matchesFilter && item.boardingHouseName.toLowerCase().includes(searchTerm);
                        });
                    }

                    if (parentFilter == 2 || parentFilter == 0) {
                        filteredDormitories = dormitoriesData.filter(function(item) {
                            var matchesFilter = true;
                            if (filterType === 'Sex') {
                                matchesFilter = item.dormitorySex == filterValue;
                            }
                            return matchesFilter && item.dormitoryName.toLowerCase().includes(searchTerm);
                        });
                    }
                } else {
                    if (parentFilter == 1 || parentFilter == 0) {
                        filteredBoardingHouses = boardingHousesData.filter(function(item) {
                            return item.boardingHouseName.toLowerCase().includes(searchTerm);
                        });
                    }

                    if (parentFilter == 2 || parentFilter == 0) {
                        filteredDormitories = dormitoriesData.filter(function(item) {
                            return item.dormitoryName.toLowerCase().includes(searchTerm);
                        });
                    }
                }

                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        map.removeLayer(layer);
                    }
                });

                if (parentFilter == 1 || parentFilter == 0) {
                    updateMapMarkers(filteredBoardingHouses, 'boardingHouse');
                }
                if (parentFilter == 2 || parentFilter == 0) {
                    updateMapMarkers(filteredDormitories, 'dormitory');
                }
            }

            function populateFilterOptions(selectedParentFilter) {
                var filterBySelect = $('#filterBy');
                var filterBySelectDorms = $('#filterByDorms');
                var filterSelect = $('#filterSelect');
                var filterSelectDorms = $('#filterSelectDorms');

                filterBySelect.empty();
                filterBySelect.append('<option value="">Filter By:</option>');

                filterBySelectDorms.empty();
                filterBySelectDorms.append('<option value="">Filter By:</option>');

                filterSelect.empty().append('<option value="">Select Filter</option>');
                filterSelectDorms.empty().append('<option value="">Select Filter</option>');

                if (selectedParentFilter === "1") {
                    filterBySelect.append('<option value="Sex">Sex</option>');
                    filterBySelect.append('<option value="lodge">Lodging Type</option>');
                    filterBySelect.append('<option value="class">Class</option>');
                } else if (selectedParentFilter === "2") {
                    filterBySelectDorms.append('<option value="Sex">Sex</option>');
                } else {
                    filterBySelect.append('<option value="Sex">Sex</option>');
                    filterBySelect.append('<option value="lodge">Lodging Type</option>');
                    filterBySelect.append('<option value="class">Class</option>');
                    filterBySelectDorms.append('<option value="Sex">Sex</option>');
                }

                $('#filterBy').change(function() {
                    var filterType = $(this).val();
                    filterSelect.empty().append('<option value="">Select Filter</option>');

                    if (filterType === 'Sex') {
                        filterSelect.append('<option value="0">Female</option><option value="1">Male</option>');
                    } else if (filterType === 'lodge') {
                        filterSelect.append('<option value="1">Bed Spacer</option><option value="2">Pad</option>');
                    } else if (filterType === 'class') {
                        filterSelect.append(
                            '<option value="Private">Private</option><option value="Government">Government</option>'
                        );
                    }
                });

                $('#filterByDorms').change(function() {
                    var filterType = $(this).val();
                    filterSelectDorms.empty().append('<option value="">Select Filter</option>');

                    if (filterType === 'Sex') {
                        filterSelectDorms.append('<option value="0">Female</option><option value="1">Male</option>');
                    }
                });
            }

            function triggerSearch() {
                $('#searchBtn').click(function() {
                    filterData();
                });

                $('#searchBh').keypress(function(e) {
                    if (e.which == 13) {
                        filterData();
                    }
                });

                // Fetch data based on selected parent filter
                $('#searchBh').on('input', function() {
                    var searchTerm = $(this).val().trim().toLowerCase();
                    if (searchTerm === '') {
                        var parentFilter = $('#parentFilter').val();
                        if (parentFilter == 1 || parentFilter == 0) {
                            fetchBoardingHouses();
                        } else if (parentFilter == 2) {
                            fetchDormitories();
                        } else {

                            fetchBoardingHouses();
                            fetchDormitories();
                        }
                    }
                });
            }


            $(document).ready(function() {
                $('#parentFilter').change(function() {
                    var selectedParentFilter = $(this).val();
                    var filterSection = $('#filterSection');

                    if (selectedParentFilter !== "") {
                        filterSection.show();
                        populateFilterOptions(selectedParentFilter);

                        if (selectedParentFilter === "2") {
                            $('#filterBy').hide().val('');
                            $('#filterByDorms').show();
                            $('#filterSelect').hide();
                            $('#filterSelectDorms').show().val('');
                            fetchDormitories();
                        } else {
                            $('#filterBy').show().val('');
                            $('#filterByDorms').hide();
                            $('#filterSelect').show().val('');
                            $('#filterSelectDorms').hide();
                            fetchBoardingHouses();
                        }
                    } else {
                        filterSection.hide();
                        $('#filterBy').hide().val('');
                        $('#filterByDorms').hide();
                        $('#filterSelect').hide().val('');
                        $('#filterSelectDorms').hide();
                        fetchBoardingHouses();
                        fetchDormitories();
                    }

                    map.eachLayer(function(layer) {
                        if (layer instanceof L.Marker) {
                            map.removeLayer(layer);
                        }
                    });

                    if (selectedParentFilter == 1) {
                        fetchBoardingHouses();
                    } else if (selectedParentFilter == 2) {
                        fetchDormitories();
                    } else {
                        fetchBoardingHouses();
                        fetchDormitories();
                    }
                });

                $('#filterSelect, #filterSelectDorms').change(filterData);

                triggerSearch();

                fetchBoardingHouses();
                fetchDormitories();
            });
        </script>
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
            <strong> <a href="https://cmu.edu.ph" target="_blank" style="color: #02681e">CENTRAL MINDANAO
                    UNIVERSITY
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
