<?php 
    require("../../path.php"); 
    include(ROOT_PATH . "/application/controllers/posts.php");
    adminOnly();
$post = array();
$id= '';
if(isset($_GET['id'])) {
    //$post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $_GET['id'];
    $post = grabPreviewPostByID($id);
    //data_dump($post['title']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview | <?php echo $post['post_title']; ?></title>
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
    <link rel="stylesheet" href="<?php echo BASE_URL . '/css/all.css'; ?>">
    <!--Custom Styles-->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/style.css'; ?>">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500&family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Oswald:wght@300&family=Slabo+27px&display=swap" rel="stylesheet">


</head>

<body class="special">
    <!--Facebook Page Plugin SDK
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" 
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0" nonce="fLWzLisp">
    </script>
    //Facebook Page Plugin SDK-->

    <!-- Include Header-->
    <?php include(ROOT_PATH . "/application/includes/header.php"); ?>
    <main class="page-wrapper">
    <?php include(ROOT_PATH . "/application/assist/formerrors.php");  ?>
        <!--Contents-->
        <section class="content clearfix">
            <!--Main Content-->
            <article class="main-content single">
                <h1 class="post-title">
                    <?php echo(html_entity_decode($post['post_title'])); ?>
                </h1>
                <div class="post-img">
                    <img src="<?php echo BASE_URL . "/assets/images/" . $post['img_name']; ?>" alt="post image">
                    <blockquote><p class="img-credit">Image credit: <em><?php echo(html_entity_decode($post['img_credit'])); ?></em></p></blockquote>
                </div>
                
                <div class="post-details">
                </br>
                <i class="far fa-user"><span class="space"><?php echo $post['userName']; ?></span></i><br/>
                <i class="fa fa-book"><span class="space"><?php echo(html_entity_decode($post['title'])); ?></span></i>
                </div>
                <div class="post-content">
                     <?php echo(html_entity_decode($post['core'])); ?>
                </div>
            </article>
            <!--//Main Content-->
        </section>
        <!--//Contents-->
    </main>
        <!-- Include Footer-->
        <?php include(ROOT_PATH . "/application/includes/footer.php"); ?>
        <!--//Footer-->
    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--Custom Javascript-->
    <script src="<?php echo BASE_URL . '/assets/js/script.js'; ?>"></script>
    <!--Slick JS-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>
</html>