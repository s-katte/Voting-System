<?php
session_start();

print_r($_POST);

$dbname = "Voting_system";
$coll = "sign_up";
$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $uname = $_POST["txt_uname"];
    $psd = $_POST['psd'];

    $user =  array('type'=> 'contestent',
                    'by' => $_SESSION['user'],
    				'uname' => $uname,
					'psd'=> password_hash($psd, PASSWORD_DEFAULT),
					'added' => 0,
                    'comments' => [],
                    'votes' => 0);

            

            $single_insert = new MongoDB\Driver\BulkWrite();
            $single_insert->insert($user);

            $conn->executeBulkWrite("$dbname.$coll", $single_insert);
            echo " added succesfully.";
header("Location: add_contestent.php")

?>