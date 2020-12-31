<?php
    include(ROOT_PATH . '/application/database/db.php');
    include(ROOT_PATH . '/application/assist/validateTopic.php');
    include(ROOT_PATH . '/application/assist/middleware.php');
    include(ROOT_PATH . '/emailController.php');

    $table = 'topics';

    $errors = array(); 
    $id = '';
    $title = '';
    $description = '';
    $data = '';
    $mail = '';
    $msg = '';


    $topics = selectAll($table);

    if (isset($_POST['insert-topic'])) {
        adminOnly();
        $errors = validateTopic($_POST);

        if (count($errors) === 0) {
            unset($_POST['insert-topic']);
            $_POST['title'] = htmlentities($_POST['title']);
            $topic_id = create($table, $_POST);
            $_SESSION['message'] = 'Topic created successfully';
            $_SESSION['type'] ='success';
            header('location: ' . BASE_URL . '/private/topics/index.php');
            exit();
        } else {
            $title = $_POST['title'];
            $description = $_POST['description'];
        }
    }


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $topic = selectOne($table, ['id' => $id]);
        $id = $topic['id'];
        $title = $topic['title'];
        $description = $topic['description'];
    }

    if(isset($_POST['update-topic'])){
        adminOnly();
        $errors = validateTopic($_POST);
        if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['id'], $_POST['update-topic']);
        $_POST['title'] = htmlentities($_POST['title']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated successfully';
        $_SESSION['type'] ='success';
        header('location: ' . BASE_URL . '/private/topics/index.php');
        exit(); 
        } else {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
        }
    }

    if (isset($_GET['delete_id'])) {
        adminOnly();
            $id = $_GET['delete_id'];
            $del_count = delete($table, $id);
            $_SESSION['message'] = 'Topic deleted successfully';
            $_SESSION['type'] ='success';
            header('location: ' . BASE_URL . '/private/topics/index.php');
            exit();
    }
    //Foter Mail Message
    if(isset($_POST['footer-btn'])){
        unset($_POST['footer-btn']);
        $data = $_POST;
        $errors = validateFooterMsg($data);
        $mail = $data['footer-email'];
        $msg = htmlentities($data['footer-message']);
        if(count($errors) === 0){
            sendFooterMSg($mail, $msg);
            $_SESSION['message'] = "Your message was succesfully sent!";
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/index.php');
            exit();
        }else {
            $mail = $_POST['footer-email'];
            $msg = $_POST['footer-message'];
        }
    }

?>