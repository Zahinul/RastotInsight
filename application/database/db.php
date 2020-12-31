<?php

    session_start();
    require('connect.php');
    //var_dump($users);

    function data_dump($value) // to be deleted
    { 
      echo "<pre>", print_r($value, true), "<pre>";
      die();
    }

    function executeQuery($sql, $data){
        global $conn;
        $stmt =$conn -> prepare($sql);
        $values = array_values($data);
        $types = str_repeat('s', count($values));
        $stmt -> bind_param($types, ...$values );
        $stmt -> execute();
        return $stmt;
    }

    function selectAll($table, $conditions =[]) {
      global $conn;
      $sql = "SELECT * FROM  $table";
      if(empty($conditions)) {
      $stmt = $conn -> prepare($sql);
      $stmt -> execute();
      $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      return $records;
      }else{
        //return records that match certain conditions ... 
        //$sql = "SELECT * FROM $table WHERE admin=1 AND userName='Asif' ";
         $i= 0;
          foreach($conditions as $key => $value) {
            if($i===0) {
              $sql = $sql . " WHERE $key = ?"; 
           }else{
                $sql = $sql . " AND $key = ?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
      }
  }

  function selectOne($table, $conditions) {
    global $conn;
    $sql = "SELECT * FROM  $table";
    
       $i= 0;
        foreach($conditions as $key => $value) {
          if($i===0) {
            $sql = $sql . " WHERE $key = ?"; 
         }else{
              $sql = $sql . " AND $key = ?";
          }
          $i++;
      }
      ///$sql = "SELECT * FROM $table WHERE admin=0 AND userName='Azmain' LIMIT 1
      $sql = $sql . " LIMIT 1";
      $stmt = executeQuery($sql, $conditions);
      $record = $stmt->get_result()->fetch_assoc();
      return $record;
    
}

function create($table, $data){
    global $conn;
    // $sql = "INSERT INTO users (username, admin, email, password) VALUES (?, ?, ?, ?)"
    // $sql = "INSERT INTO users SET (username=?, admin=?, email=?, password=?)"

    // Using the second method which is similar to the first one

    $sql = "INSERT INTO $table SET ";

    $i= 0;
        foreach($data as $key => $value) {
          if($i===0) {
            $sql = $sql . " $key = ?"; 
         }else{
              $sql = $sql . ", $key = ?";
          }
          $i++;
      }
      //data_dump($sql);
      //data_dump($data);
     $stmt = executeQuery($sql, $data);
     $id = $stmt->insert_id;
     return $id;
}


function update($table, $id, $data){
  global $conn;
  // $sql = "UPDATE INTO users SET (username=?, admin=?, email=?, password=? WHERE id=?"


  $sql = "UPDATE $table SET ";

  $i= 0;
      foreach($data as $key => $value) {
        if($i===0) {
          $sql = $sql . " $key = ?"; 
       }else{
            $sql = $sql . ", $key = ?";
        }
        $i++;
    }
    
   $sql = $sql . " WHERE id=?";
   $data['id'] = $id;
   $stmt = executeQuery($sql, $data);
   $id = $stmt->insert_id;
   return $stmt->affected_rows;
}

function delete($table, $id){
  global $conn;
  // $sql = "DELETE FROM users WHERE id=?"


  $sql = "DELETE from $table WHERE id=?";

  $stmt = executeQuery($sql, ['id' => $id]);
  return $stmt->affected_rows;
}

function getPublishedPosts(){
  global $conn;
  //SELECT * FROM posts WHERE published=1
  $sql = "SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.published=? ORDER BY 
  p.created_at DESC";
  //$sql = "SELECT p.*, u.userName FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? ORDER BY p.created_at DESC";
  $stmt = executeQuery($sql, ['published' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}
function grabFullPostByID($id){
  global $conn;
  //$post = selectOne('posts', ['id' => $id]);
  $sql = "SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
      WHERE p.id=? LIMIT 1";
$stmt = executeQuery($sql, ['id' => $id]);
$record = $stmt->get_result()->fetch_assoc();
return $record;
}

function grabMyPostByID($p_id, $u_id){
  userOnly();
  global $conn;
  //$post = selectOne('posts', ['id' => $id]);
  $sql = "SELECT p.*, u.userName, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN topics t ON t.id = p.topic_id
      WHERE p.id=? AND u.id=? LIMIT 1";
$stmt = executeQuery($sql, ['p.id' => $p_id, 'u.id' => $u_id]);
$record = $stmt->get_result()->fetch_assoc();
return $record;
}

function grabPreviewPostByID($id){
  adminOnly();
  global $conn;
  //$post = selectOne('posts', ['id' => $id]);
  $sql = "SELECT p.*, u.userName, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN topics t ON t.id = p.topic_id
      WHERE p.id=? LIMIT 1";
$stmt = executeQuery($sql, ['id' => $id]);
$record = $stmt->get_result()->fetch_assoc();
return $record;
}
function getPostsWithUsrNameMail(){
  global $conn;
  //SELECT * FROM posts WHERE 
  $sql = "SELECT p.*, u.userName, u.email, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.valid=? ORDER BY 
  p.created_at DESC";
  //$sql = "SELECT p.*, u.userName, u.email FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.valid=? ORDER BY p.created_at DESC";
  $stmt = executeQuery($sql, ['valid' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function getMyPosts($id){
  global $conn;
  //SELECT * FROM posts WHERE 
  $sql = "SELECT p.*, u.userName 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
  WHERE p.user_id=? ORDER BY 
  p.created_at DESC";
  //$sql = "SELECT p.*, u.userName, u.email FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.valid=? ORDER BY p.created_at DESC";
  $stmt = executeQuery($sql, ['user_id' => $id]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function getPostsByTopicId($topic_id){
  global $conn;
  //SELECT * FROM posts WHERE published=1
  $sql = "SELECT p.*, u.userName FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND p.topic_id=? ORDER BY p.created_at DESC";
  $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function searchPosts($search_term){
  global $conn;
  $match = '%' . $search_term . '%';
  //SELECT * FROM posts WHERE published=1
  $sql = "SELECT 
          p.*, u.userName
          FROM posts AS p
          JOIN users AS u ON 
          p.user_id=u.id WHERE 
          p.published=?
          AND p.post_title LIKE ? 
          OR u.userName LIKE ?
          OR p.core LIKE ?";
/*$sql = "SELECT p.*, u.userName, v.total_views t.title
FROM posts p
    INNER JOIN users u ON p.user_id = u.id
    INNER JOIN view_counter v ON v.p_id = p.id
    INNER JOIN topics t ON t.id = p.topic_id
WHERE p.published=?  AND p.post_title LIKE ? 
OR u.userName LIKE ? OR p.core LIKE ?";*/
  $stmt = executeQuery($sql, ['published' => 1, 'post_title' => $match, 'userName' => $match, 'core' => $match ]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function pageViewCounter($p_id, $ip){

  global $conn;
  $sql = "SELECT user_ip FROM post_views WHERE p_id = '$p_id' AND user_ip = '$ip'"; 
  $res = mysqli_query($conn, $sql);
  $check_ip = mysqli_affected_rows($conn);
  if($check_ip>=1)
  {
    $record = selectOne('view_counter', ['p_id' => $p_id]);
    $views = $record['total_views'];
  }
  else
  {
    $insert_record = create('post_views', ['p_id' => $p_id, 'user_ip' => $ip]); 
    $sql = "SELECT id FROM view_counter WHERE p_id = '$p_id'"; 
    $res = mysqli_query($conn, $sql);
    $check_pid = mysqli_affected_rows($conn);
    if($check_pid>=1){
      $sqluv = "UPDATE view_counter SET total_views = total_views+1 WHERE p_id = '$p_id'";
      $res = mysqli_query($conn, $sqluv);
      $record = selectOne('view_counter', ['p_id' => $p_id]);
      $views = $record['total_views'];
    } else {
      $insert_views = create('view_counter', ['p_id' => $p_id]); 
      $sqluv = "UPDATE view_counter SET total_views = total_views+1 WHERE p_id = '$p_id'";
      $res = mysqli_query($conn, $sqluv);
      $record = selectOne('view_counter', ['p_id' => $p_id]);
      $views = $record['total_views'];
    }
    
  }
  return $views;
}

function getTenRecentPosts(){
  global $conn;
  //SELECT * FROM posts WHERE published=1
  $sql = "SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.published=? ORDER BY 
  p.created_at DESC LIMIT 10";
  //$sql = "SELECT p.*, u.userName FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? ORDER BY p.created_at DESC Limit 10";
  $stmt = executeQuery($sql, ['published' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function getFiveRecentPosts(){
  global $conn;
  //SELECT * FROM posts WHERE published=1
  $sql = "SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.published=? ORDER BY 
  p.created_at DESC LIMIT 5";
  //$sql = "SELECT p.*, u.userName FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? ORDER BY p.created_at DESC Limit 5";
  $stmt = executeQuery($sql, ['published' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}
function getFivePopularPosts(){
  global $conn;
  //SELECT * FROM posts WHERE published=1
  /*$sql = "SELECT p.*, u.userName, v.total_views
  FROM posts p, users u, view_counter v
  WHERE p.user_id = u.id AND v.p_id = p.id AND p.published=? ORDER BY v.total_views DESC LIMIT 6"; */

  /*Reference 1
  select s.name "Student", c.name "Course"
  from student s, bridge b, course c
  where b.sid = s.sid and b.cid = c.cid */

  /*Reference 2
  SELECT s.name as Student, c.name as Course 
  FROM student s
      INNER JOIN bridge b ON s.id = b.sid
      INNER JOIN course c ON b.cid  = c.id 
  ORDER BY s.name */

  $sql = "SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.published=? ORDER BY 
  v.total_views DESC LIMIT 5";

  $stmt = executeQuery($sql, ['published' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}

function getSixTrendingPosts(){
  
/*$sql = "SELECT p.*, u.userName, v.total_views
  FROM posts p, users u, view_counter v
  WHERE p.user_id = u.id AND v.p_id = p.id AND p.published=? AND p.created_at 
  BETWEEN date_sub(CURDATE(),INTERVAL 1 WEEK)
  AND CURDATE() ORDER BY v.total_views DESC LIMIT 6";*/
  
  //SELECT * FROM dt_table WHERE `date` BETWEEN DATE_SUB( CURDATE() ,INTERVAL 10 DAY ) AND CURDATE()

  $sql = " SELECT p.*, u.userName, v.total_views, t.title 
  FROM posts p
      INNER JOIN users u ON p.user_id = u.id
      INNER JOIN view_counter v ON v.p_id = p.id
      INNER JOIN topics t ON t.id = p.topic_id
  WHERE p.published=? AND p.created_at 
  BETWEEN date_sub(CURDATE(),INTERVAL 1 WEEK)
  AND CURDATE() ORDER BY v.total_views DESC LIMIT 6";
  
  $stmt = executeQuery($sql, ['published' => 1]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  return $records;
}
  ?>