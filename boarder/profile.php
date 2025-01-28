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
    <title>Rent IT - Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/modal.css">
    <style>
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
        }

        .btn-container{
            display: flex;
            justify-content: space-evenly;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="../images/logo.png" alt="Rent IT" height="50" style="margin-right: 30px; border-radius: 25px;">
        
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
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard">
                <div class="burger" onclick="toggleSidebar()">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
                <aside class="sidebar" id="sidebar">
                    <br>
                    <a href="dashboard.php" class="sub2">
                    <div class="group"><ion-icon name="home-sharp"></ion-icon> Dashboard</div>
                    </a><br>
 
                    <a href="profile.php" class="sub2" id="profileLink">
                        <div class="group"><ion-icon name="person"></ion-icon> Profile</div>   
                    </a><br>

                    <a href="message.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="chatbox-ellipses"></ion-icon> Chats</div>  
                    </a><br>

                    <a href="booked.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="business"></ion-icon> Booked Property</div>   
                    </a>

                </aside>
                <div class="dashboard-form">
                    <h6 class="sub-dash" style="font-weight: 600;">Dashboard / <span style="font-weight: 100;">Profile</span></h6>
                    <div class="prof-container">
                        <div class="row">
                            
                                                        <?php
                            $accountID = $_SESSION["AccountID"];
                            $sql = "SELECT * FROM boarder WHERE AccountID = '$accountID'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                if($row["M_Name"] || $row["F_Name"] != ""){

                                    $sql2 = "SELECT * FROM account WHERE AccountID = '$accountID'";
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        $row2 = $result2->fetch_assoc();
                                        
                                    }

                                    echo '<div class="col-md-6">';
                                    echo '<div class="dash-box">';
                                    echo '<form id="profile-form" action="process/update_profile.php" method="post" enctype="multipart/form-data">';
                                    echo '<h4>My Profile</h4><br>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fullName">Name:</label>';
                                    echo '<input id="fullName" name="FullName" class="prof-inp" type="text" value="'.$row["FullName"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="contNum">Contact:</label>';
                                    echo '<input id="contNum" name="ContNum" class="prof-inp" type="text" value="'.$row["Contact_No"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="year">Year:</label>';
                                    echo '<input id="year" name="Year" class="prof-inp" type="text" value="'.$row["YearLvl"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="course">Course:</label>';
                                    echo '<input id="course" name="Course" class="prof-inp" type="text" value="'.$row["Course"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="email">Email:</label>';
                                    echo '<input id="email" name="Email" class="prof-inp" type="text" value="'.$row["Email"].'" disabled>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="col-md-6">';
                                    echo '<div class="dash-box">';
                                    echo '<h4><span class="parent">Parents</span>';
                                    echo '<button type="button" id="edit-save-button" class="btn btn-primary" onclick="toggleEditSave()">Edit</button>';
                                    echo '<button type="submit" id="save-button" class="btn btn-success" style="display:none;">Save</button>';
                                    echo '</h4><br>';
                                    echo '<div class="form-group">';
                                    echo '<label for="mName">Mother\'s Name:</label>';
                                    echo '<input id="mName" name="M_Name" class="prof-inp" type="text" value="'.$row["M_Name"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="mNum">Contact:</label>';
                                    echo '<input id="mNum" name="M_Num" class="prof-inp" type="text" value="'.$row["M_Cont"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fName">Father\'s Name:</label>';
                                    echo '<input id="fName" name="F_Name" class="prof-inp" type="text" value="'.$row["F_Name"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fNum">Contact:</label>';
                                    echo '<input id="fNum" name="F_Num" class="prof-inp" type="text" value="'.$row["F_Cont"].'" disabled>';
                                    echo '</div>';
                                    if(!empty($row2["Answer"])){
                                        echo '<div class="btn-container">';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pass" style="margin-left: auto;">Change Password</button>';
                                        echo '</div>';
                                    }else{
                                        echo '<div class="btn-container">';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#security">Add Security</button>';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pass">Change Password</button>';
                                        echo '</div>';
                                    }
                                    
                                    echo '</div>';
                                    echo '</div>';
                                }else{
                                    $sql2 = "SELECT * FROM account WHERE AccountID = '$accountID'";
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        $row2 = $result2->fetch_assoc();
                                        
                                    }
                                    echo '<div class="col-md-6">';
                                    echo '<div class="dash-box">';
                                    echo '<form id="profile-form" action="process/update_profile.php" method="post" enctype="multipart/form-data">';
                                    echo '<h4>My Profile</h4><br>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fullName">Name:</label>';
                                    echo '<input id="fullName" name="FullName" class="prof-inp" type="text" value="'.$row["FullName"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="contNum">Contact:</label>';
                                    echo '<input id="contNum" name="ContNum" class="prof-inp" type="text" value="'.$row["Contact_No"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="year">Year:</label>';
                                    echo '<input id="year" name="Year" class="prof-inp" type="text" value="'.$row["YearLvl"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="course">Course:</label>';
                                    echo '<input id="course" name="Course" class="prof-inp" type="text" value="'.$row["Course"].'" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="email">Email:</label>';
                                    echo '<input id="email" name="Email" class="prof-inp" type="text" value="'.$row["Email"].'" disabled>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="col-md-6">';
                                    echo '<div class="dash-box">';
                                    echo '<h4><span class="parent">Parents</span>';
                                    echo '<button type="button" id="edit-save-button" class="btn btn-primary" onclick="toggleEditSave()">Edit</button>';
                                    echo '<button type="submit" id="save-button" class="btn btn-success" style="display:none;">Save</button>';
                                    echo '</h4><br>';
                                    echo '<div class="form-group">';
                                    echo '<label for="mName">Mother\'s Name:</label>';
                                    echo '<input id="mName" name="M_Name" class="prof-inp" type="text" value="" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="mNum">Contact:</label>';
                                    echo '<input id="mNum" name="M_Num" class="prof-inp" type="text" value="" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fName">Father\'s Name:</label>';
                                    echo '<input id="fName" name="F_Name" class="prof-inp" type="text" value="" disabled>';
                                    echo '</div>';
                                    echo '<div class="form-group">';
                                    echo '<label for="fNum">Contact:</label>';
                                    echo '<input id="fNum" name="F_Num" class="prof-inp" type="text" value="" disabled>';
                                    echo '</div>';
                                    if(!empty($row2["Answer"])){
                                        echo '<div class="btn-container">';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pass" style="margin-left: auto;">Change Password</button>';
                                        echo '</div>';
                                    }else{
                                        echo '<div class="btn-container">';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#security">Add Security</button>';
                                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pass">Change Password</button>';
                                        echo '</div>';
                                    }
                                    
                                    echo '</div>';
                                    echo '</div>';
                                }         
                            }
                            ?>
                        </div>
                        <div class="row">
                            <td><p class="personal" style="font-size: 12px;">Attached COR</p></td>
                            <div class="col-md-12">
                                <div class="upload-wrapper">
                                    <div id="image-preview" class="image-preview">
                                        <?php
                                        $sql_cor = "SELECT BoarderID FROM boarder WHERE AccountID = '$accountID'";
                                        $result_cor = $conn->query($sql_cor);
                                        if ($result_cor->num_rows > 0) {
                                            $row_cor = $result_cor->fetch_assoc();
                                            $boarderID = $row_cor["BoarderID"];
                                            $sql_images = "SELECT COR FROM boarder WHERE BoarderID = '$boarderID'";
                                            $result_images = $conn->query($sql_images);
                                            if ($result_images->num_rows > 0) {
                                                while ($row_images = $result_images->fetch_assoc()) {
                                                    $file_path = $row_images["COR"];
                                                    if($file_path != null){
                                                        echo '<div class="image-container">';
                                                        echo '<img src="'.$file_path.'" alt="No COR" style="width: 120px; height: 120px; margin: 5px;" class="permit-image" onclick="openModal(\''.$file_path.'\')">';
                                                        echo '<a href="#" class="delete-permit delete-icon" style="display: none;" data-boarder-id="'.$boarderID.'"><ion-icon name="close-circle"></ion-icon></a>';
                                                        echo '</div>';
                                                    }
                                                    
                                                }
                                            }
                                        } else {
                                            echo 'No attached permits found.';
                                        }
                                        ?>
                                    </div><br>
                                        
                                    <div class="upload-container" id="upload-icon" style="display:none;" onclick="document.getElementById('file-input').click();">
                                        <input type="file" name="file" id="file-input" multiple style="display:none;" onchange="previewImages()">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
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
                echo 'toastr.error("' . $_SESSION['error_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['error_message']); // Clear the error message from session
            } elseif (isset($_SESSION['success_message'])) {
                echo 'toastr.success("' . $_SESSION['success_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['success_message']); // Clear the success message from session
            }
        ?>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        function handleResize() {
            var sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.add('active');
            } else {
                sidebar.classList.remove('active');
            }
        }

        window.addEventListener('resize', handleResize);
        document.addEventListener('DOMContentLoaded', handleResize);
        document.addEventListener("DOMContentLoaded", function() {
            var subLinks = document.querySelectorAll(".sub");
            var dropdowns = document.querySelectorAll("[id$='Dropdown']");

            subLinks.forEach(function(subLink) {
                subLink.addEventListener("click", function(event) {
                    event.preventDefault();
                    var arrowIcon = this.querySelector(".arrow-icon");
                    var dropdown = this.nextElementSibling;

                    dropdowns.forEach(function(dd) {
                        if (dd !== dropdown) {
                            dd.style.display = "none";
                            var otherArrowIcon = dd.previousElementSibling.querySelector(".arrow-icon");
                            if (otherArrowIcon) {
                                otherArrowIcon.classList.remove("rotate-down");
                                dd.previousElementSibling.classList.remove("open");
                            }
                        }
                    });

                    if (dropdown.style.display === "none" || dropdown.style.display === "") {
                        dropdown.style.display = "block";
                        arrowIcon.classList.add("rotate-down");
                        this.classList.add("open");
                    } else {
                        dropdown.style.display = "none";
                        arrowIcon.classList.remove("rotate-down");
                        this.classList.remove("open");
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '.delete-permit', function(e) {
                e.preventDefault();
                var boarderID = $(this).data('boarder-id');
                var confirmation = confirm("Are you sure you want to delete this COR?");
                if (confirmation) {
                    $.ajax({
                        url: 'process/delete_cor.php',
                        type: 'POST',
                        data: { boarderID: boarderID },
                        success: function(response) {
                            if (response.trim() == 'success') {
                                // Remove the deleted image container from DOM
                                $(e.target).closest('.image-container').remove();
                                window.location.reload();
                            } else {
                                alert('Failed to delete COR. Please try again.');
                            }
                        },
                        error: function() {
                            alert('Error deleting COR. Please try again.');
                        }
                    });
                }
            });
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
        function toggleEditSave() {
            var button = document.getElementById('edit-save-button');
            var deleteIcons  = document.querySelectorAll('.delete-icon');
            var saveButton = document.getElementById('save-button');
            var uploadIcon = document.getElementById('upload-icon');
            var uploadSection = document.getElementById('upload-section');
            var inputs = document.querySelectorAll('.prof-inp');

            if (button.innerText === 'Edit') {
                // Enable the input fields
                inputs.forEach(function(input) {
                    input.disabled = false;
                });
                button.style.display = 'none';
                deleteIcons.forEach(function(icon) {
                    icon.style.display = 'inline-block';
                });
                saveButton.style.display = 'inline-block';
                uploadIcon.style.display = 'block'; 
            } else {
                // Submit the form
                document.getElementById('profile-form').submit();
            }
        }
        function openModal(imagePath) {
            var modal = document.getElementById('imageModal');
            var modalImg = document.getElementById('modalImage');
            var modalTitle = document.getElementById('myModalLabel');

            modalImg.src = imagePath;
            modalTitle.textContent = 'Image Preview'; // Set modal title if needed
            $('#imageModal').modal('show'); // Show Bootstrap modal
        }
        function closeModal() {
            $('#imageModal').hide(); 
            $('.modal-backdrop').remove();
        }

    </script>

    <div class="modal fade" id="security" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/recovery.php" method="post">
                        <div class="form-group">
                            <label for="question">Security Question:</label>
                            <select class="form-control" name="question" id="question" required>
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
                        <div class="form-group">
                            <label for="recovery">Answer:</label>
                            <input type="text" class="form-control" name="answer" id="answer" placeholder="Enter your answer" autocomplete="off" required>
                        </div>
                        <div class="button-container text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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

    <div id="imageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialogg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="modal-image" id="modalImage">
                    <div class="button-container">
                        <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/change_pass.php" method="post">
                        <div class="form-groupp" >
                        <label style="width: 30% !important;" for="pass">Old password:</label>
                        <input type="password" name="old_pass" placeholder="Enter old password">
                        </div>
                        <div class="form-groupp">
                        <label style="width: 30% !important;" for="pass">New password:</label>
                        <input type="password" name="new_pass" placeholder="Enter new password">
                        </div>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html> 