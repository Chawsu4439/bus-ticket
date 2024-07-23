<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/inc/navbar.php'; ?>
<?php $database = new Database(); ?>
<?php $routes = $database->readAll('routes'); ?>

<style>
    .modal-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 110vh;
        width: 500px;
    }

    .modal-dialog {
        max-width: 500px; /* Adjust this value as needed */
    }
</style>
<!-- <section class="home-class"> -->
<!-- <div class="video-background">
    <video autoplay muted loop id="video">
        <source src="<?php  URLROOT; ?>/images/videos/bus-animation.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div> -->

<main class="home-ticket">
    <header class="header">
        <div class="content">
            <h1 class="animate__animated animate__fadeIn">ONLINE TICKET<br>RESERVATION SYSTEM</h1>
            <p class="animate__animated animate__fadeIn">WELCOME TO, ONLINE TICKET RESERVATION SYSTEM</p>
        </div>

        <div class="modal-center" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reserveModalLabel">Search Your Trip</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo URLROOT; ?>/UserScheduleController/index" method="post">
                          
                            <div class="form-group">
                        
                            <select name="source" class="form-control"  aria-placeholder="from" required>
                            <?php if (isset($routes) && is_array($routes) && !empty($routes)) {
                                        // Collect unique sources
                                        $sources = array_unique(array_column($routes, 'source'));
                                        foreach ($sources as $source) { ?>
                                            <option value="<?php echo ($source); ?>">
                                                <?php echo ($source); ?>
                                            </option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No routes available</option>
                                    <?php } ?>
                                </select>
                            </div>
                           
                            <div class="form-group">
                            
                            <select name="destination" class="form-control" aria-placeholder="to" required>
                            <?php if (isset($routes) && is_array($routes) && !empty($routes)) {
                                        // Collect unique sources
                                        $destinations = array_unique(array_column($routes, 'destination'));
                                        foreach ($destinations as $destination) { ?>
                                            <option value="<?php echo ($destination); ?>">
                                                <?php echo ($destination); ?>
                                            </option>
                                        <?php }
                                    } else { ?>
                                        <option value="">No routes available</option>
                                    <?php } ?>
                                </select>
                                <!-- <input type="text" class="form-control" id="destination" name="destination" placeholder="destination" required> -->
                            </div>
                            <div class="form-group">
                               
                                <input type="date" class="form-control" id="date" name="date"  required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" href="userSchedule.php">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</main>

<section id="popular">
    <?php require_once APPROOT . '/views/inc/operator-popular.php'; ?>
</section>


<!-- about page -->
 <section id="about-section">
    <div class="about-container">
        <div class="about-section">
            <button class="about-button">About Us</button>
            <div class="about-content">
                <p>At Myanmar Bus Tickets, our mission is to revolutionize the way people travel across Myanmar by providing a seamless, reliable, and affordable online bus ticket booking experience.
                     As one of the leading bus ticket reservation platforms in Myanmar, we are committed to making travel convenient and accessible for everyone. Our user-friendly platform allows customers
                      to book bus tickets effortlessly from the comfort of their homes.We partner with reputable bus operators to ensure that our customers have access to safe and timely transportation services.
                      We understand the value of cost-effective travel. That's why we work hard to provide competitive pricing on all our routes.</p>
                
            </div>
        </div>
        <div class="image-section">
            <img src="<?php echo URLROOT;?>/images/bus.jpg" alt="Bus Image">
        </div>
        <div class="promise-section">
            <button class="promise-button">Our Promise To You</button>
            <div class="promise-content">
                <ul>
                    <li>✔ Reliability: Count on us for timely and dependable bus services.</li>
                    <li>✔ Affordability: Enjoy competitive prices and special discounts.</li>
                    <li>✔ Convenience: Experience an easy and efficient booking process.</li>
                </ul>
            </div>
        </div>
        <div class="contact-section">
            <h3>Contact Us</h3>
            <div class="contact-details">
                <p><img src="whatsapp-icon.png" alt="WhatsApp Icon"> 09xxxxxxxx</p>
                <p><img src="gmail-icon.png" alt="Gmail Icon"> onlinebusticket@gmail.com</p>
                <div class="social-icons">
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                </div>
            </div>
        </div>
    </div>
 <!-- </section> -->


<?php require_once APPROOT . '/views/inc/footer.php'; ?>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('date');
        var today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        // Smooth scrolling for navigation links
        document.querySelectorAll('a.nav-link').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                document.getElementById(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // AJAX to load content dynamically
        const navLinks = document.querySelectorAll('a.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                loadContent(targetId);
            });
        });

        function loadContent(targetId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `${targetId}.php`, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('main-content').innerHTML = this.responseText;
                }
            }
            xhr.send();
        }
    });
</script>

