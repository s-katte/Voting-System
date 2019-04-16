<?php
session_start();

$conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$dbname = 'Voting_system';
$c_user = 'sign_up';

$uname = $_POST['uname'];

        $filter = ['uname' => "$uname" ,
    				'type' => 'admin'];
        $options = [];
        
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $conn->executeQuery("$dbname.$c_user", $query);
        
        $count = 0;
        
        foreach ($cursor as $document){
            $count = $count + 1;
        }
echo $count;

?>
