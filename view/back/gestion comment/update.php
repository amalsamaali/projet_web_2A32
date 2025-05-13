<?php
include '../../../Controller/comment_con.php';
include '../../../Model/comment.php';
include_once '../../../config.php';

$commentC = new commentCon("commentaire");
$error = "";
$comment = null;

if (isset($_GET['id'])) {
    $current_id = $_GET['id'];
    // Fetch the comment to pre-fill the form
    $db = config::getConnexion();
    $stmt = $db->prepare("SELECT * FROM commentaire WHERE id_commentaire = :id");
    $stmt->execute(['id' => $current_id]);
    $comment_data = $stmt->fetch();
    if (!$comment_data) {
        $error = "Comment not found.";
    }
} else {
    $error = "No comment ID provided.";
}

if (
    isset($_POST["id_blog"]) &&
    isset($_POST["contenu_commentaire"])
) {
    if (
        !empty($_POST['id_blog']) &&
        !empty($_POST["contenu_commentaire"])
    ) {
        try {
            $date_commentaire = date('Y-m-d');
            $image_commentaire = '';
            if (isset($_FILES['image_commentaire']) && $_FILES['image_commentaire']['error'] === UPLOAD_ERR_OK) {
                $image_commentaire = file_get_contents($_FILES['image_commentaire']['tmp_name']);
            } else if (isset($comment_data['image_commentaire'])) {
                $image_commentaire = $comment_data['image_commentaire'];
            }
            $comment = new Commentaire(
                $current_id,
                $_POST['id_blog'],
                $image_commentaire,
                $_POST['contenu_commentaire'],
                $date_commentaire
            );
            if ($commentC->updateComment($comment)) {
                header('Location: gestion_comment.php');
                exit();
            } else {
                $error = "Failed to update comment";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Missing information";
    }
}
?>