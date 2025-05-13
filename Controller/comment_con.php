<?php
require_once __DIR__ . '/../config.php';


class CommentCon {
    private $tab_name;

    public function __construct($tab_name) {
        $this->tab_name = $tab_name;
    }

    function addComment($comment) {
        $sql = "INSERT INTO $this->tab_name (id_blog, contenu_commentaire, image_commentaire, date_commentaire) VALUES (:id_blog, :contenu, :image, :date)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'id_blog' => $comment->get_id_blog(),
                'contenu' => $comment->get_contenu_commentaire(),
                'image' => $comment->get_image_commentaire(),
                'date' => $comment->get_date_commentaire()
            ]);
            if (!$result) {
                throw new Exception('Failed to add comment');
            }
            return $result;
        } catch (Exception $e) {
            error_log('Error adding comment: ' . $e->getMessage());
            throw $e;
        }
    }

    function updateComment($comment) {
        $sql = "UPDATE $this->tab_name SET contenu_commentaire = :contenu_commentaire, image_commentaire = :image_commentaire, date_commentaire = :date_commentaire WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'contenu_commentaire' => $comment->get_contenu_commentaire(),
                'image_commentaire' => $comment->get_image_commentaire(),
                'date_commentaire' => $comment->get_date_commentaire(),
                'id_commentaire' => $comment->get_id_commentaire()
            ]);
            if (!$result) {
                throw new Exception('Failed to update comment');
            }
            return $result;
        } catch (Exception $e) {
            error_log('Error updating comment: ' . $e->getMessage());
            throw $e;
        }
    }

    function deleteComment($id_commentaire) {
        $sql = "DELETE FROM $this->tab_name WHERE id_commentaire = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id_commentaire);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function listComments() {
        $sql = "SELECT * FROM $this->tab_name";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            error_log('Error fetching comments: ' . $e->getMessage());
            throw $e;
        }
    }

    function getComment($id_commentaire) {
        $sql = "SELECT * FROM $this->tab_name WHERE id_commentaire = :id_commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_commentaire', $id_commentaire, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            error_log('Error fetching comment: ' . $e->getMessage());
            throw $e;
        }
    }

    function generateBlogOptionsSelectedId($selected_id) {
        $sql = "SELECT id_blog, nom_blog FROM blog";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $blogs = $query->fetchAll();
            $options = '';
            foreach ($blogs as $blog) {
                $selected = ($blog['id_blog'] == $selected_id) ? 'selected' : '';
                $options .= '<option value="' . htmlspecialchars($blog['id_blog']) . '" ' . $selected . '>' . htmlspecialchars($blog['nom_blog']) . '</option>';
            }
            return $options;
        } catch (Exception $e) {
            error_log('Error generating blog options: ' . $e->getMessage());
            throw $e;
        }
    }
}