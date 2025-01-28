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
    <title>Rent IT - Booked Property</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/booked.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <link rel="stylesheet" href="../css/modal.css">
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

.property-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: calc(100vh - 140px);
}

.img-cont {
    display: flex;
    overflow-x: auto; 
    overflow-y: hidden; 
    white-space: nowrap; 
}

.image-cardd {
    width: 100%; 
    height: 400px;
    object-fit: cover; 
    transition: transform 0.3s ease;
    flex: 0 0 auto; 
    margin-right: 10px; 
}

.img-cont:hover .image-cardd {
    transform: scale(1.05);
}

.txt-in {
    display: flex;
    margin: 30px;
    width: 100%;
}

.txt-in h5 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.txt-in p {
    color: #666;
    font-size: 16px;
    margin: 0;
    line-height: 1.5;
}

.txt-in ul {
    list-style-type: none;
    padding: 0;
    margin: 10px 0 0 0;
}

.txt-in ul li {
    font-size: 16px;
    color: #333;
    margin-bottom: 5px;
}

.txt-in ul li::before {
    content: "• ";
    color: #4CAF50;
    font-weight: bold;
}
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
                        <div class="group"><ion-icon name="newspaper"></ion-icon> Chats</div>  
                    </a><br>

                    <a href="booked.php" class="sub" id="queryLink">
                        <div class="group"><ion-icon name="business"></ion-icon> Booked Property</div>   
                    </a>
                </aside>
                <div class="dashboard-form">
                    <h6 class="sub-dash" style="font-weight: 600;">Dashboard / <span style="font-weight: 100;">Booked Property</span></h6>
                    <?php
                        $accountid = $_SESSION['AccountID']; 

                        $sql_boarderid = "SELECT BoarderID FROM boarder WHERE AccountID = ?";
                        $stmt_boarderid = $conn->prepare($sql_boarderid);
                        if (!$stmt_boarderid) {
                            die("Error in statement preparation: " . $conn->error);
                        }
                        $stmt_boarderid->bind_param("s", $accountid);
                        $stmt_boarderid->execute();
                        $result_boarderid = $stmt_boarderid->get_result();

                        if ($result_boarderid->num_rows > 0) {
                            $row_boarderid = $result_boarderid->fetch_assoc();
                            $boarderid = $row_boarderid['BoarderID'];

                            $sql = "SELECT room.*, property.*, book_log.*, owner.FullName AS name 
                                    FROM room 
                                    JOIN property ON room.PropertyID = property.PropertyID 
                                    JOIN book_log ON room.RoomID = book_log.RoomID AND room.PropertyID = book_log.PropertyID AND room.BoarderID = book_log.BoarderID
                                    JOIN owner ON property.OwnerID = owner.OwnerID
                                    WHERE room.BoarderID = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $boarderid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            // Display the results 
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                   
                                    $imageUrls = explode(',', $row['ImgURL']);
                            
                                    $propertyID = htmlspecialchars($row['PropertyID']);
                                    $accountID = htmlspecialchars($row['BoarderID']);

                                    $logDate = new DateTime($row['LogDate']);
                                    $formattedLogDate = $logDate->format('F j, Y \a\t g:i A');
                                    
                                    echo '<div class="col-md-12">';
                                    echo '<div class="property-card">';
                                    echo '<div class="img-cont">';
                                    echo '<a>';
                                    foreach ($imageUrls as $imageUrl) {
                                    echo '<img class="image-cardd" src="' . $imageUrl . '" alt="Property Image">';
                                    }
                                    echo '</a>';

                                    echo '</div>';
                                    echo '<div class="row txt">';
                                    echo '<div class="txt-in">';
                                    echo '<div class="col-md-8">';
                                    echo '<h5>Location:</h5><br>';
                                    echo '<p class="loc" onclick="openDirections(\'' . htmlspecialchars($row['Location']) . '\')"><ion-icon class="icon" name="location"></ion-icon>' . htmlspecialchars($row['Location']) . '</p><br>';
                                    if($row['Activity'] == 'Check-in'){
                                        echo '<p>Check-in: '.$formattedLogDate.'</p>';
                                    }
                                    echo '<br>';
                                    echo '</div>';
                                    echo '<div class="col-md-4">';
                                    echo '<h5>Owner:</h5><br>';
                                    echo '<p>' . htmlspecialchars($row['name']) . '</p><br>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "You currently do not have any booked properties.";
                            }
                        
                            $stmt->close();
                        } else {
                            echo "No boarderid found for the provided accountid.";
                        }
                        
                        $stmt_boarderid->close();
                        $conn->close();
                    ?>
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
                        <textarea name="message" id="messageText" required></textarea>
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
        <div class="modal-dialog" role="document" style="width: 60%; max-width: 5000px;">
            <div class="modal-content">
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
                            <th>Action</th>
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
    <!-- Popper.js (if needed by Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS --> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <!-- Ionicons JS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        
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
