<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
    {{-- Box Icons --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css">

    <title>CMU | BDMS</title>
</head>

<body>
    {{-- Navbar --}}
    <header>
        <a href="#" class="logo"><img src="{{ asset('images/cmu.png') }}" alt="cmu logo"><span>Central Mindanao
                University</span></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="{{ route('landingPageInteractiveMap') }}">Interactive Map</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>



        </ul>
    </header>

    <section class="home" id="home">
        <div class="home-text">
            <span>Welcome to</span>
            <h1>Boarding House and Dormitory</h1>
            <h2>Management System</h2>
            <p>by Central Mindanao University</p>
            <a href="/register-page" class="btn">Register Now</a>
        </div>
        <div class="home-img">
            <img src="{{ asset('images/BDMS LOGO.png') }}" alt="BDMS logo">
        </div>
    </section>

    <div class="about-overlay">
        <section class="about" id="about">
            <div class="about-heading">
                <span>Department's</span>
                <h1>COLLABORATION</h1>
            </div>

            <div class="scroller" data-direction="right" data-speed="slow">
                <div class="scroller__inner">
                    <img src="{{ asset('images/cisc.png') }}" alt="" />
                    <img src="{{ asset('images/osa.png') }}" alt="" />
                    <img src="{{ asset('images/cisc.png') }}" alt="" />
                    <img src="{{ asset('images/osa.png') }}" alt="" />
                    <img src="{{ asset('images/cisc.png') }}" alt="" />
                    <img src="{{ asset('images/osa.png') }}" alt="" />
                </div>
            </div>

            <br>
            <br>
            <br>
            <br>


            <div class="about-heading">
                <span>Boarding House and Dormitory Management System</span>
                <h1>Features and Functions</h1>
            </div>

            <div class="container">
                <div class="about-img">
                    <img id="img1" src="{{ asset('images/img2.png') }}" alt="defaultImage" style="max-width: 80%; height: auto;"  />
                </div>
            
                <div class="about-text">
                    <button type="button" class="btnn btnn-block btnn-outline-warning btnn-lg" onmouseover="setNewImage('{{ asset('images/img2.png') }}')" onmouseout="setOldImage({{ asset('images/img2.png') }})">
                        <div class="about-text">
                            <h2>Interactive Map</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Sed blandit velit vitae nunc ultricies, eget fermentum eros suscipit. 
                                Integer quis nisl velit. 
                            </p>
                        </div>
                    </button>
                
                    <br>
                    <br>
                
                    <button onmouseover="setNewImage('{{ asset('images/img1.png') }}')" onmouseout="setOldImage({{ asset('images/img1.png') }})" type="button" class="btnn btnn-block btnn-outline-warning btnn-lg">
                        <div class="about-text">
                            <h2>Boarding House Management</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Sed blandit velit vitae nunc ultricies, eget fermentum eros suscipit. 
                                Integer quis nisl velit. </p>
                        </div>
                    </button>
                
                    <br>
                    <br>
                
                    <button type="button" class="btnn btnn-block btnn-outline-warning btnn-lg" onmouseover="setNewImage('{{ asset('images/img3.png') }}')" onmouseout="setOldImage({{ asset('images/img2.png') }})">
                        <div class="about-text">
                            <h2>Operations Management</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Sed blandit velit vitae nunc ultricies, eget fermentum eros suscipit. 
                                Integer quis nisl velit. </p>
                        </div>
                    </button>
                </div>

            
                
            </div>
            
                
            </div>
            </div>
            

        </section>
    </div>


    <section class="contact" id="contact">
        <div class="social">
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-instagram"> </i></a>
        </div>
        <div class="links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
            <a href="#">Our Company</a>
        </div>
        <p>
            &#169; Software Development Department OJT-2024. All Rights Reserved.
        </p>
    </section>


    <script src="{{ asset('js/landing_page.js') }}">
    
    </script>
</body>

</html>
