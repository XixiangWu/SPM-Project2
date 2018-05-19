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
                                <div class="col-md-4"> <a href="#" class="btn btn-success" onclick="add_new_dog()"><span class="glyphicon glyphicon-thumbs-up"></span> Add new dog</a> <a href="#" class="btn btn-danger" value=""><span class="glyphicon glyphicon-remove-sign"></span> Clear</a> </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var profile_dic = {};
            // Retrieve and shows the profile information
            function add_new_dog() {
                $.ajax({
                    type: "POST"
                    , url: 'newdog_db.php'
                    , data: {
                        op: "ADD"
                        , name: document.getElementById("name").value
                        , breed: document.getElementById("breed").value
                        , dob: document.getElementById("dob").value
                    }
                    , success: function (res) {
                        alert("Your dog is logged in our database!");
                        window.location = 'index.php';
                    }
                });
            }
        </script>
</body>

</html>