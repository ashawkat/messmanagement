<?php
    require 'config.php';
    isUserLoggedIn();

    $con = dbConnect();
    $details = getStaffDetails( $con );

    if ( $con ) {
        if ( isset( $_REQUEST['addStaff'] ) ) {
            $result = registerStaff( $_REQUEST, $con );
        }
    }
?>
<?php require 'header.php' ?>
<?php require 'navbar.php' ?>
<div class="content">
    <button class="button" id="staffAddCall">Add Staff</button>
</div>

<div class="row">
    <div class="twelve columns">
        <?php require 'message.php'; ?>
        <table class="u-full-width" id='mess-tables'>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Staff Email</th>
                    <th>Staff Mobile No.</th>
                    <th>Staff Role</th>
                    <th>Staff Joined</th>
                    <th>Staff Activity</th>
                    <?php if ( $_SESSION['mm_user_role'] == 1 ) : ?>
                    <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ( $row = mysqli_fetch_assoc( $details ) ) : ?>
                <tr>
                    <td><?php echo $row['mm_user_id']; ?></td>
                    <td><?php echo $row['mm_user_name']; ?></td>
                    <td><?php echo $row['mm_user_email']; ?></td>
                    <td><?php echo $row['mm_user_mobile']; ?></td>
                    <td><?php echo ( $row['mm_user_role'] == 1 ) ? 'Super Admin' : 'Staff'; ?></td>
                    <td><?php echo $row['mm_user_created_at']; ?></td>
                    <td><?php echo ( $row['mm_user_status'] == 1 ) ? 'Active' : 'Inactive'; ?></td>
                    <?php if ( $_SESSION['mm_user_role'] == 1 ) : ?>
                    <td>
                        <a href="diposit.php?user=<?php echo $row['mm_user_id']; ?>" title="Add Diposit"><i class="fa fa-money fa-2x"></i></a>&nbsp;
                        <a href="meal.php?user=<?php echo $row['mm_user_id']; ?>" title="Add Meal"><i class="fa fa-cutlery fa-2x"></i></a>&nbsp;
                        <?php if ( $row['mm_user_status'] == 1 ) : ?>
                        <a href="staffmod.php?ban=<?php echo $row['mm_user_id']; ?>" title="Make Staff Inactive"><i class="fa fa-trash fa-2x"></i></a>
                        <?php else : ?>
                        <a href="staffmod.php?active=<?php echo $row['mm_user_id']; ?>" title="Make Staff Active"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Staff Modal -->
<div id="addStaff" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" method="post">
            <label for="username">Username</label>
            <input class="u-full-width" name="username" type="text" placeholder="Enter username..." id="username">
            <label for="useremail">Email</label>
            <input class="u-full-width" name="usermail" type="email" placeholder="Enter email address..." id="usermail">
            <label for="usermobile">Mobile Number</label>
            <input class="u-full-width" name="usermobile" type="text" placeholder="Enter mobile no..." id="usermobile">
            <label for="password">Password</label>
            <input class="u-full-width" name="password" type="password" placeholder="Enter password..." id="password">
            <label for="staffJoined">Staff Joining Date</label>
            <input class="u-full-width" name="user_created" type="text" placeholder="Enter date exp:2017-04-30" id="staffJoined">
            <input name="addStaff" type="submit" value="Add Staff">
        </form>
    </div>
</div>

<?php require 'footer.php' ?>
