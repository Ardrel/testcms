<?php 
require ("inc/common.php");
require ("inc/require_login.php");
require "inc/html_header.php";

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit(); //needed because it apparently still runs php code after the redirect
}
?>
<body>
    
    <?php require "inc/html_nav.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-8 col-sm-5"><?php 

//if button was pressed
if (isset($_POST['create']) ) {

    //Check for bad input
    if ($_POST['username'] == '' || $_POST['password'] == '') { 
        ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            You must enter both a username and password.
        </div>
        <?php
    } 
    
    //If input is not bad
    else {
        
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        //Check if connnection succeeded
        if($connection) {
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $hash = password_hash("$password", PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, password)";
            $query .= " VALUES('$username','$hash')";
            $result = mysqli_query($connection, $query);
            if ($result) echo "User $username created.";
                else echo "Could not create user.";
        }

        //If the connection did not succeed
        else { ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Connection to database failed, please try again later.
            </div> <?php
        }
    }

} 
?>
                <h2>New User</h2>
                <form method="post">        
                    <div class="form-group">    
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control" type="text" name="username" id="username">
                        </div>

                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="create" value="Create">

                </form>
            </div>
        </div>  

    </div>
<?php require "inc/footer.php"; ?>

</body>
</html>