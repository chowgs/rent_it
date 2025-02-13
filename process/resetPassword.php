<?php
	require_once("../config/constant.php");
  require_once("../config/db.php");
	
	$resetPasswordPassword1 = '';
	$resetPasswordPassword2 = '';
	$hashedPassword = '';

	if (isset($_POST['userDetailsUserPassword1'])) {
		$resetPasswordPassword1 = htmlentities($_POST['userDetailsUserPassword1']);
		$resetPasswordPassword2 = htmlentities($_POST['userDetailsUserPassword2']);
		$changePassUserDetailsUserID = htmlentities($_POST['userDetailsUserID']);

		if (!empty($resetPasswordPassword1) && !empty($resetPasswordPassword2)) {

			if (empty($resetPasswordPassword1)) {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Old password cannot be empty!</div>';
				exit();
			} 
			
			if (empty($resetPasswordPassword2)) {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>New password cannot be empty!</div>';
				exit();
			} 

			// Encrypt the password
			$hashedPassword = password_hash($resetPasswordPassword1, PASSWORD_BCRYPT);
			
			// Check the given credentials
			$checkUserSql = 'SELECT * FROM account WHERE AccountID = :userID AND PWord = :password';
			$checkUserStatement = $conn->prepare($checkUserSql);
			$checkUserStatement->execute(['userID' => $changePassUserDetailsUserID, 'password' => $hashedPassword]);
			
			if ($checkUserStatement->rowCount() > 0) {
				$row = $checkUserStatement->fetch(PDO::FETCH_ASSOC);

				// Start UPDATING password to DB
				// Encrypt the password
				$hashedPassword2 = password_hash($resetPasswordPassword2, PASSWORD_BCRYPT);

				$updatePasswordSql = 'UPDATE account SET PWord = :password WHERE AccountID = :userID';
				$updatePasswordStatement = $conn->prepare($updatePasswordSql);
				$updatePasswordStatement->execute(['password' => $hashedPassword2, 'userID' => $changePassUserDetailsUserID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Password changed Successfully!</div>';
				exit();
				
			} else {
				// Incorrect Current Password
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Incorrect Old Password!</div>';
				exit();
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Old password and new password cannot be empty!</div>';
			exit();
		}
	}
	
	if(isset($_POST['changePassword1'])){
		$resetPasswordPassword1 = htmlentities($_POST['changePassword1']);
		$resetPasswordPassword2 = htmlentities($_POST['changePassword2']);
		$changePassUserDetailsUserID = htmlentities($_POST['changePassUserDetailsUserID']);
		
		if (!empty($resetPasswordPassword1) && !empty($resetPasswordPassword2)) {

			if ($resetPasswordPassword1 !== $resetPasswordPassword2) {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Password does not match!</div>';
				exit();
			} else {

				$hashedPassword = password_hash($resetPasswordPassword1, PASSWORD_BCRYPT);
				$updatePasswordSql = 'UPDATE account SET PWord = :password WHERE AccountID = :userID';
				$updatePasswordStatement = $conn->prepare($updatePasswordSql);
				$updatePasswordStatement->execute([
					'password' => $hashedPassword, 
					'userID' => $changePassUserDetailsUserID
				]);

				$updateTokenExpireSQL = 'UPDATE account set ResetExpires = :reset_expires, ResetToken = :reset_token WHERE accountID = :userID';
				$updateTokenExpireStatement = $conn->prepare($updateTokenExpireSQL);
				$updateTokenExpireStatement->execute([
					'reset_expires' => null,
					'reset_token' => null,
					'userID' => $changePassUserDetailsUserID
				]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Password reset complete. Please login using your new password.</div>';
				exit();
			}
			
		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Enter all fields</div>';
			exit();
		}
	}
?>