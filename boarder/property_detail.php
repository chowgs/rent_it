<?php
session_start();
require_once("../config/connect.php");
if (!isset($_SESSION["AccountID"])) {
    header("location:../landing_page.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/logo.png" />
    <title>Rent IT - Property</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="boarder-css/property.css">
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
        .ab {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .property-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 100%;
            overflow-x: hidden;
            transition: transform 0.3s;
        }

        .property-card:hover {
            transform: translateY(-10px);
        }

        .img-cont {
            position: relative;
            background-color: floralwhite;
            height: 100%;
            width: 100% !important;
        }

        .image-cardd {
            width: 100%;
            border-bottom: 1px solid #dddddd;
            height: 100%;
        }

        .thumbnail-cont {
            padding: 10px;
            overflow-y: hidden;
            overflow-x: auto;
            margin-bottom: 5px;
        }

        .thumbnail {
            width: 100%;
            height: 90%;
            object-fit: cover;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }

        .txt {
            padding: 20px;
            width: 100% !important;
        }

        .txt h5 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333333;
        }

        .txt p {
            margin: 0 0 15px;
            font-size: 16px;
            color: #666666;
        }

        .txt ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .txt ul li {
            font-size: 16px;
            margin: 10px 0;
            color: #666666;
        }

        .btn-container {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-success {
            background-color: #28a745;
            color: #ffffff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .view-rooms-btn {
            margin-right: 10px;
        }

        /* Ionicons */
        .icon {
            vertical-align: middle;
            margin-right: 5px;
            color: #007bff;
        }

        .loc {
            cursor: pointer;
            color: #007bff;
            transition: color 0.3s;
        }

        .loc:hover {
            color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .txt h5 {
                font-size: 16px;
            }

            .txt p, .txt ul li {
                font-size: 14px;
            }

            .btn {
                padding: 8px 15px;
                font-size: 14px;
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

        @media (max-width: 576px) {

            .txt {
                padding: 15px;
            }

            .txt h5 {
                font-size: 14px;
            }

            .txt p, .txt ul li {
                font-size: 12px;
            }

            .btn {
                padding: 6px 10px;
                font-size: 12px;
            }

            .btn-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .view-rooms-btn {
                margin-right: 0;
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
                <div class="dashboard-form">
                <?php

                if (isset($_GET['id'])) {
                    $propertyID = $_GET['id'];
                    // Query to fetch properties along with the owner's name
                    $query = "SELECT property.*, owner.* 
                            FROM property 
                            JOIN owner ON property.OwnerID = owner.OwnerID 
                            WHERE PropertyID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $propertyID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $properties = $result->fetch_all(MYSQLI_ASSOC);

                    // Count vacant rooms for this property
                    $vacantRoomsQuery = "SELECT COUNT(*) AS vacant_count FROM room WHERE PropertyID = ? AND (Status = 'Vacant' OR Status = 'Pending')";
                    $vacantRoomsStmt = $conn->prepare($vacantRoomsQuery);
                    $vacantRoomsStmt->bind_param("s", $propertyID);
                    $vacantRoomsStmt->execute();
                    $vacantRoomsResult = $vacantRoomsStmt->get_result();
                    $vacantRoomsCount = $vacantRoomsResult->fetch_assoc()['vacant_count'];

                    if ($properties) {
                        foreach ($properties as $property) {
                            // Split the image URL string by commas
                            $imageUrls = explode(',', $property['ImgURL']);
                            $firstImageUrl = array_shift($imageUrls); // Get the first URL and remove it from the array
                            $accountID = $_SESSION['AccountID'];

                            // Fetch the BoarderID using AccountID
                            $acc = "SELECT BoarderID FROM boarder WHERE AccountID = ?";
                            $stmt = $conn->prepare($acc);
                            $stmt->bind_param("s", $accountID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $boarder = $result->fetch_assoc();

                            $boarderID = $boarder['BoarderID'];

                            $checkRoomQuery = "SELECT BoarderID FROM room WHERE PropertyID = ? AND BoarderID = ? AND Status = 'Booked'";
                            $checkRoomStmt = $conn->prepare($checkRoomQuery);
                            $checkRoomStmt->bind_param("ss", $propertyID, $boarderID);
                            $checkRoomStmt->execute();
                            $checkRoomStmt->bind_result($existingBoarderID);
                            $checkRoomStmt->fetch();
                            $checkRoomStmt->close();

                            // Fetch all rooms for this property
                            $roomsQuery = "SELECT * FROM room WHERE PropertyID = ? AND (Status = 'Vacant' OR Status = 'Pending')";
                            $roomsStmt = $conn->prepare($roomsQuery);
                            $roomsStmt->bind_param("s", $property['PropertyID']);
                            $roomsStmt->execute();
                            $roomsResult = $roomsStmt->get_result();
                            $rooms = $roomsResult->fetch_all(MYSQLI_ASSOC);
                            
                            $kitchen = 0;
                            $liv = 0;
                            $cr = 0;
                            $bed = 0;

                            if ($rooms) {
                                foreach ($rooms as $room) {
                                    $kitchen += intval($room['Kitchen']);
                                    $liv += intval($room['Liv_Room']);
                                    $cr += intval($room['Rest_Room']);
                                    $bed += intval($room['Bed']);
                                }
                            }

                            echo '<div class="col-md-12 ab">';
                            echo '<div class="property-card" style="background-color: floralwhite;">';
                            echo '<div class="row" style="width: 100% !important; margin: 0;">';
                            echo '<div class="col-md-6" style="height: 96% !important; padding: 0;">';
                            echo '<div class="img-cont">';
                            echo '<a>';
                            echo '<img class="image-cardd" src="' . htmlspecialchars($firstImageUrl) . '" alt="Property Image" style="width:100%; height:60%;">';
                            echo '</a>';
                            // Display remaining images
                            if (!empty($imageUrls)) {
                                echo '<div class="thumbnail-cont" style="margin-top: 10px; padding-bottom: 5px; display: flex; justify-content: space-evenly; gap: 5px;">';
                                foreach ($imageUrls as $imageUrl) {
                                    echo '<img class="thumbnail" src="' . htmlspecialchars($imageUrl) . '" alt="Thumbnail Image" style="width:100% ; height:100%;">';
                                }
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-md-6" style="height: 96% !important; padding: 0;">';
                            echo '<div class="txt">';
                            echo '<h5>Location:</h5><br>';
                            echo '<p style="margin-left: 5%;" class="loc"onclick="openDirections(\'' . htmlspecialchars($property['Location']) . '\')"><ion-icon class="icon" name="location"></ion-icon>' . htmlspecialchars($property['Location']) . '</p>';
                            echo '<ul>';
                            echo '<li class="lst">Occupants - '.$property['Category'].'</li>';
                            echo '<li class="lst">Available Rooms - '.$vacantRoomsCount.'</li>';
                            echo '<li class="lst">Beds - '.$bed.'</li>';
                            echo '<li class="lst">Rest Room - '.$cr.'</li>';
                            echo '<li class="lst">Living Room - '.$liv.'</li>';
                            echo '<li class="lst">Kitchen - '.$kitchen.'</li>';
                            echo '<li class="lst">Description - '.$property['Description'].'</li>';
                            echo '</ul><br>';
                            echo '<h5>Owner:</h5><br>';
                            echo '<p style="margin-left: 5%;  margin-bottom: 0;">'.$property['FullName'].'</p>';
                            if ($existingBoarderID) {
                            echo '<div class="btn-container">
                                <button class="btn btn-success" data-bid="'.$boarderID.'" data-id="'.$propertyID.'" data-toggle="modal" data-target="#review" onclick="setID(this)">Write a review!</button>
                            </div>';
                            }else{
                                echo '<div class="btn-container">
                                <button class="btn btn-success view-rooms-btn" data-id="'.$propertyID.'" data-toggle="modal" data-target="#viewRooms">Book Now</button>
                                <button data-boarderid="' . htmlspecialchars($accountID)     . '" data-ownerid="' . htmlspecialchars($property['OwnerID']) . '" class="btn btn-primary" data-toggle="modal" data-target="#message">Message</button>
                                </div>';
                            }

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No property ID provided.</p>';
                        exit;
                    }
                }
                ?>

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
                                    <?php

                    $sql = "SELECT * FROM info";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo'
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="mail"></ion-icon> '.$row['Gmail'].'</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="logo-facebook"></ion-icon> <a href="'.$row['FB'].'" target="_blank">'.$row["FB"].'</a></div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><ion-icon name="call"></ion-icon> '.$row['ContNum'].'</div>
                        </div>
                        ';
                    }else{
                        echo '
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="mail"></ion-icon> rentit@gmail.com</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="logo-facebook"></ion-icon> Rent IT</div>
                        </div>
                        <div class="col-md-4" style="padding: 10px;">
                        <div><ion-icon name="call"></ion-icon> +63 992 2762 412</div>
                        </div>
                        ';
                    }
                    

                ?>
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
    </footer>

    <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Write a review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/review.php" method="post">
                        <textarea name="message" required style="width: 100%;"></textarea>
                        <input type="hidden" name="propertyID" id="proID">
                        <input type="hidden" name="boarderID" id="bID">
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="z-index: 2000;" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to book this room? The booking request will be sent to the owner for verification.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmBookingBtn">Book Now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Send Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="messageForm">
                        <textarea name="message" id="messageText" required style="width: 100%;"></textarea>
                        <input type="hidden" name="ownerID" id="ownerID">
                        <input type="hidden" name="boarderID" id="boarderID">
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewRooms" tabindex="-1" role="dialog" aria-labelledby="viewRoomsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 100%; max-width: 783px;">
            <div class="modal-content" style="overflow-x: auto;">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRoomsLabel">Available Rooms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Rooms will be loaded here -->
                    <div class="dash-box">
                        <table>
                            <thead>
                                <th>Room Number</th>
                                <th>Room Floor</th>
                                <th>Beds</th>
                                <th>Kitchen</th>
                                <th>Living Room</th>
                                <th>Rest Room</th>
                            </thead>
                            <tbody id="roomsContent"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Property Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 500px;"></div>
                    <button type="button" onclick="chooseModal()" id="getDirectionsButton" class="btn btn-success mt-2">Get Directions</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Select Location Option</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" id="currentLocationButton" class="btn btn-primary btn-block">Use Current Location</button>
                    <button type="button" id="typeLocationButton" class="btn btn-primary btn-block">Type Location</button>
                    <div id="typeLocationInput" style="display: none;">
                        <input type="text" id="locationInput" class="form-control" placeholder="Enter location">
                        <button type="button" id="inputLocationButton" class="btn btn-success mt-2 btn-block">Find Location</button>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Popper.js (if needed by Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS --> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <!-- Ionicons JS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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
        let map;
        let userMarker;
        let inputLocationMarker;
        let propertyMarker;
        let currentLocation;
        let routingControl;
        <?php

            if (isset($_SESSION['error_message'])) {
                echo 'toastr.error("' . $_SESSION['error_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['error_message']); // Clear the error message from session
            } elseif (isset($_SESSION['success_message'])) {
                echo 'toastr.success("' . $_SESSION['success_message'] . '", "", {timeOut: 1000, extendedTimeOut: 1000, positionClass: "toast-center", toastClass: "toast" });';
                unset($_SESSION['success_message']); // Clear the success message from session
            }
        ?>
        function setID(element){
            var proID = element.getAttribute('data-id');
            var bID = element.getAttribute('data-bid');

            document.getElementById('proID').value = proID;
            document.getElementById('bID').value = bID;
        }

        $(document).ready(function() {
            $('#message').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var ownerID = button.data('ownerid'); // Extract info from data-* attributes
                var boarderID = button.data('boarderid'); // Extract info from data-* attributes

                var modal = $(this);
                modal.find('#ownerID').val(ownerID);
                modal.find('#boarderID').val(boarderID);
            });

            $('#messageForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: 'process/send_message.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert('Message sent successfully.');
                            $('#message').modal('hide');
                        } else {
                            alert('Error sending message: ' + response); // Display the actual error response
                        }
                    },
                    error: function() {
                        alert('Error sending message.');
                    }
                });
            });
        });

        $(document).ready(function() {
            var roomIdToBook;
            var propIdToBook;
            var ownIdToBook;

            $(document).on('click', '.bookBtn', function() {
                roomIdToBook = $(this).data('roomid');
                propIdToBook = $(this).data('propid');
                ownIdToBook = $(this).data('ownerid');
                $('#confirmModal').modal('show');
            });

            $('#confirmBookingBtn').click(function() {
                $.ajax({
                    url: 'process/book.php',
                    type: 'POST',
                    data: { 
                        RoomID: roomIdToBook,
                        PropID: propIdToBook,
                        OwnerID: ownIdToBook
                    },
                    success: function(response) {
                        if(response == 'success') {
                            alert('Book request sent successfully!');
                            location.reload();
                        } else {
                            alert('You can only send 1 book request. You can send a book request after the owner accept/decline your booking. Thank You!');
                        }
                    }
                });
                $('#confirmModal').modal('hide');
            });

            $(document).on('click', '.cancelBookBtn', function() {
                var roomIdToCancel = $(this).data('roomid');
                var propIdToCancel = $(this).data('propid');
                var boarderIdToCancel = $(this).data('boarderid');

                if (confirm("Are you sure you want to cancel the booking?")) {
                    $.ajax({
                        url: 'process/cancel_booking.php',
                        type: 'POST',
                        data: {
                            RoomID: roomIdToCancel,
                            PropID: propIdToCancel,
                            BoarderID: boarderIdToCancel
                        },
                        success: function(response) {
                            if (response == 'success') {
                                alert('Booking request canceled successfully!');
                                location.reload(); // Refresh the page or update the UI accordingly
                            } else {
                                alert('Failed to cancel booking request.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });

        $(document).ready(function(){
            $('.view-rooms-btn').on('click', function(){
                var propertyID = $(this).data('id');
                
                $.ajax({
                    url: 'process/fetch_rooms.php',
                    type: 'POST',
                    data: {id: propertyID},
                    success: function(response){
                        $('#roomsContent').html(response);
                    },
                    error: function(){
                        $('#roomsContent').html('<p>An error has occurred</p>');
                    }
                });
            });
        });

        // Function to initialize Leaflet map
        function initializeMap() {
            map = L.map('map').setView([0, 0], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }

        // Function to open the map modal and load location
        function openDirections(location) {
            $('#mapModal').modal('show');
            fetchLocationCoordinates(location);
        }

        function chooseModal() {
            $('#locationModal').modal('show');
        }

        function typeLocation() {
            $('#typeLocationInput').show();
        }

        // Function to fetch coordinates and show location on map
        function fetchLocationCoordinates(location) {
            const geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`;
            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const { lat, lon } = data[0];
                        showLocationOnMap(lat, lon);
                    } else {
                        alert("Location not found.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Function to show location on map
        function showLocationOnMap(lat, lon) {
            map.setView([lat, lon], 13);

            // Clear existing markers and routing control if they exist
            clearMarkersAndRoute();

            // Add marker for property location if it doesn't exist
            if (!propertyMarker) {
                propertyMarker = L.marker([lat, lon]).addTo(map)
                    .bindPopup('Property Location')
                    .openPopup();
            }

            // Add listener for 'Use Current Location' button
            $('#currentLocationButton').off('click').on('click', function() {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const userLat = position.coords.latitude;
                        const userLon = position.coords.longitude;

                        // Clear existing user marker if it exists
                        clearUserMarker();

                        // Add marker for user's current location
                        userMarker = L.marker([userLat, userLon]).addTo(map)
                            .bindPopup('Your Current Location')
                            .openPopup();

                        // Store current location coordinates
                        currentLocation = [userLat, userLon];

                        // Zoom to user's current location
                        map.setView([userLat, userLon], 13);

                        getRoute(currentLocation, [lat, lon]);
                        $('#locationModal').modal('hide');
                        
                    }, function(error) {
                        console.error('Error getting current location:', error);
                        alert('Error getting current location. Please try again.');
                    });
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            });
            $('#inputLocationButton').off('click').on('click', function() {
                const location = $('#locationInput').val().trim();
                if (location) {
                    // Use OpenStreetMap's Nominatim to get the coordinates
                    searchLocation(location, function(coords) {
                        if (coords) {
                            const userLat = coords.lat;
                            const userLon = coords.lon;

                            // Clear existing user marker if it exists
                            clearUserMarker();

                            // Add marker for user's input location
                            userMarker = L.marker([userLat, userLon]).addTo(map)
                                .bindPopup('Your Location')
                                .openPopup();

                            // Store input location coordinates
                            currentLocation = [userLat, userLon];

                            // Zoom to input location
                            map.setView([userLat, userLon], 13);

                            getRoute(currentLocation, [lat, lon]);
                            $('#locationModal').modal('hide');
                            $('#typeLocationInput').hide();
                        } else {
                            alert('Location not found. Please try again.');
                        }
                    });
                } else {
                    alert('Please enter a location.');
                }
            });
        }

        // Function to search for the location using OpenStreetMap's Nominatim
        function searchLocation(location, callback) {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`;

            $.get(url, function(data) {
                if (data && data.length > 0) {
                    callback({ lat: data[0].lat, lon: data[0].lon });
                } else {
                    callback(null);
                }
            }).fail(function() {
                callback(null);
            });
        }

        // Function to fetch and display route using Leaflet Routing Machine
        function getRoute(origin, destination) {
            // Clear existing routing control if it exists
            clearRoutingControl();

            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(origin[0], origin[1]),
                    L.latLng(destination[0], destination[1])
                ],
                createMarker: function() { return null; }, // Disable default markers
                routeWhileDragging: true, // Recalculate route while dragging waypoints
                lineOptions: {
                    styles: [{ color: 'blue', opacity: 0.8, weight: 6 }]
                },
            }).addTo(map);
        }

        // Function to clear user marker
        function clearUserMarker() {
            if (userMarker) {
                map.removeLayer(userMarker);
                userMarker = null;
            }
        }

        // Function to clear markers and routing control
        function clearMarkersAndRoute() {
            clearUserMarker(); // Clear user marker
            clearRoutingControl(); // Clear routing control

            // Clear property marker if it exists
            clearPropertyMarker();
        }

        // Function to clear property marker
        function clearPropertyMarker() {
            if (propertyMarker) {
                map.removeLayer(propertyMarker);
                propertyMarker = null;
            }
        }

        // Function to clear routing control
        function clearRoutingControl() {
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }
        }

        $(document).ready(function() {
            initializeMap(); // Initialize the map on document ready

            // Triggered when the map modal is shown
            $('#mapModal').on('shown.bs.modal', function (e) {
                // Refresh the map size to ensure it displays correctly
                map.invalidateSize();
            });

            // Triggered when the map modal is hidden
            $('#mapModal').on('hidden.bs.modal', function (e) {
                // Clear markers and routing control when modal is closed
                clearMarkersAndRoute();
            });

            // Example of how to open the modal with a specific location
            $('#openMapButton').on('click', function() {
                openDirections('Your location here'); // Replace with actual location
            });

            // Event listener for typing location button in location modal
            $('#typeLocationButton').on('click', function() {

                typeLocation();
            });
        });

        $(document).ready(function() {
            let currentPage = 1;
            const itemsPerPage = 3; // Number of properties per page

            function loadProperties(page = 1) {
                const formData = $('#searchForm').serialize() + `&page=${page}&itemsPerPage=${itemsPerPage}`;
                $.ajax({
                    url: 'process/search_property.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#propertiesContainer').html(response);
                        updatePaginationButtons(page);
                        document.getElementById('paginationContainer').style.display = 'block';
                    }
                });
            }

            function updatePaginationButtons(page) {
                $('#prevButton').prop('disabled', page <= 1);
                $('#nextButton').prop('disabled', page >= totalPages);
            }

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                currentPage = 1;
                loadProperties(currentPage);
            });

            $('#prevButton').on('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    loadProperties(currentPage);
                }
            });

            $('#nextButton').on('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    loadProperties(currentPage);
                }
            });


        });
    </script>
</body>
</html>
