<?php require("../path.php"); 
  include(ROOT_PATH . "/application/controllers/users.php");
  guestOnly();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Rastot Insight</title>
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
        <form action="register.php" method="post">
          <h2 class="form-title">Want to join Rastot Insight? Sign Up</h2>
        <!--Msg-->
        <?php include(ROOT_PATH . "/application/assist/formerrors.php"); ?>


         <!-- <div class="msg success ">
              <li>Username Required</li>
          </div>-->
          <!--//Msg-->
          <div>
            <label>Username</label>
            <p class="constraint">(Minimum 3 chars long with only small letters, capital letters and numbers)</p>
            <input
              type="text"
              name="userName"
              class="text-input"
              value="<?php echo $userName;  ?>"
              placeholder="Set Username..."
            />
          </div>

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
            <label>Confirm Password</label>
            <input
              type="password"
              name="passConfirm"
              class="text-input"
              value="<?php echo $passConfirm; ?>"
              placeholder="Rewrite the password..."
            />
          </div>
          <div>
            <button type="submit" class="btn btn-big" name="register-btn">
              Register
            </button>
          </div>
          <p class="signin-link">Or <a href= <?php echo BASE_URL . "/public/login.php" ?>>Sign In</a></p>
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
