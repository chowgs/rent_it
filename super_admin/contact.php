<?php
session_start();
require_once("../config/connect.php");
if(!isset($_SESSION["AccountID"])){
    header("location:../index.php");

 } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/logo.png" />
    <title>Rent IT - Contact</title>

    <?php
        // Custom font from google
        include("../css/fonts.html");
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <style>
        .toast-center {
            top: 5% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
        }
        .toast{
            font-size: 20px;
            width: 100% !important;
            opacity: 0.99 !important;
        }
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

        /* para ma fixed ung footer sa dulo dvh - device viewport height*/
        .background-image {
            height: 100dvh;
        }

        /* konting space sa taas */
        .footer-container {
            margin-top: 20px;
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
    </style>
</head>
<body>
<!-- Remove the styling since mas mataas hierarchy ng inline css -->
<img src="../images/booking_system.jpg" alt="" class="background-image">
<div class="navbar">
    <img src="../images/logo.png" alt="Rent It" class="logo">
    <div class="nav-links">
        <div class="nav-items">
            <a href="landing_page.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <a class="login-btn" href="#" data-toggle="modal" data-target="#myModal">Logout</a>
    </div>
    <div class="hamburger" onclick="toggleMenu(this)">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>
<?php 
    include("../components/ResponsiveNavSA.html");
?>
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard">
                <div class="dashboard-form text-center">
                    <?php
                        require_once("../config/connect.php");
                        $sql = "SELECT * FROM info";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<div class="col-md-12">
                            <div class="dash-box">

                            <form id="profile-form" action="process/edit_contact.php" method="post">
                            <h2><span class="parent">CONTACT US</span>
                            <button type="button" id="edit-save-button" class="btn btn-primary" onclick="toggleEditSave()">Edit</button>
                                <button type="submit" id="save-button" class="btn btn-success" style="display:none;">Save</button>
                            </h2><br>
                            <p id="p">'.$row["P"].'</p>
                            <p id="pp" style="display:none;"><input name="p" class="inp" type="text" value="'.$row["P"].'" disabled></p>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cont">
                                        <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                                        <h3 class="top">Rent IT</h3>
                                        <p id="fb-link" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;"><a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></p>
                                        <p id="fbb" style="display:none;"><input name="fb" class="inp" type="text" value="'.$row["FB"].'" disabled></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cont">
                                        <ion-icon name="call" class="call"></ion-icon><br>
                                        <h5 class="top">Cellphone Number:</h5>
                                        <p id="num" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;">'.$row["ContNum"].'</p>
                                        <p id="cont" style="display:none;"><input name="cont" class="inp" type="text" value="'.$row["ContNum"].'" disabled></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cont">
                                        <ion-icon name="business" class="add"></ion-icon><br>
                                        <h5 class="top">Address:</h5>
                                        <p id="add" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: black;" title="'. $row["Address"] .'">'.$row["Address"].'</p>
                                        <p id="address" style="display:none;"><input name="address" class="inp" type="text" value="'.$row["Address"].'" disabled></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <footer>
                            <div class="footer-container" style="background-color: mintcream; border-top: 1px solid #e7e7e7;
                            background: rgba(255, 255, 255, 0.6) !important;
                            -webkit-backdrop-filter: blur(15px) !important;
                            backdrop-filter: blur(60px) !important;
                            border: 1px solid rgba(255,255,255,0.15) !important;
                            align-items: center ;
                            box-shadow: 5px 5px !important;
                            letter-spacing: 3px; margin-bottom: 0;">
                            <div class="container" style="text-align: center; font-size: 12px;">
                            <div class="row" style=" display: flex; align-items: center;">
                        
                            <div class="col-md-4" style="padding: 10px;">
                                <div id="ggm"style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="mail"></ion-icon> '.$row["Gmail"].'</div>
                                <div id="ggmail" style="display:none;"><input name="gmail"  class="inp" type="text" value="'.$row["Gmail"].'" disabled></div>
                            </div>
                            <div class="col-md-4" style="padding: 10px;">
                            <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="logo-facebook"></ion-icon> <a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></div>
                            </div>
                            <div class="col-md-4" style="padding: 10px;">
                            <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="call"></ion-icon> '.$row["ContNum"].'</div>
                            </div>
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
                            </footer>';
                        } else {
                            echo '<div class="col-md-12">
                            <div class="dash-box">
                            <form id="profile-form" action="process/edit_contact.php" method="post">
                            <h2><span class="parent">Contact Us</span>
                            <button type="button" id="edit-save-button" class="btn btn-primary" onclick="toggleEditSave()">Edit</button>
                                <button type="submit" id="save-button" class="btn btn-success" style="display:none;">Save</button>
                            </h2><br>
                            <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cont" style="background-color:rgb(219, 219, 211);">
                                        <ion-icon name="logo-facebook" class="fb"></ion-icon><br>
                                        <h3 class="top">Rent IT</h3>
                                        <a href=""><input id="p" name="p" class="inp" type="text" value="" disabled></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cont" style="background-color:rgb(219, 219, 211);">
                                        <ion-icon name="call" class="call"></ion-icon><br>
                                        <h5 class="top">Cellphone Number:</h5>
                                        <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cont" style="background-color:rgb(219, 219, 211);">
                                        <ion-icon name="business" class="add"></ion-icon><br>
                                        <h5 class="top">Address:</h5>
                                        <p><input id="p" name="p" class="inp" type="text" value="" disabled></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <footer>
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
                            <div class="col-md-4" style="padding: 10px;">
                                <div><ion-icon name="mail"></ion-icon> rentit@gmail.com</div>
                            </div>
                            <div class="col-md-4" style="padding: 10px;">
                            <div><ion-icon name="logo-facebook"></ion-icon> Rent IT</div>
                            </div>
                            <div class="col-md-4" style="padding: 10px;">
                            <div><ion-icon name="call"></ion-icon> +63 992 2762 412</div>
                            </div>
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
                            </footer>';
                        }
                        ?>             
</form>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../process/logout.php">
                        <h5>Are you sure you want to logout?</h5>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
            <?php

        if (isset($_SESSION['error_message'])) {
            echo 'toastr.error("' . $_SESSION['error_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
            unset($_SESSION['error_message']); // Clear the error message from session
        } elseif (isset($_SESSION['success_message'])) {
            echo 'toastr.success("' . $_SESSION['success_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
            unset($_SESSION['success_message']); // Clear the success message from session
        }
        ?>
        function toggleEditSave() {
            var button = document.getElementById('edit-save-button');
            var saveButton = document.getElementById('save-button');
            var inputs = document.querySelectorAll('.inp');

            var link1 = document.getElementById('fb-link');
            var fb = document.getElementById('fbb');

            var link2 = document.getElementById('num');
            var cont = document.getElementById('cont');

            var link3 = document.getElementById('add');
            var address = document.getElementById('address');

            var link4 = document.getElementById('p');
            var pp = document.getElementById('pp');

            var link5 = document.getElementById('ggm');
            var gmail = document.getElementById('ggmail');

            if (button.innerText === 'Edit') {
                // Enable the input fields
                inputs.forEach(function(input) {
                    input.disabled = false;
                });
                button.style.display = 'none';

                link1.style.display = 'none';
                fb.style.display = 'block';

                link2.style.display = 'none';
                cont.style.display = 'block';

                link3.style.display = 'none';
                address.style.display = 'block';

                link4.style.display = 'none';
                pp.style.display = 'block';

                link5.style.display = 'none';
                gmail.style.display = 'inline-block';

                saveButton.style.display = 'inline-block';

            } else if (button.innerText === 'Save') {
                // Submit the form
                document.getElementById('profile-form').submit();
            }
        }
        function toggleMenu() {
            const navLinks = document.querySelector('.navbarsmall');
            navLinks.style.display = (navLinks.style.display === 'flex') ? 'none' : 'flex';
        }
    </script>
</body>
</html>
