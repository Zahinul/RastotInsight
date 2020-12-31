<?php
    require("../../path.php"); 
    include(ROOT_PATH . "/application/controllers/users.php");
    adminOnly();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Area - Manage Users</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL . '/assets/favicon/favicon.ico'; ?>"/>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-57x57.png';?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-60x60.png';?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-72x72.png';?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-76x76.png';?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-114x114.png';?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-120x120.png';?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-144x144.png';?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-152x152.png';?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL .  '/assets/favicon/apple-icon-180x180.png';?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BASE_URL .  '/assets/favicon/android-icon-192x192.png';?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL .  '/assets/favicon/favicon-32x32.png';?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE_URL .  '/assets/favicon/favicon-96x96.png';?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL .  '/assets/favicon/favicon-16x16.png';?>">
        <link rel="manifest" href="<?php echo BASE_URL .  '/assets/favicon/manifest.json';?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    <!--//Favicon -->
    <!--Font Awesome-->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/css/all.css'; ?>" />
    <!--Custom Styles-->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/style.css'; ?>" />
    <!--Admin Styles-->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/admin.css'; ?>" />
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500&family=Raleway&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Oswald:wght@300&family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<body>
    <!--Admin Header Here-->

        <?php include(ROOT_PATH  . '/application/includes/adminHeader.php'); ?>

    <!--//Admin Header-->

    <!--Admin Page Wrapper-->
    <main class="knight-wrapper">
    
        <!--Left Managing Sidebar-->
            <?php include(ROOT_PATH . '/application/includes/adminSidebar.php'); ?>
        <!--//Left Managing Sidebar-->

       <!--Main Writers Content-->
        <section class="knight-content">
            <!--<div class="btn-grp">
                <a href="create.php" class="btn btn-big">Insert Admin</a>
                <a href="index.php" class="btn btn-big">Manage Admins</a>
            </div>-->

            <div class="content">
                <h2 class="page-title">Manage Users</h2>
                <?php include(ROOT_PATH . "/application/includes/messages.php"); ?>
                <table>
                    <thead>
                        <th>Serial</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php foreach ($users_detail as $key => $user): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $user['userName']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <?php if($user['admin']): ?>
                                    <td>Admin</td>
                                    <?php else: ?>
                                    <td>Member</td>
                                <?php endif; ?> 
                                <!--<td><a href="edit.php?id=<?php //echo $user['id']; ?>" class="edit">edit</a></td>-->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    
                </table>
            </div>
        </section>
        <!--//Main Writers Content-->
    </main>
    <!--//Admin Page Wrapper-->

    <!-- Admin Footer-->

    <?php include(ROOT_PATH  . '/application/includes/adminFooter.php'); ?>

    <!--//Admin Footer-->

    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--//Jquery-->

    <!--Custom Javascript-->
    <script src="<?php echo BASE_URL . '/assets/js/script.js'; ?>"></script>
    <!--//Custom Javascript-->
    
</body>

</html>