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
    
        <!-- Start feature Area -->
        <section class="feature-area section-gap">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 pb-40 header-text text-center">
                        <h1 class="pb-10 text-white">Welcome Groomer</h1>
                        <p class="text-white"> These are all the appointments </p>
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
            , url: 'portal_db.php'
            , data: {
                op: "READ"
            }
            , success: function (res) {
                var profile_dic = JSON.parse(res);
                for (j = 0; j < profile_dic.no_app; j++) {
                    create_app_card(profile_dic, j);
                }
            }
        });
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