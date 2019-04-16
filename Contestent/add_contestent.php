<?php
session_start();


if($_SERVER['REQUEST_METHOD'] == "POST"){

    print_r($_POST);
    
	$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$dbname = "Voting_system";
	$coll = "sign_up";
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

	$fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
  $email = test_input($_POST["email"]);
  $about = test_input($_POST["about"]);

  $bulk->update([ 'uname' => $_SESSION['user']],
                  ['$set' => ['fname' => $fname,
                              'lname' => $lname,
                              'email' => $email,
                              'about' => $about,
                              'added' => 1
                ]]);

	$conn->executeBulkWrite("$dbname.$coll", $bulk);

    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
