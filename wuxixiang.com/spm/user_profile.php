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
                                        <textarea id="address" rows=3 name="address" type="text" placeholder="Address" class="form-control input-md">Address</textarea>
                                    </div>
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
                            <!-- Dog Profile starts here -->
                            <label class="col-md-4 control-label" for="email">Dog Profile</label>
                            <div class="row" id="dog_profile_row">
                                
                            </div>
                            <!-- Dog profile stops here -->
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4"> <a href="#" class="btn btn-success" onclick="modify_user_profile()"><span class="glyphicon glyphicon-thumbs-up"></span> Submit</a> <a href="#" class="btn btn-danger" value=""><span class="glyphicon glyphicon-remove-sign"></span> Clear</a> </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var profile_dic = {};
            window.onload = retrieve_user_profile();
            // Retrieve and shows the profile information
            function retrieve_user_profile() {
                create_dog_card();
                $.ajax({
                    type: "POST"
                    , url: 'user_profile_db.php'
                    , data: {
                        op: "READ"
                    }
                    , success: function (res) {
                        profile_dic = JSON.parse(res);
                        //                    alert(res);
                        document.getElementById("username").value = profile_dic.username;
                        document.getElementById("username").disabled = true;
                        document.getElementById("email").value = profile_dic.email;
                        document.getElementById("email").disabled = true;
                        document.getElementById("address").value = profile_dic.address;
                        document.getElementById("mobile_num").value = profile_dic.mobile_num;
                        document.getElementById("home_num").value = profile_dic.home_num;
                        document.getElementById("work_num").value = profile_dic.work_num;
                    }
                });
            }
            // Modify the data in database
            function modify_user_profile() {
                $.ajax({
                    type: "POST"
                    , url: 'user_profile_db.php'
                    , data: {
                        op: "MODI"
                        , address: document.getElementById("address").value
                        , mobile_num: document.getElementById("mobile_num").value
                        , home_num: document.getElementById("home_num").value
                        , work_num: document.getElementById("work_num").value
                    }
                    , success: function (res) {
                        alert("Success!" + res);
                    }
                });
            }
            
            function create_dog_card() {

                var colDiv = document.createElement('div');
                colDiv.className = 'col-md-4';
                
                var boxShadowDiv = document.createElement('div');
                boxShadowDiv.className = 'card mb-4 box-shadow';
                
                var cardDiv = document.createElement('div');
                cardDiv.className = 'card-body';
                
                var dog_name = document.createElement('h1');
                dog_name.innerHTML = "Lucky";
                
                var dog_breed = document.createElement('p');
                dog_breed.innerHTML = "Beagle";
                
                var dog_dob = document.createElement('small');
                dog_dob.className = "text-muted";
                dog_dob.innerHTML = "2018-01-01";
                
                var buttons = document.createElement('div');
                buttons.className = "d-flex justify-content-between align-items-center";
                
                var btn_group = document.createElement('div');
                btn_group.className = "btn-group";
                var btn_view = document.createElement('button');
                var btn_edit = document.createElement('button');
                btn_view.className = "btn btn-sm btn-outline-secondary";
                btn_edit.className = "btn btn-sm btn-outline-secondary";
                btn_view.type = "button";
                btn_edit.type = "button";
                btn_view.innerHTML = "View";
                btn_edit.innerHTML = "Edit";
                
                
                btn_group.appendChild(btn_view);
                btn_group.appendChild(btn_edit);
                buttons.appendChild(btn_group);
                buttons.appendChild(dog_dob);
                cardDiv.appendChild(dog_name);
                cardDiv.appendChild(dog_breed);
                cardDiv.appendChild(buttons);
                boxShadowDiv.appendChild(cardDiv);
                colDiv.appendChild(boxShadowDiv);
                
                
                
                document.getElementById("dog_profile_row").appendChild(colDiv);
            }
//                            "<div class="col-md-4">
//                                    <div class="card mb-4 box-shadow">
//                                        <div class="card-body">
//                                            <h1>Lucky</h1> 
//                                            <p>Beagle</p>
//                                            <div class="d-flex justify-content-between align-items-center">
//                                                <div class="btn-group">
//                                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
//                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
//                                                </div>
//                                                
//                                                <small class="text-muted">2018-1-4</small>
//                                            </div>
//                                        </div>
//                                    </div>
//                                </div>";
        </script>
</body>

</html>