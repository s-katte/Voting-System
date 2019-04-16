<?php 
session_start();

if(sizeof($_SESSION) == 0){
   header('Location: index.php');
}

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login</title>
     <!-- Bootstrap CSS CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
     <!-- Our Custom CSS -->
 
     <!-- Font Awesome JS -->
     <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
     <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 
     <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <!-- Popper.JS -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
     <!-- Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js" type="text/javascript"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
        <script>
            $(document).ready(function(){

                $("#txt_uname").keyup(function(){

                    var uname = $("#txt_uname").val().trim();

                    if(uname != ''){

                        $("#uname_response").show();

                        $.ajax({
                            url: 'uname_check.php',
                            type: 'post',
                            data: {uname:uname},
                            success: function(response){
                                console.log(response);
                                // Show status
                                if(response > 0){
                                    $("#uname_response").className += "row";
                                    $("#uname_response").html("<span class='not-exists'>* Username Already in use.</span>");

                                }

                            }
                        });
                    }else{
                        $("#uname_response").hide();
                    }

                });

            });
        </script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a href="logout.php" class="btn btn-primary">logout</a>
</nav>
<?php
echo <<<HTML

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 25%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>


<div class="container-fluid border-rounded d-flex flex-row justify-content-center align-items-center my-5">

<form action="add_cont_db.php" method="POST">
<h2 text-align="right">Add Contestent</h2>
  <div class="imgcontainer">
    <img src="../Images/login.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" class="form-control" id="txt_uname" name="txt_uname" placeholder="Username*" value="" required />
    <div id="uname_response" class="response"></div>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psd" required>
        
    <button type="submit">Add</button>

  </div>  
</form>
</div>


</body>
</html>


HTML;
?>
