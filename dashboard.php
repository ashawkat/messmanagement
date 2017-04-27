<?php
    require 'config.php';
    isUserLoggedIn();
    $con = dbConnect();
    $totalUser = getTotalStaff( $con );
    $totalDiposit = getTotalDiposit( $con );
?>

<?php require 'header.php' ?>
<?php require 'navbar.php' ?>
<div class="content">
    <div class="row">
        <div class="one-third offset-by-two column">
            <div class="box user-box">
                <i class="fa fa-users fa-4x"></i><br>
                <p>Total <?php echo $totalUser; ?> Staff Joined</p>
            </div>
        </div>
        <div class="one-third column">
            <div class="box diposit-box">
                <i class="fa fa-money fa-4x"></i><br>
                <p>Total <?php echo number_format( $totalDiposit['TOTAL'] ); ?> TK Diposited</p>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
