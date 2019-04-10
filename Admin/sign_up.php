<?php

print_r($_POST);

$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbname = 'Voting_system';
$c_user = 'sign_up';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $uname = test_input($_POST["uname"]);
    $email = test_input($_POST["email"]);
    $psd = test_input($_POST["psd"]);
    $cpsd =  test_input($_POST["cpsd"]);


        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        
        $filter = ['uname' => "$uname" ];
        $options = [];
        
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $manager->executeQuery("$dbname.$c_user", $query);
        
        $count = 0;
        
        foreach ($cursor as $document){
            $count = $count + 1;
        }
        
        if($count > 0){
            header("Location: index.php?sign_up=usertaken");
        }
        
        if($psd != $cpsd){
                header("Location: index.php?signup=paswword_not_match");
        }
        
            else{
                $hashed_psd = password_hash($psd, PASSWORD_DEFAULT);
                $hashed_cpsd = password_hash($cpsd, PASSWORD_DEFAULT);
                //Insert data in DB
                $user = array(
                'type' => 'admin'
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
            echo "$name added succesfully.";

            header('Location: index.php?signup=success');
            exit();
            }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
