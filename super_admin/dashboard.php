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
    <title>Rent IT - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard_admin.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/scrollbar.css">
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
        .dash-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .dash-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dash-box p {
            margin: 10px 0;
        }

        .dash-box .boarder {
            font-size: 50px;
            color: #eb9500;
        }
        .dash-box .owner {
            font-size: 50px;
            color: #00ff26;
        }
        .dash-box .prop {
            font-size: 50px;
            color: #c40000;
        }

        .dash-box .pending {
            font-size: 50px;
           
        }

        .dash-box .count {
            font-size: 30px;
            font-weight: bold;
            color: #333;
        }

        .dash-box .label {
            font-size: 18px;
            color: #555;
        }

        @media (max-width: 768px) {
            .dash-box {
                padding: 15px;
            }
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
                    <a href="#" class="sub2">
                    <div class="group"><ion-icon name="home-sharp"></ion-icon> Dashboard</div>
                    </a><br>

                    <a href="profile.php" class="sub2" id="profileLink">
                        <div class="group"><ion-icon name="person"></ion-icon> Profile</div>   
                    </a><br>

                    <a href="message.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="chatbox-ellipses"></ion-icon> Chats</div>  
                    </a><br>
 
                    <a href="#" class="sub" id="allUsersLink">
                        <div class="group"><ion-icon name="person-sharp"></ion-icon> All Users</div>  
                        <ion-icon name="chevron-forward-sharp" class="arrow-icon"></ion-icon>
                    </a>
                    <div id="userDropdown" style="display: none; margin-top: 10px;">
                        <a class="d-item" href="all_users/admin.php">Admin</a><br>
                        <a class="d-item" href="all_users/boarders.php">Borders</a><br>
                        <a class="d-item" href="all_users/owners.php">Owners</a><br>
                        <a class="d-item" href="all_users/pending.php">Pending</a>
                    </div><br>

                    <a href="property.php" class="sub2" id="propertyLink">
                        <div class="group"><ion-icon name="newspaper"></ion-icon> Property</div>  
                    </a><br>

                </aside>
                <div class="dashboard-form">
                    <h1>WELCOME ADMIN!</h1>
                    <h4 class="sub-dash">Dashboard</h4>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <a href="all_users/boarders.php" style="text-decoration: none;"><div class="dash-box">
                                <p><ion-icon name="people-sharp" class="boarder"></ion-icon></p>
                                <?php
                                    // SQL query to count the number of boarders
                                    $sql = "SELECT COUNT(*) AS boarder_count FROM account WHERE AccType = 'Boarder'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo '<p class="count">' . $row["boarder_count"] . '</p>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }

                                ?>
                                <p class="label">Registered Boarders</p>
                            </div></a>
                        </div>

                        <div class="col-md-4">
                            <a href="all_users/owners.php" style="text-decoration: none;"><div class="dash-box">
                                <p><ion-icon name="people-sharp" class="owner"></ion-icon></p>
                                <?php
                                    // SQL query to count the number of boarders
                                    $sql = "SELECT COUNT(*) AS owner_count FROM account WHERE AccType = 'Owner' AND Approval = 'Approved'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo '<p class="count">' . $row["owner_count"] . '</p>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }

                                ?>
                                <p class="label">Registered Owners</p>
                            </div></a>
                        </div>

                        <div class="col-md-4">
                            <a href="property.php" style="text-decoration: none;"><div class="dash-box">
                                <p><ion-icon name="business-sharp" class="prop"></ion-icon></ion-icon></p>
                                <?php
                                    // SQL query to count the number of boarders
                                    $sql = "SELECT COUNT(*) AS property_count FROM property";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo '<p class="count">' . $row["property_count"] . '</p>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }

                                ?>
                                <p class="label">No. of Properties</p>
                            </div></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="all_users/pending.php" style="text-decoration: none;"><div class="dash-box">
                                <p><ion-icon name="hourglass" class="pending"></ion-icon></p>
                                <?php
                                    // SQL query to count the number of boarders
                                    $sql = "SELECT COUNT(*) AS owner_count FROM account WHERE AccType = 'Owner' AND Approval = 'Pending'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo '<p class="count">' . $row["owner_count"] . '</p>';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    // Close connection
                                    $conn->close();
                                ?>
                                <p class="label">Pending Owner Accounts</p>
                            </div></a>
                        </div>
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
    </script>
    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html> 