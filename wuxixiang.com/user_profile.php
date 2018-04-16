<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>spmdog- UserProfile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    </style>
    <script src="./assets/js/jquery-1.11.1.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <form class="form-horizontal">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Edit Profile</legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="username">Name</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="username" name="Username" type="text" placeholder="Username" class="form-control"> </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="email" name="E-mail" type="text" placeholder="Email" class="form-control input-md"> </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Address</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <textarea id="address" rows=3 name="address" type="text" placeholder="Address" class="form-control input-md">Address</textarea> </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mobile_num">Mobile Number</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="mobile_num" name="Mobile Number" type="text" placeholder="Mobile Number" class="form-control input-md"> </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="work_num">Work Number</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="work_num" name="Work Number" type="text" placeholder="Work Number" class="form-control input-md"> </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="home_num">Home Number</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="home_num" name="Home Number" type="text" placeholder="Home Number" class="form-control input-md"> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4"> <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Submit</a> <a href="#" class="btn btn-danger" value=""><span class="glyphicon glyphicon-remove-sign"></span> Clear</a> </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script>
        var profile_dic = {};
        window.onload = retrieve_user_profile();

        function retrieve_user_profile() {
            $.ajax({
                type: "POST"
                , url: 'user_profile_db.php'
                , data: {}
                , success: function (res) {
//                    alert(res);
                    profile_dic = JSON.parse(res);
                    document.getElementById("username").value = profile_dic.username;
                    document.getElementById("username").disabled = true;
                    document.getElementById("email").value = profile_dic.email;
                    document.getElementById("address").value = profile_dic.address;
                    document.getElementById("mobile_num").value = profile_dic.mobile_num;
                    document.getElementById("home_num").value = profile_dic.home_num;
                    document.getElementById("work_num").value = profile_dic.work_num;
                }
            });
        }
        // Retrieve and shows the profile information
    </script>
</body>

</html>