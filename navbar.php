<div class="navbar-spacer"></div>
<nav class="navbar">
    <div class="container">
        <ul class="navbar-list">
            <li class="navbar-item"><a class="navbar-link" href="dashboard.php">Dashboard</a></li>
            <li class="navbar-item"><a class="navbar-link" href="staff.php">View Staff</a></li>
            <li class="navbar-item"><a class="navbar-link" data-popover="#reportNavPopover" href="#">Report</a>
                <div id="reportNavPopover" class="popover">
                    <ul class="popover-list">
                        <li class="popover-item">
                            <a class="popover-link" href="diposit.php">Diposit</a>
                        </li>
                        <li class="popover-item">
                            <a class="popover-link" href="meal.php">Meal</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="navbar-item u-pull-right"><a class="button nav-item" href="logout.php">Logout</a></li>
            <li class="navbar-item u-pull-right"><a class="navbar-link" data-popover="#adminNavPopover" href="#">Welcome <?php echo ucwords( $_SESSION['mm_user_name'] ); ?>!</a>
                <div id="adminNavPopover" class="popover">
                    <ul class="popover-list">
                        <li class="popover-item">
                            <a class="popover-link" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
