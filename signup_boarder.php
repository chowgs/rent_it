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
    <title>Rent IT - Signup (Boarder)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="css/signup_owner.css">
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
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="Rent IT" height="50" style="margin-right: 30px; border-radius: 25px;">
        
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact Us</a>
        </div>
    </div>
        <button class="burger" onclick="toggleMenu()">☰</button>
        <a class="login-btn" href="login_page.php">Log in</a>
    </div>
    <div class="dropdown-menu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact Us</a>
        <a href="login_page.php">Log in</a>
    </div>
    <div class="signup-container">
        <div class="signup-box">
            <div class="signup-form">
                <form action="process/signup_boarder.php" method="post" enctype="multipart/form-data">
                    <h3>Sign up as Boarder</h3>
                    <h5 class="personal">Personal Details</h5>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="fullname">First Name</label><br>
                            <input class="form-control" type="text" name="name" placeholder="Enter your First name" required>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="lastname">Last Name</label><br>
                            <input class="form-control" type="text" name="lname" placeholder="Enter your Last name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="middlename">Middle Name</label><br>
                            <input class="form-control" type="text" name="mname" placeholder="Enter your Middle name" required>
                        </div>
                        <div class="col-md-2">
                            <label for="username">Username</label><br>
                            <input class="form-control" type="text" name="uname" placeholder="Enter your username" required>
                        </div>
                        <div class="col-md-2">
                            <label for="fullname">Password</label><br>
                            <div class="password-container">
                                <input class="form-control" type="password" id="password" name="pword" placeholder="Enter your password" required>
                                <span class="toggle-password" onclick="togglePasswordVisibility()"><ion-icon name="eye-outline"></ion-icon></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ContactNumber">Contact Number</label><br>
                            <input class="form-control" type="text" name="contact" placeholder="Enter your contact number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Department">Year Level</label><br>
                            <select class="form-control" name="year" id="year" style="font-size: 14px;" required>
                                <option value="">Select</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option> 
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="Email">Course</label><br>
                            <input class="form-control" type="text" name="course" placeholder="Enter your course" required>
                        </div>
                        <div class="col-md-2">
                            <label for="ContactNumber">Email</label><br>
                            <input class="form-control" type="text" name="email" placeholder="Enter your contact number" required>
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
                    <h5 class="personal">Parents Details</h5>
                    <div class="row" >
                        <div class="col-md-3">
                            <label for="fullname">Mother's Full Name</label><br>
                            <input class="form-control" type="text" name="mother" placeholder="Enter your mother's full name" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="Email">Contact Number</label><br>
                            <input class="form-control" type="text" name="m_cont" placeholder="Enter your mother's contact number" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="fullname">Father's Full Name</label><br>
                            <input class="form-control" type="text" name="father" placeholder="Enter your father's full name" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="Email">Contact Number</label><br>
                            <input class="form-control" type="text" name="f_cont" placeholder="Enter your father's contact number" autocomplete="off" required>
                        </div>  
                    </div>
                    <h6 class="personal">Upload Registration Form</h6>
<div class="row">
    <div class="col-md-12">
        <div class="upload-wrapper">
            <div id="image-preview" class="image-preview"></div>
            <div class="upload-container" onclick="document.getElementById('file-input').click();">
                <input type="file" name="file" id="file-input" multiple required onchange="previewImages()">
            </div>
        </div>
    </div>
</div>
<div class="button-container">
    <button type="submit" class="btn btn-primary" onclick="return validateFileInput()">Sign up</button>
</div>
                </form>
            </div>
        </div>
    </div> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>

        function validateFileInput() {
            var fileInput = document.getElementById('file-input');
            if (fileInput.files.length === 0) {
                alert("Please upload a registration form before submitting.");
                return false; 
            }
            return true; 
        }
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
        function toggleMenu() {
            var dropdown = document.getElementsByClassName("dropdown-menu")[0];
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementsByClassName("dropdown-menu")[0];
            var burger = document.querySelector('.burger');
            if (event.target !== dropdown && event.target !== burger && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
        window.addEventListener('resize', function() {
            var burger = document.querySelector('.burger');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            if (window.innerWidth > 768) { // Adjust this value to match your media query breakpoint
                
                dropdownMenu.style.display = 'none';
            }
        });
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
        function previewImages() {
            var preview = document.getElementById('image-preview');
            var file = document.getElementById('file-input').files[0];
            
            // Clear previous images
            preview.innerHTML = '';

            if (file && file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
