        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script>
        $( function() {
            $('#mess-tables').DataTable();
            $( "#staffJoined" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
            $( "#billProvided" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
        <?php $uri = explode( '/', $_SERVER["PHP_SELF"] ); ?>
        <?php if( $uri[2] == 'profile.php') : ?>
        var modal = document.getElementById('updateProfile');
        var btn = document.getElementById("updateProfileCall");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        <?php endif; ?>
        <?php if( $uri[2] == 'staff.php') : ?>
        var modal = document.getElementById('addStaff');
        var btn = document.getElementById("staffAddCall");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        <?php endif; ?>

        function findTotal() {
            var inputs = document.getElementsByClassName('counter'),
            result = document.getElementById('total'),
            sum = 0;

            for( var i=0; i<inputs.length; i++ ) {
                var ip = inputs[i];

                if (ip.name && ip.name.indexOf("total") < 0) {
                    sum += parseInt(ip.value) || 0;
                }
            }

            result.value = sum;
        }

        $popoverLink = $('[data-popover]');
        $document = $(document);
        $popoverLink.on('click', openPopover);
        $document.on('click', closePopover);

        function openPopover(e) {
            e.preventDefault()
            closePopover();
            var popover = $($(this).data('popover'));
            popover.toggleClass('open')
            e.stopImmediatePropagation();
        }

        function closePopover(e) {
            if($('.popover.open').length > 0) {
                $('.popover').removeClass('open')
            }
        }
    </script>
</body>
</html>
