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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/signup_accred.css">
    <link rel="stylesheet" href="css/modal.css">

</head>
<body>
    <div class="navbar">
        <img src="images/logo.png" alt="Rent It" class="logo">
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact us</a>
            <a href="login_page.php" class="login-link">Log in</a>
        </div>
    </div><br><br><br><br>
    <div class="signup-container">
        <div class="signup-box">
            <div class="signup-form">
                <form action="process/accreditation.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <h3>Sign up as Owner</h3>                    
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="name_owner" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="Lastn_owner">Last Name</label> -->
                            <input class="form-control" type="text" name="Lastn_owner" placeholder="Last Name" required>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label for="username">Username</label> -->
                            <input class="form-control" type="text" name="user_owner" placeholder="Username" required>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="fullname">Password</label> -->
                            <div class="password-container">
                                <input class="form-control" type="password" id="password" name="pass_owner" placeholder="Password" required>
                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label for="ContactNumber">Contact Number</label> -->
                            <input class="form-control" type="text" name="cont_owner" placeholder="Contact No." required>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="fblink">Facebook Link</label> -->
                            <input class="form-control" type="text" name="fblink" placeholder="Facebook Link" required>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label for="Department">Address</label> -->
                            <input class="form-control" type="text" name="add_owner" placeholder="Address" required>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="Email">Email</label> -->
                            <input class="form-control" type="text" name="email_owner" placeholder="Email">
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label for="question">Security Question:</label> -->
                            <select class="form-control" style="font-size: 14px;" name="question" id="question">
                                <option value="" disabled selected>Select a security question:</option>
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
                        <div class="col-md-6">
                            <!-- <label for="recovery">Answer:</label> -->
                            <input class="form-control" type="text" name="answer" id="answer" placeholder="Answer">
                        </div>
                    </div>

                    <!-- Checkbox for with landlord -->
                    <div class="row">
                        <div class="col-md-12">
                            <input id="withLandlord" value="with_landlord" style="width: 20px !important; margin-top: -20px !important; margin-right: 10px; margin-left: 10px;" type="checkbox">with Landlord
                        </div>
                    </div>

                    <!-- Landlord Details -->
                    <div id="landlord-details" class="row" style="display: none;">
                        <div class="col-md-4">
                            <label for="fullname">Full Name</label>
                            <input class="form-control" type="text" name="name_land" placeholder="Enter your name" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="Email">Email</label>
                            <input class="form-control" type="text" name="email_land" placeholder="Enter your email" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <label for="ContactNumber">Contact Number</label>
                            <input class="form-control" type="text" name="cont_land" placeholder="Enter your contact number" autocomplete="off">
                        </div>
                    </div>

                    <div class="container">
                        <p class="personal" style="font-size: 14px;">Please upload the following documents for accreditation:</p>
                        <div class="file-upload-grid">
                            <div class="file-upload-item">
                                <label for="application-letter">1. Application Letter:</label>
                                <input type="file" name="application_letter" id="application-letter" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="application-letter-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="owner-photo">2. 2x2 Photo of Owner:</label>
                                <input type="file" name="owner_photo" id="owner-photo" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="owner-photo-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="business-permit">3. Business Permit:</label>
                                <input type="file" name="business_permit" id="business-permit" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="business-permit-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="tax-certificate">4. Tax Certificate:</label>
                                <input type="file" name="tax_certificate" id="tax-certificate" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="tax-certificate-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="dti-certificate">5. DTI Certificate:</label>
                                <input type="file" name="dti_certificate" id="dti-certificate" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="dti-certificate-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="clearance">6. Clearance:</label>
                                <input type="file" name="clearance" id="clearance" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="clearance-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="bir-certificate">7. BIR Certificate:</label>
                                <input type="file" name="bir_certificate" id="bir-certificate" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="bir-certificate-preview"></div>
                            </div>
                            <div class="file-upload-item">
                                <label for="medical-certificate">8. Medical Certificate:</label>
                                <input type="file" name="medical_certificate" id="medical-certificate" accept="image/*, .pdf" onchange="validateFile(this)" required>
                                <div id="medical-certificate-preview"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="button-container">
                        <button type="submit" class="btn">Sign up</button>
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
