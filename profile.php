<?php
    require 'config.php';
    isUserLoggedIn();

    $con = dbConnect();
    $details = getStaffProfile( $con );

    if ( $con ) {
        if ( isset( $_REQUEST['updateProfile'] ) ) {
            $result = updateProfile( $_REQUEST, $con );
        }
    }
?>
<?php require 'header.php' ?>
<?php require 'navbar.php' ?>

<div class="row content">
    <div class="twelve columns">
        <?php require 'message.php'; ?>
        <table class="u-full-width">
            <tbody>
                <tr>
                    <td><strong>Staff ID</strong></td>
                    <td><?php echo $details['mm_user_id']; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Name</strong></td>
                    <td><?php echo $details['mm_user_name']; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Email</strong></td>
                    <td><?php echo $details['mm_user_email']; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Mobile No.</strong></td>
                    <td><?php echo $details['mm_user_mobile']; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Role</strong></td>
                    <td><?php echo ( $details['mm_user_role'] == 1 ) ? 'Super Admin' : 'Staff'; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Joined</strong></td>
                    <td><?php echo $details['mm_user_created_at']; ?></td>
                </tr>
                <tr>
                    <td><strong>Staff Activity</strong></td>
                    <td><?php echo ( $details['mm_user_status'] == 1 ) ? 'Active' : 'Inactive'; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><button class="button" id="updateProfileCall">Update Profile</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Staff Modal -->
<div id="updateProfile" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" method="post">
            <label for="useremail">Email</label>
            <input class="u-full-width" name="usermail" type="email" placeholder="Enter email address..." id="usermail" value="<?php echo $details['mm_user_email']; ?>">
            <label for="usermobile">Mobile Number</label>
            <input class="u-full-width" name="usermobile" type="text" placeholder="Enter mobile no..." id="usermobile" value="<?php echo $details['mm_user_mobile']; ?>">
            <label for="password">Password</label>
            <input class="u-full-width" name="password" type="password" placeholder="Enter password..." id="password">
            <input type="hidden" name="userid" value="<?php echo $details['mm_user_id']; ?>">
            <input name="updateProfile" type="submit" value="Update Profile">
        </form>
    </div>
</div>

<?php require 'footer.php' ?>
