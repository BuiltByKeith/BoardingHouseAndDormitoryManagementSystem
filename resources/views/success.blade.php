<!DOCTYPE html>
<html lang="en">

<head>
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


    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE JS -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>


    {{-- Toaster --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>

<body class="layout-top-nav" style="height: auto;">

    <div class="wrapper">
        <div id="loadingIndicator"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); z-index: 9999;">
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
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="./" class="navbar-brand">
                    <img src="{{ asset('images/cmu.png') }}" alt="CMU Logo" class="brand-image img-circle"
                        style="width: 60px; height:auto;">
                    <span class="brand-text font-weight-bold ml-2" style="font-size: 18px; color:#02681e">Central
                        Mindanao
                        University</span>
                </a>
                <div class="navbar-nav">
                    <div class="nav-item">
                        <a class="nav-link" href="/" style="color:#02681e">
                            <p style="font-weight: bold">Home</p>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="content-wrapper" style="min-height: 600.4px;">
            <div class="content-header mt-3">
                <div class="container">

                </div>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">
                                    <div id="registrationForm">

                                        <div class="successRegisterPart">
                                            <div class="text-center">
                                                <h3>Registration Successful!</h3>
                                                <a href="/login"><button class="btn btn-success">Proceed to
                                                        login</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <footer class="main-footer">

        <!-- Default to the left -->
        <strong> <a href="https://cmu.edu.ph" target="_blank" style="color: #02681e">CENTRAL MINDANAO UNIVERSITY
            </a>| CMU BDMS 2023-2024.</strong> All
        rights reserved.
    </footer>
    </div>



</body>

</html>
