<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/navbar.php'; ?>



<style>
    /* body {
        background-color: lightblue;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    } */
    .container  {
        background-color: rgba(255, 255, 255, 0.9); /* Optional: adds a semi-transparent background to the container for better readability */
        padding: 20px;
        border-radius: 10px;
    }
    .chooseSeat {
        background-color: lightblue;

        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        margin-top: 10px;
    }
   .btn {
    border-radius: 10px;
    width: 100px;
   }
</style>

<section class="chooseSeat">

    <div class="container mt-5">
        <?php if (!empty($data['schedules'])): ?>
            <h2 class="mb-4">Search Results</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Schedule ID</th>
                        <th>Bus Name</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Price per Seat</th>
                        <th>Available Seats</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['schedules'] as $schedule): ?>
                        <tr>
                            <td><?php echo $schedule['schedule_id']; ?></td>
                            <td><?php echo $schedule['bus_name']; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($schedule['departure_time'])); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($schedule['arrival_time'])); ?></td>
                            <td><?php echo $schedule['price_per_seat']; ?></td>
                            <td><?php echo $schedule['available_seats']; ?></td>
                            <td><?php echo $schedule['source']; ?></td>
                            <td><?php echo $schedule['destination']; ?></td>
                            <td>
                            <form action="<?php echo URLROOT; ?>/UserScheduleController/chooseSeats" method="post">
                                    <input type="hidden" name="schedule_id" value="<?php echo $schedule['schedule_id']; ?>">
                                    <button type="submit" class="btn btn-info">Choose Seats</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h2 class="mb-4">No Schedules Found</h2>
            <p>We could not find any schedules for your search criteria. Please try again with different options.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>