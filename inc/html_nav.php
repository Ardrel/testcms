<?php
$url = explode('/', $_SERVER['REQUEST_URI']);
$url = end($url);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            
    <a class="navbar-brand" href="home.php"><i class="fas fa-power-off mr-2"></i>Elite Testing Corporation</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
        <ul class="navbar-nav ml-auto mr-md-3">
        
        <li class="nav-item<?=($url == "home.php" ? " active" : "")?>">
            <a class="nav-link" href="home.php">Home<?=($url == "home.php" ?  ' <span class="sr-only">(current)</span>' : '')?></a>
        </li>
        <li class="nav-item<?=($url == "changepassword.php" ? " active" : "")?>">
            <a class="nav-link" href="changepassword.php">Change Password<?=($url == "changepassword.php" ?  ' <span class="sr-only">(current)</span>' : '')?></a>
        </li>
        <li class="nav-item<?=($url == "newuser.php" ? " active" : "")?>">
            <a class="nav-link" href="newuser.php">New User<?=($url == "newuser.php" ?  ' <span class="sr-only">(current)</span>' : '')?></a>
        </li>

        </ul>

          <a href="<?=(isset($_SESSION['username'])) ? "logout.php" : "login.php"?>" class="btn btn-sm btn-primary my-2 my-md-0">
            <?=(isset($_SESSION['username'])) ? "Logout" : "Login"?>
          </a>

    </div>
</nav>