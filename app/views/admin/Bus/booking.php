<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php require_once APPROOT . '/views/inc/admin/sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/admin/navbar.php'; ?>
<?php require APPROOT . '/views/components/auth_message.php'; ?>

<style>
.table-header {
        background-color: #adb5bd;  /* Change to your preferred color */
        color: orangered; /* Text color */
    }
</style>
<section id="booking">
    <div class="container">
        <h2 class="text-center mb-5">Manage Bookings</h2>

        <!-- Booking Table -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-header">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>

                    <th>Bus Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Time</th>
                    <th>Booking Date</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['booking_info'] as $booking) { ?>
                    <tr>
                        <td><?php echo $booking['booking_id']; ?></td>
                        <td><?php echo $booking['user_name']; ?></td>
                        <td><?php echo $booking['user_email']; ?></td>
                        <td><?php echo $booking['customer_phone']; ?></td>
                        <td><?php echo $booking['bus_name']; ?></td>
                        <td><?php echo $booking['source']; ?></td>
                        <td><?php echo $booking['destination']; ?></td>
                        <td><?php echo $booking['departure_time']; ?></td>
                        <td><?php echo $booking['booking_date']; ?></td>
                        <td><?php echo $booking['qty']; ?></td>
                        <td><?php echo $booking['total_price']; ?></td>
                        <td><?php echo $booking['status']; ?></td>
                        <td> 
                            
                            <!-- Delete Button -->
                            <button class="btn btn-danger" onclick="openDeleteModal('<?php echo $booking['booking_id']; ?>')">Delete</button>
                        </td>
                    </tr>

                  
           
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Booking</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="deleteForm" action="<?php echo URLROOT; ?>/bookingController/destroy" method="POST">
                                        <input type="hidden" name="booking_id" id="deleteBookingId" value="">
                                        <p>Are you sure you want to delete this booking?</p>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" form="deleteForm" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

<?php } ?>
</tbody>
</table>
</div>
</section>


<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>
<script>
    function openDeleteModal(bookingId) {
        document.getElementById('deleteBookingId').value = bookingId;
        $('#deleteModal').modal('show');
    }
</script>