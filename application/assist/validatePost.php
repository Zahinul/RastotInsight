<?php
    function validatePost($post){
        $errors = array();
        
        $table = 'posts';
        if(empty($post['post_title'])){
        array_push($errors, 'Title of the post is required');
        }

        if(empty($post['core'])){
            array_push($errors, 'Please enter the document body');
        }
        if(empty($post['img_credit'])){
            array_push($errors, 'Please enter the image credits');
        }
        if(empty($post['topic_id'])){
            array_push($errors, 'Please select a topic');
        }

        $existingPostTitle = selectOne($table,  ['post_title' => $post['post_title']]);
        //$existingPostBody = selectOne($table,  ['core' => $post['core']]);

        if($existingPostTitle){
            if(isset($_POST['update-post']) && $existingPostTitle['id'] != $post['id']) {
                array_push($errors, 'Post with the same title already exists');
            }
            if(isset($_POST['insert-post'])){
                array_push($errors, 'Post with the same title already exists');
            }
                
        }
            
        
       /* if($existingPostTitle && $existingPostBody){
            array_push($errors, 'Post with the same title already exists');
            array_push($errors, 'Post with the same document body already exists');
        }elseif($existingPostTitle){
            array_push($errors, 'Post with the same title already exists');
        }elseif($existingPostBody){
            array_push($errors, 'Post with the same document body already exists');
        }*/
        return $errors;
    }
 ?>