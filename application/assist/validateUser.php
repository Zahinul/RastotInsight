<?php
    function validateUser($user){
        $errors = array();
        $passPattern = '/^(?=.*[!@#$%^&*-_])(?=.*[0-9])(?=.*[A-Z]).{12,}$/';
        $namePattern = "/^([a-zA-Z0-9-' ]).{3,}$/";
        if(empty($user['userName'])){
        array_push($errors, 'Username is required');
        }
        if(!preg_match($namePattern, $user['userName'])){
            array_push($errors, 'Username does not meet given reqirements!');
         }
        if(empty($user['email'])){
            array_push($errors, 'Email is required');
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Invalid email format') ;
          }
        if(empty($user['pass'])){
            array_push($errors, 'Password is required');
        }
        if(!preg_match($passPattern, $user['pass'])){
            array_push($errors, 'Password does not meet given reqirements!');
         }

        if($user['passConfirm'] !== $user['pass']){
            array_push($errors, 'Passwords do not match');
        }
        
        $existingUserMail = selectOne('users', ['email' => $user['email']]);
        if($existingUserMail){
            if(isset($user['update-admin']) && $existingUserMail['id'] != $user['id']) {
                array_push($errors, 'User with a similar email already exists');
            }
            if(isset($user['create-admin']) || isset($user['register-btn'])){
                array_push($errors, 'User with a similar email already exists');
            }
                
        }

        return $errors;
    }

    function validateLogin($user){
        $errors = array();
        

        if(empty($user['email'])){
            array_push($errors, 'Email is required');
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Invalid email format') ;
          }
        if(empty($user['pass'])){
            array_push($errors, 'Password is required');
        }

        return $errors;
    }

    function validateRecover($user){
        $errors = array();
        

        if(empty($user['email'])){
            array_push($errors, 'Email is required');
        }
        $existingUserMail = array();
        $existingUserMail = selectOne('users', ['email' => $user['email']]);
        if (count($existingUserMail)<1) {
            array_push($errors, 'No user with this email exixts!') ;
          } 

        return $errors;
    }

    function validateReset($user){
        $errors = array();
        $passPattern = '/^(?=.*[!@#$%^&*-_])(?=.*[0-9])(?=.*[A-Z]).{12,}$/';
        if(empty($user['pass'])){
            array_push($errors, 'Password is required');
        }

        if(!preg_match($passPattern, $user['pass'])){
            array_push($errors, 'Password does not meet given reqirements!');
         }
        if($user['passConfirm'] !== $user['pass']){
            array_push($errors, 'Passwords do not match');
        }

        return $errors;
    }
?>