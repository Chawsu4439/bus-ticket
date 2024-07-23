<nav class="navbar-bar navbar-expand-lg navbar-dark bg-white">
    <a class="navbar-brand-ticket" href="#">ONLINE TICKETS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link-bar" href="<?php echo URLROOT;?>/pages/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="#popular-places">Popular Places</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="#operator-container">Operator</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="#about-section">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="<?php echo URLROOT; ?>/bookingController/history">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-bar" href="<?php echo URLROOT;?>/pages/login">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<script>
    // Smooth scrolling effect for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const sectionId = this.getAttribute('href').substring(1);
            const section = document.getElementById(sectionId);

            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
