<head>
    <?php include_once('session.php'); ?>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="codepixer">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>Dog Clinic</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
        <!--
			CSS
			============================================= -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">
        <link rel="stylesheet" href="css/hexagons.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/main.css"> </head>

<body>
    <?php include_once('navbar.php'); ?>
        <!-- start banner Area -->
        <section class="banner-area" id="home">
            <div class="container">
                <div class="row fullscreen d-flex align-items-center justify-content-center">
                    <div id="banner-h1" class="banner-content col-lg-6 col-md-6">
                        <h2 style="color:white">Welcome <?php echo $login_session.','; ?></h2>
                        <h1>
								need help with<br>
								your lovely Dog?<br>
							</h1>
                        <p class="text-white text-uppercase"> Make appointment immediately for free </p> 
                        <a href="appointment.php" class="primary-btn header-btn text-uppercase">Book a time</a> </div>
                    <div class="banner-img col-lg-6 col-md-6"> <img class="img-fluid" src="img/banner-dog.png" alt=""> </div>
                </div>
            </div>
        </section>
        <!-- End banner Area -->
        <!-- ==================================================================== -->
        <!-- Start products Area -->
        <section class="products-area section-gap">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 pb-40 header-text text-center">
                        <h1 class="pb-10">These are the dogs that you've owned</h1>
                        <p> You can make appointment for any of them </p>
                    </div>
                </div>
                <div id="dogcard" class="row">
                    <!-- Generate from the database -->
                </div>
            </div>
        </section>
        <!-- End products Area -->
        <!-- ==================================================================== -->
        <!-- Start feature Area -->
        <section class="feature-area section-gap">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 pb-40 header-text text-center">
                        <h1 class="pb-10 text-white">Your next meeting with us</h1>
                        <p class="text-white"> Feel free to modify the date and details about the meeting </p>
                    </div>
                </div>
                <div id="appointmentCard" class="row"> </div>
            </div>
        </section>
        <!-- End feature Area -->
        <!-- start footer Area -->
        <footer class="footer-area section-gap">
            <div class="container">
                <div class="row footer-bottom d-flex justify-content-between">
                    <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <div class="col-lg-4 col-sm-12 footer-social"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-dribbble"></i></a> <a href="#"><i class="fa fa-behance"></i></a> </div>
                </div>
            </div>
        </footer>
        <!-- End footer Area -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
</body>
<script>
    //var profile_dic = {};
    window.onload = retrieve_user_profile();
    // Retrieve and shows the profile information
    function retrieve_user_profile() {
        $.ajax({
            type: "POST"
            , url: 'user_profile_db.php'
            , data: {
                op: "READ"
            }
            , success: function (res) {
                var profile_dic = JSON.parse(res);
                for (i = 0; i < profile_dic.no_dog; i++) {
                    create_dog_card(profile_dic, i);
                }
                for (j = 0; j < profile_dic.no_app; j++) {
                    create_app_card(profile_dic, j);
                }
                new_dog_card(profile_dic);
            }
        });
    }

    function create_dog_card(dict, i) {
        var pri_btn = document.createElement("a");
        pri_btn.href = 'dog_profile.php?value=' + dict.dogIdLst[i];
        pri_btn.className = "primary-btn text-uppercase";
        pri_btn.innerHTML = "Edit";
        var pri_p = document.createElement("p");
        pri_p.innerHTML = dict.dogDobLst[i];
        var pri_h4 = document.createElement("h4");
        pri_h4.innerHTML = dict.dogLst[i];
        var detail = document.createElement("div");
        detail.className = "details";
        detail.appendChild(pri_h4);
        detail.appendChild(pri_p);
        detail.appendChild(pri_btn);
        var sin_pro = document.createElement("div");
        sin_pro.className = "single-product";
        sin_pro.appendChild(detail);
        var col = document.createElement("div");
        col.className = "col-lg-3 col-md-6";
        col.appendChild(sin_pro);
        document.getElementById("dogcard").appendChild(col);
    }
    // Create a button for creating a new dog.
    function new_dog_card(profile_dic) {
        var pri_btn = document.createElement("a");
        pri_btn.href = 'newdog.php';
        pri_btn.className = "primary-btn text-uppercase";
        pri_btn.innerHTML = "Add";
        var detail = document.createElement("div");
        detail.className = "details";
        detail.appendChild(pri_btn);
        var sin_pro = document.createElement("div");
        sin_pro.className = "single-product";
        sin_pro.appendChild(detail);
        var col = document.createElement("div");
        col.className = "col-lg-3 col-md-6";
        col.appendChild(sin_pro);
        document.getElementById("dogcard").appendChild(col);
    }

    function create_app_card(dict, i) {
        var pri_btn = document.createElement("a");
        pri_btn.class = "primary-btn header-btn text-uppercase";
        pri_btn.href = 'reschedule.php?value='+dict.appIdLst[i];
        pri_btn.innerHTML = "Edit";
        var pri_href = document.createElement("a");
        pri_href.href = 'reschedule.php?value='+dict.appIdLst[i];
        pri_href.className = "title d-flex flex-row";
        var pri_h4 = document.createElement("h4");
        pri_h4.innerHTML = dict.appDogLst[i];
        pri_href.appendChild(pri_h4);
        var pri_h6 = document.createElement("h6");
        pri_h6.innerHTML = dict.appTimeLst[i];
        var pri_p = document.createElement("p");
        pri_p.style = "color:gray";
        pri_p.innerHTML = dict.appOptLst[i];
        var pri_p2 = document.createElement("p");
        pri_p2.innerHTML = dict.appNoteLst[i];
        var sin_fea = document.createElement("div");
        sin_fea.className = "single-feature";
        sin_fea.appendChild(pri_href);
        sin_fea.appendChild(pri_h4);
        sin_fea.appendChild(pri_h6);
        sin_fea.appendChild(pri_p);
        sin_fea.appendChild(pri_p2);
        sin_fea.appendChild(pri_btn);
        var col = document.createElement("div");
        col.className = "col-lg-4 col-md-6";
        col.appendChild(sin_fea);
        document.getElementById("appointmentCard").appendChild(col);
    }
</script>