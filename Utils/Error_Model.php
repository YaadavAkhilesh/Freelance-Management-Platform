<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:#fffefe;">
            <div class="modal-header">
                <div class="rounded-5 rouded-circle bg-warning" style="height:15px;width:15px;"></div>
                <h5 class="modal-title mx-2" id="messageModalLabel">FrelaxPro</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalMessage">
                <?php if (!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to show the modal with a message
        function showMessage(message) {
            $('#modalMessage').text(message); // Set the message
            $('#messageModal').modal('show'); // Show the modal

            // Hide the modal after 3 seconds
            setTimeout(function() {
                $('#messageModal').modal('hide');
            }, 1500);
        }

        <?php if (!empty($message)): ?>
            showMessage('<?php echo addslashes($message); ?>');
        <?php endif; ?>

    });
</script>