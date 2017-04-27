<?php

// DB connection config function
function dbConnect() {

    $host     = 'localhost';
    $user     = 'root';
    $pass     = '';
    $dbname   = 'mess-management';

    $connection = mysqli_connect( $host, $user, $pass, $dbname );
    // Check connection
    if ( mysqli_connect_errno() ) {
        return "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        return $connection;
    }
}

// Login staffs/admins
function login( $request, $con ) {
    extract( $request );
    $username = stripslashes( $username );
    $username = mysqli_real_escape_string( $con, $username );
    $password = stripslashes( $password );
    $password = mysqli_real_escape_string( $con, $password );
    $query = "SELECT * FROM `mm_user` WHERE mm_user_name='$username' and mm_user_pass='".md5($password)."' and mm_user_status='1'";
    $result = mysqli_query( $con, $query ) or die( mysql_error() );
    $rows = mysqli_num_rows( $result );
    if( $rows == 1 ){
        $row = mysqli_fetch_assoc( $result );
        if ( $row['mm_user_status'] == 1 ) {
            session_start();
            $_SESSION = array(
                'login'          => true,
                'mm_user_id'     => $row['mm_user_id'],
                'mm_user_name'   => $row['mm_user_name'],
                'mm_user_email'  => $row['mm_user_email'],
                'mm_user_mobile' => $row['mm_user_mobile'],
                'mm_user_role'   => $row['mm_user_role'],
            );
            header("Location: dashboard.php");
        } else{
           return 'User is not active';
        }
    } else {
        return 'Username/Password is incorrect';
    }
}

// Register new staffs
function registerStaff( $request, $con ) {
    extract( $request );

    $username = stripslashes( $username );
    $username = mysqli_real_escape_string( $con, $username );
    $usermail = stripslashes( $usermail );
    $usermail = mysqli_real_escape_string( $con, $usermail );
    $usermobile = stripslashes( $usermobile );
    $usermobile = mysqli_real_escape_string( $con, $usermobile );
    $staffjoined = stripslashes( $user_created );
    $staffjoined = mysqli_real_escape_string( $con, $staffjoined );
    $password = stripslashes( $password );
    $password = mysqli_real_escape_string( $con, $password );
    // Check if given username is already exists or not
    $checkingQuery = "SELECT * FROM `mm_user` WHERE mm_user_name='$username'";
    $checkingResult = mysqli_query( $con, $checkingQuery ) or die( mysql_error() );
    $checkingRows = mysqli_num_rows( $checkingResult );
    if( $checkingRows == 1 ){
        $_SESSION['error'] = 'Given username already exits, please try another!';
        header( 'Location: staff.php' ); exit;
    } else {
        $query = "INSERT INTO `mm_user` SET mm_user_name='$username', mm_user_email='$usermail', mm_user_mobile='$usermobile', mm_user_pass='".md5($password)."', mm_user_created_at='$staffjoined', mm_user_role='2', mm_user_status='1'";
        //debug ( $query ); exit;
        $result = mysqli_query( $con, $query );
        if ( $result ) {
            $_SESSION['success'] = 'Staff Added Successfully';
            header( 'Location: staff.php' ); exit;
        }
    }
}

// Update Staff profile
function updateProfile( $request, $con ) {
    extract( $request );
    if( empty( $password ) || empty( $usermobile ) || empty( $usermail ) ){
        $_SESSION['error'] = 'Provided fields are mendatory!';
        header( 'Location: profile.php' ); exit;
    }
    $sql = "UPDATE mm_user SET mm_user_email='$usermail', mm_user_mobile='$usermobile', mm_user_pass='".md5($password)."' WHERE mm_user_id='$userid'";
    $query = mysqli_query( $con, $sql );
    $row = mysqli_affected_rows ( $con );
    if ( $row == 1 ) {
        $_SESSION['success'] = 'Profile Updated Successfully';
        header( 'Location: profile.php' ); exit;
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header( 'Location: staff.php' ); exit;
    }
}

// Get Staff Profile
function getStaffProfile( $con ) {
    $currentUser = $_SESSION['mm_user_id'];
    $sql = "SELECT * FROM mm_user WHERE mm_user_id='$currentUser'";
    $query = mysqli_query( $con, $sql );
    $result = mysqli_fetch_assoc( $query );
    return $result;
}

// Get Total staffs
function getTotalStaff( $con ) {
    $query = "SELECT * FROM mm_user";
    $result = mysqli_query( $con, $query );
    $rows = mysqli_num_rows( $result );
    return $rows;
}

// Get Total Diposits
function getTotalDiposit( $con ) {
    $currentUser = $_SESSION['mm_user_id'];
    if ( $_SESSION['mm_user_role'] == 1 )
        $query = "SELECT SUM(mm_ud_total) as TOTAL FROM mm_user_diposit";
    else
        $query = "SELECT SUM(mm_ud_total) as TOTAL FROM mm_user_diposit WHERE mm_ud_user='$currentUser'";
    $result = mysqli_query( $con, $query );
    $row = mysqli_fetch_assoc( $result );
    return $row;
}

// Get all staff details
function getStaffDetails( $con ) {
    $query = "SELECT * FROM mm_user";
    $result = mysqli_query( $con, $query );
    return $result;
}

// Get all Diposit details
function getDipositDetails( $con ) {
    $currentUser = $_SESSION['mm_user_id'];
    if ( $_SESSION['mm_user_role'] == 1 )
        $query = "SELECT * FROM mm_user_diposit md LEFT JOIN mm_user mu ON md.mm_ud_user=mu.mm_user_id";
    else
        $query = "SELECT * FROM mm_user_diposit md LEFT JOIN mm_user mu ON md.mm_ud_user=mu.mm_user_id WHERE mu.mm_user_id='$currentUser'";
    $result = mysqli_query( $con, $query );
    return $result;
}

// Get all Meal details
function getMealDetails( $con ) {
    $currentUser = $_SESSION['mm_user_id'];
    if ( $_SESSION['mm_user_role'] == 1 )
        $query = "SELECT * FROM mm_user_meal mm LEFT JOIN mm_user mu ON mm.mm_um_user=mu.mm_user_id";
    else
        $query = "SELECT * FROM mm_user_meal mm LEFT JOIN mm_user mu ON mm.mm_um_user=mu.mm_user_id WHERE mu.mm_user_id='$currentUser'";
    $result = mysqli_query( $con, $query );
    return $result;
}

// Modify staffs whether to ban or make active again
function modStaff( $request, $con ) {
    extract( $request );
    if ( isset( $ban ) ) {
        $_SESSION['success'] = 'Staff banned or got inactive successfully';
        $query = "UPDATE mm_user SET mm_user_status='0' WHERE mm_user_id='$ban'";
    }
    else {
        $_SESSION['success'] = 'Staff activated again successfully';
        $query = "UPDATE mm_user SET mm_user_status='1' WHERE mm_user_id='$active'";
    }
    $result = mysqli_query( $con, $query );
    $row = mysqli_affected_rows ( $con );
    if ( $row == 1 ) {
        header( 'Location: staff.php' ); exit;
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header( 'Location: staff.php' ); exit;
    }
}

// Add staff diposit
function addDiposit( $request, $con ) {
    extract( $request );

    $rent = stripslashes( $rent );
    $rent = mysqli_real_escape_string( $con, $rent );
    $utility = stripslashes( $utility );
    $utility = mysqli_real_escape_string( $con, $utility );
    $meal = stripslashes( $meal );
    $meal = mysqli_real_escape_string( $con, $meal );
    $total = stripslashes( $total );
    $total = mysqli_real_escape_string( $con, $total );
    $billProvided = stripslashes( $billProvided );
    $billProvided = mysqli_real_escape_string( $con, $billProvided );

    $query = "INSERT INTO mm_user_diposit SET mm_ud_rent='$rent', mm_ud_utility='$utility', mm_ud_meal='$meal', mm_ud_total='$total', mm_ud_user='$userid', mm_ud_diposited='$billProvided'";
    $result = mysqli_query( $con, $query );
    if ( $result ) {
        $_SESSION['success'] = "Diposit Added Successfully!";
        header( 'Location: diposit.php' ); exit;
    }
}

// Add staff daily meal
function addMeal( $request, $con ) {
    extract( $request );

    $meal = implode( ',', $meal );

    if ( empty($meal) ){
        $_SESSION['error'] = "You must select at least one meal time";
        header( "Location: meal.php?user=$user" ); exit;
    }
    if ( empty($billProvided) ){
        $_SESSION['error'] = "You must select date which is required";
        header( "Location: meal.php?user=$user" ); exit;
    }

    $query = "INSERT INTO mm_user_meal SET mm_um_time='$meal', mm_um_user='$user', mm_um_date='$billProvided'";
    $result = mysqli_query( $con, $query );
    if ( $result ) {
        $_SESSION['success'] = "Meal Added Successfully!";
        header( 'Location: meal.php' ); exit;
    }
}

// Check if user is already logged in or not
function isUserLoggedIn() {
    session_start();
    if( !isset( $_SESSION["login"] ) ) {
        header( "Location: index.php" );
        exit();
    } else {
        return true;
    }
}

// Logout user to login/index page
function logOut() {
    session_start();
    if ( session_destroy() ) {
        header( 'Location: index.php' );
    }
}

function debug( $dataArray ) {
    echo "<pre>";
    print_r( $dataArray );
    echo "</pre>";
}
