<?php require("../path.php"); 
      include(ROOT_PATH . "/application/controllers/users.php");

      /*if(isset($_GET['pass_token'])){
        $passwordToken = $_GET['token'];
        resetPass($passwordToken);
      }*/
      /*$check = '';
      if(isset($_GET['token'])){
        $token = $_GET['token'];
        $check = selectOne('users', ['token' => $token]);
        if($check !== ''){
            $_SESSION['token'] = $token;
            $_SESSION['message'] = "You are now authorized. Proceed to reset your password!";
            $_SESSION['type'] = 'success';
        } else {
            $_SESSION['message'] = "You are not authorized!";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . '/index.php');
            exit();
        }

      } else {
        $_SESSION['message'] = "You are not authorized!";
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . '/index.php');
        exit();
      }*/

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Reset | Rastot Insight</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="../css/all.css" />
    <!--Custom Styles-->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500&family=Raleway&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap"
      rel="stylesheet"
    />
  </head>

  <body class="special">
    <!-- Include Header-->
    <?php include(ROOT_PATH . "/application/includes/header2.php"); ?>
    <main>
      <div class="reg-content">
      <?php include(ROOT_PATH . "/application/includes/messages.php"); ?>
        <form action="resetPassword.php" method="post">
          <h2 class="form-title">Reset Your Password</h2>
          <?php include(ROOT_PATH . "/application/assist/formerrors.php"); ?>
          <div>
          <div>
            <label>Set New Password</label>
            <p class="constraint">(Minimum 12 chars long with atleast 1 capital letter, 1 number and 1 special char)</p>
            <input
              type="password"
              name="pass"
              class="text-input"
              value="<?php echo $pass; ?>"
              placeholder="Set password..."
            />
          </div>
          <div>
            <label>Confirm New Password</label>
            <input
              type="password"
              name="passConfirm"
              class="text-input"
              value="<?php echo $passConfirm; ?>"
              placeholder="Rewrite the password..."
            />
          </div>
          <div>
            <button type="submit" class="btn btn-big" name="reset-btn">
              Reset Password
            </button>
          </div>
        </form>
      </div>
    </main>
    <!--//Main Content-->

    <!--Footer-->
    
    <!--//Footer-->

    <!-- Jquery-->
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"
    ></script>
    <!--Custom Javascript-->
    <script src="../assets/js/script.js"></script>
  </body>
</html>
