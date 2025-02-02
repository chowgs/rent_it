<?php
    session_start();
if(isset($_SESSION['loggedIn'])){
        if ($_SESSION['AccType'] === 'Super_Admin' || $_SESSION['AccType'] === 'Admin') {
            header('Location: /booking_sys/super_admin/dashboard.php');
            exit();
        } else if ($_SESSION['AccType'] === 'Owner') {
            header('Location: /booking_sys/owner/dashboard.php');
            exit();
        } else if ($_SESSION['AccType'] === 'Boarder') {
            header('Location: /booking_sys/boarder/dashboard.php');
            exit();
        }
        
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <title>Rent It</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login_css/login.css">
    <link rel="stylesheet" href="css/headerStyle.css">
    <link rel="stylesheet" href="login_css/dialog.css">

</head>
<body>
<div class="navbar">
    <img src="images/logo.png" alt="Rent It" class="logo">
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact us</a>
    </div>
</div>

<!-- <button class="burger" onclick="toggleMenu()">☰</button>
    </div>
    <div class="dropdown-menu">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact Us</a>
    </div> -->

<div class="login-container">
    <div class="login-box">
        <form action="process/login.php" method="post">
            <h1>LOGIN</h1>
            
            <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required>
            
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <ion-icon name="eye-outline"></ion-icon>
                </span>
            </div>
            <a href="#" data-toggle="modal" data-target="#forgot" class="forgot">Forgot password?</a>
            <button type="submit" class="login-btn" name="login">Log in</button>
        </form>

        <div class="signup-container">
            <p class="not-member-text">Not a member? <br><span class="join-now-text"><a href="#" data-toggle="modal" data-target="#myModal">Join Now</a></span></p>
        </div>
        <div class="accreditation-container">
            <h2>Application for Accreditation</h2>
        </div>
        <p class="not-member-text">Not a member?<span class="apply-now-text">
            <a href="#" data-toggle="modal" data-target="#applyModal"> Apply Now!</a></span>
        </p>
    </div>
</div>

    <!------------------------ Accreditation Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Application Form</h5>
                </div>
                <div class="modal-body">
                    <form id="accredForm">
                        <div class="form-group">
                            <label class="forgotPass-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                            <label class="forgotPass-label">Contact No.</label>
                            <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter contact no.">
                            <label class="forgotPass-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        </div><hr>
                        <label class="forgotPass-label">Letter of Application</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">2x2 of the Owner</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">Business Permit</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">Community Tax Certificate</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">DTI Certification</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">BFP Clearance</label>
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">BIR Clearance</label>   
                        <input type="file" name="" id="">
                        <label class="forgotPass-label">RHU Medical Examination</label>
                        <input type="file" name="" id="">
                        <hr>
                        <div class="forgotPass-footer">
                            <button type="button" class="btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn-submit">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!------------------------ Forgot Password Modal -->
    <div class="modal fade" id="forgot" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Find your account</h5>
                </div>
                <div class="modal-body">
                    <form id="forgotForm">
                        <div class="form-group">
                            <label class="forgotPass-label">Please enter your username.</label>
                            <input type="text" class="form-control" name="usernamee" id="usernamee" placeholder="Enter your username">
                        </div><hr>
                        <div class="forgotPass-footer">
                            <button type="button" class="btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn-submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!------------------------ Security Question Modal -->
    <div class="modal fade" id="securityQuestion" tabindex="-1" role="dialog" aria-labelledby="securityQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="securityQuestionLabel">Security Question</h5>
                </div>
                <div class="modal-body">
                    <form id="securityQuestionForm">
                        <div class="form-group">
                            <label id="forgotPass-label" class="forgotPass-label">What is the answer?</label>
                            <input type="text" class="form-control" name="securityAnswer" id="securityAnswer" placeholder="Your answer?">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-cancel" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!------------------------ Join Modal  -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Join as</h5>
                </div>
                <div class="modal-body">
                    <div class="button-container text-center">
                        <a href="signup_boarder.php" class="btn-boarder">Boarder</a>
                        <a href="signup_owner.php" class="btn-owner">Owner</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------------ Change Password MODAL -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="form-group">
                            <div class="password-container">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" autocomplete="off" required>
                                <span class="toggle" onclick="togglePassword()"><ion-icon name="eye-outline"></ion-icon></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="password-container">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" autocomplete="off" required>
                                <span class="toggle" onclick="togglePasswordd()"><ion-icon name="eye-outline"></ion-icon></span>
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
    <!-- CUSTOM SCRIPT  -->
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
        //document.addEventListener('click', function(event) {
           // var dropdown = document.getElementsByClassName("dropdown-menu")[0];
          // var burger = document.querySelector('.burger');
           // if (event.target !== dropdown && event.target !== burger && !dropdown.contains(event.target)) {
             //   dropdown.style.display = 'none';
          //  }
       // });
        window.addEventListener('resize', function() {
            var burger = document.querySelector('.burger');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            if (window.innerWidth > 768) { // Adjust this value to match your media query breakpoint
                
                dropdownMenu.style.display = 'none';
            }
        });
        <?php

        if (isset($_SESSION['error_message'])) {
            echo 'toastr.error("' . $_SESSION['error_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
            unset($_SESSION['error_message']); // Clear the error message from session
        } elseif (isset($_SESSION['success_message'])) {
            echo 'toastr.success("' . $_SESSION['success_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
            unset($_SESSION['success_message']); // Clear the success message from session
            echo 'setTimeout(function() { window.location.href = "super_admin/dashboard.php"; }, 1000);'; // Redirect after 2 seconds
        }
        ?>
    </script>

</body>
</html>