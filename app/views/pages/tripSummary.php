<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/navbar.php'; ?>

<style>
  

    #chooseSeat {
        background-color: lightblue !important;
        margin-top: 70px;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .containerTrip {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Fixed width for invoice-like appearance */
        margin: auto; /* Center the container */
        text-align: center;
        height: 100%;
        margin-top: 60px;
    }
    .trip-details, .user-details, .customer-info {
        margin-bottom: 20px;
        text-align: left;
    }
    .trip-details {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .trip-details h3, .customer-info h3 {
        color: #007bff;
        margin-bottom: 15px;
    }
    .trip-details p, .user-details p {
        font-size: 16px;
        margin: 5px 0;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        text-align: center;
    }
    .form-group label {
        font-weight: bold;
        color: #333;
    }
    .form-group input {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
        display: block;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        display: block;
        margin: 20px auto;
    }
    .details-table {
        width: 100%;
        border-collapse: collapse;
    }
    .details-table td {
        padding: 10px;
        border: none; /* Hidden table borders */
    }
    .details-table tr {
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    .details-table tr:nth-child(even) {
        background-color: #f1f1f1;
    }
</style>

<main >
    <section id="chooseSeat">
    <div class="containerTrip mt-5">
        <h3 class="mb-4 text-center">Trip Summary and Personal Information</h3>
        <form action="<?php echo URLROOT; ?>/BookingController/store" method="post">
            <div class="trip-details">
                <h3>Booking Details</h3>
                <table class="details-table">
                    <tr>
                        <td><strong>Bus Operator:</strong></td>
                        <td><?php echo $data['bus']['name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Route:</strong></td>
                        <td><?php echo $data['schedule']['source']; ?> - <?php echo $data['schedule']['destination']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Departure Time:</strong></td>
                        <td><?php echo date('M d, H:i A', strtotime($data['schedule']['departure_time'])); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Selected Seats:</strong></td>
                        <td><?php echo implode(', ', $data['selected_seats']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Price:</strong></td>
                        <td><?php echo $data['total_price']; ?> MMK</td>
                    </tr>
                </table>
            </div>

            <div class="user-details mt-4">
                <h3>User Details</h3>
                <table class="details-table">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo $data['user']['name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo $data['user']['email']; ?></td>
                    </tr>
                </table>
                <input type="hidden" name="user_id" value="<?php echo $data['user']['id']; ?>">
            </div>

            <!-- Hidden fields to pass data -->
            <input type="hidden" name="bus_id" value="<?php echo $data['bus']['id']; ?>">
            <input type="hidden" name="route_id" value="<?php echo $data['schedule']['route_id']; ?>">
            <input type="hidden" name="schedule_id" value="<?php echo $data['schedule']['schedule_id']; ?>">
            <input type="hidden" name="selected_seats" value="<?php echo implode(',', $data['selected_seats']); ?>">
            <input type="hidden" name="total_price" value="<?php echo $data['total_price']; ?>">
            <input type="hidden" name="qty" value="<?php echo $data['qty']; ?>">

            <div class="customer-info mt-4">
                <h3>Personal Information</h3>
                 <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div> -->
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="number" name="phone" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3" href="<?php echo URLROOT; ?>/pages/bookSuccess">Submit</button>
        </form>
    </div>
</section>
</main>

