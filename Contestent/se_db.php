<?php 
session_start();

$uname = $_POST['uname'];
$psd = $_POST['psd'];

$dbname = 'Voting_system';
$c_user = 'sign_up';
print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $uname = test_input($_POST["uname"]);
    $psd = test_input($_POST["psd"]);

	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017'); 
        
    $filter = ['uname' => "$uname",
    			'type' => 'contestent' ];
    $options = [];
        
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery("$dbname.$c_user", $query);
    $count = 0;
    foreach ($cursor as $kc) {//
    	$count += 1;
    }
    echo $count;
    $hashedpwd = password_verify($psd, $kc->psd);

    if($hashedpwd == true && $count > 0){
    	echo"True";
        $_SESSION['user'] = $uname;
    	header("location: add_profile.php");
    }

    else{
    	header("Location: login.php?password_not_match");
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>