<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent IT - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/apply.css">
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
            right: 34px;
            top: 60%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 25px;
            color: #c9ded3;
        }

        .password-container .toggle {
            position: absolute;
            right: 10px;
            top: 60%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
        }

        .password-container .togglee{
            position: absolute;
            right: 10px;
            top: 60%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
        }
        .burger-drop {
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

                .burger-drop {
                    display: block;
                }

                .login-form input{
                    font-size: 12px;
                }

                .login-form button{
                    font-size: 12px;
                }

                .login-box{
                    width: 90%;
                }

                h4{
                    font-size: 18px;
                }

                .forgot,
                .text-center{
                    font-size: 12px;
                }

                .password-container .toggle-password {
                    right: 10px;
                    top: 55%;
                    font-size: 16px;
                }
        }
            .forgot{
                color: #58735c;
            }
            .forgot:hover{
                text-decoration: none;
                color: green;
            }

            .text-center{
                color:#58735c !important;
            }
            .txt {
                color: #316136; 
                font-weight: 600;
                margin-bottom: 20px;
            }
            .form{
                font-weight: 600;
                color: #316136;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="Rent IT" height="50" style="margin-right: 30px; border-radius: 25px;">
        
        <div class="nav-links">
            <a href="landing_page.php">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact Us</a>
        </div>
    </div>
        <button class="burger-drop" onclick="toggleMenu()">☰</button>
        <a class="login-btn" href="#" data-toggle="modal" data-target="#myModal">Logout</a>
    </div>
    <div class="dropdown-menu">
        <a href="landing_page.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact Us</a>
        <a href="#" data-toggle="modal" data-target="#myModal">Logout</a>
    </div>
    <div class="login-container">
        <div class="login-box">
            <div class="row log-cont">
                <div class="col-md-12 login-form">
                    <div class="">
                        <form action="process/application.php" method="post" enctype="multipart/form-data">
                            <h4 for="application">APPLICATION FORM</h4><br>
                            <div class="row">
                                <div class="col-md-12 form">
                                    <label for="name" style="width: 40%;">Name:</label>
                                    <input type="text" id="name" name="name" autocomplete="off" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 form">
                                    <label for="cont" style="width: 40%;">Contact No:</label>
                                    <input type="text" id="cont" name="cont" autocomplete="off" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12 form">
                                    <label for="add" style="width: 40%;">Address:</label>
                                    <input type="text" id="add" name="add" autocomplete="off" required>
                                </div>
                            </div>
                            <br>
                            <h4>REQUIREMENTS</h4>

                            <div class="container py-4">
                                <div class="row justify-content-center align-items-center text-center">
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="letter" class="form-label">Letter of Application:</label>
                                        <div class="upload-container" id="letter-container">
                                            <input type="file" id="letter" hidden name="letapp">
                                            <label for="letter" class="upload-button">+</label>
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="pic" class="form-label">2x2 of the owner:</label>
                                        <div class="upload-container" id="pic-container">
                                            <input type="file" id="pic" hidden name="picture">
                                            <label for="pic" class="upload-button">+</label>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="permit" class="form-label">Business Permit:</label>
                                        <div class="upload-container" id="permit-container">
                                            <input type="file" id="permit" hidden name="bpermit">
                                            <label for="permit" class="upload-button">+</label>
                                        </div>
                                    </div>
                               
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="cert" class="form-label">Community Tax Certificate:</label>
                                        <div class="upload-container" id="cert-container">
                                            <input type="file" id="cert" hidden name="ctc">
                                            <label for="cert" class="upload-button">+</label>
                                        </div>
                                    </div>
                                    </div>
                            </div>

                            <div class="container py-4">
                                <div class="row justify-content-center align-items-center text-center">
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="dti" class="form-label">DTI Certification:</label>
                                        <div class="upload-container" id="dti-container">
                                            <input type="file" id="dti" hidden name="dti">
                                            <label for="dti" class="upload-button">+</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="bfp" class="form-label">BFP Clearance:</label>
                                        <div class="upload-container" id="bfp-container">
                                            <input type="file" id="bfp" hidden name="bfp">
                                            <label for="bfp" class="upload-button">+</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="bir" class="form-label">BIR Certificate:</label>
                                        <div class="upload-container" id="bir-container">
                                            <input type="file" id="bir" hidden name="bir">
                                            <label for="bir" class="upload-button">+</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <label for="rhu" class="form-label">RHU Medical Examination:</label>
                                        <div class="upload-container" id="rhu-container">
                                            <input type="file" id="rhu" hidden name="rhu">
                                            <label for="rhu" class="upload-button">+</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>  
        </div>
    </div>

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
                    <h5>Signup As:</h5>
                    <div class="button-container">
                        <a href="signup_boarder.php" class="signup-btn btn-success">Boarder</a>
                        <a href="signup_owner.php" class="signup-btn btn-primary">Owner</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Forgot password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="forgotForm">
                    <div class="form-group" style="display: flex; justify-content: space-between; gap: 20px; align-items: center;">
                        <label for="recovery">Username:</label>
                        <input type="text" class="form-control" name="usernamee" id="usernamee" placeholder="Enter your username">
                    </div>
                    <div class="modal-footer" style="margin-bottom: -20px;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Security Question Modal -->
<div class="modal fade" id="securityQuestion" tabindex="-1" role="dialog" aria-labelledby="securityQuestionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="securityQuestionLabel">Security Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="securityQuestionForm">
                    <div class="form-group">
                        <label id="questionLabel"></label>
                        <input type="text" class="form-control" name="securityAnswer" id="securityAnswer" placeholder="Enter your answer">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="form-group" style="display: flex; justify-content: space-between; gap: 20px; align-items: center;">
                        <label style="width: 40%;" for="newPassword">New Password:</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" autocomplete="off" required>
                            <span class="toggle" onclick="togglePassword()"><ion-icon name="eye-outline"></ion-icon></span>
                        </div>
                    </div>
                    <div class="form-group" style="display: flex; justify-content: space-between; gap: 20px; align-items: center;">
                        <label style="width: 40%;" for="confirmPassword">Confirm Password:</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" autocomplete="off" required>
                            <span class="togglee" onclick="togglePasswordd()"><ion-icon name="eye-outline"></ion-icon></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Attach event listeners to all file inputs
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            const container = this.closest('.upload-container');
            if (this.files.length > 0) {
                // File selected: Add a checkmark
                if (!container.querySelector('.checkmark')) {
                    const checkmark = document.createElement('span');
                    checkmark.classList.add('checkmark');
                    checkmark.textContent = '✓';
                    container.appendChild(checkmark);
                }
                container.classList.add('file-uploaded');
            } else {
                // No file selected: Remove the checkmark
                const checkmark = container.querySelector('.checkmark');
                if (checkmark) checkmark.remove();
                container.classList.remove('file-uploaded');
            }
        });
    });
        $(document).ready(function() {
            $('#forgotForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var username = $('#usernamee').val();
                $.ajax({
                    type: 'POST',
                    url: 'process/fetch_question.php',
                    data: { username: username },
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.success) {
                            $('#forgot').modal('hide');
                            $('.modal-backdrop').remove();
                            $('#questionLabel').text(response.question);
                            $('#securityQuestion').modal('show');
                        } else {
                            toastr.error('Username not found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            });

            $('#securityQuestionForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var username = $('#usernamee').val();
                var answer = $('#securityAnswer').val();
                $.ajax({
                    type: 'POST',
                    url: 'process/verify_answer.php',
                    data: { username: username, answer: answer },
                    dataType: 'json', // Expect JSON response
                    success: function(response) {
                        if (response.success) {
                            $('#securityQuestion').modal('hide');
                            $('.modal-backdrop').remove();
                            $('#changePassword').modal('show');
                        } else {
                            toastr.error('Incorrect answer.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                    }
                });
            });

            $('#changePasswordForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var username = $('#usernamee').val();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                if (newPassword === confirmPassword) {
                    $.ajax({
                        type: 'POST',
                        url: 'process/change_pass.php',
                        data: { username: username, newPassword: newPassword },
                        dataType: 'json', // Expect JSON response
                        success: function(response) {
                            if (response.success) {
                                $('#changePassword').modal('hide');
                                $('.modal-backdrop').remove();
                                toastr.success('Password changed successfully.');
                            } else {
                                toastr.error('An error occured.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            console.error('Response:', xhr.responseText);
                                                    }
                    });
                } else {
                    toastr.error('Password do not match.');
                }
            });

    
        });
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });

        function togglePassword() {
            const passwordField = document.getElementById('newPassword');
            const passwordFieldType = passwordField.getAttribute('type');
            const togglePassword = document.querySelector('.toggle');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                togglePassword.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>'; // Change icon to indicate visibility
            } else {
                passwordField.setAttribute('type', 'password');
                togglePassword.innerHTML = '<ion-icon name="eye-outline"></ion-icon>'; // Change icon to indicate invisibility
            }
        } 

        function togglePasswordd() {
            const passwordField = document.getElementById('confirmPassword');
            const passwordFieldType = passwordField.getAttribute('type');
            const togglePassword = document.querySelector('.togglee');

            if (passwordFieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                togglePassword.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>'; // Change icon to indicate visibility
            } else {
                passwordField.setAttribute('type', 'password');
                togglePassword.innerHTML = '<ion-icon name="eye-outline"></ion-icon>'; // Change icon to indicate invisibility
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
            var burger = document.querySelector('.burger-drop');
            if (event.target !== dropdown && event.target !== burger && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
        window.addEventListener('resize', function() {
            var burger = document.querySelector('.burger-drop');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            if (window.innerWidth > 768) { // Adjust this value to match your media query breakpoint
                
                dropdownMenu.style.display = 'none';
            }
        });
        <?php

            if (isset($_SESSION['error_message'])) {
                echo 'toastr.error("' . $_SESSION['error_message'] . '", "", { positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['error_message']); // Clear the error message from session
            } elseif (isset($_SESSION['success_message'])) {
                echo 'toastr.success("' . $_SESSION['success_message'] . '", "", { positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['success_message']); // Clear the success message from session
                echo 'setTimeout(function() { window.location.href = "super_admin/dashboard.php"; }, 1000);'; // Redirect after 2 seconds
            }
        ?>
    </script>

</body>
</html>