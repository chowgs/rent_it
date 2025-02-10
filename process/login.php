<?php
session_start();

if (isset($_POST["login"])) {
    require_once("../config/connect.php");

    // Sanitize user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user by username
    $query = "SELECT * FROM account WHERE UName = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing the statement.");
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['PWord'];

        // Verify the password
        if (password_verify($password, $storedHashedPassword)) {
            // Password is correct, check account type and status
            if ($row['AccType'] == "Super_Admin") {
                if ($row['Status'] == 1) {
                    $_SESSION["AccountID"] = $row['AccountID'];
                    $_SESSION["Type"] = "Admin";
                    $_SESSION['success_message'] = "Login successful!";
                    $_SESSION['loggedIn'] = 1;
                    header("Location: ../super_admin/dashboard.php");  //should be directed to dashboard
                    exit;
                } else {
                    $_SESSION['error_message'] = "Your account is not active. Please contact the administrator.";
                    header("Location: ../login_page.php");
                    exit;
                }

            } elseif ($row['AccType'] == "Admin") {
                if ($row['Status'] == 1) {
                    $_SESSION["AccountID"] = $row['AccountID'];
                    $_SESSION["Type"] = "Admin";
                    $_SESSION['success_message'] = "Login successful!";
                    header("Location: ../super_admin/dashboard.php"); //should be directed to dashboard
                    exit;
                } else {
                    $_SESSION['error_message'] = "Your account is not active. Please contact the administrator.";
                    header("Location: ../login_page.php");
                    exit;
                }

            } elseif ($row['AccType'] == "Owner") {
                if ($row['Approval'] == "Approved") {
                    if ($row['Status'] == 1) {
                        $_SESSION["AccountID"] = $row['AccountID'];
                        $_SESSION["Type"] = "Owner";
                        $_SESSION['success_message'] = "Login successful!";
                        header("Location: ../owner/dashboard.php");
                        exit;
                    } else {
                        $_SESSION['error_message'] = "Your account is not active. Please contact the administrator.";
                        header("Location: ../login_page.php");
                        exit;
                    }

                } else {
                    $_SESSION['error_message'] = "Your account is not approved yet. Please contact the administrator.";
                    header("Location: ../login_page.php");
                    exit;
                }
            } elseif ($row['AccType'] == "Boarder") {
                if ($row['Status'] == 1) {
                    $_SESSION["AccountID"] = $row['AccountID'];
                    $_SESSION["Type"] = "Boarder";
                    $_SESSION['success_message'] = "Login successful!";
                    header("Location: ../boarder/dashboard.php");
                    exit;
                } else {
                    $_SESSION['error_message'] = "Your account is not active. Please contact the administrator.";
                    header("Location: ../login_page.php");
                    exit;
                }
            }
        } else {
            // Invalid password
            $_SESSION['error_message'] = "Invalid username or password. Please try again.";
            header("Location: ../login_page.php");
            exit;
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "Invalid username or password. Please try again.";
        header("Location: ../login_page.php");
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
