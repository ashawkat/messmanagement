<?php

    require 'config.php';

    session_start();
    if( isset( $_SESSION["login"] ) ) {
        header( "Location: dashboard.php" );
        exit(); }

    $con = dbConnect();

    if ( $con ) {
        if ( isset( $_REQUEST['login'] ) ) {
            $result = login( $_REQUEST, $con );
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/skeleton.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <title>Mess Management</title>
</head>
<body>
    <div class="wrapper login">
        <div class="container">
            <div class="row">
                <div class="six offset-by-three columns">
                    <h3 class="intro-title">Mess Management System V 1.0</h3><small>by John</small>
                    <?php if ( isset( $result ) ) : ?>
                    <div class="error"><?php echo $result; ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <label for="username">Username</label>
                        <input class="u-full-width" name="username" type="text" placeholder="Enter username..." id="username">
                        <label for="exampleEmailInput">Password</label>
                        <input class="u-full-width" name="password" type="password" placeholder="Enter password..." id="password">
                        <input name="login" type="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
