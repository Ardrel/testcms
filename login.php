<?php 
require ("inc/common.php");

$login_failed = false;
$password_incorrect = false;



// redirect if logged in
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

// if not logged in
else {
    
    //if login button was pressed
    if (isset($_POST['login'])) {
        //Make sure all form fields are filled out
        if ($_POST['username'] == '' || $_POST['password'] == '') {
            $login_failed = true;
        }
        
        //Proceed with login
        else {
            
            $username = safe($connection, $_POST['username']);
            $password = safe($connection, $_POST['password']);
    
            $query = "SELECT id, username, password FROM users";
            $query .= " WHERE username = '$username'";
            $result = mysqli_query($connection, $query) or die(mysql_error());
            
            $row = mysqli_fetch_assoc($result);
                //check password
                if (password_verify($password, $row['password'])) {
                    
                    $_SESSION['username'] = $username;

                    if(isset($_GET['r'])) { //redirect to original page, if applicable
                        $redirect = unescape_url($_GET['r']);
                        header("Location: $redirect");
                        exit();
                    }
                    else {
                        header("Location: home.php");
                        exit();
                    }
                
                }
                //password did not match
                else {
                    $password_incorrect = true;
                }
        }
    }
/*
--------------
Start page HTML
--------------
*/
require "inc/html_header.php";
?>

<body>
<?php require "inc/html_nav.php"; ?>

    <section class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-lg-5"><?php

            //Error message if the password was incorrect
            if($password_incorrect) { 
                ?><div class="alert alert-danger alert-dismissible">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Username or password incorrect. Please try again!
                </div> 
            <?php }

            //Error message if some fields were left empty
            if($login_failed) { ?>
                <div class="alert alert-danger alert-dismissible">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                You must enter both a username and password.
            </div>
        <?php } ?>

            <?=(isset($_GET['r'])) ? '<p style="text-align: center;"><i style="font-size: 125%;" class="fas fa-exclamation-circle"></i> You must login to visit this page!<p>'."\n" : ""?>
            <div class="card justify-content-center" style="border-radius: 5px;">
                <h1 class="card-header" style="text-align: center;">Site Login</h1>
                <div class="card-body">
                    <form method="post">
                        
                        <div class="form-group">    
                            <label for="username">Username</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input class="form-control" type="text" id="username" name="username">
                            </div>

                            <label for="password">Password</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>

                        </div>
                        
                            <div class="d-flex justify-content-center">
                                <input class="btn btn-primary w-50" type="submit" name="login" value="Log in">
                            </div> 
                    </form>
                </div>

            </div><?php
}
?>           
            </div>
        </div>  
    </section>
<?php require "inc/footer.php";?>

</body>
</html>