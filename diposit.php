<?php
    require 'config.php';
    isUserLoggedIn();

    $con = dbConnect();

    $details = getDipositDetails( $con );

    if ( $con ) {
        if ( isset( $_REQUEST['addDiposit'] ) ) {
            $result = addDiposit( $_REQUEST, $con );
        }
    }
?>
<?php require 'header.php' ?>
<?php require 'navbar.php' ?>
<div class="row content">
    <div class="twelve columns">
        <?php require 'message.php'; ?>
        <?php if ( isset( $_GET['user'] ) ) : ?>
        <form action="" method="post">
            <label for="rent">House Rent</label>
            <input class="u-full-width counter" onblur="findTotal()" name="rent" type="number" placeholder="Enter house rent..." id="rent">
            <label for="bill">Utility Bill</label>
            <input class="u-full-width counter" onblur="findTotal()" name="utility" type="number" placeholder="Enter utility bills..." id="bill">
            <label for="meal">Meal Cost</label>
            <input class="u-full-width counter" onblur="findTotal()" name="meal" type="number" placeholder="Enter meal cost..." id="meal">
            <label for="total">Total Diposit</label>
            <input class="u-full-width" name="total" type="text" placeholder="Total diposited..." id="total" readonly>
            <label for="billProvided">Diposit Provide Date</label>
            <input class="u-full-width" name="billProvided" type="text" placeholder="Enter date exp:2017-04-30" id="billProvided">
            <input type="hidden" name="userid" value="<?php echo $_GET['user']; ?>">
            <input name="addDiposit" type="submit" value="Add Diposit">
        </form>
        <?php else : ?>
        <table class="u-full-width" id='mess-tables'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Staff Name</th>
                    <th>House Rent</th>
                    <th>Utility Bill</th>
                    <th>Meal Cost</th>
                    <th>Total Cost</th>
                    <th>Payment Diposited</th>
                </tr>
            </thead>
            <tbody>
                <?php while ( $row = mysqli_fetch_assoc( $details ) ) : ?>
                <tr>
                    <td><?php echo $row['mm_ud_id']; ?></td>
                    <td><?php echo $row['mm_user_name']; ?></td>
                    <td><?php echo $row['mm_ud_rent']; ?></td>
                    <td><?php echo $row['mm_ud_utility']; ?></td>
                    <td><?php echo $row['mm_ud_meal']; ?></td>
                    <td><?php echo $row['mm_ud_total']; ?></td>
                    <td><?php echo $row['mm_ud_diposited']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>


<?php require 'footer.php' ?>
