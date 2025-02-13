<?php
    require_once('../config/constant.php');
    require_once('../config/db.php');
    $token = $_GET['token'];

    $getUserSQL = 'SELECT * FROM account where ResetToken = :reset_token LIMIT 1';
    $getUserStatement = $conn->prepare($getUserSQL);
    $getUserStatement->execute(['reset_token' => $token]);

    $row = $getUserStatement->fetch(PDO::FETCH_ASSOC);

    if ($row <= 0) {
        $userID = $row['AccountID'] ?? 'No user';
    } else {
        $userID = $row['AccountID'];
    }

    $checkTokenExpireSQL = "SELECT * FROM account WHERE ResetToken = :reset_token AND ResetExpires > NOW()";
    $checkTokenExpireStatement = $conn->prepare($checkTokenExpireSQL);
    $checkTokenExpireStatement->execute([
        'reset_token' => $token
    ]);

    // Check if there is a valid token
    if ($checkTokenExpireStatement->rowCount() <= 0) {
        // Token is invalid or expired
        // Redirect to a custom "Token Expired" page
        header("Location: 404.html");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="../vendor/bootstrap/css/cerulean.theme.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- MATERIAL CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <title>Rent IT Change Password</title>
</head>

<body>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Change Password</h3>
            <p class="text-muted">Change password for <?php echo ucwords($row['UName'] ?? "") . "<small>" . " (ID: " . "<span id='userID'>"  . $userID . "</span>" . ")" . "</small>"; ?></p>
        </div>

        <div class="container d-flex justify-content-center">
            <form method="POST" style="width:55vw; min-width:300px;">
                <div id="changePass"></div>
                <div class="row">
                    <div class="col mt-2">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="userDetailsUserPassword1" id="userDetailsUserPassword1">
                    </div>
                    <div class="col mt-2">
                        <label class="form-label">Retype New Password</label>
                        <input type="password" class="form-control" name="userDetailsUserPassword2" id="userDetailsUserPassword2">
                    </div>
                <div>
                <br>
                <input type="button" id="changePassBtn" value="Change Password" class="btn btn-primary">
            </form>
        </div>

    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>           
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        // Listen to reset password button
        $('#changePassBtn').on('click', function(){
          changePass();
        });
      });
      function changePass() {
        var userDetailsUserPassword1 = $('#userDetailsUserPassword1').val();
        var userDetailsUserPassword2 = $('#userDetailsUserPassword2').val();
        var userDetailsUserID = $('#userID').text();

        console.log(userDetailsUserPassword1);
        console.log(userDetailsUserPassword2);
        console.log(userDetailsUserID);

        $.ajax({
          url: '../process/resetPassword.php',
          method: 'POST',
          data: {
            changePassword1: userDetailsUserPassword1,
            changePassword2: userDetailsUserPassword2,
            changePassUserDetailsUserID: userDetailsUserID
          },
          success: function(data) {
            console.log('AJAX Response:', data); // Log the response
            // Check for a success message from the server
                  if (data.includes("Password reset complete")) {
                      // Replace form with a success message
                      $('form').html(`
                          <div class="alert alert-success">
                              Password Changed Successfully! You can now Sign In using your new password.
                          </div>
                <br>
                <div class="text-center">
                  <a style="padding: .5rem 2rem; text-transform: uppercase" href="../index.php" class="btn btn-theme">Sign In</a>
                </div>
                      `);
                  } else {
                      // Display error messages
                      $('#changePass').html(data).fadeIn();
                      setTimeout(function() {
                          $('#changePass').fadeOut();
                      }, 2000);
                  }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error: ', textStatus, errorThrown); // Log any errors
          }
        });
      }
    </script>    
</body>

</html>