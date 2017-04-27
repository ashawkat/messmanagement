<?php
    require 'config.php';
    isUserLoggedIn();

    $con = dbConnect();

    $details = getMealDetails( $con );

    if ( $con ) {
        if ( isset( $_REQUEST['addMeal'] ) ) {
            $result = addMeal( $_REQUEST, $con );
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
            <label for="meal">Meal Time</label>
            <input type="checkbox" name="meal[]" value="breakfast"> Breakfast
            <input type="checkbox" name="meal[]" value="lunch"> Lunch
            <input type="checkbox" name="meal[]" value="dinner"> Dinner
            <label for="billProvided">Meal Date</label>
            <input class="u-full-width" name="billProvided" type="text" placeholder="Enter date exp:2017-04-30" id="billProvided">
            <input type="hidden" name="userid" value="<?php echo $_GET['user']; ?>">
            <input name="addMeal" type="submit" value="Add Meal">
        </form>
        <?php else : ?>
        <table class="u-full-width" id='mess-tables'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Staff Name</th>
                    <th>Meal Time</th>
                    <th>Meal Count</th>
                    <th>Meal Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ( $row = mysqli_fetch_assoc( $details ) ) : ?>
                <tr>
                    <td><?php echo $row['mm_um_id']; ?></td>
                    <td><?php echo $row['mm_user_name']; ?></td>
                    <td><?php echo $row['mm_um_time']; ?></td>
                    <td><?php $meal = explode( ',', $row['mm_um_time'] ); echo sizeof($meal); ?></td>
                    <td><?php echo $row['mm_um_date']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>


<?php require 'footer.php' ?>
