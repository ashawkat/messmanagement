<?php if ( isset( $_SESSION['error'] ) ) : ?>
<div class="error"><?php echo $_SESSION['error']; ?></div>
<?php unset( $_SESSION['error'] ); ?>
<?php endif; ?>
<?php if ( isset( $_SESSION['success'] ) ) : ?>
<div class="success"><?php echo $_SESSION['success']; ?></div>
<?php unset( $_SESSION['success'] ); ?>
<?php endif; ?>
