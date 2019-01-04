<?php
require ("inc/common.php");
require ("inc/require_login.php");
require ("inc/html_header.php");

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
 
//Do if the form was submitted
if (isset($_POST['update']) ) {

    //Check for empty fields
    if ($_POST['username'] == '' || $_POST['password'] == '' || $_POST['newpassword'] == '') { 
        ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            You must enter a username, password, and new password.
        </div>
        <?php
    } 
    
    else {
        
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $newpassword = mysqli_real_escape_string($connection, $_POST['newpassword']);

        //If connnection failed
        if(!$connection) {
            ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Connection to database failed, please try again later.
            </div>
            <?php
        }

        //If the regular and new password are the same
        elseif ($password == $newpassword) {
            echo '<span class="badge badge-warning">Error</span><br>Please enter a password different from what you have now.<br><br>';
        }
        
        else {
            //Retrieve password for user
            $result = mysqli_query($connection, "SELECT password FROM users WHERE username = '$username'");
            $row = mysqli_fetch_assoc($result);

            //If provided user does not exist
            if(!$row) {
                echo "Please check the entered usename.<br>";
            }

            //If passwords do not match
            elseif (!password_verify($password, $row['password']) ) {
                echo '<span class="badge badge-danger">Error</span><br>Passwords do not match.<br><br>';
            }

            //Change the password; all checks passed
            else {
                $hash = password_hash($newpassword, PASSWORD_DEFAULT);
                $query = "UPDATE users";
                $query .= " SET password = '$hash'";
                $query .= " WHERE username = '$username'";

                $result = mysqli_query($connection, $query);
                if ($result) echo '<span class="badge badge-success">Success</span><br>Password successfully changed.<br><br>';
                else echo mysqli_error($connection);
            }          
        }
    }
} ?>

            <h2>Change Password</h2>
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

                    <label for="newpassword">New password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input class="form-control" type="password" name="newpassword" id="newpassword">
                    </div>
                </div>
            <input class="btn btn-primary" type="submit" name="update" value="Update">
            </form>
            </div>
        </div>  
    </div>
<?php require "inc/footer.php"; ?>

</body>
</html>