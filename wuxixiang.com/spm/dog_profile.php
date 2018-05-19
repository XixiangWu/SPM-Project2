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
                                <label class="col-md-4 control-label" for="name"></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input id="name" name="Name" type="text" placeholder="Name" class="form-control"> </div>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="breed"></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input id="breed" name="breed" type="text" placeholder="Breed" class="form-control input-md"> </div>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="address"></label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <textarea id="dob" rows=3 name="dob" type="text" placeholder="Date of Birth" class="form-control input-md"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4"> <a href="#" class="btn btn-success" onclick="modify_dog_data()"><span class="glyphicon glyphicon-thumbs-up"></span> Modify </a> <a href="#" class="btn btn-danger" value=""><span class="glyphicon glyphicon-remove-sign"></span> Clear</a> </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script>
            window.onload = retrieve_dog_profile();
            // Retrieve and shows the profile information
            function retrieve_dog_profile() {
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var value = url.searchParams.get("value");
                $.ajax({
                    type: "POST"
                    , url: 'dog_profile_db.php'
                    , data: {
                        op: "READ"
                        , value: value
                    }
                    , success: function (res) {
                        var profile_dic = JSON.parse(res);
                        document.getElementById("name").value = profile_dic.dogname;
                        document.getElementById("breed").value = profile_dic.dogbreed;
                        document.getElementById("dob").innerHTML = profile_dic.dogdob;
                    }
                });
            }
            function modify_dog_data() {
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var value = url.searchParams.get("value");
                $.ajax({
                    type: "POST"
                    , url: 'dog_profile_db.php'
                    , data: {
                        op: "MODI"
                        , value: value
                        , name: document.getElementById("name").value
                        , breed: document.getElementById("breed").value
                        , dob: document.getElementById("dob").innerHTML
                    }
                    , success: function (res) {
                        alert("Change Successfully!" + res);
                        window.location = 'index.php';
                    }
                });
            }
            
        </script>
</body>

</html>