<?php require("../path.php"); 
      include(ROOT_PATH . "/application/controllers/users.php");
      guestOnly();

      if(isset($_GET['token'])){
        $token = $_GET['token'];
        verifyUser($token);
      }
      if(isset($_GET['pass_token'])){
        $passwordToken = $_GET['pass_token'];
        resetPass($passwordToken);
      }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In | Rastot Insight</title>
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
        <form action="login.php" method="post">
          <h2 class="form-title">Sign in to your Account</h2>
          <?php include(ROOT_PATH . "/application/assist/formerrors.php"); ?>
          <div>
            <label>Email Address</label>
            <input
              type="email"
              name="email"
              class="text-input"
              value="<?php echo $email; ?>"
              placeholder="Email..."
            />
          </div>

          <div>
            <label>Password</label>
            <input
              type="password"
              name="pass"
              class="text-input"
              value="<?php echo $pass; ?>"
              placeholder="Type Password..."
            />
          </div>
          <div>
            <button type="submit" class="btn btn-big" name="login-btn">
              Sign In
            </button>
          </div>
          <p class="signin-link">
            Don't have an account? <a href=<?php echo BASE_URL . "/public/register.php" ?>>Sign UP</a>
          </p>
          <p class="forget-pass">
           <a href=<?php echo BASE_URL . "/public/recover.php" ?>>Forgot Password?</a>
          </p>
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
