<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent IT - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login_page.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/scrollbar.css">
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
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 25px;
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
        .forgot{
            color: white;
        }
        .forgot:hover{
            text-decoration: none;
            color: gainsboro;
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
    </div>
    <div class="dropdown-menu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact Us</a>
    </div>
    <div class="login-container">
        <div class="login-box">
            <div class="row log-cont">
                <div class="col-md-6 login-form">
                     <div class="">
                        <form action="process/login.php" method="post">
                            <h1 for="username">Login</h1><br>
                            <input type="text" id="username" name="username" placeholder="username" autocomplete="off" required>
                            <div class="password-container">
                                <input type="password" id="password" name="password" placeholder="password" autocomplete="off" required>
                                <span class="toggle-password" onclick="togglePasswordVisibility()"><ion-icon name="eye-outline"></ion-icon></span>
                            </div><br>
                            <div class="forgot">
                                <a href="#" data-toggle="modal" data-target="#forgot" class="forgot">Forgot password?</a>
                            </div>
                            <br><br><br>
                            <button type="submit" class="btn btn-success" name="login">Log in</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 signup-container">
                    <div class="">
                        <h2>HI! THERE</h2>
                        <p>If you don't have an account,<br> you can Sign Up here!</p><br><br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Sign up</button>
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
                        <a href="signup_boarder.php" class="btn btn-success">Boarder</a>
                        <a href="signup_owner.php" class="btn btn-primary">Owner</a>
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