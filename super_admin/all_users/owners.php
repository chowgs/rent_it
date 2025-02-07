<?php
session_start();
require_once("../../config/connect.php");
if(!isset($_SESSION["AccountID"])){
    header("location:../../index.php");

 } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../images/logo.png" />
    <title>Rent IT - Owners</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sa-css/all_user.css">
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
            <img src="../../images/logo.png" alt="Rent IT" height="50" style="margin-right: 30px; border-radius: 25px;">
        
        <div class="nav-links">
            <a href="../landing_page.php">Home</a>
            <a href="../about.php">About</a>
            <a href="../contact.php">Contact Us</a>
        </div>
    </div>
        <button class="burger-drop" onclick="toggleMenu()">☰</button>
        <a class="login-btn" href="#" data-toggle="modal" data-target="#myModal">Logout</a>
    </div>
    <div class="dropdown-menu">
        <a href="../landing_page.php">Home</a>
        <a href="../about.php">About</a>
        <a href="../contact.php">Contact Us</a>
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
                    <a href="../dashboard.php" class="sub2">
                        <div class="group"><ion-icon name="home-sharp"></ion-icon> Dashboard</div>
                    </a><br>

                    <a href="../profile.php" class="sub2" id="profileLink">
                        <div class="group"><ion-icon name="person"></ion-icon> Profile</div>   
                    </a><br>

                    <a href="../message.php" class="sub2" id="queryLink">
                        <div class="group"><ion-icon name="chatbox-ellipses"></ion-icon> Chats</div>  
                    </a><br>

                    <a href="#" class="sub" id="allUsersLink">
                        <div class="group"><ion-icon name="person-sharp"></ion-icon> All Users</div>
                        <ion-icon name="chevron-forward-sharp" class="arrow-icon"></ion-icon>
                    </a>
                    <div id="userDropdown" style="display: none; margin-top: 10px;">
                        <a class="d-item" href="admin.php">Admin</a><br>
                        <a class="d-item" href="boarders.php">Boarders</a><br>
                        <a class="d-item" href="owners.php">Owners</a><br>
                        <a class="d-item" href="pending.php">Pending</a>
                    </div><br>

                    <a href="../property.php" class="sub2" id="propertyLink">
                        <div class="group"><ion-icon name="newspaper"></ion-icon> Property</div>  
                    </a><br>

                </aside>
                <div class="dashboard-form">
                    <h6 class="sub-dash" style="font-weight: 600;">Dashboard / <span style="font-weight: 100;">Owner</span></h6>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="dash-box">
                                <table id="ownerTable">
                                    <thead>
                                        <tr>
                                            <th colspan="6">Owner List</th>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        require_once("../../config/connect.php");

                                        $sql = "SELECT owner.*, account.status AS Status 
                                        FROM owner 
                                        LEFT JOIN account ON owner.AccountID = account.AccountID
                                        WHERE Approval = 'Approved'";                                

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {

                                                echo '<tr>';
                                                echo "<td>" . $row["OwnerID"] . "</td>";
                                                echo "<td>" . $row["FullName"] . "</td>";
                                                echo "<td>" . $row["ContNum"] . "</td>";
                                                echo "<td>" . $row["Email"] . "</td>";
                                                echo "<td>" . $row["Address"] . "</td>"; 

                                                if($row["Status"] == "0"){
                                                    echo '<td><button class="btn btn-success" data-OwnerID="' . $row["OwnerID"] . '" onclick="setOwnerID(this)" data-toggle="modal" data-target="#enable">Enable</button></td>';
                                                }else{
                                                    echo '<td><button class="btn btn-danger" data-ownerID="' . $row["OwnerID"] . '" onclick="setOwnerId(this)" data-toggle="modal" data-target="#disable">Disable</button></td>';
                                                }
                                                
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No records found</td></tr>";
                                        }

                                        $conn->close();
                                    ?>
                                    <tr class="page-tr"> 
                                        <td colspan="6">
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

        let currentPage = 1;
        const rowsPerPage = 4;
        let filteredRows = [];

        function displayTableRows() {
            const table = document.getElementById('ownerTable');
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

        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('ownerTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const tr = Array.from(tbody.getElementsByTagName('tr')).slice(0, -1); // Exclude pagination row

            filteredRows = tr.filter(row => {
                let td = row.getElementsByTagName('td');
                return Array.from(td).some(cell => cell.innerHTML.toUpperCase().indexOf(filter) > -1);
            });

            currentPage = 1;
            displayTableRows();
        }
        window.onload = function() {
            searchTable(); // Initialize table display
        };

        function setOwnerID(element){
            var ownerID = element.getAttribute('data-OwnerID');

            document.getElementById('ownerId').value = ownerID;
        }

        function setOwnerId(element) {
            var ownerId = element.getAttribute('data-ownerID');

            document.getElementById('ownerIdInput').value = ownerId;
        }
    </script>
    
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

    <div class="modal fade" id="enable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../process/enable_owner.php" method="post">
                        <input type="hidden" name="owner_id" id="ownerId" value="">
                        <h5>Are you sure you want to enable this account?</h5>
                        <div class="button-container">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="disable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../process/disable_owner.php" method="post">
                        <input type="hidden" name="owner_id" id="ownerIdInput" value="">
                        <h5>Are you sure you want to disable this account?</h5>
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