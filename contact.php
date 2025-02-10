<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent IT - Contact</title>

    <?php
        // Custom font from google
        include("css/fonts.html");
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <!-- <style>
        .burger {
            display: none;
            position: absolute;
            top: 10px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            z-index: 2; /* Ensure it's above the dropdown */
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 80px; 
            right: 10px; 
            left: auto;
            background: rgba(255, 255, 255, 0.9);
            width: 200px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            padding: 10px;
            text-decoration: none;
            color: black;
            display: block;
            text-align: center;
            font-weight: 600;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .login-btn {
                display: none;
            }

            .burger {
                display: block;
            }
        }
    </style> -->
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
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard">
                <div class="dashboard-form text-center">
                    <h2 style="font-size: 30px;margin-top: 50px;">CONTACT US</h2>
                    <p style="margin-bottom: 40px;">Get in touch and let us know how we can help.</p>
                    <div class="row">
                    <?php
                        require_once("config/connect.php");
                        $sql = "SELECT * FROM info";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo'
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                            <h3 class="top" style="color: black;">Rent IT</h3>
                            <p id="fb-link" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;"><a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></p>
                          
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="call" class="call"></ion-icon><br>
                            <h5 class="top" style="color: black;">Cellphone Number:</h5>
                            <p id="num" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;">'.$row["ContNum"].'</p>
                            
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="business" class="add"></ion-icon><br>
                            <h5 class="top" style="color: black;">Address:</h5>
                            <p id="add" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;" title="'. $row["Address"] .'">'.$row["Address"].'</p>
                            <p id="address" style="display:none; color: black;"><input name="address" class="inp" type="text" value="'.$row["Address"].'" disabled></p>
                            </div>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                            <h3 class="top">Rent IT</h3>
                            <a href=""><input id="p" name="p" class="inp" type="text" value="" disabled></a>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="call" class="call"></ion-icon><br>
                            <h5 class="top">Cellphone Number:</h5>
                            <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="cont">
                            <ion-icon name="business" class="add"></ion-icon><br>
                            <h5 class="top">Address:</h5>
                            <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                            </div>
                            </div>
                            ';
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
        const navLinks = document.querySelector('.navbarsmall');
        navLinks.style.display = (navLinks.style.display === 'flex') ? 'none' : 'flex';
    }
    </script>
</body>
</html>
