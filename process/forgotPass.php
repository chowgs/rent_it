<?php

	session_start();
  require_once("../config/constant.php");
  require_once("../config/db.php");
  require_once("./sendEmail.php");


    // Get the protocol (HTTP or HTTPS)
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    // Get the host (domain or IP)
    $host = $_SERVER['HTTP_HOST'];

    // Get the current directory
    $path = rtrim(dirname($_SERVER['SCRIPT_NAME'], 2), '/');

    // Combine to form the base URL
    $baseURL = $protocol . "://" . $host . $path;
	
	$loginUsername = '';
	
	if(isset($_POST['forgotPass'])){
		$loginUsername = $_POST['forgotPass'];
		
		if(!empty($loginUsername)){
			
			// Sanitize username
			$loginUsername = filter_var($loginUsername, FILTER_SANITIZE_STRING);

      echo $loginUsername;
			
			// Check the given credentials
			$checkUserSql = 'SELECT 
                        account.*, 
                        owner.*, 
                        COALESCE(owner.Email, account.Email) AS Email 
                        FROM account 
                        JOIN owner ON account.accountID = owner.accountID
                        WHERE account.UName = :loginUsername';
			$checkUserStatement = $conn->prepare($checkUserSql);
			$checkUserStatement->execute(['loginUsername' => $loginUsername]);
			
			// Check if user exists or not
			if($checkUserStatement->rowCount() > 0){
				// Valid credentials. Hence, start the session
				$row = $checkUserStatement->fetch(PDO::FETCH_ASSOC);

                if ($row['Status'] === 0) {
                  echo 'Warning: Your account is not yet activated!';
                  exit();
                }

                $emailRecipient = $row['Email'];

                $token = bin2hex(random_bytes(32));
                $expires = date("Y-m-d H:i:s", strtotime("+5 minutes"));

                $updateTokenSql = "UPDATE account SET ResetToken = :reset_token, ResetExpires = :reset_expires WHERE UName = :username";
                $updateTokenStatement = $conn->prepare($updateTokenSql);
                $updateTokenStatement->execute([
                    'reset_token' => $token,
                    'reset_expires' => $expires,
                    'username' => $loginUsername
                ]);

                
                $resetLink = $baseURL . "/process/changepass.php?token=" . $token;
				        echo 'Password reset link has been sent to your email' . $emailRecipient . '';
                forgotPassword($resetLink, $emailRecipient);
                
				exit();
			} else {
				// Redirect to login with error message in query parameter
				echo 'User not found</div>';
			}
		} else {
			echo 'Please enter your USERNAME or EMAIL in username field';
			exit();
		}
	}
?>