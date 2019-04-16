<?php
session_start();
    
$dbname = 'Voting_system';
$c_user = 'sign_up';

$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $uname = test_input($_POST["txt_uname"]);
    $email = test_input($_POST["email"]);
    $psd = test_input($_POST["psd"]);
    $cpsd =  test_input($_POST["cpsd"]);
    if($psd != $cpsd){
    	header("Location: index.php?password_not_matcg");
    }
    $hashed_psd = password_hash($psd, PASSWORD_DEFAULT);
	$hashed_cpsd = password_hash($cpsd, PASSWORD_DEFAULT);

	$user = array(
                'type' => 'admin',
                'fname' => $fname,
                'lname' => $lname,
                'uname' => $uname,
                'email' => $email,
                'psd' => $hashed_psd,
                'cpsd' => $hashed_cpsd
            );

			$single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert->insert($user);

            $conn->executeBulkWrite("$dbname.$c_user", $single_insert);
            header("Location: index.php?signup=success");
            echo "$name added succesfully.";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>