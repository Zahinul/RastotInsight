<?php

include(ROOT_PATH . '/application/database/db.php');
include(ROOT_PATH . '/application/assist/validateUser.php');
include(ROOT_PATH . '/application/assist/middleware.php');
include(ROOT_PATH . '/emailController.php');
    $errors = array();
    $userName = '';
    $email = '';
    $pass = '';
    $admin = '';
    $passConfirm = '';
    $del_count = '';
    $table = 'users';
    $id = '';
    $user = '';
    $update_count = '';
    $token = '';
    $verified = '';
    $users_detail = selectAll($table);



    function loginUser($user){

        $_SESSION['verified'] =$user['verified'];
        
        if($_SESSION['verified'] == 1){
            $_SESSION['id'] = $user['id'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['super_admin'] = $user['super_admin'];
            $_SESSION['message'] = "You are successfully signed in";
            $_SESSION['type'] = 'success';
            if($_SESSION['admin']){
                header('location: ' . BASE_URL . '/private/dashboard.php');
            } else {
                header('location: ' . BASE_URL . '/index.php');
            }
             exit();
        } else {
            $_SESSION['message'] = "You need to verify first to login!";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . '/index.php');
            exit();
        }
    }


    if(isset($_POST['register-btn']) || isset($_POST['create-admin'])){
        $errors = validateUser($_POST);
        if(count($errors) === 0){
            unset($_POST['register-btn'], $_POST['passConfirm'], $_POST['create-admin']);
            $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            
            if (isset($_POST['admin'])) {
                adminOnly();
                $_POST['admin'] = 1;
                $user_id = create($table, $_POST);
                $_SESSION['message'] = "Admin user is created successfully";
                $_SESSION['type'] = 'success';
                header('location: ' . BASE_URL . '/private/users/index.php');
                exit();
            } else {
                $token = bin2hex(random_bytes(50));
                $verified = 0;
                $_POST['admin'] = 0;
                $_POST['super_admin'] = 0;
                $_POST['token'] = $token;
                $_POST['verified'] = $verified;
                //data_dump($_POST);
                $user_id = create($table, $_POST);
                $user = selectOne($table, ['id' => $user_id]);

                sendVerificationMail($user['email'], $token);
                $_SESSION['message'] = "You need to verify your account via your mail account first";
                $_SESSION['type'] = 'success';
                header('location: ' . BASE_URL . '/public/login.php');
                exit();
            }

        } else{
            $userName = $_POST['userName'];
            $admin = isset($_POST['admin']) ? 1 : 0;
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $passConfirm = $_POST['passConfirm'];
         }
    }

    

    if(isset($_GET['id'])){
        $user = selectOne($table, ['id' => $_GET['id']]);
        //data_dump($user);
        $id = $user['id'];
        $userName = $user['userName'];
        $admin = $user['admin'] == 1 ? 1 : 0;
        $email = $user['email'];
    }

    if (isset($_GET['admin']) && isset($_GET['u_id'])){
        superAdminOnly();
        $admin = $_GET['admin'];
        $id = $_GET['u_id'];
        //...update admin field
        $admin_count = update($table, $id, ['admin' => $admin]);
        $_SESSION['message'] = "Admin state is changed successfully";
        $_SESSION['type'] = 'success';
        header('location: '. BASE_URL . '/private/users/index.php');
        exit();
    }


    if(isset($_POST['update-admin'])){
        adminOnly();
        $errors = validateUser($_POST);
        if(count($errors) === 0){
            $id = $_POST['id'];
            unset($_POST['passConfirm'], $_POST['update-admin'], $_POST['id']);
            $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
 
            $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
            $update_count = update($table, $id, $_POST);
            $_SESSION['message'] = "Admin user is updated successfully";
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/private/users/index.php');
            exit();
             
        } else{
            $userName = $_POST['userName'];
            $admin = isset($_POST['admin']) ? 1 : 0;
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $passConfirm = $_POST['passConfirm'];
         }
    }

    if (isset($_POST['login-btn'])) {
        $errors = validateLogin($_POST);
        if(count($errors) === 0){
            $user = selectOne($table, ['email' => $_POST['email']]);

            if($user && password_verify($_POST['pass'], $user['pass'])){
                //Log user in and redirect
                loginUser($user);
            } else {
                array_push($errors, 'Wrong credentials');
                $email = $_POST['email'];
                $pass = $_POST['pass'];
            }
        }
        
    }




    if (isset($_GET['delete_id'])) {
        adminOnly();
        $del_count = delete($table, $_GET['delete_id']);
        $_SESSION['message'] = "User is deleted successfully";
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/private/users/index.php');
        exit();
    }

    if (isset($_POST['recover-btn'])) {
        $errors = validateRecover($_POST);
        if(count($errors) === 0){
            $user = selectOne($table, ['email' => $_POST['email']]);
            sendPasswordResetLink($user['email'], $user['token']);
            $_SESSION['message'] = "A password recovery link has been sent to your email address. Please click it to continue.";
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/public/login.php');
            exit();

        } else {
            array_push($errors, 'Email not found!');
            $email = $_POST['email'];
        }
        
    }

    if(isset($_POST['reset-btn'])){
        $errors = validateReset($_POST);
        $id = $_SESSION['id'];
        $update_count = '';

        if(count($errors) === 0){
            if(isset($_SESSION['token'])){
                unset($_POST['passConfirm']);
                $pass = $_POST['pass'];
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $update_count = update('users', $id, ['pass' => $pass]);
                if($update_count !==''){
                    unset($_SESSION['id']);
                    unset($_SESSION['token']);
                    $_SESSION['message'] = "Congratulations! Your password is successfully reset.Sign in using the new password";
                    $_SESSION['type'] = 'success';
                    header('location: ' . BASE_URL . '/public/login.php');
                    exit();
            } else {
                $_SESSION['message'] = "You are not authorized!";
                $_SESSION['type'] = 'error';
                header('location: ' . BASE_URL . '/index.php');
                exit();
            }

            } else {
                $_SESSION['message'] = "User not found";
                $_SESSION['type'] = 'error';
                header('location: ' . BASE_URL . '/index.php');
                exit();
            }
        }
    }
    /*if(isset($_POST['reset-btn'])){
        $errors = validateReset($_POST);
        if(count($errors) === 0){
            //unset($_POST['passConfirm']);
            //$_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $token = $_SESSION['token'];
            resetPass($token, $_POST);
        }
    }*/


    function verifyUser($token){
        $result = '';
        $update_count = 0;
        $result = selectOne('users', ['token' => $token]);

        
        if($result !== ''){
            $user = $result;
            $update_count = update('users', $user['id'], ['verified' => 1]);

            if($update_count > 0) {
                $_SESSION['verified'] = 1;
                    $_SESSION['message'] = "Congratulations! Your email address is successfully verified. Now you can sign in!";
                    $_SESSION['type'] = 'success';
                    header('location: ' . BASE_URL . '/public/login.php');
                    exit();
            }
        }else {
            $_SESSION['message'] = "User not found";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . '/index.php');
            exit();
        }
    }

    function resetPass($passwordToken){
        $user = selectOne('users', ['token' => $passwordToken]);
        $_SESSION['id'] = $user['id'];
        $_SESSION['token'] = $passwordToken;
        $passwordToken = '';
        $_SESSION['message'] = "You are now authorized. Proceed to reset your password!";
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/public/resetPassword.php');
        exit();
    }



    /*function resetPass($token){
        $result = '';
        $update_result = '';
        $result = selectOne('users', ['token' => $token]);
        unset($data['passConfirm']);
        unset($token);
        $token = bin(random_bytes(50));
        $pass = $data['pass'] ;
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        if($result !== ''){
            $user = $result;
            $update_result = update('users', $user['id'], ['pass' => $pass]);
            $update_result = update('users', $user['id'], ['token' => $token]);

            if($update_result !== '') {
                    //$_SESSION['pass'] = $pass;
                    $_SESSION['message'] = "Congratulations! Your password is successfully reset.Sign in using the new password";
                    $_SESSION['type'] = 'success';
                    header('location: ' . BASE_URL . '/public/login.php');
                    exit();
            }
        }else {
            $_SESSION['message'] = "User not found";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . '/index.php');
            exit();
        }
    }*/


?>