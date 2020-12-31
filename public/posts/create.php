<?php 
    require("../../path.php");
    include(ROOT_PATH . "/application/controllers/posts.php");
    userOnly();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Authors - Create Post</title>
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
</head>

<body>
   <!--Admin Header Here-->

   <?php include(ROOT_PATH  . '/application/includes/header3.php'); ?>

  <!--//Admin Header-->

  <!--Admin Page Wrapper-->
  <main class="knight-wrapper">

    <!--Left Managing Sidebar-->
      <?php include(ROOT_PATH . '/application/includes/sidebar.php'); ?>
    <!--//Left Managing Sidebar-->

    <!--Main Writers Content-->
    <section class="knight-content">
      <!--<div class="btn-grp">
        <a href="create.php" class="btn btn-big">Insert Post</a>
        <a href="index.php" class="btn btn-big">Manage Posts</a>
      </div>-->

      <div class="content">
        <h2 class="page-title">Create Posts</h2>

        <?php include(ROOT_PATH . "/application/assist/formerrors.php"); ?>

        <form action="create.php" method="post" enctype="multipart/form-data">
          <div>
            <label>Title</label>
            <input type="text" name="post_title" value="<?php echo $post_title; ?>" class="text-input" >
          </div>
          <div class="container">
            <h2 class="docudesc">Document Editing Tools</h2>    
              <textarea name="core" ><?php echo $core; ?></textarea>
          </div>
          <div>
            <label>Image</label>
            <input type="file" name="img_name" class="text-input"/>
          </div>
          <div>
            <label>Image Credit</label>
            <p>Write 'Author' if you are owner of image or else write the source:</p>
            <input type="text" name="img_credit" value="<?php echo $credit; ?>" class="text-input" >
          </div>
          <div>
            <label>Topic</label>
            <select name="topic_id" class="text-input">
              <?php foreach ($topics as $key => $topic): ?>
                <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                  <option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['title']; ?></option>
                <?php else: ?>
                  <option value="<?php echo $topic['id']; ?>"><?php echo $topic['title']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
          <!--<div>
            <?php //if (empty($published)): ?>
              <label>
                <input type="checkbox" name="published">
                Publish
              </label>
            <?php //else: ?>
              <label>
                <input type="checkbox" name="published" checked>
                Publish
              </label>
            <?php //endif; ?>

          </div>-->
          <div>
            <button type="submit" name="submit-post" class="btn btn-big">Submit Post</button>
          </div>
        </form>
      </div>
    </section>
    <!--//Main Writers Content-->
  </main>
  <!--//Admin Page Wrapper-->

    <!-- Admin Footer-->

    <?php include(ROOT_PATH  . '/application/includes/adminFooter.php'); ?>

    <!--//Admin Footer-->

  <!-- Jquery CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!--//Jquery CDN-->

  <!--Ckeditor 4 Full-->
  <script src="<?php echo BASE_URL . '/ckeditor4/ckeditor.js'; ?>"></script>
  <!--//Ckeditor 4 Full-->

  <!--Custom Javascript-->
    <script src="<?php echo BASE_URL . '/assets/js/script.js'; ?>"></script>
  <!--//Custom Javascript-->

</body>

</html>