<?php
include '../../../Controller/comment_con.php';
include '../../../Model/comment.php';

// Create an instance of the comment controller
$commentC = new commentCon("commentaire");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];

    $res = $commentC->deleteComment($current_id);

    if ($res){
        header('Location: ./gestion_comment.php');
        exit();
    }
    else{
        header('Location: ./gestion_comment.php');
        exit();
    }
}
else{
    header('Location: ./gestion_comment.php');
    exit();
}
?>