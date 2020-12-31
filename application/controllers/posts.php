<?php

include(ROOT_PATH . '/application/database/db.php');
include(ROOT_PATH . '/application/assist/validatePost.php');
include(ROOT_PATH . '/application/assist/middleware.php');

$table = 'posts';

$errors = array();

$topics = selectAll('topics');
$posts = selectAll($table);

$id= '';
$published = '';
$post_title = '';
$core = '';
$credit = '';
$topic_id = '';
$result = '';
$del_count = '';
$pub_count = '';

if (isset($_GET['id'])) {
  $post = selectOne($table, ['id' => $_GET['id']]);
  //data_dump($post);
  $id = $post['id'];
  $post_title = $post['post_title'];
  $core = $post['core'];
  $topic_id = $post['topic_id'];
  $published = $post['published'];
}

if (isset($_GET['delete_id'])) {
    userOnly();
    $id = $_GET['delete_id'];
    $del_count = delete($table, $id);
    $_SESSION['message'] = "Post is deleted successfully";
    $_SESSION['type'] = 'success';
    header('location: '. BASE_URL . '/private/posts/index.php');
    exit();
  }

if (isset($_GET['published']) && isset($_GET['p_id'])){
    adminOnly();
    $published = $_GET['published'];
    $id = $_GET['p_id'];
    //...update published field
    $pub_count = update($table, $id, ['published' => $published]);
    $_SESSION['message'] = "Published state is changed successfully";
    $_SESSION['type'] = 'success';
    if(empty($_SESSION['super_admin'])){
        header('location: '. BASE_URL . '/private/posts/index2.php');
        exit();
    }else{
        header('location: '. BASE_URL . '/private/posts/index.php');
        exit();
    }

}
    if (isset($_POST['insert-post'])) {
        adminOnly();
        //data_dump($_FILES['img_name']);
        $errors = validatePost($_POST);

        if (!empty($_FILES['img_name']['name'])) {
            $image_name = time() . '_' . $_FILES['img_name']['name'];
            $destination = ROOT_PATH . '/assets/images/' . $image_name;

            $result = move_uploaded_file($_FILES['img_name']['tmp_name'], $destination);

            if ($result) {
                $_POST['img_name'] = $image_name;
            } else {
                array_push($errors, 'Image upload failed');
            }
        } else {
            array_push($errors, 'Post image is required');
        }
        
        if (count($errors) === 0) {
            unset($_POST['insert-post']);
            $_POST['valid'] = 1;
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['post_title'] = htmlentities($_POST['post_title']);
            $_POST['core'] = htmlentities($_POST['core']);
            $_POST['img_credit'] = htmlentities($_POST['img_credit']);
            $post_id = create($table, $_POST);
            $_SESSION['message'] = "Post is created successfully";
            $_SESSION['type'] = 'success';
            header('location: '. BASE_URL . '/private/posts/index.php');
            exit();
        } else {
            $post_title = $_POST['post_title'];
            $core = $_POST['core'];
            $topic_id = $_POST['topic_id'];
            $credit = $_POST['img_credit'];
            $published = isset($_POST['published']) ? 1 : 0;
        }

    }

    if (isset($_POST['submit-post'])) {
        userOnly();
        //data_dump($_FILES['img_name']);
        $errors = validatePost($_POST);

        if (!empty($_FILES['img_name']['name'])) {
            $image_name = time() . '_' . $_FILES['img_name']['name'];
            $destination = ROOT_PATH . '/assets/images/' . $image_name;

            $result = move_uploaded_file($_FILES['img_name']['tmp_name'], $destination);

            if ($result) {
                $_POST['img_name'] = $image_name;
            } else {
                array_push($errors, 'Image upload failed');
            }
        } else {
            array_push($errors, 'Post image is required');
        }
        
        if (count($errors) === 0) {
            unset($_POST['insert-submit']);
            $_POST['valid'] = 1;
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = 0;
            $_POST['post_title'] = htmlentities($_POST['post_title']);
            $_POST['core'] = htmlentities($_POST['core']);
            $_POST['img_credit'] = htmlentities($_POST['img_credit']);
            $post_id = create($table, $_POST);
            $_SESSION['message'] = "Post is submited successfully";
            $_SESSION['type'] = 'success';
            header('location: '. BASE_URL . '/public/posts/index.php');
            exit();
        } else {
            $post_title = $_POST['post_title'];
            $core = $_POST['core'];
            $topic_id = $_POST['topic_id'];
            $credit = $_POST['img_credit'];
        }

    }

    if (isset($_POST['update-post'])) {
        adminOnly();
        $errors = validatePost($_POST);

        if (!empty($_FILES['img_name']['name'])) {
            $image_name = time() . '_' . $_FILES['img_name']['name'];
            $destination = ROOT_PATH . '/assets/images/' . $image_name;

            $result = move_uploaded_file($_FILES['img_name']['tmp_name'], $destination);

            if ($result) {
                $_POST['img_name'] = $image_name;
            } else {
                array_push($errors, 'Image upload failed');
            }
        } else {
            array_push($errors, 'Post image is required');
        }

        if (count($errors) === 0) {
            $id = $_POST['id'];
            unset($_POST['update-post'], $_POST['id']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['post_title'] = htmlentities($_POST['post_title']);
            $_POST['core'] = htmlentities($_POST['core']);
            $_POST['img_credit'] = htmlentities($_POST['img_credit']);
            $post_id = update($table, $id, $_POST);
            $_SESSION['message'] = "Post is updated successfully";
            $_SESSION['type'] = 'success';
            header('location: '. BASE_URL . '/private/posts/index.php');
            exit();
        } else {
            $post_title = $_POST['post_title'];
            $core = $_POST['core'];
            $topic_id = $_POST['topic_id'];
            $credit = $_POST['img_credit'];
            $published = isset($_POST['published']) ? 1 : 0;
        }

    }

    if (isset($_POST['submit-update'])) {
        userOnly();
        $errors = validatePost($_POST);

        if (!empty($_FILES['img_name']['name'])) {
            $image_name = time() . '_' . $_FILES['img_name']['name'];
            $destination = ROOT_PATH . '/assets/images/' . $image_name;

            $result = move_uploaded_file($_FILES['img_name']['tmp_name'], $destination);

            if ($result) {
                $_POST['img_name'] = $image_name;
            } else {
                array_push($errors, 'Image upload failed');
            }
        } else {
            array_push($errors, 'Post image is required');
        }

        if (count($errors) === 0) {
            $id = $_POST['id'];
            unset($_POST['submit-update'], $_POST['id']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = 0;
            $_POST['post_title'] = htmlentities($_POST['post_title']);
            $_POST['core'] = htmlentities($_POST['core']);
            $_POST['img_credit'] = htmlentities($_POST['img_credit']);
            $post_id = update($table, $id, $_POST);
            $_SESSION['message'] = "Update post is submited successfully";
            $_SESSION['type'] = 'success';
            header('location: '. BASE_URL . '/public/posts/index.php');
            exit();
        } else {
            $post_title = $_POST['post_title'];
            $core = $_POST['core'];
            $topic_id = $_POST['topic_id'];
            $credit = $_POST['img_credit'];
        }

    }

?>