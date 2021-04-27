<?php

$action = $_GET["action"] ?? "display";
// $action =  $_GET["action"] ? $_GET["action"] : "display";

switch ($action) {

  case 'register':
    // code...
    break;

  case 'logout':
    // code...
    break;

  case 'login':
    // code...
    break;

  case 'newMsg':
    // code...
    break;

  case 'newComment':
    // code...
    break;

  case 'display':
  default:
    include "../models/PostManager.php";
    $posts = GetAllPosts();

    include "../models/CommentManager.php";
    $comments = array();

    foreach ($posts as $onePost) {
     $comments[$onePost["id"]] = GetAllCommentsFromPostId($onePost['id']); 
    }
    
    // foreach ($posts as $onePost) {
    //   $postId = $onePost['id'];
    //   $commentsForThisPostId = GetAllCommentsFromPostId($postId);
    //   $comments[$postId] = $commentsForThisPostId;
    // }

    include "../views/DisplayPosts.php";
    break;
}
