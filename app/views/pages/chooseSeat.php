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
    /* .chooseSeat {
        background-color: lightblue;
        margin-top: 60px;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    } */
    .container {
        
        background-color: rgba(255, 255, 255, 0.9); /* Optional: adds a semi-transparent background to the container for better readability */
        padding: 20px;
        border-radius: 10px;
        margin-top: 60px;
    }

    .seat-selection {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .seat {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
    }
    .seat input[type="checkbox"] {
        display: none;
    }
    .seat label {
        cursor: pointer;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
    }
.seat-available {
        background-color: white;
    }
    .seat-booked {
        background-color: red;
        color: white;
        border: 1px solid red;
        cursor: not-allowed;
    }
    .seat-selected {
        background-color: green;
        color: white;
        border: 1px solid green;
    }
</style>
<!-- <main class="chooseSeat"> -->
    <div class="container mt-5">
        <h2 class="mb-4">Choose Your Seats for <?php echo  $data['bus_name'] ; ?></h2>
        <form action="<?php echo URLROOT; ?>/UserScheduleController/book" method="post">
            <input type="hidden" name="schedule_id" value="<?php echo $data['schedule']['schedule_id']; ?>">
            <div class="seat-selection">
                <?php for ($i = 1; $i <= $data['capacity']; $i++): 
                    $seatStatus = 'available';
                    foreach ($data['seats'] as $seat) {
                        if ($seat['seat_number'] == $i) {
                            $seatStatus = $seat['status'];
                            break;
                        }
                    }
                ?>
                    <div class="seat">
                        <input type="checkbox" id="seat-<?php echo $i; ?>" name="seats[]" value="<?php echo $i; ?>" <?php echo $seatStatus == 'booked' ? 'disabled' : ''; ?>>
                        <label for="seat-<?php echo $i; ?>" class="<?php echo $seatStatus == 'booked' ? 'seat-booked' : ''; ?>"><?php echo $i; ?></label>
                    </div>
                <?php endfor; ?>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Book Now</button>
        </form>
    

    <!-- Seat Legend -->
    <div class="mt-5">
            <h4>Seat Legend:</h4>
            <div class="d-flex align-items-center mb-2">
                <div class="seat seat-available" style="width: 30px; height: 30px; margin-right: 10px;"></div>
                <span>Available Seat</span>
            </div>
            <div class="d-flex align-items-center mb-2">
                <div class="seat seat-booked" style="width: 30px; height: 30px; margin-right: 10px;"></div>
                <span>Booked Seat</span>
            </div>
            <div class="d-flex align-items-center mb-2">
                <div class="seat seat-selected" style="width: 30px; height: 30px; margin-right: 10px;"></div>
                <span>Selected Seat</span>
            </div>
        </div>
    </div>
<!-- </main> -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seats = document.querySelectorAll('.seat input[type="checkbox"]');
        seats.forEach(seat => {
            seat.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.checked) {
                    label.classList.add('seat-selected');
                } else {
                    label.classList.remove('seat-selected');
                }
            });
        });

        // // Handle modal display
        // const seatModal = document.getElementById('seatModal');
        // seatModal.addEventListener('show.bs.modal', function (event) {
        //     const selectedSeats = [];
        //     seats.forEach(seat => {
        //         if (seat.checked) {
        //             selectedSeats.push(seat.value);
        //         }
        //     });

        //     const seatSummaryDiv = document.querySelector('.seat-summary');
        //     seatSummaryDiv.innerHTML = `<p>Selected Seats: ${selectedSeats.join(', ')}</p>`;
        // });

        // // Handle form submission
        // document.getElementById('confirmBooking').addEventListener('click', function() {
        //     document.getElementById('seatForm').submit();
        // });
    });
</script>


