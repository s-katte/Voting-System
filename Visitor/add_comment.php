<?php 
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET"){



	$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$dbname = "Voting_system";
	$coll = "sign_up";
  	$bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);

  	$comment_to = $_GET['to'];
  	$comment = $_GET['user_cmt'];

  	echo $comment_to;
  	echo $comment;

  	$bulk->update([ 'uname' => $comment_to, "type" => "contestent"],
                  ['$push' => ["comments" => array($_SESSION["user"] => $comment)]]); 

	$conn->executeBulkWrite("$dbname.$coll", $bulk); 
}

header("Location: contestent_profile.php?uname=".$comment_to);

?>