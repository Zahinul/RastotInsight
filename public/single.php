<?php 
    require("../path.php"); 
    include(ROOT_PATH . "/application/controllers/posts.php");
    function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$posts = array();
$views = '';
$id= '';
$address_ip = getRealIpAddr();
$user_ip = isset($_SESSION['userName']) ? $_SESSION['userName'] : $address_ip;
if(isset($_POST['search_term'])){
    $posts = searchPosts($_POST['search_term']);
    if(count($posts)>0){
        $trending = " ";
        $postsTitle = "You searched for '" . $_POST['search_term'] . "'";
        $rec_posts = searchPosts($_POST['search_term']);
        $trend_posts = searchPosts($_POST['search_term']);
    } else {
        $_SESSION['message'] = "Sorry, no post is found with term '" .  $_POST['search_term']. "'!";
        $_SESSION['type'] = 'pending';
        header('location: ' . BASE_URL .  '/index.php');
        exit();
    }
} elseif(isset($_GET['t_id'])) {
    $postsByTopic = getPostsByTopicId($_GET['t_id']);
    $topic = selectOne('topics', ['id' => $_GET['t_id']]);
    //data_dump($posts);
    if(count($postsByTopic)>0){
        $trending = " ";
        //data_dump(count($postsByTopic));
        $postsTitle = "Posts under the topic '" . html_entity_decode($topic['title']) . "'";
        $rec_posts = getPostsByTopicId($_GET['t_id']);
        $trend_posts = getPostsByTopicId($_GET['t_id']);
    } else{
        //data_dump(count($postsByTopic));
        //array_push($errors, "Sorry, posts under topic " .  $topic['title'] . " are yet to be made!"); 
        $_SESSION['message'] = "Sorry, posts under topic '" .  html_entity_decode($topic['title']) . "' are yet to be made!";
        $_SESSION['type'] = 'pending';
        header('location: ' . BASE_URL .  '/index.php');
        exit();
    }
} elseif(isset($_GET['id'])) {
    //$post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $_GET['id'];
    $p_id = $_GET['id'];
    $ip = $user_ip;
    $views = pageViewCounter($p_id, $ip);
    $post = grabFullPostByID($id);
    //data_dump($post['title']);
}
    $topics = selectAll('topics');
   // $posts = getPublishedPosts();
    $rec_posts = getFiveRecentPosts();
    $pop_posts = getFivePopularPosts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['post_title']; ?> | Rastot Insight</title>
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
                <i class="fa fa-book"><span class="space"><?php echo(html_entity_decode($post['title'])); ?></span></i><br/>
                <i class="fa fa-eye"><span class="space"><?php echo $post['total_views']; ?></span></i>
                </div>
                <div class="post-content">
                     <?php echo(html_entity_decode($post['core'])); ?>
                </div>
            </article>
            <!--//Main Content-->
            <!--Sidebar-->
            <article class="sidebar single">
                <!--<div class="fb-page" data-href="https://www.facebook.com/rastot.co/" data-tabs="" 
                    data-width="" data-height="" data-small-header="false" data-adapt-container-width="true"
                     data-hide-cover="false" data-show-facepile="true">
                     <blockquote cite="https://www.facebook.com/rastot.co/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/rastot.co/">Rastot</a></blockquote>
                </div>-->
                <div class="partition popular">
                <h3 class="partition-title">Popular</h3>
                    <?php foreach ($pop_posts as $p): ?>
                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL . "/assets/images/" . $p['img_name']; ?>" alt="post image">
                            <a href="<?php echo BASE_URL . '/public/single.php?id=' . $p['id']; ?>" class="title"><?php echo(html_entity_decode($p['post_title'])); ?></a>
                            <div style="margin-top:10px">
                                <i class="far fa-user"><span class="space"><?php echo $p['userName']; ?></span></i>
                                    <!--<br/>
                                <i class="far fa-calendar"><span class="space"><?php //echo date('F j, Y', strtotime($p['created_at'])); ?></span></i>-->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <div class="partition">
                      <h3 class="partition-title">Search</h3>
                        <form action="<?php echo BASE_URL . '/index.php'?>" method="post">
                            <input type="text" name="search_term" class="text-input" placeholder="Search...">
                        </form>
                  </div>
                  <div class="partition popular">
                    <h3 class="partition-title">Recent Posts</h3>
                    <?php foreach ($rec_posts as $p): ?>
                            <div class="post clearfix">
                                <img src="<?php echo BASE_URL . "/assets/images/" . $p['img_name']; ?>" alt="post image">
                                <a href="<?php echo BASE_URL . '/public/single.php?id=' . $p['id']; ?>" class="title"><?php echo(html_entity_decode($p['post_title'])); ?></a>
                                <div style="margin-top:10px">
                                    <i class="far fa-user"><span class="space"><?php echo $p['userName']; ?></span></i>
                                        <!--<br/>
                                    <i class="far fa-calendar"><span class="space"><?php //echo date('F j, Y', strtotime($p['created_at'])); ?></span></i>-->
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
                <div class="partition topics">
                      <h3 class="partition-title">Topics</h3>
                      <ul>

                      <?php foreach($topics as $key => $topic): ?>
                        <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id']; ?>"><?php echo(html_entity_decode($topic['title'])); ?></a></li>
                      <?php endforeach; ?>

                      </ul>
                    </div>
            </article>
            <!--//Sidebar-->
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