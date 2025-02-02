<?php
session_start();
require_once("config/connect.php");

// Your PHP logic here...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent IT - Signup (Owner)</title>
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
                <form action="process/accreditation.php" method="post" enctype="multipart/form-data" autocomplete="off">
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
                            <label for="ContactNumber">Contact Number</label><br>
                            <input class="form-control" type="text" name="cont_owner" placeholder="Enter your contact number" required>
                        </div>
                        <div class="col-md-3">
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
                    <div class="container">
                   
                        <p class="personal" style="font-size: 14px;">Please upload the following documents for accreditation:</p>
                        
                        <table class="table-form">
                            <tr>
                                <td><label for="application-letter">1. Application Letter:</label></td>
                                <td>
                                    <input type="file" name="application_letter" id="application-letter" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="application-letter-preview"></div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><label for="owner-photo">2. 2x2 Photo of Owner:</label></td>
                                <td>
                                    <input type="file" name="owner_photo" id="owner-photo" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="owner-photo-preview"></div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><label for="business-permit">3. Business Permit:</label></td>
                                <td>
                                    <input type="file" name="business_permit" id="business-permit" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="business-permit-preview"></div>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="tax-certificate">4. Tax Certificate:</label></td>
                                <td>
                                    <input type="file" name="tax_certificate" id="tax-certificate" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="tax-certificate-preview"></div>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="dti-certificate">5. DTI Certificate:</label></td>
                                <td>
                                <input type="file" name="dti_certificate" id="dti-certificate" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="dti-certificate-preview"></div>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="clearance">6. Clearance:</label></td>
                                <td>
                                    <input type="file" name="clearance" id="clearance" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="clearance-preview"></div>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="bir-certificate">7. BIR Certificate:</label></td>
                                <td>
                                    <input type="file" name="bir_certificate" id="bir-certificate" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="bir-certificate-preview"></div>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="medical-certificate">8. Medical Certificate:</label></td>
                                <td>
                                    <input type="file" name="medical_certificate" id="medical-certificate" accept="image/*, .pdf," onchange="validateFile(this)" required>
                                    <div id="medical-certificate-preview"></div>
                                </td>
                            </tr>
                        </table>

                
                    
                </div>
                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <script>

        function validateFile(input) {
            var file = input.files[0];

            if (file) {
                var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];

                if (!allowedExtensions.includes(fileExtension) || !allowedMimeTypes.includes(file.type)) {
                    alert("Invalid file type! Only images (JPG, PNG, GIF) and PDFs are allowed.");
                    input.value = ''; 
                }
            }
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
        document.getElementById('withLandlord').addEventListener('click', function() {
            var landlordDetails = document.getElementById('landlord-details');
            landlordDetails.style.display = this.checked ? 'flex' : 'none';
        });

        function previewFile(previewId, input) {
        var preview = document.getElementById(previewId);
        preview.innerHTML = ''; // Clear previous previews

        var files = input.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px'; // Size for image preview
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else if (file.type === 'application/pdf') {
                var pdfPreview = document.createElement('span');
                pdfPreview.innerText = 'PDF file: ' + file.name;
                preview.appendChild(pdfPreview);
            } else {
                var otherPreview = document.createElement('span');
                otherPreview.innerText = 'File: ' + file.name;
                preview.appendChild(otherPreview);
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
