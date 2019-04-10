<?php

$dbname = 'Voting_system';
$c_user = 'sign_up';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $uname = test_input($_POST["uname"]);
    $psd = test_input($_POST["psd"]);

        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017'); 
        
        $filter = ['uname' => "$uname" ];
        $options = [];
        
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $manager->executeQuery("$dbname.$c_user", $query);
        
        $count = 0;
        
        foreach ($cursor as $dd){
            $count = $count + 1;    
        }
        
        if ($count == 0){
            header("Location: index.php?login=NoUsernameError");
            exit();
        }
        
        else{   
        
        
            $hashedpwd = password_verify($psd, $dd->psd);
            
            if($hashedpwd == false){
                header("Location: index.php?login=PwError");
                exit();
            }
            
            elseif($hashedpwd == true){
            $_SESSION['user'] = $uname;
            
	        header("Location: index.php?user=".$uname);}
    
}}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
