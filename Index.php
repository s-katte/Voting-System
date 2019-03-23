<?php



?>

<!DOCTYPE html>
<html>

<body>

<style>
.btn-group button {
  position: relative;
  background-color: #F0F8FF;
  border-radius: 50%;
  font-size: 28px;
  margin:auto;
  color: #000000;
  padding: 20px;
  width: 400px;
  text-align: center;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  text-decoration: none;
  overflow: hidden;
  cursor: pointer;
  display: block
  
}

.btn-group button:not(:last-child) {
  border-bottom: none; /* Prevent double borders */
}


/*This testog comment for change */+

.btn-group button:after {
  content: "";
  background: #f1f1f1;
  display: block;
  position: absolute;
  padding-top: 300%;
  padding-left: 350%;
  margin-left: -20px !important;
  margin-top: -120%;
  opacity: 0;
  transition: all 0.8s
}

.btn-group button:active:after {
  padding: 0;
  margin: 0;
  opacity: 1;
  transition: 0s
}

</style>

<img src="https://www.worthofread.com/wp-content/uploads/2017/01/who-are-you.jpg" alt="Who you are?" 
width="500" height="200"

style="position: relative;
  display: block;
  border-radius: 8px;
  margin-left: auto;
  margin-right: auto;
  z-index: 1;"
>
<div class="btn-group">
  <button>I AM A VIEWER</button>
  <button>I AM A CONTESTANT</button>
  <a href = "Admin/login.php" class = "btn btn-dark text-black"> I AM AN ADMIN </a>
  
</div>



</body>
</html>