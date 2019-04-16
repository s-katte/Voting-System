<?php 
session_start();

if(sizeof($_SESSION) == 0){
   header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Contestent List</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="Home_1.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>
 <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="logout.php" class="btn btn-primary">logout</a>
            </nav>

<div class="container-fluid border rounded">
    <div class="row text-center p-5 justify-content-around">

    <?php 

    $dbname = 'Voting_system';
    $c_user = 'sign_up';
    $conn = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $filter = ['by' => $_SESSION['user'], 'added' => 1];
    $query = new MongoDB\Driver\Query($filter, []);
    $cursor = $conn->executeQuery("$dbname.$c_user", $query);
    $count = 0;
    foreach($cursor as $c){
        
        echo '
        <div class="col-sm-4">
            <div class="card shadow-lg">
                <img class="card-img-top img-fluid" src="../Images/profile.jpeg" style="width: 100em; height: 20em;">
                <div class="card-body">
                    <h5 class="card-title">'.$c->fname.' '.$c->lname.'</h5>
                    <p class="card-text">'.$c->about.'</p>
                    <hr>
                    <p class="card-text text-danger">___no of votes</p><br>
                    <a href="contestent_profile.php" class="btn btn-primary">View Profile</a>
                </div>
            </div>
        </div>';
        $count += 1;
    }

    if($count == 0){
        echo'<h1>No contestent has yet submitted the details!!</h1>';
    }

    ?>
    </div> 
</div>
</body>
</html>  