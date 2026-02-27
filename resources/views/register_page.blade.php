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
                    <div class="row">
                        <div class="text-center">
                            <h4 style="color: #02681e">Boarding House and Dormitory Management System</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">
                                    <p class="login-box-msg"><strong>
                                            Registration Form</strong></p>
                                    <div class="container">
                                        <div class="container-fluid">

                                            <div id="verificationForm">
                                                <div class="col-md-12">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label for="registerEmployeeIdVerification">Verify
                                                                    Employee ID</label>
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        name="registerEmployeeIdVerification"
                                                                        id="registerEmployeeIdVerification"
                                                                        class="form-control" required>
                                                                    <span class="input-group-append">
                                                                        <button type="button" class="btn btn-success"
                                                                            onclick="verifyEmployeeId()">Verify</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="registrationForm" hidden>
                                                <form action="{{ route('registerNewEmployeeUser') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="" id="employeeInformation">
                                                        <div class="text-center">
                                                            <img src="" alt="user-avatar"
                                                                class="img-circle img-fluid"
                                                                style="width: 125px; height:auto;"
                                                                id="profileImageOfEmployee">
                                                            <h5 id="employeeFullName" class="mt-2"><span
                                                                    class="mr-2"></span>Allen Keith Aradillos
                                                            </h5>
                                                            <p id="employeeEmployeeId" class="mt-0">2020302269</p>

                                                        </div>
                                                    </div>

                                                    <input type="text" id="registerEmployeeId"
                                                        name="registerEmployeeId" hidden>

                                                    <div class="form-floating mb-3">

                                                        <input type="email" class="form-control"
                                                            id="registerEmployeeEmail" name="registerEmployeeEmail"
                                                            placeholder="name@example.com">
                                                        <label for="registerEmployeeEmail">Email address</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control"
                                                            id="registerEmployeePassword"
                                                            name="registerEmployeePassword"
                                                            placeholder="Enter Password">
                                                        <label for="registerEmployeePassword">Password</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control"
                                                            id="registerEmployeeRePass" name="registerEmployeeRePass"
                                                            placeholder="Re-type Password">
                                                        <label for="registerEmployeeRePass">Re-type Password</label>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-success btn-block">Register</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-block">Back</button>
                                                        </div>
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
            </div>
        </div>
        <script>
            function showLoadingIndicator() {
                $('#loadingIndicator').show();
            }

            function hideLoadingIndicator() {
                $('#loadingIndicator').hide();
            }
            $('#registerEmployeeIdVerification').keypress(function(event) {
                if (event.which == 13) {
                    // Enter key is pressed
                    verifyEmployeeId();
                }
            });
            $('#registrationForm form').submit(function(event) {
                showLoadingIndicator(); // Show loading indicator
            });


            function verifyEmployeeId() {
                showLoadingIndicator();
                var employeeId = $('#registerEmployeeIdVerification').val();
                console.log(employeeId);
                $.ajax({

                    url: "{{ route('registrationFormFetchEmployeeIdExistense') }}",
                    type: "POST",
                    data: {
                        employee_id: employeeId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {

                        if (response.status == 'Not Found') {

                            alert('Employee ID not found.');
                            hideLoadingIndicator();
                        } else {
                            var employee = response[0];
                            console.log(employee);
                            if (employee.employeeSex == 1) {
                                $('#profileImageOfEmployee').attr('src',
                                    "{{ asset('images/male_avatar.svg') }}");
                            } else if (employee.employeeSex == 0) {
                                $('#profileImageOfEmployee').attr('src',
                                    "{{ asset('images/female_avatar.svg') }}");
                            } else {
                                $('#profileImageOfEmployee').attr('src', "");
                            }

                            $('#registerEmployeeId').val(employeeId);
                            $('#employeeFullName').text(employee.employeeFullName);
                            $('#employeeEmployeeId').text(employee.employeeId);
                            $('#verificationForm').attr('hidden', 'hidden');
                            $('#registrationForm').removeAttr('hidden');
                            hideLoadingIndicator();
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        hideLoadingIndicator();
                    }
                });


            }
        </script>

        <footer class="main-footer">

            <!-- Default to the left -->
            <strong> <a href="https://cmu.edu.ph" target="_blank" style="color: #02681e">CENTRAL MINDANAO UNIVERSITY
                </a>| CMU BDMS 2023-2024.</strong> All
            rights reserved.
        </footer>
    </div>


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


</body>

</html>
