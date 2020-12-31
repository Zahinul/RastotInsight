<?php 

    function userOnly($redirect = '/index.php'){
        if(empty($_SESSION['id'])){
            $_SESSION['message'] = "You need to sign in first!";
            $_SESSION['type'] = 'pending';
            header('location: ' . BASE_URL . $redirect);
            exit();
        }
    }

    function adminOnly($redirect = '/index.php'){
        if(empty($_SESSION['id']) || empty($_SESSION['admin'])){
            $_SESSION['message'] = "Sorry! You are not authorized to access this content.";
            $_SESSION['type'] = 'warning';
            header('location: ' . BASE_URL . $redirect);
            exit();
        }
    }
    function superAdminOnly($redirect = '/index.php'){
        if(empty($_SESSION['id']) || empty($_SESSION['admin']) || empty($_SESSION['super_admin'])){
            $_SESSION['message'] = "Sorry! You are not authorized to access this content.";
            $_SESSION['type'] = 'warning';
            header('location: ' . BASE_URL . $redirect);
            exit();
        }
    }
    function guestOnly($redirect = '/index.php'){
        if(isset($_SESSION['id'])){
            header('location: ' . BASE_URL . $redirect);
            exit();
        }
    }
?>