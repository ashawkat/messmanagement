<?php
    require 'config.php';
    isUserLoggedIn();

    $con = dbConnect();

    if ( $con ) {
        if ( isset( $_REQUEST['ban'] ) ) {
            $result = modStaff( $_REQUEST, $con );
        } elseif ( isset( $_REQUEST['active'] ) ) {
            $result = modStaff( $_REQUEST, $con );
        } else {
            header( 'Location: staff.php' ); exit;
        }
    }
?>
<?php require 'header.php' ?>
<?php require 'navbar.php' ?>
<?php require 'footer.php' ?>
