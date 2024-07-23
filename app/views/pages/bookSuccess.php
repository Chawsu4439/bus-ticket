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

.container {
    text-align: center;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.success-icon {
    margin-bottom: 20px;
    color: #4CAF50;
}

.success-icon svg {
    width: 80px;
    height: 80px;
}

h1 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
}

p {
    font-size: 16px;
    margin-bottom: 30px;
    color: #666;
}

.ok-button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.ok-button:hover {
    background-color: #45A049;
}

</style>
    <div class="container">
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M9 11l3 3L22 4M22 12a10 10 0 1 1-10-10"></path></svg>
        </div>
        <h1>Booking Successful!</h1>
        <p>Your booking has been confirmed. Thank you for choosing our service.</p>
        <button class="ok-button" onclick="window.location. href='<?php echo URLROOT; ?>/pages/home'">OK</button>
    </div>



<!-- <script>
function handleOkClick() {
    alert("OK button clicked!");  // Replace this with the desired action
}

</script> -->
