<?php
    session_start();
if(isset($_SESSION['loggedIn'])){
        if ($_SESSION['AccType'] === 'Super_Admin' || $_SESSION['AccType'] === 'Admin') {
            header('Location: super_admin/dashboard.php');
            exit();
        } else if ($_SESSION['AccType'] === 'Owner') {
            header('Location: owner/dashboard.php');
            exit();
        } else if ($_SESSION['AccType'] === 'Boarder') {
            header('Location: boarder/dashboard.php');
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
    <title>Rent IT - Home</title>
    <meta name="description" content="Find and rent the best properties with Rent IT. Explore our listings and discover your next home or rental property today.">
    <meta name="keywords" content="rent, rentit, rent it, property, home, rental, Rent IT, apartments, houses, property listings, real estate">
    <meta http-equiv="content-language" content="en-gb">
    <meta name="google-site-verification" content="_0Gl3ztRf0zyoPTl38KrHXFSLs_PvHN11hS-e6sK7t4" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <style>
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

        .col-md-4 {
            padding: 15px;
            z-index: 5000;
        }

        .property-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .property-card:hover {
            transform: translateY(-10px);
        }

        .property-card a {
            display: block;
            width: 100%;
        }

        .image-card {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .txt, .txtt {
            padding: 15px;
        }
        .txt{
            min-height: 24%;
        }
        .txt p, .txtt p {
            margin: 0 0 10px;
            font-size: 16px;
            color: #666666;
            cursor: pointer;
            transition: color 0.3s;
        }

        .txt p:hover, .txtt p:hover {
            color: #0056b3;
        }

        .icon {
            vertical-align: middle;
            margin-right: 5px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            border-top: 1px solid #dddddd;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }

        table td:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .current-booked {
            border: 3px solid #4CAF50;
            box-shadow: 0 4px 12px rgba(0, 128, 0, 0.4);
            position: relative;
        }

        .booked-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            z-index: 1;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .txt p, .txtt p, table td {
                font-size: 14px;
            }

            table td {
                padding: 8px;
            }
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

        @media (max-width: 576px) {
            .txt, .txtt {
                padding: 10px;
            }

            .txt p, .txtt p, table td {
                font-size: 12px;
            }

            table td {
                padding: 6px;
            }

            .property-card {
                margin-bottom: 20px;
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
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard">
                <div class="dashboard-form">
                    <h1 style="text-align: center; letter-spacing: 3px; font-weight: 600 !important;">RENT LIKE<span style="color: rgb(0 84 6);"> HOME</span></h1>
                    <form id="searchForm">
                        <div class="type">
                            <div class="row">
                                <div class="col-md-2 select">
                                  <!--  <select name="type" id="type" style="width: 100%; padding: 12.5px;">
                                        <option value="">Select Type</option>
                                        <option value="apartment">Apartment</option>
                                        <option value="dormitory">Dormitory</option>
                                    </select> -->
                                </div>
                                <div class="col-md-8 inp">
                                    <input type="text" name="location" placeholder="Enter location" style="width: 100%; padding: 10px;">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success" style="border-radius: 10px; width: 100%; min-width: 50px; padding: 10px;">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="properties-container">
                        <div class="row" id="propertiesContainer">
                            <!-- Properties will be displayed here -->
                        </div>
                    </div>
                    <div class="pagination-container" id="paginationContainer">
                        <div class="pagination-buttons">
                            <button id="prevButton" class="btn btn-secondary btns" disabled><ion-icon name="caret-back"></ion-icon></button>
                            <button id="nextButton" class="btn btn-secondary btns"><ion-icon name="caret-forward"></ion-icon></button>
                        </div>
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
                    require_once("config/connect.php");
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
        let map;
        let userMarker;
        let inputLocationMarker;
        let propertyMarker;
        let currentLocation;
        let routingControl;

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
                        if ($.trim(response) === '' || response.indexOf('No properties found') !== -1) {
                            document.getElementById('paginationContainer').style.display = 'none';
                        } else {
                            updatePaginationButtons(page);
                            $('#paginationContainer').show();
                        }

                    }
                });
            }loadProperties(page = 1);

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
