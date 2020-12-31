<?php require("../path.php"); 
      include(ROOT_PATH . "/application/controllers/users.php");
      guestOnly();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recover Password | Rastot Insight</title>
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
        <form action="recover.php" method="post">
          <h2 class="form-title">Recover my Password</h2>
          <div class="rec-pass">
              <p>Forgot your password? Please provide the email address <br/> you used to sign up for helping us recover it for you</p>
          </div>
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
            <button type="submit" class="btn btn-big" name="recover-btn">
              Recover Password
            </button>
          </div>

          <p class="signin-link">
            Don't have an account? <a href=<?php echo BASE_URL . "/public/register.php" ?>>Sign UP</a>
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
