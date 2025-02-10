<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent IT - About</title>

    <?php
        // Custom font from google
        include("css/fonts.html");
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/accredited.css">
    <link rel="stylesheet" href="css/scrollbar.css">
</head>
<body>
<img src="images/booking_system.jpg" alt="" class="background-image" style="height: 1100px;">
<div class="navbar">
    <img src="images/logo.png" alt="Rent It" class="logo">
    <div class="nav-links">
        <div class="nav-items">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact us</a>
            <a href="accredited.php">Accredited</a>
        </div>
        <a href="login_page.php" class="login-link">Login</a>
    </div>
    <div class="hamburger" onclick="toggleMenu(this)">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>
<?php 
    include('./components/ResponsiveNav.html');
?>

<h2>ACCREDITED DORMITORY/BOARDING HOUSE</h2> 
<div class="container text-center">
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/2.jpeg" alt="Accredited Photo 2" class="img-fluid rounded shadow">
            <p>CLOUD BOARDING HOUSE </p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/3.jpeg" alt="Accredited Photo 3" class="img-fluid rounded shadow">
            <p>DATINGUINOO DORMITORY</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/4.jpeg" alt="Accredited Photo 4" class="img-fluid rounded shadow">
            <p>ENGRACIA'S BOARDING HOUSE</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/5.jpeg" alt="Accredited Photo 5" class="img-fluid rounded shadow">
            <p>QUEEN ELIZABETH LADIES HOME</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/6.jpeg" alt="Accredited Photo 6" class="img-fluid rounded shadow">
            <p>K&M SPACE RENTAL</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/7.jpeg" alt="Accredited Photo 7" class="img-fluid rounded shadow">
            <p>KRT BOARDING HOUSE</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/8.jpeg" alt="Accredited Photo 8" class="img-fluid rounded shadow">
            <p>ROSALINDA ABUY BOARDING HOUSE</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/9.jpeg" alt="Accredited Photo 9" class="img-fluid rounded shadow">
            <p>BREZA'S BOARDING HOUSE</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/10.jpeg" alt="Accredited Photo 10" class="img-fluid rounded shadow">
            <p>SLSU DORMITORY</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/11.jpeg" alt="Accredited Photo 11" class="img-fluid rounded shadow">
            <p>LORNA'S BOARDING HOUSE AND MINI STORE</p>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <img src="images/accredited/12.jpeg" alt="Accredited Photo 12" class="img-fluid rounded shadow">
            <p>BM AMPARO APARTMENT</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.navbarsmall');
        navLinks.style.display = (navLinks.style.display === 'flex') ? 'none' : 'flex';
    }
</script>
</body>
</html>
