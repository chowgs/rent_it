<?php
    session_start();
    require_once("config/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent IT - Signup (Owner)</title>

    <?php
        // Custom font from google
        include("css/fonts.html");
    ?>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="css/asOwner.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/modal.css">
        <style>
        .password-container {
            position: relative;
        }
        .password-container input[type="password"],
        .password-container input[type="text"] {
           
            padding-right: 30px; /* Adjust based on your icon size */
        }
        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 60%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
        }
        .modal {
    display: none; /* Initially hidden */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    
    /* Centering fix */
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    width: 400px;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    
    /* Ensure it stays in the middle of the viewport */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #333;
    font-weight: bold;
}

    </style>
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
    <div class="signup-container">
        <div class="signup-box">
            <div class="signup-form">
                <form action="process/signup_owner.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <h3>Sign up as Owner</h3>
                    <h5 class="personal">Personal Details</h5>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="fullname">First Name</label><br>
                            <input class="form-control" type="text" name="name_owner" placeholder="Enter first name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="Lastn_owner">Last Name</label><br>
                            <input class="form-control" type="text" name="Lastn_owner" placeholder="Enter last name" required>
                        </div>
                        <div class="col-md-1">
                            <label for="username">Username</label><br>
                            <input class="form-control" type="text" name="user_owner" placeholder="Enter username" required>
                        </div>
                        <div class="col-md-2">
                            <label for="fullname">Password</label><br>
                            <div class="password-container">
                                <input class="form-control" type="password" id="password" name="pass_owner" placeholder="Enter your password" required>
                                <span class="toggle-password" onclick="togglePasswordVisibility()"><ion-icon name="eye-outline"></ion-icon></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="fullname">Re-Password</label><br>
                            <div class="password-container">
                                <input class="form-control" type="repassword" id="repassword" name="repass_owner" placeholder="Confirm your password" required>
                                <span class="toggle-password toggle-repassword" onclick="toggleRePasswordVisibility()"><ion-icon name="eye-outline"></ion-icon></span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label for="ContactNumber">Contact</label><br>
                            <input class="form-control" type="number" name="cont_owner" placeholder="Enter your contact number" required>
                        </div>
                        <div class="col-md-2">
                            <label for="fblink">Facebook Link</label><br>
                            <input class="form-control" type="text" name="fblink" placeholder="Enter your FB Link" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Department">Address</label><br>
                            <input class="form-control" type="text" name="add_owner" placeholder="Enter your address" required>
                        </div>
                        <div class="col-md-2">
                            <label for="Email">Email</label><br>
                            <input class="form-control" type="text" name="email_owner" placeholder="Enter your email">
                        </div>
                        <div class="col-md-4">
                            <label for="question">Security Question:</label>
                            <select class="form-control" style="font-size: 14px;" name="question" id="question">
                                <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                                <option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
                                <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                                <option value="What is the name of the town where you were born?">What is the name of the town where you were born?</option>
                                <option value="What is the name of your favorite teacher?">What is the name of your favorite teacher?</option>
                                <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                                <option value="What is the name of your first employer?">What is the name of your first employer?</option>
                                <option value="What is your favorite movie?">What is your favorite movie?</option>
                                <option value="What is the name of the hospital where you were born?">What is the name of the hospital where you were born?</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="recovery">Answer:</label>
                            <input class="form-control" type="text" name="answer" id="answer" placeholder="Enter your answer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input id="withLandlord" value="with_landlord" style="width: 20px !important; margin-top: -20px !important; margin-right: 10px; margin-left: 10px;" type="checkbox">with Landlord
                        </div>
                    </div>
                    <div id="landlord-details" class="row" style="display: none;">
                        <div class="col-md-4">
                            <label for="fullname">Full Name</label><br>
                            <input class="form-control" type="text" name="name_land" placeholder="Enter your name" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="Email">Email</label><br>
                            <input class="form-control" type="text" name="email_land" placeholder="Enter your email" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="ContactNumber">Contact Number</label><br>
                            <input class="form-control" type="text" name="cont_land" placeholder="Enter your contact number" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <p class="personal" style="font-size: 12px;">Attached Permits</p>
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <div id="image-preview" class="image-preview"></div>
                                <div class="upload-container" onclick="document.getElementById('file-input').click();">
                                    <input type="file" name="files[]" id="file-input" multiple onchange="validateFileSize()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" id="termsCheckbox" style="width: 20px !important; margin-right: 10px;" required>
                            <label for="termsCheckbox">
                                I agree to the 
                                <a href="#" id="openModal">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                    <div id="termsModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Terms and Conditions</h2>
                            <p>
                                By using this website, you agree to our Terms and Conditions, 
                                including providing accurate information, 
                                respecting user rights, and not engaging in illegal activities.
                            </p>
                            <p>
                                We protect your data per our Privacy Policy but are not liable for any damages from service use. 
                                We may update these terms anytime, 
                                and continued use means acceptance.
                            </p>
                            <button id="acceptTerms" class="btn btn-success">Accept</button>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn btn-primary" id="signupBtn" disabled>Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <script>

        document.getElementById('termsCheckbox').addEventListener('change', function() {
            document.getElementById('signupBtn').disabled = !this.checked;
        });


        document.getElementById('openModal').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('termsModal').style.display = 'block';
        });


        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('termsModal').style.display = 'none';
        });


        document.getElementById('acceptTerms').addEventListener('click', function() {
            document.getElementById('termsCheckbox').checked = true;
            document.getElementById('signupBtn').disabled = false;
            document.getElementById('termsModal').style.display = 'none';
        });


        window.onclick = function(event) {
            let modal = document.getElementById('termsModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const passwordFieldType = passwordField.getAttribute('type');
            const togglePassword = document.querySelector('.toggle-password');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                togglePassword.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>'; // Change icon to indicate visibility
            } else {
                passwordField.setAttribute('type', 'password');
                togglePassword.innerHTML = '<ion-icon name="eye-outline"></ion-icon>'; // Change icon to indicate invisibility
            }
        }
        function toggleRePasswordVisibility() {
            const passwordField = document.getElementById('repassword');
            const passwordFieldType = passwordField.getAttribute('type');
            const togglePassword = document.querySelector('.toggle-repassword');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                togglePassword.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>'; // Change icon to indicate visibility
            } else {
                passwordField.setAttribute('type', 'password');
                togglePassword.innerHTML = '<ion-icon name="eye-outline"></ion-icon>'; // Change icon to indicate invisibility
            }
        }
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = (navLinks.style.display === 'flex') ? 'none' : 'flex';
        }
        document.getElementById('withLandlord').addEventListener('click', function() {
            var landlordDetails = document.getElementById('landlord-details');
            landlordDetails.style.display = this.checked ? 'flex' : 'none';
        });

        function validateFileSize() {
            const input = document.getElementById('file-input');
            const maxSize = 3 * 1024 * 1024; // 3MB in bytes

            for (const file of input.files) {
                if (file.size > maxSize) {
                    alert(`File ${file.name} exceeds the 3MB size limit.`);
                    input.value = ""; // Reset file input
                    return;
                }
            }

            previewImages();
        }

        function previewImages() {
            var preview = document.getElementById('image-preview');
            var files = document.getElementById('file-input').files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(e) {
                            var img = document.createElement('img');
                            img.src = e.target.result;
                            preview.appendChild(img);
                        };
                    })(file);
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "positionClass": "toast-top-center",
                "toastClass": "toast"
            };
            <?php
            if (isset($_SESSION['error_message'])) {
                echo 'toastr.error("' . $_SESSION['error_message'] . '");';
                unset($_SESSION['error_message']);
            } elseif (isset($_SESSION['success_message'])) {
                echo 'toastr.success("' . $_SESSION['success_message'] . '");';
                unset($_SESSION['success_message']);
            }
            ?>
        });
    </script>
</body>
</html>
