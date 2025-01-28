<?php

require_once("../../config/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin ID is provided
    if (isset($_POST["admin_id"]) && !empty($_POST["admin_id"])) {
        // Sanitize and validate input
        $admin_id = $_POST["admin_id"];

        // Include database connection
        require_once("../../config/connect.php");

        // Prepare and execute SQL statement to retrieve account ID based on admin ID
        $sql = "SELECT AccountID FROM admin WHERE AdminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Account ID retrieved successfully
            $row = $result->fetch_assoc();
            $account_id = $row["AccountID"];

            // Prepare and execute SQL statement to update account status
            $sql_update = "UPDATE account SET Status = '0' WHERE AccountID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $account_id);

            if ($stmt_update->execute()) {
                // Account status updated successfully
                header("Location: ../all_users/admin.php");
                exit();
            } else {
                // Error updating account status
                header("Location: ../all_users/admin.php");
                exit();
            }

            // Close statement for updating account status
            $stmt_update->close();
        } else {
            // No account found for the given admin ID
            header("Location: ../all_users/admin.php");
            exit();
        }

        // Close statement and database connection for retrieving account ID
        $stmt->close();
        $conn->close();
    } else {
        // Admin ID not provided
        header("Location: ../all_users/admin.php");
        exit();
    }
} else {
    // Redirect to appropriate page if accessed directly
    header("Location: ../index.php");
    exit();
}
?>
<?php

require_once("../../config/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin ID is provided
    if (isset($_POST["admin_id"]) && !empty($_POST["admin_id"])) {
        // Sanitize and validate input
        $admin_id = $_POST["admin_id"];

        // Include database connection
        require_once("../../config/connect.php");

        // Prepare and execute SQL statement to retrieve account ID based on admin ID
        $sql = "SELECT AccountID FROM admin WHERE AdminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Account ID retrieved successfully
            $row = $result->fetch_assoc();
            $account_id = $row["AccountID"];

            // Prepare and execute SQL statement to update account status
            $sql_update = "UPDATE account SET Status = '0' WHERE AccountID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $account_id);

            if ($stmt_update->execute()) {
                // Account status updated successfully
                header("Location: ../all_users/admin.php");
                exit();
            } else {
                // Error updating account status
                header("Location: ../all_users/admin.php");
                exit();
            }

            // Close statement for updating account status
            $stmt_update->close();
        } else {
            // No account found for the given admin ID
            header("Location: ../all_users/admin.php");
            exit();
        }

        // Close statement and database connection for retrieving account ID
        $stmt->close();
        $conn->close();
    } else {
        // Admin ID not provided
        header("Location: ../all_users/admin.php");
        exit();
    }
} else {
    // Redirect to appropriate page if accessed directly
    header("Location: ../index.php");
    exit();
}
?>
<?php

require_once("../../config/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin ID is provided
    if (isset($_POST["admin_id"]) && !empty($_POST["admin_id"])) {
        // Sanitize and validate input
        $admin_id = $_POST["admin_id"];

        // Include database connection
        require_once("../../config/connect.php");

        // Prepare and execute SQL statement to retrieve account ID based on admin ID
        $sql = "SELECT AccountID FROM admin WHERE AdminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Account ID retrieved successfully
            $row = $result->fetch_assoc();
            $account_id = $row["AccountID"];

            // Prepare and execute SQL statement to update account status
            $sql_update = "UPDATE account SET Status = '0' WHERE AccountID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $account_id);

            if ($stmt_update->execute()) {
                // Account status updated successfully
                header("Location: ../all_users/admin.php");
                exit();
            } else {
                // Error updating account status
                header("Location: ../all_users/admin.php");
                exit();
            }

            // Close statement for updating account status
            $stmt_update->close();
        } else {
            // No account found for the given admin ID
            header("Location: ../all_users/admin.php");
            exit();
        }

        // Close statement and database connection for retrieving account ID
        $stmt->close();
        $conn->close();
    } else {
        // Admin ID not provided
        header("Location: ../all_users/admin.php");
        exit();
    }
} else {
    // Redirect to appropriate page if accessed directly
    header("Location: ../index.php");
    exit();
}
?>
<?php

require_once("../../config/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if admin ID is provided
    if (isset($_POST["admin_id"]) && !empty($_POST["admin_id"])) {
        // Sanitize and validate input
        $admin_id = $_POST["admin_id"];

        // Include database connection
        require_once("../../config/connect.php");

        // Prepare and execute SQL statement to retrieve account ID based on admin ID
        $sql = "SELECT AccountID FROM admin WHERE AdminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Account ID retrieved successfully
            $row = $result->fetch_assoc();
            $account_id = $row["AccountID"];

            // Prepare and execute SQL statement to update account status
            $sql_update = "UPDATE account SET Status = '0' WHERE AccountID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("s", $account_id);

            if ($stmt_update->execute()) {
                // Account status updated successfully
                header("Location: ../all_users/admin.php");
                exit();
            } else {
                // Error updating account status
                header("Location: ../all_users/admin.php");
                exit();
            }

            // Close statement for updating account status
            $stmt_update->close();
        } else {
            // No account found for the given admin ID
            header("Location: ../all_users/admin.php");
            exit();
        }

        // Close statement and database connection for retrieving account ID
        $stmt->close();
        $conn->close();
    } else {
        // Admin ID not provided
        header("Location: ../all_users/admin.php");
        exit();
    }
} else {
    // Redirect to appropriate page if accessed directly
    header("Location: ../index.php");
    exit();
}
?>
