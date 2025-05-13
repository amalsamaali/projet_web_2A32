<?php
include_once '../../../config.php';
include_once '../../../Controller/comment_con.php';
include_once '../../../Model/comment.php';

// Create an instance of the comment controller
$commentC = new commentCon("commentaire");

// Create an instance of the Comment class
$comment = null;

if (
    isset($_POST["id_blog"]) &&
    isset($_POST["content_comment"])
) {
    if (
        !empty($_POST['id_blog']) &&
        !empty($_POST["content_comment"])
    ) {
        // Get current date
        $currentDate = date("Y-m-d");

        // Bad words filter
        $badWords = ["badword1", "badword2", "badword3"]; // Add your bad words here
        $contentLower = strtolower($_POST['content_comment']);
        $foundBadWord = false;
        foreach ($badWords as $word) {
            if (strpos($contentLower, $word) !== false) {
                $foundBadWord = true;
                break;
            }
        }
        if ($foundBadWord) {
            $error = "Your comment contains inappropriate language.";
        } else {
            $comment = new Commentaire(
                '',
                $_POST['id_blog'],
                $_POST['content_comment'],
                '',  // Empty image for now
                $currentDate
            );

            $commentC->addComment($comment);
            header('Location: ./gestion_comment.php');
            exit();
        }
    } else {
        $error = "Missing information";
    }
}
?>