<?php
$action = $_GET["action"] ?? "display";
// $action =  $_GET["action"] ? $_GET["action"] : "display";

switch ($action) {

  case 'register':
    // code...
    break;

  case 'logout':
      if (isset($_SESSION['userId'])) {
        unset($_SESSION['userId']);
      }
      // header('Location: ?action=display');
      include "../views/LoginForm.php";
      break;

  case 'login':
    include "../models/UserManager.php";
    if (isset($_POST['username']) && isset($_POST['password'])) {
      $userId = GetUserIdFromUserAndPassword($_POST['username'], $_POST['password']);
      if ($userId > 0) {
        $_SESSION['userId'] = $userId;
        header('Location: ?action=display');
      } else {
        $errorMsg = "Wrong login and/or password.";
        include "../views/LoginForm.php";
      }
    } else {
      include "../views/LoginForm.php";
    }
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

    if (isset($_GET['search'])) {
      $posts = SearchInPosts($_GET['search']);
    } else {
      $posts = GetAllPosts();
    }

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
