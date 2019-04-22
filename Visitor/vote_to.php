<?php
session_start();


if($_SERVER['REQUEST_METHOD'] == "GET"){

    
	$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$dbname = "Voting_system";
	$coll = "sign_up";
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

  $voted_to = $_GET['cont'];


  $bulk->update([ 'uname' => $_SESSION['user']],
                  ['$set' => ['voted' => 1,
                              'voted_to' => $voted_to
                ]]); 

	$conn->executeBulkWrite("$dbname.$coll", $bulk);
  
  $bulk1 = new MongoDB\Driver\BulkWrite(['ordered' => true]);

  $bulk1->update(['type' => 'contestent', 'uname' => $voted_to],
                  ['$inc' => ['votes'=>1]]);
  $conn->executeBulkWrite("$dbname.$coll", $bulk1);
  
  echo"<h1>YOU ARE ADDED SUCCESFULLY!!</h1>";
  echo"aaa";
  header("Location: contestent_list.php");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
