<?php
    
    function validateTopic($topic){
        $errors = array();
        $table = 'topics';
        if(empty($topic['title'])){
        array_push($errors, 'Title is required');
        }

        $existingTopic = selectOne($table, ['title' => $topic['title']]);

        if($existingTopic){
            if(isset($_POST['update-topic']) && $existingTopic['id'] != $topic['id']) {
                array_push($errors, 'Topic already exists');
            }
            if(isset($_POST['insert-topic'])){
                array_push($errors, 'Topic already exists');
            }
                
        }

        return $errors;
    }

    function validateFooterMsg($msg){
        $errors = array();
        if(empty($msg['footer-email'])){
            array_push($errors, 'Email is required!');
        }
        if(empty($msg['footer-message'])){
            array_push($errors, 'Message is required!');
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Invalid email format') ;
          }

        return $errors;
    }

?>