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
    <title>Rent IT - Property</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="owner-css/property.css">
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
                    <a href="dashboard.php" class="sub2">
                    <div class="group"><ion-icon name="home-sharp"></ion-icon> Dashboard</div>
                    </a><br>
 
                    <a href="profile.php" class="sub2" id="profileLink">
                        <div class="group"><ion-icon name="person"></ion-icon> Profile</div>   
                    </a><br>

                    <a href="message.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="chatbox-ellipses"></ion-icon> Chats</div>  
                    </a><br>

                    <a href="property.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="newspaper"></ion-icon> Property</div>  
                    </a><br>

                    <a href="tenant.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="people"></ion-icon> Boarders/Tenants</div>  
                    </a><br>

                    <a href="pending.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="hourglass"></ion-icon> Pending Reservations</div>  
                    </a><br>

                </aside>
                <div class="dashboard-form">
                    <h6 class="sub-dash" style="font-weight: 600;">Dashboard / <span style="font-weight: 100;">Property</span></h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dash-box">
                                    <table id="profileTable">
                                        <thead>
                                            <tr>
                                                <th colspan="6">Property List</th>
                                                <th style="text-align: right; font-size: 12px;">
                                                    <button type="button" data-toggle="modal" data-target="#addProperty" class="btn btn-success" >Add Property</button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="12">
                                                    <div class="filter-container">
                                                        <div class="show">
                                                        </div>
                                                        <div class="search">
                                                            <label for="search">Search:</label>
                                                            <input type="text" id="searchInput" onkeyup="searchTable()">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Property Name</th>
                                                <th>Description</th>
                                                <th>Location</th>
                                                <th>Rooms</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                require_once("../config/connect.php");
                                                
                                                $accountID = $_SESSION["AccountID"];

                                                $acc = "SELECT OwnerID FROM owner WHERE AccountID = '$accountID'";                                

                                                $accresult = $conn->query($acc);

                                                if ($accresult->num_rows > 0) {
                                                    $accrow = $accresult->fetch_assoc();

                                                    $ownerID = $accrow["OwnerID"];

                                                    $sql = "SELECT * FROM property WHERE OwnerID = '$ownerID'";                                

                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {

                                                            echo '<tr>';
                                                            echo "<td>" . $row["Type"] . "</td>";
                                                            echo "<td>" . $row["Category"] . "</td>";
                                                            echo "<td>" . $row["PropertyName"] . "</td>";
                                                            echo "<td>" . $row["Description"] . "</td>";
                                                            echo "<td>" . $row["Location"] . "</td>";
                                                            echo "<td>" . $row["Total_Room"] . "</td>";
                                                            echo "<td style='text-overflow: clip; white-space: unset;'><button class='btn btn-primary' data-toggle='modal' data-target='#editProperty' data-idd='".$row["PropertyID"]."'>Edit</button>
                                                            <button data-toggle='modal' data-target='#viewRooms' data-id='".$row["PropertyID"]."' class='btn btn-primary view-rooms-btn'>Rooms</button> 
                                                            <button data-toggle='modal' data-target='#viewImages' data-pid='".$row["PropertyID"]."' class='btn btn-primary view-images-btn' >Images</button>
                                                            <button data-toggle='modal' data-target='#delete' data-propertyID='".$row["PropertyID"]."' class='btn btn-danger' onclick='setPropID(this)'>Delete</button>
                                                            </td>";
                                                            echo "</tr>";
                                                        }
                                                    }else {
                                                        echo "<tr><td colspan='4'>No records found</td></tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No account id found</td></tr>";
                                                }

                                                $conn->close();
                                            ?>
                                            <tr class="page-tr"> 
                                                <td colspan="12">
                                                    <div class="pagination-container">
                                                        <div>
                                                            <button id="prevBtn" onclick="prevPage()">Previous</button>
                                                            <span id="pageInfo"></span>
                                                            <button id="nextBtn" onclick="nextPage()">Next</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProperty" tabindex="-1" role="dialog" aria-labelledby="editRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomLabel">Edit Property</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/edit_property.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="prid" id="prid">
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="location">Location:</label>
                                <input style="border: none; background-color: transparent; width: 100%; text-align: center;" type="text" id="location2" name="location" readonly required><br><br>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#mapModal2">
                                    <ion-icon name="location-sharp"></ion-icon> Open Map
                                </button>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="cat">Category:</label>
                                <select style="padding: 5px;" name="cat" id="cat" required>
                                    <option value="Both">Both</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Description:</p>
                                <textarea type="text" style="width: 90%;" id="desc" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" style="z-index: 1060;" id="mapModal2" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel2">Select Location on Map</h5>
                    <button type="button" class="close" onclick="closeModal2()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map2" style="height: 500px; width: 100%;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button id="myLocation2" class="btn btn-secondary">Use My Location</button>
                    <button type="button" class="btn btn-primary" id="confirmLocation2" data-dismiss="modal">Confirm Location</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewImages" tabindex="-1" role="dialog" aria-labelledby="viewImagesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 60%; max-width: 5000px;">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewImagesLabel">Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Rooms will be loaded here -->
                <div id="imagesContent" class="image-preview">
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('imageUploadInput').click();">Upload Image</button>
                <form id="imageUploadForm" action="process/upload_image.php" method="post" enctype="multipart/form-data" style="display:none;">
                    <input type="file" id="imageUploadInput" name="images[]" multiple onchange="uploadImages()">
                    <input type="hidden" id="propID" name="propertyID">
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewRooms" tabindex="-1" role="dialog" aria-labelledby="viewRoomsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 70%; max-width: 5000px;">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRoomsLabel">Rooms</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Rooms will be loaded here -->
                <div class="dash-box">
                    <table id="roomsContent">
                        
                    </table>
                </div>
                <!-- Image Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Room Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" class="img-fluid" alt="Room Image">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-toggle='modal' data-target='#addRoom'>Add Room</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="z-index: 1060; height: calc(100vh - 40px); overflow: auto;" id="mapModal" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Select Location on Map</h5>
                    <button type="button" class="close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 500px; width: 100%;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button id="myLocation" class="btn btn-secondary">Use My Location</button>
                    <button type="button" class="btn btn-primary" id="confirmLocation" data-dismiss="modal">Confirm Location</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProperty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 95%; max-width: 5000px; overflow: auto; height: calc(100vh - 50px);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Property</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-property-form" action="process/add_property.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 prop">
                                <h5 class="prop-head">Property Details</h5>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="location">Location:</label>
                                <input style="border: none; background-color: transparent; width: 100%; text-align: center;" type="text" id="location" name="location" readonly required><br><br>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#mapModal">
                                    <ion-icon name="location-sharp"></ion-icon> Open Map
                                </button>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4" style="display: none;">
                                <label for="type">Type:</label>
                                <select style="padding: 5px;" name="type" id="type" required>
                                   
                                    <option value="dormitory">Dormitory</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="cat">Category:</label>
                                <select style="padding: 5px;" name="cat" id="cat" required>
                                    <option value="Both">Both</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="totalRooms">Total Rooms:</label>
                                <input type="number" style="width: 25%;" id="totalRooms" name="totalRooms" required>
                            </div>
                            <div class="col-md-4">
                                <label for="totalRooms">Property Name:</label>
                                <input type="text" style="width: 50%;" id="PropName" name="PropName" required>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Description:</p>
                                <textarea type="text" style="width: 30%;" id="description" name="description" required></textarea>
                            </div>
                        </div>
                        <div id="roomFieldsContainer" style="margin: 0 auto;"></div>
                        <br>
                        <div class="row">
                            <p class="personal" style="margin-left: 20px; font-size: 12px;">Gallery</p>
                            <div class="col-md-12">
                                <div class="upload-wrapper">
                                    <div id="image-preview" class="image-preview"></div>
                                    <div class="upload-container" onclick="document.getElementById('file-input').click();">
                                        <input type="file" name="files[]" id="file-input" multiple onchange="previewImages()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="button" onclick="updateFormSubmission()" class="btn btn-primary">Save</button>
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

        <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 80%; max-width: 5000px; overflow: auto; height: calc(100vh - 50px);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/add_room.php" method="post">
                        <input type="hidden" id="propid" name="propid">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="totalRooms">Total Rooms:</label>
                                <input type="number" style="width: 25%;" id="totalRooms2" name="totalRooms" required>
                            </div>
                        </div>
                        <div id="roomFieldsContainer2" style="margin: 0 auto;"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-labelledby="editRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoomLabel">Edit Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRoomForm" enctype="multipart/form-data">
                <input type="hidden" id="roomID" name="roomID">
                <div class="form-groups">
                    <label for="roomNo">Room Number</label>
                    <input type="text" style="text-align: center;" class="form-control" id="roomNo" name="roomNo" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="roomFloor">Room Floor</label>
                    <input type="text" style="text-align: center;" class="form-control" id="roomFloor" name="roomFloor" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="roomFloor">Bed</label>
                    <input type="text" style="text-align: center;" class="form-control" id="bed" name="bed" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="roomFloor">Rest Room</label>
                    <input type="text" style="text-align: center;" class="form-control" id="rest" name="restRoom" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="kitchen">Kitchen</label>
                    <input type="text" style="text-align: center;" class="form-control" id="kitchen" name="kitchen" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="livingRoom">Living Room</label>
                    <input type="text" style="text-align: center;" class="form-control" id="livingRoom" name="livingRoom" autocomplete="off">
                </div>
                <div class="form-groups">
                    <label for="livingRoom">Room Picture</label>
                    <input type="file" style="text-align: center;" class="form-control" id="roomPicture" name="roomPicture">
                </div>
                <div class="form-groups">
                    <label for="status">Status</label>
                    <input type="text" style="text-align: center;" class="form-control" id="status" name="status" disabled>
                </div>
                <button type="button" class="btn btn-primary" id="updateRoomBtn">Update Room</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        function viewImage(imageUrl) {
            $('#modalImage').attr('src', "../" + imageUrl); // Set image source
            $('#imageModal').modal('show'); // Show modal
        }
        
        function toggleMenu() {
            var dropdown = document.getElementsByClassName("dropdown-menu")[0];
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            var mapContainer2 = document.getElementById('map2');
            var map2, marker2;

            function initializeMap2() {
                if (mapContainer2.clientHeight > 0) {
                    map2 = L.map('map2').setView([13.9546, 121.4783], 10);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
                    }).addTo(map2);

                    var geocoder = L.Control.geocoder({
                        defaultMarkGeocode: false
                    }).on('markgeocode', function(e) {
                        var bbox = e.geocode.bbox;
                        var poly = L.polygon([
                            bbox.getSouthEast(),
                            bbox.getNorthEast(),
                            bbox.getNorthWest(),
                            bbox.getSouthWest()
                        ]).addTo(map2);
                        map2.fitBounds(poly.getBounds());
                        if (marker2) {
                            map2.removeLayer(marker2);
                        }
                        marker2 = L.marker(e.geocode.center).addTo(map2);
                    }).addTo(map2);

                    map2.on('click', function(e) {
                        if (marker2) {
                            map2.removeLayer(marker2);
                        }
                        marker2 = L.marker(e.latlng).addTo(map2);
                    });

                    document.getElementById('confirmLocation2').addEventListener('click', function() {
                        if (marker2) {
                            var lat = marker2.getLatLng().lat;
                            var lng = marker2.getLatLng().lng;

                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                                .then(response => response.json())
                                .then(data => {
                                    var locationName = data.display_name;
                                    document.getElementById('location2').value = locationName;
                                })
                                .catch(error => {
                                    console.error('Error fetching location:', error);
                                    document.getElementById('location2').value = `${lat}, ${lng}`;
                                });
                        } else {
                            alert('Please select a location on the map.');
                        }
                    });

                    document.getElementById('myLocation2').addEventListener('click', function() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var lat = position.coords.latitude;
                                var lng = position.coords.longitude;

                                if (marker2) {
                                    map2.removeLayer(marker2);
                                }
                                map2.setView([lat, lng], 13);
                                marker2 = L.marker([lat, lng]).addTo(map2);
                            }, function(error) {
                                alert('Error getting your location: ' + error.message);
                            });
                        } else {
                            alert('Geolocation is not supported by your browser.');
                        }
                    });
                } else {
                    setTimeout(initializeMap2, 100);
                }
            }

            // Initialize the map
            initializeMap2();
        });

        $(document).on('click', '[data-target="#editProperty"]', function () {
            var propertyID = $(this).data('idd');
            $('#prid').val(propertyID);
            // Fetch property details using AJAX
            $.ajax({
                url: 'process/fetch_prop.php',
                type: 'POST',
                data: { propertyID: propertyID },
                success: function(response) {
                    try {
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }

                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#editProperty #location2').val(response.Location);
                            $('#editProperty #cat').val(response.Category);
                            $('#editProperty #desc').val(response.Description);
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
                        console.log('Response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                    console.log('XHR:', xhr);
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const totalRoomsInput = document.getElementById('totalRooms2');
            const roomFieldsContainer = document.getElementById('roomFieldsContainer2');

            function updateRoomFields() {
                // Clear existing room fields
                roomFieldsContainer.innerHTML = '';

                // Get the number of rooms
                const numberOfRooms = parseInt(totalRoomsInput.value);
                if (isNaN(numberOfRooms) || numberOfRooms <= 0) {
                    return;
                }

                // Create room fields
                for (let i = 1; i <= numberOfRooms; i++) {
                    const roomFieldSet = document.createElement('fieldset');
                    roomFieldSet.innerHTML = `
                    <br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="roomFloor${i}">Room Floor:</label>
                                    <input style="width: 25%;" type="text" id="roomFloor${i}" name="roomFloor${i}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="roomNumber${i}">Room Number:</label>
                                    <input style="width: 25%;" type="text" id="roomNumber${i}" name="roomNumber${i}" required>
                                </div>
                            </div>
                           
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="bed${i}">Bed:</label>
                                    <input style="width: 25%;" type="text" id="bed${i}" name="bed${i}" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="restroom${i}">Rest Room:</label>
                                    <input style="width: 25%;" type="text" id="restroom${i}" name="restroom${i}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="kitchen${i}">Kitchen:</label>
                                    <select style="width: 25%; padding: 5px;" id="kitchen${i}" name="kitchen${i}">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="livingRoom${i}">Living Room:</label>
                                    <select style="width: 25%; padding: 5px;" id="livingRoom${i}" name="livingRoom${i}">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    `;
                    roomFieldsContainer.appendChild(roomFieldSet);
                }
            }

            totalRoomsInput.addEventListener('input', updateRoomFields);

        });
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

        document.querySelectorAll('.view-images-btn').forEach(button => {
            button.addEventListener('click', function() {
                var propertyID = this.getAttribute('data-pid');
                document.getElementById('propID').value = propertyID;
            });
        });

        function uploadImages() {
            var form = document.getElementById('imageUploadForm');
            form.submit();
        }

        // Ensure the hidden input is reset when the modal is closed
        $('#viewImages').on('hidden.bs.modal', function () {
            document.getElementById('propID').value = '';
        });

        window.addEventListener('resize', handleResize);
        document.addEventListener('DOMContentLoaded', handleResize);
        let currentPage = 1;
        const rowsPerPage = 5;
        let filteredRows = [];
        document.addEventListener("DOMContentLoaded", function() {
            // Dropdown functionality
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

            // Map functionality
            var mapContainer = document.getElementById('map');
            var map, marker;

            // Ensure the map container is correctly sized before initializing the map
            function initializeMap() {
                if (mapContainer.clientHeight > 0) {
                    map = L.map('map').setView([13.9546, 121.4783], 10); // Example center and zoom

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Add search control
                    var geocoder = L.Control.geocoder({
                        defaultMarkGeocode: false
                    }).on('markgeocode', function(e) {
                        var bbox = e.geocode.bbox;
                        var poly = L.polygon([
                            bbox.getSouthEast(),
                            bbox.getNorthEast(),
                            bbox.getNorthWest(),
                            bbox.getSouthWest()
                        ]).addTo(map);
                        map.fitBounds(poly.getBounds());
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        marker = L.marker(e.geocode.center).addTo(map);
                    }).addTo(map);

                    // Handle click on map to add marker
                    map.on('click', function(e) {
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        marker = L.marker(e.latlng).addTo(map);
                    });

                    // Handle click on confirm location button
                    document.getElementById('confirmLocation').addEventListener('click', function() {
                        if (marker) {
                            var lat = marker.getLatLng().lat;
                            var lng = marker.getLatLng().lng;

                            // Perform reverse geocoding
                            fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng)
                                .then(response => response.json())
                                .then(data => {
                                    var locationName = data.display_name; // Extract the location name from the JSON response
                                    document.getElementById('location').value = locationName; // Set location input value
                                })
                                .catch(error => {
                                    console.error('Error fetching location:', error);
                                    document.getElementById('location').value = lat + ',' + lng; // Fallback to coordinates if reverse geocoding fails
                                });

                            document.getElementById('mapModal').style.display = 'none'; // Hide the map modal
                        } else {
                            alert('Please select a location on the map.');
                        }
                    });

                    // Handle click on "My Location" button
                    document.getElementById('myLocation').addEventListener('click', function() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var lat = position.coords.latitude;
                                var lng = position.coords.longitude;

                                if (marker) {
                                    map.removeLayer(marker);
                                }
                                map.setView([lat, lng], 13); // Zoom in to the user's location
                                marker = L.marker([lat, lng]).addTo(map);
                            }, function(error) {
                                alert('Error getting your location: ' + error.message);
                            });
                        } else {
                            alert('Geolocation is not supported by your browser.');
                        }
                    });
                } else {
                    // Retry after a short delay if the container is not ready
                    setTimeout(initializeMap, 100);
                }
            }

            // Initialize the map
            initializeMap();
        });
        document.addEventListener("DOMContentLoaded", function() {
            const totalRoomsInput = document.getElementById('totalRooms');
            const roomFieldsContainer = document.getElementById('roomFieldsContainer');
            const typeSelect = document.getElementById('type');

            function updateRoomFields() {
                // Clear existing room fields
                roomFieldsContainer.innerHTML = '';

                // Get the number of rooms
                const numberOfRooms = parseInt(totalRoomsInput.value);
                if (isNaN(numberOfRooms) || numberOfRooms <= 0) {
                    return;
                }

                // Get the selected property type
                const propertyType = typeSelect.value;

                // Determine column classes
                const colClass = propertyType === 'apartment' ? 'col-md-2' : 'col-md-2';

                // Create room fields
                for (let i = 1; i <= numberOfRooms; i++) {
                    const roomFieldSet = document.createElement('fieldset');
                    roomFieldSet.innerHTML = `
                    <br>
                        <div class="row">
                            <div class="${colClass}">
                                <div class="form-groupp">
                                    <label for="roomFloor${i}">Room Floor:</label>
                                    <input style="width: 25%;" type="text" id="roomFloor${i}" name="roomFloor${i}" required>
                                </div>
                            </div>
                            <div class="${colClass}">
                                <div class="form-groupp">
                                    <label for="roomNumber${i}">Room Number:</label>
                                    <input style="width: 25%;" type="text" id="roomNumber${i}" name="roomNumber${i}" required>
                                </div>
                            </div>
                            ${propertyType !== 'apartment' ? `
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="bed${i}">Bed:</label>
                                    <input style="width: 25%;" type="text" id="bed${i}" name="bed${i}" required>
                                </div>
                            </div>
                            ` : ''}
                            <div class="col-md-2">
                                <div class="form-groupp">
                                    <label for="restroom${i}">Rest Room:</label>
                                    <input style="width: 25%;" type="text" id="restroom${i}" name="restroom${i}" required>
                                </div>
                            </div>
                            <div class="${colClass}">
                                <div class="form-groupp">
                                    <label for="kitchen${i}">Kitchen:</label>
                                    <select style="width: 25%; padding: 5px;" id="kitchen${i}" name="kitchen${i}">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="${colClass}">
                                <div class="form-groupp">
                                    <label for="livingRoom${i}">Living Room:</label>
                                    <select style="width: 25%; padding: 5px;" id="livingRoom${i}" name="livingRoom${i}">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    `;
                    roomFieldsContainer.appendChild(roomFieldSet);
                }
            }

            totalRoomsInput.addEventListener('input', updateRoomFields);
            typeSelect.addEventListener('change', function() {
                const selectedType = typeSelect.value;
                if (selectedType === 'dormitory' || selectedType === 'apartment') {
                    totalRoomsInput.removeAttribute('disabled');
                } else {
                    totalRoomsInput.setAttribute('disabled', 'disabled');
                    totalRoomsInput.value = ''; // Clear the value when disabled
                }
                updateRoomFields(); // Update room fields when type changes
            });

            // Initialize disabled state based on initial type selection
            if (typeSelect.value !== 'dormitory' && typeSelect.value !== 'apartment') {
                totalRoomsInput.setAttribute('disabled', 'disabled');
                totalRoomsInput.value = ''; // Clear the value when disabled initially
            }
        });

        $(document).ready(function(){
            $('.view-rooms-btn').on('click', function(){
                var propertyID = $(this).data('id');
                $('#propid').val(propertyID);
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
            $('.view-images-btn').on('click', function(){
                var propertyID = $(this).data('pid');
                
                $.ajax({
                    url: 'process/fetch_images.php',
                    type: 'POST',
                    data: {id: propertyID},
                    success: function(response){
                        $('#imagesContent').html(response);
                    },
                    error: function(){
                        $('#imagesContent').html('<p>An error has occurred</p>');
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '.delete-image', function(e) {
                e.preventDefault();
                var permitID = $(this).data('image-id');
                var imgURL = $(this).siblings('img').attr('src'); // Get the image URL
                var confirmation = confirm("Are you sure you want to delete this image?");
                if (confirmation) {
                    $.ajax({
                        url: 'process/delete_image.php',
                        type: 'POST',
                        data: { 
                            permitID: permitID,
                            imgURL: imgURL
                        },
                        success: function(response) {
                            if (response.trim() == 'success') {
                                // Remove the deleted image container from DOM
                                $(e.target).closest('.image-container').remove();
                                window.location.reload();
                            } else {
                                alert('Failed to delete image. Please try again.');
                            }
                        },
                        error: function() {
                            alert('Error deleting image. Please try again.');
                        }
                    });
                }
            });
        });
        $(document).on('click', '[data-target="#editRoom"]', function () {
            var roomID = $(this).data('id');
            
            // Fetch room details using AJAX
            $.ajax({
                url: 'process/fetch_room_details.php',
                type: 'POST',
                data: {id: roomID},
                success: function(response) {
                    var room = JSON.parse(response);
                    $('#editRoom #roomID').val(room.RoomID);
                    $('#editRoom #roomNo').val(room.Room_No);
                    $('#editRoom #roomFloor').val(room.Room_Flr);
                    $('#editRoom #bed').val(room.Bed);
                    $('#editRoom #rest').val(room.Rest_Room);
                    $('#editRoom #kitchen').val(room.Kitchen);
                    $('#editRoom #livingRoom').val(room.Liv_Room);
                    $('#editRoom #status').val(room.Status);
                    $('#editRoom #roomPicture').val(room.RoomImageURL);
                }
            });
        });

        $(document).on('click', '#updateRoomBtn', function () {
            // var formData = $('#editRoomForm').serialize();
            var form = document.getElementById('editRoomForm');
            var formData = new FormData(form);
            $.ajax({
                url: 'process/update_room.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response === 'success'){
                        toastr.success('Room updated successfully!');
                        $('#editRoom').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX ERROR: " + error);
                } 
            });
        });

        $(document).on('click', '[data-target="#deleteRoom"]', function () {
            var roomID = $(this).data('id');

            // Fetch room status using AJAX
            $.ajax({
                url: 'process/check_status.php',
                type: 'POST',
                data: {id: roomID},
                success: function(response) {
                    var data = JSON.parse(response);
                    var status = data.status;
                    var error = data.error;
                    
                    if (error) {
                        toastr.error('Error: ' + error);
                        return;
                    }

                    if (status === 'Vacant') {
                        // Proceed to delete the room
                        if (confirm('Are you sure you want to delete this room?')) {
                            $.ajax({
                                url: 'process/delete_room.php',
                                type: 'POST',
                                data: {id: roomID},
                                success: function(response) {
                                    if(response === 'success'){
                                        toastr.success('Room deleted successfully!');
                                        location.reload();
                                    } else {
                                        toastr.error('Failed to delete room.');
                                    }
                                }
                            });
                        }
                    } else {
                        toastr.error('Room is currently booked and cannot be deleted.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('AJAX error: ' + status + ' - ' + error);
                }
            });
        });
        
        var selectedFiles = [];

        function checkFileInput() {
            var fileInput = document.getElementById("file-input");
            var uploadContainer = document.querySelector(".upload-container");
            if (selectedFiles.length > 0) {
                uploadContainer.style.display = "none";
            } else {
                uploadContainer.style.display = "block";
                fileInput.value = ""; // Reset file input to allow re-selection
            }
        }

        function previewImages() {
            var preview = document.getElementById('image-preview');
            var files = document.getElementById('file-input').files;
            
            selectedFiles = [];

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file.type.startsWith('image/')) {
                    selectedFiles.push(file); // Add file to selectedFiles array

                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(e) {
                            var imgContainer = document.createElement('div');
                            imgContainer.classList.add('image-container');

                            var img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('preview-image');
                            imgContainer.appendChild(img);

                            // Add a "Remove" button
                            var removeBtn = document.createElement('button');
                            removeBtn.textContent = 'Remove';
                            removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-image-btn');
                            removeBtn.addEventListener('click', function() {
                                imgContainer.remove(); // Remove the image preview container
                                removeFromSelectedFiles(file); // Remove file from selectedFiles array
                                checkFileInput(); // Remove file from selectedFiles array
                            });
                            imgContainer.appendChild(removeBtn);

                            preview.appendChild(imgContainer);
                        };
                    })(file);
                    reader.readAsDataURL(file);
                }
            }
            checkFileInput();
        }
        // Function to remove file from selectedFiles array
        function removeFromSelectedFiles(fileToRemove) {
            selectedFiles = selectedFiles.filter(function(file) {
                return file !== fileToRemove;
            });
            checkFileInput();
        }
        // Function to update the form submission with selectedFiles
        function updateFormSubmission() {
            var form = document.getElementById('add-property-form');
            var formData = new FormData(form);

            // Remove existing files from FormData
            formData.delete('files[]');

            // Add selected files to FormData
            for (var i = 0; i < selectedFiles.length; i++) {
                formData.append('files[]', selectedFiles[i]);
            }

            // Submit the form with updated FormData
            fetch(form.action, {
                method: 'POST',
                body: formData
            }).then(function(response) {
                return response.text();
            }).then(function(responseText) {
                if (responseText.trim() === 'success') {
                    
                    // Optionally, you can reset the form or redirect the user
                    form.reset();
                    $('#addProperty').modal('hide');
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            }).catch(function(error) {
                toastr.error('An error occurred. Please try again.');
            });
        }
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('profileTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const tr = Array.from(tbody.getElementsByTagName('tr')).slice(0, -1); // Exclude pagination row

            filteredRows = tr.filter(row => {
                let td = row.getElementsByTagName('td');
                return Array.from(td).some(cell => cell.innerHTML.toUpperCase().indexOf(filter) > -1);
            });

            currentPage = 1;
            displayTableRows();
        }
        function displayTableRows() {
            const table = document.getElementById('profileTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const tr = Array.from(tbody.getElementsByTagName('tr')).slice(0, -1); // Exclude pagination row

            const totalRows = filteredRows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            tr.forEach(row => row.style.display = 'none'); // Hide all rows

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            for (let i = start; i < end && i < totalRows; i++) {
                filteredRows[i].style.display = '';
            }

            document.getElementById('pageInfo').innerText = `Page ${currentPage} of ${totalPages}`;
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages;
        }
        function nextPage() {
            currentPage++;
            displayTableRows();
        }
        function prevPage() {
            currentPage--;
            displayTableRows();
        }
        function openModal() {
            document.getElementById("mapModal").style.display = "block";
        }
        function closeModal() {
            document.getElementById("mapModal").style.display = "none";
            $('.modal-backdrop').remove();
        }
        window.onload = function() {
            searchTable(); // Initialize table display
        };
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
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
        function setPropID(element){
            var propertyID = element.getAttribute('data-propertyID');

            document.getElementById('PropertyID').value = propertyID;
        }
    </script>    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="process/delete_property.php" method="post">
                        <input type="hidden" name="PropertyID" id="PropertyID" value="">
                        <h5>Are you sure you want to delete this property?</h5>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html> 