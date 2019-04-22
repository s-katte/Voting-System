<?php  
session_start();

if(sizeof($_SESSION) == 0){
   header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Contestent Profile</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="home.css">
    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<meta charset="utf-8">
   <script src="jquery-3.1.1.min.js" type="text/javascript"></script> 

        <meta name="viewport" content="initial-scale=1,width=device-width">
        <link rel="stylesheet" href="StarRating.css">
        <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<script>
    function get_star(){
      for (var i = 2; i >= 0; i--) {
      
      var val = document.getElementById("star").value;}
      console.log(val);
    }
</script>
<!--
<script>
  
    

    function mufunc(){
      var comment = document.getElementById("user_cmt").value;
      var to = $.trim($("#contestent").html());
      console.log(to);
      console.log(comment);
      if(comment != ""){
        $.ajax({
                  url: "add_comment.php",
                  type: "POST",      
                  processData: false,
                  data:{comment:comment,
                        to:contestent} });
      }
      else{
        alert("Blank Comment!!");
      }
    }
</script>
-->
</head>


<body>
 <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="logout.php" class="btn btn-primary">logout</a>
            </nav>

<div class="container-fluid border rounded">
<div class="container">

  <?php 
    $dbname = 'Voting_system';
    $c_user = 'sign_up';
    $conn = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $filter = [ 'added' => 1, 'uname' => $_GET["uname"]];
    $query = new MongoDB\Driver\Query($filter, []);
    $cursor = $conn->executeQuery("$dbname.$c_user", $query);

foreach($cursor as $c){
  $rated_by = 0;
  foreach($c->rated_by as $r){
      $rated_by += 1;
  }
echo'
  <div class="card" style="width:600px">
    <img class="card-img-top" src="../Images/profile.jpeg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 id="contestent" class="card-title">'.$c->fname." ".$c->lname.'</h4>
      <p class="card-text">'.$c->about.'</p>
      <hr>
      <div class="row justify-content-around">
        <form col="9" action="rate.php ">
        <div class="row justify-content-around">
          <input type="hidden" name="contestent" value="'.$c->uname.'"/>
          <input type="number" min="1" max="10" class="form-control col-5 m-1" placeholder="Rate me" id="rating" name="rating">
          <button class="btn-primary form-control text-center col-5 m-1" type="submit"> rate </button>
        </div>
        </form>';
        if($rated_by == 0){
          echo'<label class="col-3">0 / 0<p>by '.$rated_by.' people</label>';
        }
        else{
          $avg = $c->rate_sum / $rated_by;
          echo'
        <label class="col-3">'.round($avg, 1).' / 10<p>by '.$rated_by.' people</label>';
        }echo'
      </div>
      <hr>
        <form method="GET" action="add_comment.php">
          <div class="form-group">
            <textarea class="form-control" rows="2" name="user_cmt" id="user_cmt" placeholder="add your comment here.."></textarea>
          </div>
          <input type="hidden" name="to" id="to" value="'.$c->uname.'"> 
          <button class="col-3 btn-lg btn btn-primary" type="submit">comment</button>
        </form>
      <hr>';
foreach($c->comments as $comment){
  foreach($comment as $by=>$comm){
      echo'
      <label class="card-text">'.$by.': '.$comm.'</label><br>';}}
      echo'
    </div>
  </div>';
}
?>
</div>

</body>
