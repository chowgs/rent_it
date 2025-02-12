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
    <title>Rent IT - Chats</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="boarder-css/message.css">
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
        .minimized {
            position: fixed;
            bottom: 0;
            right: 20px;
            width: auto;
            height: 40px;
            color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px 4px 0 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: left;
        }

        .minimized span {
            flex-grow: 1;
        }

        .minimized .minimize-close {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            padding-left: 10px;
            padding-right: 10px;
            flex-grow: 0;
        }

        .minimized button {
            background: #f9f9f9;
            border: none;
            color: white;
            cursor: pointer;
            margin-right: auto;
            padding: 5px;
            padding-left: 10px;
            flex-grow: 1;
            text-align: left;
        }
        .minimized button:focus{
            outline: none;
        }
        #conversationContainer {
            display: none; /* Ensure it starts hidden */
        }

        .conversation-container {
            position: relative;
            background-color: #fcfcfc;
            max-width: 850px;
            width: 100%;
        }
        .convo{
            padding: 10px;
            width: 100%;
            height:calc(100vh - 226px);
            overflow-y: auto;
        }
        .chat-head {
            display: flex;
            justify-content: left;
            background-color: #f9f9f9 !important;
            border: 1px solid gainsboro;
        }
        .chat-head .minimize-close {
            background: #f9f9f9;
            border: none;
            color: black;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            padding-left: 10px;
            padding-right: 15px;
            flex-grow: 0;
        }
        .minimize-close:focus{
            outline: none;
        }
        .close-chatbox {
            background: #f9f9f9;    
            color: black;
            border: none;
            padding: 5px 15px;
            cursor: pointer;
            flex-grow: 1;
            margin-right: auto;
            text-align: center;
        }
        .close-chatbox:focus{
            outline: none;
        }

        .message {
            margin-bottom: 10px;
            padding: 0 15px;
            padding-top: 10px !important;
            border-radius: 20px;
            clear: both;
            max-width: 50%;
            word-wrap: break-word;
        }

        .message.sent {
            background-color: #3395ff; /* Light green for boarder's messages */
            float: right;
            color: white;
            letter-spacing: 2px;
            font-size: 14px;
        }

        .message.received {
            background-color: #e7e7e7; /* Light grey for owner's messages */
            float: left;
            letter-spacing: 2px;
            font-size: 14px;
        }

        .message-form {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid gainsboro;
        }

        .message-form .txt {
            width: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }

        .message-form textarea {
            width: calc(100% - 50px); /* Adjust this value to leave space for the button */
            height: 60px; /* Adjust as needed */
            padding: 10px;
            border: none;
            resize: none;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .message-form textarea:focus{
            outline: none;
        }
 
        .message-form button {
            width: 50px; /* Adjust as needed */
            height: 60px; 
            border: none !important;
            background-color: white;
            color: #007bff;
            font-size: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .convo-cont{
            height: calc(100vh - 130px);
        }

        .list-cont{
            background-color: white;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 15px;
            padding-right: 15px;
            margin-bottom: 20px;
            height: calc(100vh - 130px);
            overflow: auto;
        }
        .noName{
            padding: 5px 15px;
            user-select: none;
        }
        .receiverName{
            padding: 5px 15px;
            user-select: none;
        }
        .receiverName:hover{
            background-color: rgb(230, 230, 230);
            cursor: pointer;
        }
        .message-date {

            color: #666;
            font-size: 14px;
            font-weight: bold;
            padding: 5px 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            clear: both;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .message-timestamp{
            font-size: 10px;
            margin-top: -10px !important;
            text-align: center;
        }
        .convo::-webkit-scrollbar {
            width: 12px; 
        }
        
        /* Handle on hover */
        .convo::-webkit-scrollbar-thumb:hover {
            background: lightgray; 
        }
        
        /* Handle */
        .convo::-webkit-scrollbar-thumb {
            background: #E6E6E6; 
        }
        
        /* Track */
        .convo::-webkit-scrollbar-track {
            background: #f6f6f9; 
        }
        .seen-status{
            color: #666;
            font-size: 10px;
            font-weight: bold;
            padding: 0 10px;
            border-radius: 5px;
            margin-left: auto;
            clear: both;
            width: 15%;
            display: flex;
            justify-content: right;
            user-select: none;
        }
        #receiverList {
            position: relative;
        }

        #userList {
            display: none;
            position: absolute;
            top: 50px; /* Adjust this value to position the dropdown correctly */
            width: 91.5%;
            max-height: 200px; /* Adjust the height as needed */
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: #fff;
            z-index: 1000;
        }
        #userList::-webkit-scrollbar {
            width: 12px; 
        }
        
        /* Handle on hover */
        #userList::-webkit-scrollbar-thumb:hover {
            background: lightgray; 
        }
        
        /* Handle */
        #userList::-webkit-scrollbar-thumb {
            background: #E6E6E6; 
        }
        
        /* Track */
        #userList::-webkit-scrollbar-track {
            background: #f6f6f9; 
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
                <div class="dashboard-form" style="height: calc(100vh - 100px) !important;">
                <h6 class="sub-dash" style="font-weight: 600;">Dashboard / <span style="font-weight: 100;">Chats</span></h6>
                    <div class="row">

                        <div class="col-md-12">
                        <?php
                            if (isset($_SESSION['AccountID'])) {
                                $accountID = $_SESSION['AccountID'];

                                // Function to get full name based on AccountID
                                function getFullName($conn, $accountID, $table) {
                                    $query = "SELECT FullName FROM $table WHERE AccountID = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("s", $accountID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $stmt->close();
                                    return $row['FullName'];
                                }

                                // Function to get receiver's full name based on AccountID and account type
                                function getReceiverFullName($conn, $receiverID) {
                                    // Get the account type
                                    $query = "SELECT AccType FROM account WHERE AccountID = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("s", $receiverID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_assoc();
                                    $accountType = $row['AccType'];
                                    $stmt->close();
                                    
                                    // Determine the table to fetch full name from based on account type
                                    if ($accountType == 'Owner') {
                                        $table = 'owner';
                                    } elseif ($accountType == 'Boarder') {
                                        $table = 'boarder';
                                    } else {
                                        $table = 'admin';
                                    }
                                    return getFullName($conn, $receiverID, $table);
                                }

                                // Function to get all users
                                function getAllUsers($conn, $accountID) {
                                    $users = [];
                                
                                    // Fetch admins excluding current user
                                    $query = "SELECT AccountID, FullName FROM admin WHERE AccountID != ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("s", $accountID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $users[] = ['AccountID' => $row['AccountID'], 'FullName' => $row['FullName'], 'AccType' => 'Admin'];
                                    }
                                
                                    // Fetch owners excluding current user
                                    $query = "SELECT AccountID, FullName FROM owner WHERE AccountID != ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("s", $accountID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $users[] = ['AccountID' => $row['AccountID'], 'FullName' => $row['FullName'], 'AccType' => 'Owner'];
                                    }
                                
                                    // Fetch boarders excluding current user
                                    $query = "SELECT AccountID, FullName FROM boarder WHERE AccountID != ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("s", $accountID);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $users[] = ['AccountID' => $row['AccountID'], 'FullName' => $row['FullName'], 'AccType' => 'Boarder'];
                                    }
                                
                                    return $users;
                                }
                                
                                // Get all users
                                $allUsers = getAllUsers($conn, $accountID);

                                // Fetch sender's full name
                                $senderFullName = getFullName($conn, $accountID, 'boarder');

                                    // Fetch unique user IDs based on sent and received messages
                                    $query = "SELECT DISTINCT userID, Seen AS Seen 
                                    FROM (
                                        SELECT SenderID AS userID, Seen, Timestamp FROM messages WHERE ReceiverID = ?
                                        UNION
                                        SELECT ReceiverID AS userID, Seen, Timestamp FROM messages WHERE SenderID = ?
                                    ) AS combined_messages
                                    GROUP BY userID
                                    ORDER BY Timestamp DESC";
                          

                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("ss", $accountID, $accountID);
                                $stmt->execute();
                                $result = $stmt->get_result();

                            } else {
                                echo '<p>Session not active or not set.</p>';
                            }
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 lists">
                                    <div id="receiverList" class="list-cont">
                                        <div class="search-container">
                                            <ion-icon class="search-icon" name="search"></ion-icon>
                                            <input placeholder="Search"type="text" class="search" id="searchInput" onkeyup="searchFunction()">
                                        </div>
                                        <div id="userList" class="dropdown-content">
                                            <?php
                                            foreach ($allUsers as $user) {
                                                echo '<div class="receiverName" data-receiver-id="' . htmlspecialchars($user['AccountID']) . '" data-receiver-name="' . htmlspecialchars($user['FullName']) . '">' . htmlspecialchars($user['FullName']) . '</div>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $senderID = $row['userID'];
                                                $senderFullName = getReceiverFullName($conn, $senderID);
                                                $check_sql = "SELECT COUNT(*) FROM messages WHERE ReceiverID = '$accountID' AND SenderID = '$senderID' AND Seen = 0";
                                                $check_result = $conn->query($check_sql);
                                                $row = $check_result->fetch_row();
                                                $unreadd = $row[0];

                                                if ($unreadd > 0) {
                                                    $color = 'gainsboro';
                                                    $unread = $unreadd;
                                                    $bg = '#ff0000ad';
                                                } else {
                                                    $color = 'white';
                                                    $unread = "";
                                                    $bg = 'none';
                                                }

                                                $senderFullName = getReceiverFullName($conn, $senderID);
                                                echo '<div class="receiverName" style="background-color: '.$color.'; display: flex; justify-content: space-between; align-items: center;" data-receiver-id="' . $senderID . '" data-receiver-name="' . htmlspecialchars($senderFullName) . '">' . htmlspecialchars($senderFullName) . ' <span class="unread" style=" background-color: '.$bg.'; padding: 5px; font-size: 12px; border-radius: 40%;">' . $unread . '</span></div>';
                                            }
                                        } else {
                                            echo '<div class="noName">No messages yet.</div>';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-md-8 convo-cont">

                                    <!-- Container for conversation -->
                                    <div id="minimizedChatbox" class="minimized" style="display:none;">
                                        <button id="restoreChatbox"><span id="minimizedReceiverName"></span></button>
                                        <button class="closeMinimizedChatbox minimize-close">X</button>
                                    </div>
                                    <!-- Container for conversation -->
                                    <div id="conversationContainer" class="conversation-container" style="display:none;">
                                        <div class="chat-head">
                                            <button id="closeChatbox" class="close-chatbox" style="display:none;"></button>
                                            <button class="closeMinimizedChatbox minimize-close">X</button>
                                        </div>
                                        <div>
                                            <div class="convo" id="conversationContent">
                                                <!-- Conversation content will be loaded dynamically here -->
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- Form to send message -->
                                    <form id="messageForm" class="message-form" style="display:none;">
                                        <input type="hidden" id="receiverID" name="receiverID" value="">
                                        <div class="txt">
                                            <textarea id="messageText" name="message" placeholder="Type your message here..." required></textarea>
                                            <button type="submit"><ion-icon class="send" name="send"></ion-icon></button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.receiverName').forEach(function(element) {
                element.addEventListener('click', function() {
                    // Change background color to white
                    this.style.backgroundColor = 'white';
                    
                    // Find the unread span and clear the unread count and background color
                    var unreadSpan = this.querySelector('.unread');
                    if (unreadSpan) {
                        unreadSpan.style.backgroundColor = 'transparent';
                        unreadSpan.textContent = '';
                    }
                });
            });
        });
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
            var receiverNames = document.getElementsByClassName('receiverName');
        
            for (var i = 0; i < receiverNames.length; i++) {
                receiverNames[i].addEventListener('click', function() {
                    // Remove the dot from clicked receiverName
                    this.classList.remove('unseen');
                    
                    // You may add additional logic here to mark the message as seen in the database
                    // For example, send an AJAX request to update Seen status
                    var receiverID = this.getAttribute('data-receiver-id');
                    fetchMessages(); // Assuming you have a function to handle this
                });
            }
            function fetchMessages() {
                var receiverID = $('#receiverID').val();
                console.log('Fetching messages for receiver ID:', receiverID);
                if (receiverID) {
                    $.ajax({
                        url: 'process/fetch_message.php',
                        type: 'POST',
                        data: { receiverID: receiverID },
                        success: function(response) {
                            var receiverName = $('.receiverName[data-receiver-id="' + receiverID + '"]').data('receiver-name');
                            $('#closeChatbox').text(receiverName);
                            var conversationContent = $('#conversationContent');
                            var previousHeight = conversationContent[0].scrollHeight;
                            conversationContent.html(response);
                            var newHeight = conversationContent[0].scrollHeight;

                            // Scroll to bottom only if new messages are added
                            if (newHeight > previousHeight) {
                                scrollToBottom();
                            }
                        
                        },
                        error: function() {
                            alert('Error fetching conversation.');
                        }
                    });
                }
            }
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

            function scrollToBottom() {
                var conversationContent = $('#conversationContent');
                conversationContent.scrollTop(conversationContent[0].scrollHeight);
            }

            function fetchMessages() {
                var receiverID = $('#receiverID').val();
                console.log('Fetching messages for receiver ID:', receiverID);
                if (receiverID) {
                    $.ajax({
                        url: 'process/fetch_message.php',
                        type: 'POST',
                        data: { receiverID: receiverID },
                        success: function(response) {
                            var receiverName = $('.receiverName[data-receiver-id="' + receiverID + '"]').data('receiver-name');
                            $('#closeChatbox').text(receiverName);
                            var conversationContent = $('#conversationContent');
                            var previousHeight = conversationContent[0].scrollHeight;
                            conversationContent.html(response);
                            var newHeight = conversationContent[0].scrollHeight;

                            // Scroll to bottom only if new messages are added
                            if (newHeight > previousHeight) {
                                scrollToBottom();
                            }
                        
                        },
                        error: function() {
                            alert('Error fetching conversation.');
                        }
                    });
                }
            }

            // Fetch messages every 1 second
            setInterval(fetchMessages, 1000);

            $('#receiverList').on('click', '.receiverName', function() {
                var receiverID = $(this).data('receiver-id');
                var receiverName = $(this).data('receiver-name');

                $('#receiverID').val(receiverID);
                // Fetch messages immediately when a receiver is selected
                fetchMessages();
                
                $('#conversationContainer').show();
                $('#closeChatbox').show();
                $('#messageForm').show();
                $('#minimizedChatbox').hide();
            });

            $('#messageForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: 'process/new_message.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $('#messageText').val(''); // Clear message input
                            fetchMessages(); // Fetch messages immediately after sending a new one
                        } else {
                            alert(response);
                        }
                    },
                    error: function() {
                        alert('Error sending message.');
                    }
                });
            });

            $('#closeChatbox').click(function() {
                $('#minimizedChatbox').hide();
                $('#conversationContainer').hide();
                $('#messageForm').hide();
                $('#minimizedReceiverName').text('');
            });

            $('#restoreChatbox').click(function() {
                $('#minimizedChatbox').hide();
                $('#conversationContainer').show();
                $('#messageForm').show();
                scrollToBottom();
            });

            $('.closeMinimizedChatbox').click(function() {
                $('#minimizedChatbox').hide();
                $('#conversationContainer').hide();
                $('#messageForm').hide();
                $('#minimizedReceiverName').text('');
            });
        });
        document.addEventListener('click', function(event) {
            var userList = document.getElementById('userList');
            var searchInput = document.getElementById('searchInput');

            // Check if the click is outside the userList and searchInput
            if (!userList.contains(event.target) && event.target !== searchInput) {
                userList.style.display = 'none';

                // Optionally, clear the search input when clicking outside
                searchInput.value = '';

                // Reset the list to show all users
                var users = userList.getElementsByClassName('receiverName');
                for (var i = 0; i < users.length; i++) {
                    users[i].style.display = '';
                }

                var noNameDiv = userList.querySelector('.noName');
                if (noNameDiv) {
                    noNameDiv.remove();
                }
            }
        });
        function searchFunction() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var userList = document.getElementById('userList');
            var users = userList.getElementsByClassName('receiverName');

            // Show the dropdown when there is input, hide it when input is empty
            if (filter.length > 0) {
                userList.style.display = 'block';

                // Loop through all user names and hide those that don't match the search query
                var matchFound = false;
                for (var i = 0; i < users.length; i++) {
                    var name = users[i].getAttribute('data-receiver-name');
                    if (name.toLowerCase().indexOf(filter) > -1) {
                        users[i].style.display = '';
                        matchFound = true;
                    } else {
                        users[i].style.display = 'none';
                    }
                }

                // If no matches found, display a message
                if (!matchFound) {
                    var noMatchDiv = document.createElement('div');
                    noMatchDiv.className = 'noName';
                    noMatchDiv.textContent = 'No matches found.';
                    userList.appendChild(noMatchDiv);
                } else {
                    var noNameDiv = userList.querySelector('.noName');
                    if (noNameDiv) {
                        noNameDiv.remove();
                    }
                }
            } else {
                userList.style.display = 'none';
                // Reset the list to show all users when input is cleared
                for (var i = 0; i < users.length; i++) {
                    users[i].style.display = '';
                }
                var noNameDiv = userList.querySelector('.noName');
                if (noNameDiv) {
                    noNameDiv.remove();
                }
            }
        }
        $(document).ready(function() {

            $('#messageText').on('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    $('#messageForm').submit();
                }
            });

            $('#messageForm').on('submit', function(e) {
                e.preventDefault();
                // Your form submission logic here
                console.log('Message sent: ' + $('#messageText').val());
                // Clear the textarea after submission
                $('#messageText').val('');
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