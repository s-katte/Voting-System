<?php 
session_start();

if(sizeof($_SESSION) == 0){
   header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>


<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Analysis</title>
<!-- Bootstrap CSS CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<!-- Our Custom CSS -->
 
<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js" type="text/javascript"></script>
<script>
    function show_filters(){
        document.getElementById("filterArea").className = "d-block"
    }

        function set_max_votes(){
            var min = document.getElementById("min_votes").value;
            document.getElementById("max_votes").min = min;
            document.getElementById("max_votes").value = min;
            document.getElementById("votesvalue").value = "";
            document.getElementById("ratevalue").value = "";
        }
        function set_max_rates(){
           var min = document.getElementById("min_rates").value;
            document.getElementById("max_rates").min = min;
            document.getElementById("max_rates").value = min;
            document.getElementById("votesvalue").value = "";
            document.getElementById("ratevalue").value = ""; 
        }
        function erase_val(){
            document.getElementById("max_votes").value = "";
            document.getElementById("min_votes").value = "";
            document.getElementById("max_rates").value = "";
            document.getElementById("min_rates").value = "";
        }
    </script>
</head>


<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a href="logout.php" class="btn btn-primary">logout</a>
</nav>
<div class="card shadow-lg col-11 mx-auto text-center justify-content-center bg-light m-3">
    <div class="btn btn-lg btn-success col-2 mx-auto m-3" onclick="show_filters()">More filters?</div>
        <div class="d-none" id="filterArea">
            <form action="Analysis.php" method="POST" class="form-group">   
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                <h4 class="display text-primary">Votes&#58;</h4>
                            </div>
                            <div class="form-group d-flex flex-row justify-content-center align-items-center">
                                <label for="form-select" id="form-select"></label>
                                <select class="form-control" name="votescomp">
                                    <option>Equal to</option>
                                    <option>Not equal to</option>
                                    <option>Greater than</option>
                                    <option>Greater than equal to</option>
                                    <option>Less than</option>
                                    <option>Less than equal to</option> 
                                </select>
                                <input type="number" min="1" max="10" onchange="erase_val()" class="form-control m-3" placeholder="Enter value" id="votesvalue" name="votesvalue">
                            </div>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                <h4 class="display text-primary">Rate: <small>(in Millions)</small>&#58;</h4>
                            </div>
                            <div class="form-group d-flex flex-row justify-content-center align-items-center">
                                <label for="form-select" id="form-select"></label>
                                <select class="form-control" name="ratecomp">
                                    <option>Equal to</option>
                                    <option>Not equal to</option>
                                    <option>Greater than</option>
                                    <option>Greater than equal to</option>
                                    <option>Less than</option>
                                    <option>Less than equal to</option> 
                                </select>
                                <input type="number" min="1" max="10" onchange="erase_val()" class="form-control m-3" placeholder="Enter value" id="ratevalue" name="ratevalue">
                                </div> 
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                    <h4 class="display text-primary">By City&#58;</h4>
                                </div>
                                <textarea name="city" placeholder="city name"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label for="display" id="mess">OR</label>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                    <h4 class="display text-primary">Votes&#58;</h4>
                                </div>
                                <div class="form-group d-flex flex-row justify-content-center align-items-center">
                                    <input type="number" min="1" max="10" class="form-control m-3" onchange="set_max_votes()" placeholder="min votes" id="min_votes" name="min_votes">
                                    <input type="number" min="1" max="10" class="form-control m-3" placeholder="max votes" id="max_votes" name="max_votes">
                                </div>
                            </div> 
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-2 d-flex flex-row justify-content-center align-items-center">
                                    <h4 class="display text-primary">Rates&#58;</h4>
                                </div>
                                <div class="form-group d-flex flex-row justify-content-center align-items-center">
                                    <input type="number" min="1" max="10" class="form-control m-3" onchange="set_max_rates()" placeholder="min rates" id="min_rates" name="min_rates">
                                    <input type="number" min="1" max="10" class="form-control m-3" placeholder="max rates" id="max_rates" name="max_rates">
                                </div>
                            </div> 
                        </div>
                    </div>
                    <hr class="col-6">
                    <button class="btn col-1 btn-primary" type="submit" value="submit" id="submit" onclick="">
                        Go
                    </button>
                </form>
            </div>
        </div>
    </div> 

<!--
#php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //$test = ['Genre'=>['$all'=>['Action']], 'Rank'=>['$ne'=>5], 'Votes'=>['$gt'=>1500000]];
    //$test = ["Runtime_in_minutes"=>['$eq'=> 121]];
    //print_r($test);
    //echo gettype($test);
    //echo '<br>';

    $comp_ops = ['Equal to'=>'$eq', 'Not equal to'=>'$ne', 
                'Greater than'=>'$gt', 'Greater than equal to'=>'$gte', 
                'Less than'=>'$lt', 'Less than equal to'=>'$lte'];

    if ($_POST['genre'] != 'Any'){
        $filter['Genre'] = ['$all'=>[$_POST['genre']]];
    }
    if ($_POST['actor'] != ''){
        $filter['Actors'] = ['$regex'=>$_POST['actor']];
    }
    if ($_POST['rankvalue'] != ''){
        $filter['Rank'] = [$comp_ops[$_POST['rankcomp']]=>(int)$_POST['rankvalue']];
    }
    if ($_POST['yearvalue'] != ''){
        $filter['Year'] = [$comp_ops[$_POST['yearcomp']]=>(int)$_POST['yearvalue']];
    }
    if ($_POST['runtimevalue'] != ''){
        $filter['Runtime_in_minutes'] = [$comp_ops[$_POST['runtimecomp']]=>(float)$_POST['runtimevalue']];
    }
    if ($_POST['votesvalue'] != ''){
        $filter['Votes'] = [$comp_ops[$_POST['votescomp']]=>(float)$_POST['votesvalue']];
    }
    if ($_POST['revenuevalue'] != ''){
        $filter['Revenue_in_Millions'] = [$comp_ops[$_POST['revenuecomp']]=>(float)$_POST['revenuevalue']];
    }
    if ($_POST['metascorevalue'] != ''){
        $filter['Metascore'] = [$comp_ops[$_POST['metascorecomp']]=>(float)$_POST['metascorevalue']];
    }
    //print_r($filter);
    //echo gettype($filter);
} <-->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
   //    print_r($_POST);


//Array ( [votescomp] => Greater than [votesvalue] => 8 [revenuecomp] => Not equal to [revenuevalue] => 10 [city] => gh [min_votes] => 1 [max_votes] => 3 [min_rates] => 3 [max_rates] => 5 ) 

$comp_ops = ['Equal to'=>'$eq', 'Not equal to'=>'$ne', 
                'Greater than'=>'$gt', 'Greater than equal to'=>'$gte', 
                'Less than'=>'$lt', 'Less than equal to'=>'$lte'];

if($_POST["votesvalue"] != ""){
    $filter["votes"] = [$comp_ops[$_POST['votescomp']]=>(int)$_POST['votesvalue']];
}

if($_POST["ratevalue"] != ""){
    $filter["rates"] = ['$gte' => (int)$_POST["min_rates"], '$lte' => (int)$_POST["max_rates"]];
}

if($_POST["city"] != ""){
    $filter["city"] = $_POST["city"];
}

if($_POST["min_votes"] != "" && $_POST["max_votes"] != ""){
    $filter["votes"] = ['$gte' => (int)$_POST["min_votes"], '$lte' => (int)$_POST["max_votes"]];
}

if($_POST["min_rates"] != "" && $_POST["max_rates"] != ""){
    $filter["rated_by"] = array ('$ne' => []);
    $filter["rates"] = ['$gte' => (int)$_POST["min_rates"], '$lte' => (int)$_POST["max_rates"]];
}

$filter["type"] = "contestent";


print_r($filter);


    $dbname = 'Voting_system';
    $c_user = 'sign_up';
    $conn = new MongoDB\Driver\Manager('mongodb://localhost:27017');

    $query = new MongoDB\Driver\Query($filter, []);
    $cursor = $conn->executeQuery("$dbname.$c_user", $query);
    $count = 0;
    foreach($cursor as $c){
        
        $rated_by = 0;
            foreach($c->rated_by as $r){
                $rated_by += 1;
            }
            echo '<br><br>'.$c->fname;

        echo'
        <div class="col-sm-4">
            <div class="card shadow-lg">
                <img class="card-img-top img-fluid" src="../Images/profile.jpeg" style="width: 100em; height: 20em;">
                <div class="card-body">
                    <h5 class="card-title">'.$c->fname.'  '.$c->lname.'</h5>
                                
                    <p class="card-text">'.$c->about.'</p>
                    <hr>';
    if($count1 == 1){
                    echo'
                    <a href="vote_to.php?cont='.$c->uname.'" id="vote" class="btn btn-primary">Vote</a>
                    <a href="contestent_profile.php?uname='.$c->uname.'" class="btn btn-primary">view Profile</a>
                </div>
            </div>
        </div>
        ';}
    else{           echo'
                    <a href="contestent_profile.php?uname='.$c->uname.'" class="btn btn-primary">view Profile</a>
                </div>  
            </div>
        </div>';}

    }


}
?>
</body>
</html>