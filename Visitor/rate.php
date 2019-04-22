<?php
session_start();


if($_SERVER['REQUEST_METHOD'] == "GET"){

    
	$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$dbname = "Voting_system";
	$coll = "sign_up";

  $rated_to = $_GET['contestent'];
  
  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => true]);
//---------------
$filter = [ 'added' => 1, 'uname' => $rated_to];
  $query = new MongoDB\Driver\Query($filter, []);
  $cursor = $conn->executeQuery("$dbname.$coll", $query);

   $ctr = 0;
  foreach ($cursor as $c) {
    foreach($c->rated_by as $r){
      foreach ($r as $key => $value) {
        if($key == $_SESSION["user"]){
          $ctr = $ctr + 1;
        }
      }
    }
  }
echo $ctr;

if($ctr == 0){
  $bulk1->update(['type' => 'contestent', 'uname' => $rated_to],
                  ['$inc' => ['rate_sum'=> (int)$_GET["rating"]],
              	  '$push' => ["rated_by" => array($_SESSION["user"] => (int)$_GET["rating"])]]);
  $conn->executeBulkWrite("$dbname.$coll", $bulk1);
}else{
	echo"<script type='text/javascript'>alert('You have already voted');</script>";
}
  
  
  echo"<h1>YOU ARE ADDED SUCCESFULLY!!</h1>";
  echo"aaa";
  header("Location: contestent_profile.php?uname=".$rated_to);
}
?>