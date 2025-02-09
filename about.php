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
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/modal.css">
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
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard">
                <div class="dashboard-form">
                <h2>ABOUT US</h2>
                    <div class="row" style="margin: 0 !important;">
                        <div class="col-md-4 about-cont text-center" >
                            <div class="about">
                                <img src="images/logo.png" alt="Rent IT" height="200" style=" border-radius: 25px;">
                                <h5>Provide digital solution for your life.</h5>
                            </div> 
                        </div>
                        <?php
                            require_once("config/connect.php");
                            $sql = "SELECT * FROM info";
                            $result = $conn->query($sql);
                            $result->num_rows;
                            $row = $result->fetch_assoc();
                            $aboutText = $row['About'] ?? '';
                            if (!empty($aboutText)) {
                                echo "
                               <div class='col-md-8 us'style='background-color: rgba(0, 0, 0, 0.7); padding: 25px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);''>
                                    <p id='about-link' style='color: #fff; font-size: 16px; line-height: 1.6;'>".nl2br(htmlspecialchars($aboutText))."</p>
                                </div>
                            ";
                            
                            }else{
                                echo "
                                <div class='col-md-8 us' >

                                <div id='aboutt-link'>
                                    <p>Welcome to Rent IT, your trusted partner for seamless dorm and apartment bookings. We specialize in connecting boarders with comfortable and affordable accommodations tailored to their needs. Whether you're a student looking for a convenient dormitory or a professional seeking a cozy apartment, our platform offers a diverse range of options to suit every lifestyle and budget.</p><br>
                                    <p>Our mission is to simplify the booking process, providing a user-friendly platform where you can easily find, book, and manage your stay. With a focus on quality, security, and customer satisfaction, we ensure that every property listed meets our high standards. Our dedicated support team is always here to assist you, making your experience as smooth and enjoyable as possible.</p><br>
                                    <p>At Rent IT, we're not just about finding you a place to stay; we're about helping you find your home away from home.</p>
                                </div>
                                
                                </div>
                                ";
                            }
                        
                        ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- <footer>
        <div class="footer-container" style="background-color: mintcream; border-top: 1px solid #e7e7e7;
            background: rgba(255, 255, 255, 0.6) !important;
            -webkit-backdrop-filter: blur(15px) !important;
            backdrop-filter: blur(60px) !important;
            border: 1px solid rgba(255,255,255,0.15) !important;
            align-items: center ;
            box-shadow: 5px 5px !important;
            letter-spacing: 3px;">
            <div class="container" style="text-align: center; font-size: 12px;">
                <div class="row" style=" display: flex; align-items: center;">
                    <?php

                    $sql = "SELECT * FROM info";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo'
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="mail"></ion-icon> '.$row['Gmail'].'</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="logo-facebook"></ion-icon> <a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="call"></ion-icon> '.$row['ContNum'].'</div>
                        </div>
                        ';
                    }else{
                        echo '
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="mail"></ion-icon> rentit@gmail.com</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="logo-facebook"></ion-icon> Rent IT</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="call"></ion-icon> +63 992 2762 412</div>
                        </div>
                        ';
                    }
                    

                ?>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="border"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="text-muted" style="margin-top: 10px; font-size: 10px;">Rent IT | est. 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js (if needed by Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <!-- Ionicons JS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.style.display = (navLinks.style.display === 'flex') ? 'none' : 'flex';
    }
    </script>  
</body>
</html>
