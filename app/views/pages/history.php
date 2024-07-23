<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/navbar.php'; ?>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}
body, html {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: lightblue;
    margin-top: 100px;
}
.container  {
    background-color: white;
    margin-top: 100%;
}
</style>
<!-- <div id="history-class"> -->
<div class="container mt-5">
    <h3 class="mb-4 text-center">Your Booking History (Last 24 Hours)</h3>
    <?php if (empty($data['bookings'])) : ?>
        <p class="text-center">No bookings found in the last 24 hours.</p>
    <?php else : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Bus Operator</th>
                    <th>Route</th>
                    <th>Departure Time</th>
                    <th>Seats</th>

                    <th>Total Price</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $booking) : ?>
                    <tr>
                        <td><?php echo $booking['name']; // You might want to join tables to get the actual bus name 
                            ?></td>
                        <td><?php echo $booking['source'].'_'.$booking['destination']; // Similarly for route 
                            ?></td>
                        <td><?php echo date('M d, H:i A', strtotime($booking['departure_time'])); ?></td>
                        <td><?php echo $booking['seat_number']; ?></td>
                        <td><?php echo $booking['total_price']; ?> MMK</td>
                        <td><?php echo date('M d, Y H:i A', strtotime($booking['booking_date'])); ?></td>
                        <td><?php echo $booking['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<!-- </div> -->

