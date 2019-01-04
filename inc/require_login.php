<?php
if (!isset($_SESSION['username'])) {

    $redirect = explode('/', $_SERVER['REQUEST_URI']);
    $redirect = end($redirect);

    if ($redirect == "login.php") {
        header("Location: login.php");
    }

    else {
        $redirect = escape_url($redirect);
        header("Location: login.php?r=$redirect");
    }  
}
?>