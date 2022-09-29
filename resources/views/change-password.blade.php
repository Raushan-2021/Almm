<!DOCTYPE html>
<html lang="en">

<head>
    <title>ALMM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/animations.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">




</head>

<body>
    <section class="bg-light">
        <div class="container">

            <div class="row top_header pt-2 pb-2">
                <div class="col-md-9 leftSide">
                    <table>
                        <tr>
                            <td class="gov-india"><span class="responsive_go_hindi" lang="hi"><a target="_blank"
                                        href="javascript:void(0)" role="link">भारत सरकार</a></span><br><span
                                    class="li_eng responsive_go_eng"><a target="_blank" href="javascript:void(0)"
                                        role="link">Government of India</a></span></td>
                            <td class="ministry"><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');"
                                    target="_blank" alt="Ministry of New And Renewable Energy"
                                    title="Ministry of New And Renewable Energy"><span class="responsive_minis_hi"
                                        lang="hi">नवीन और नवीकरणीय ऊर्जा मंत्रालय</span></a>
                                <br><a href="javascript:void(0)" onclick="menu('https://mnre.gov.in/');" target="_blank"
                                    alt="Ministry of New And Renewable Energy"
                                    title="Ministry of New And Renewable Energy"><span
                                        class="li_eng responsive_minis_eng">Ministry of New And Renewable
                                        Energy</span></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3 rightSide nav justify-content-end"><a class="hvr-hang" href=""><img
                            src="images/meta_fb.png"></a> <a class="hvr-hang" href=""><img src="images/twitter.png"></a>
                    <a class="hvr-hang" href=""><img src="images/linkedin.png"></a> <a class="hvr-hang" href=""><img
                            src="images/youtube.png"></a> <a class="hvr-hang" href=""><img
                            src="images/instagram.png"></a>
                </div>
            </div>


        </div>
    </section>
    <section>
        <nav id="stick_nav" class="navbar navbar-expand-lg  navbar-light bg-light bgWhite rounded ">

            <div class="container">

                <a class="navbar-brand" href=""><img src="images/ALMM_logo.png" style="height: 60px;"> <img
                        src="images/azdi_ka_mohtsv.png" style="height: 60px;"> </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse  justify-content-md-end" id="navbarCollapse">
                    <ul class="navbar-nav    mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=""><button type="button"
                                    class="btn btn-link">Home</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><button type="button" class="btn btn-link">About Us</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><button type="button" class="btn btn-link">Services</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><button type="button" class="btn btn-link">Contact
                                    Us</button></a>
                        </li>
                        <li>
                            <a class="nav-link" href=""> <button type="button"
                                    class="btn btn-success">Register</button></a>
                        </li>
                        <li>
                            <a class="nav-link" href=""> <button type="button"
                                    class="btn btn-outline-success">Login</button></a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

    </section>
    <section class="signup_sectn">
        <div class="container pt-5 pb-5">
            <div class="row pt-5 pb-5 animatedParent">
                <div class="col-md-4 col-sm-3"></div>
                <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                    <div class="heading">Forgot Password</div>
                    <div class="row signupforms">

                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Old Password</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Enter Old Password">
                            <div class="text-danger" style="padding-top: 3px; padding-left: 10px;">error msg sample
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">New Password</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Enter New Password">
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Confirm Password</label>
                            <input type="text" class="form-control form-control-lg"
                                placeholder="Enter Confirm Password">
                        </div>


                        <div class="col-md-12 d-grid text-center">


                            <button type="button" class="btn btn-success btn-lg btn-block mb-3">CHANGE
                                PASSWORD</button><br>
                            <p><span><a href="" style="text-decoration: none;"><strong
                                            class="text-success">Login</strong></a></span> | <span><a href=""
                                        style="text-decoration: none;"><strong class="text-success">sign
                                            in</strong></a></span></p>


                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-3"></div>
            </div>
        </div>

    </section>

    <section class="footer_section">
        <div class="container">
            <div class="row pt-5 pb-1">
                <div class="col-md-12 col-lg-4 img-fluid tab_scrn animatedParent">
                    <div class="animated fadeInDownShort go">
                        <img src="images/mnre_logo.png" style="height: 50px; margin-bottom: 15px;">
                        <div>The website belongs to Ministry of New and Renewable Energy (MNRE), Government of India.
                            Content displayed are for reference purpose only. All efforts have been made to make the
                            information as accurate as possible. MNRE will not responsible for any loss or harm, direct
                            or consequential or any violation of law as that may be caused by inaccuracy in the
                            information available on this website. Any discrepancy found may be brought to the notice of
                            Ministry. </div>

                    </div>
                </div>

                <div class="col-md-8 col-lg-5 useful_links animatedParent">
                    <div class="animated fadeInUpShort go">
                        <div class="row">
                            <div class="col-md-12 pb-5 text-white">USEFUL LINKS</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <ul>
                                    <li><a href="">Home</a></li>
                                    <li><a href="">About Us</a></li>
                                    <li><a href="">Services</a></li>
                                    <li><a href="">Reserch & Development</a></li>
                                    <li><a href="">Contact Us</a></li>
                                    <li><a href="">Policy & Guidelines</a></li>
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul>
                                    <li><a href="">Schemes</a></li>
                                    <li><a href="">Manufacturing</a></li>
                                    <li><a href="">Website Policy & Help</a></li>
                                    <li><a href="">SiteMap </a></li>
                                    <li><a href="">Feedback </a></li>
                                    <li><a href="">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 animatedParent">
                    <div class="animated fadeInDownShort go">
                        <div class="row">
                            <div class="col-md-12 pb-5 text-white">
                                CONNECT WITH US
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><i class="fa-solid fa-location-dot"></i> Block 14, Ministry of New and <br>
                                    Renewable Energy,CGO Complex,<br>
                                    Lodhi Road, New Delhi 3.</p>
                                <p><i class="fa-solid fa-phone"></i> Missed call at: 9966054447</p>
                                <p><i class="fa-solid fa-envelope"></i> rts-mnre@gov.in </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bottom_footer">
        <div class="container">
            <div class="row pt-3 ">
                <div class="col-md-12">
                    <small>Copyright @2022</small>
                    <p>Website Content Managed by Ministry of New and Renewable Energy <br>Designed, Developed and
                        Hosted by <span>National Informatics Centre (NIC)</span></p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/css3-animate-it/1.0.3/js/css3-animate-it.min.js"
        integrity="sha512-X04knNLL77jarDJ7uTIUXMBvZwMCWn2lmV9qPrfq7UrPPd3GP5a4IVbZBkRNI/vumMMMqOZqnNLq8Eb/Y6TU7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar = document.getElementById("stick_nav");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
    </script>
</body>

</html>