<?php
include '../../../Controller/comment_con.php';
include '../../../Model/comment.php';

$commentC = new commentCon("commentaire");

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
    $res = $commentC->deleteComment($current_id);
    if ($res){
        header('Location: ../gestion blog/blog.php');
        exit();
    } else {
        header('Location: ../gestion blog/blog.php');
        exit();
    }
} else {
    header('Location: ../gestion blog/blog.php');
    exit();
}
?>