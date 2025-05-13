<?php

require_once __DIR__ . '/../config.php';

class blogCon{

    private $tab_name;

    public function __construct($tab_name){
        $this->tab_name = $tab_name;
    }

    public function getBlog($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE id_blog = $id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $voyage = $query->fetch();
            return $voyage;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listBlogs()
    {
        $sql = "SELECT * FROM $this->tab_name";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addBlog($blog)
    {
        $sql = "INSERT INTO $this->tab_name(image_blog, nom_blog, type_blog, description_blog, date_blog) VALUES (:image, :nom, :type, :description, :date)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'image' => $blog->get_image(),
                'nom' => $blog->get_nom(),
                'type' => $blog->get_type(),
                'description' => $blog->get_description(),
                'date' => $blog->get_date()
               ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateBlog($blog, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE $this->tab_name SET image_blog = :image, nom_blog = :nom, type_blog = :type, description_blog = :description, date_blog = :date WHERE id_blog = :id");
            $query->execute([
                'id' => $id, 
                'image' => $blog->get_image(),
                'nom' => $blog->get_nom(),
                'type' => $blog->get_type(),
                'description' => $blog->get_description(),
                'date' => $blog->get_date()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }

    function updateBlogWithoutImg($blog, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE $this->tab_name SET nom_blog = :nom, type_blog = :type, description_blog = :description, date_blog = :date WHERE id_blog = :id");
            $query->execute([
                'id' => $id, 
                'nom' => $blog->get_nom(),
                'type' => $blog->get_type(),
                'description' => $blog->get_description(),
                'date' => $blog->get_date()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }

    function deleteBlog($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE id_blog = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function generateBlogs($blog) {

       
        $db = config::getConnexion();
        // Fetch data from PDOStatement object and convert it into an array
        $blogPosts = $blog->fetchAll(PDO::FETCH_ASSOC);

        echo '<div id="main" class="col-md-12">';
        for ($i = 0; $i < count($blogPosts); $i++) {
            $blogId = $blogPosts[$i]['id_blog'];
            // Get average rating
            $avgRatingData = $this->getAverageRating($blogId);
            $avgRating = $avgRatingData['average'];
            $ratingCount = $avgRatingData['count'];
            // Blog Card (Vertical Layout)
            $blogId = $blogPosts[$i]['id_blog'];
            // Blog Card (Vertical Layout)
            echo '<div class="blog-card-row enhanced-blog-card" style="max-width: 820px; margin: 0 auto 48px auto; background: linear-gradient(120deg, #f8fafc 0%, #e4ecfa 100%); border-radius: 28px; box-shadow: 0 8px 40px rgba(43,144,217,0.13); overflow: hidden; display: flex; flex-direction: column; align-items: stretch;">';
            // IMAGE ON TOP
            echo '<div class="blog-card-image" style="width: 100%; min-height: 270px; background: linear-gradient(135deg, #e9f1ff 0%, #f9f9f9 100%); display: flex; align-items: center; justify-content: center;">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($blogPosts[$i]['image_blog']) . '" alt="Blog Photo" style="width: 230px; height: 230px; object-fit: cover; border-radius: 22px; margin: 28px 0 18px 0; box-shadow: 0 4px 24px rgba(43,144,217,0.12);">';
            echo '</div>';
            // BLOG CONTENT
            echo '<div class="blog-card-content" style="padding: 40px 48px 28px 48px; display: flex; flex-direction: column; justify-content: center; align-items: flex-start; font-family: Poppins, sans-serif;">';
            echo '<h4 style="margin-bottom: 12px; font-size: 2.1rem; font-weight: 700; color: #3580BB;"><a href="#" style="color: #3580BB; text-decoration: none;">' . htmlspecialchars($blogPosts[$i]['type_blog']) . ' : ' . htmlspecialchars($blogPosts[$i]['nom_blog']) . '</a></h4>';
            echo '<p style="margin-bottom: 22px; color: #333; font-size: 1.18rem; line-height:1.7;">'. htmlspecialchars($blogPosts[$i]['description_blog']) . '</p>';
            echo '<div class="blog-meta" style="font-size: 1.08rem; color: #888; margin-bottom: 12px; display: flex; gap: 36px;">';
            echo '<span class="blog-meta-author">By: <a href="#" style="color: #3580BB; font-weight:600;">tripped</a></span>';
            echo '<span>' . htmlspecialchars($blogPosts[$i]['date_blog']) . '</span>';
            echo '</div>';
            // --- STAR RATING DISPLAY & AJAX ---
            echo '<div class="blog-rating" style="margin-bottom:10px;">';
            echo '<div class="star-rating-widget" data-blog-id="' . $blogId . '" style="display:inline-block;">';
            // Show 5 stars, filled up to average
            for ($star = 1; $star <= 5; $star++) {
                $color = ($avgRating >= $star - 0.25) ? '#FFD700' : '#ccc';
                echo '<i class="fa fa-star" style="font-size:22px;cursor:pointer;color:' . $color . ';margin-right:2px;" data-value="' . $star . '"></i>';
            }
            echo '<span style="margin-left:10px;color:#222;font-size:15px;">(' . number_format($avgRating, 1) . ' / 5, ' . $ratingCount . ' votes)</span>';
            echo '</div>';
            echo '<span class="rate-message" style="margin-left:15px;color:#1976d2;font-size:14px;display:none;"></span>';
            echo '</div>';
            // --- END STAR RATING ---
            echo '</div>';
            // Add JS for AJAX rating only once (after all blogs)
            if ($i === count($blogPosts) - 1) {
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelectorAll(".star-rating-widget").forEach(function(widget) {
                        var stars = widget.querySelectorAll(".fa-star");
                        var blogId = widget.getAttribute("data-blog-id");
                        stars.forEach(function(star, idx) {
                            star.addEventListener("click", function() {
                                var rating = this.getAttribute("data-value");
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "rate_blog.php", true);
                                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        var res = JSON.parse(xhr.responseText);
                                        if (res.success) {
                                            // Update stars
                                            stars.forEach(function(s, i) {
                                                s.style.color = (i < rating) ? "#FFD700" : "#ccc";
                                            });
                                            // Update text
                                            var txt = widget.querySelector("span");
                                            if (txt) txt.innerHTML = "(" + res.average.toFixed(1) + " / 5, " + res.count + " votes)";
                                            // Show thank you
                                            var msg = widget.parentElement.querySelector(".rate-message");
                                            if (msg) { msg.innerHTML = "Thank you for your rating!"; msg.style.display = "inline"; setTimeout(function(){ msg.style.display = "none"; }, 2000); }
                                        }
                                    }
                                };
                                xhr.send("blog_id=" + encodeURIComponent(blogId) + "&rating=" + encodeURIComponent(rating));
                            });
                        });
                    });
                });
                </script>';
            }
            // COMMENTS BELOW
            echo '<div class="blog-card-comments enhanced-comments" style="background: #f7faff; border-top: 1.5px solid #e0e6ed; padding: 32px 38px 18px 38px; display: flex; flex-direction: column; justify-content: flex-start; border-radius: 0 0 28px 28px;">';
            // Fetch comments for this blog
            $sql_comments = "SELECT * FROM commentaire WHERE id_blog = :id_blog ORDER BY date_commentaire DESC";
            $stmt_comments = $db->prepare($sql_comments);
            $stmt_comments->execute(['id_blog' => $blogId]);
            $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
            // Comments List
            echo '<div class="comments-list" style="margin-bottom: 16px;">';
            echo '<div style="font-weight: bold; color: #3580BB; margin-bottom: 8px; font-size:1.09rem;">Comments</div>';
            if (count($comments) > 0) {
                foreach ($comments as $comment) {
                    echo '<div class="comment-card" style="background: #fff; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 12px 16px; margin-bottom: 12px;">';
                    echo '<div style="margin-bottom: 4px; display: flex; align-items: center; justify-content: space-between;">';
                    echo '<span><span style="font-weight:600; color:#3580BB; font-size:1.01rem;">' . htmlspecialchars($comment['auteur_commentaire'] ?? 'Anonymous') . '</span> <span style="color:#aaa; font-size:12px; margin-left:8px;">' . htmlspecialchars($comment['date_commentaire']) . '</span></span>';
                    echo '<span>';
                    echo '<a href="../gestion_comment/delete_comment.php?id=' . $comment['id_commentaire'] . '" onclick="return confirm(\'Are you sure you want to delete this comment?\');" class="comment-btn delete" style="margin-left:4px; background: linear-gradient(90deg, #ff5252 0%, #ff6700 100%); color:#fff; border:none; border-radius:7px; padding:3px 13px; font-size:13px; text-decoration:none; display:inline-block; font-weight:600;">Delete</a>';
                    echo '<a href="../gestion_comment/update_comment.php?id=' . $comment['id_commentaire'] . '" class="comment-btn update" style="margin-left:4px; background: linear-gradient(90deg, #3580BB 0%, #43a7ff 100%); color:#fff; border:none; border-radius:7px; padding:3px 13px; font-size:13px; text-decoration:none; display:inline-block; font-weight:600;">Update</a>';
                    echo '</span>';
                    echo '</div>';
                    echo '<div style="font-size:1.03rem; color:#333; margin-bottom:4px; font-family:Poppins,sans-serif;">' . nl2br(htmlspecialchars($comment['contenu_commentaire'])) . '</div>';
                    if (!empty($comment['image_commentaire'])) {
                        echo '<div style="margin-top:6px;"><img src="data:image/jpeg;base64,' . base64_encode($comment['image_commentaire']) . '" alt="Comment Image" style="max-width:90px; max-height:90px; border-radius:8px; box-shadow:0 2px 8px rgba(43,144,217,0.08);"></div>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<div style="font-size: 13px; color: #888; margin-bottom: 6px; font-family:Poppins,sans-serif;">No comments yet.</div>';
            }
            echo '</div>';
            // Add Comment Button
            echo '<a href="../gestion_comment/add_comment.php?id_blog=' . $blogId . '" class="add-comment-btn" style="margin-bottom: 10px; background: linear-gradient(90deg, #43a7ff 0%, #ff6700 100%); color: #fff; border: none; border-radius: 12px; padding: 9px 0; font-size: 1.04rem; font-weight:600; width:100%; display:block; box-shadow: 0 2px 8px rgba(255,103,0,0.10);">Add Comment</a>';
            // Comment Modal
            echo '<div id="comment-modal-' . $blogId . '" class="modal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.4);">';
            echo '<div class="modal-content" style="background:#fff; margin:10% auto; padding:20px; border:1px solid #888; width:80%; max-width:400px; border-radius: 12px;">';
            echo '<span onclick="document.getElementById(\'comment-modal-' . $blogId . '\').style.display=\'none\'" class="close" style="float:right; font-size:28px; font-weight:bold; cursor:pointer;">&times;</span>';
            echo '<form action="../gestion_comment/add_comment.php" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id_blog" value="' . $blogId . '">';
            echo '<div class="form-group">';
            echo '<label for="contenu_commentaire">Comment</label>';
            echo '<div style="position: relative;">';
            echo '<textarea name="contenu_commentaire" class="form-control" required></textarea>';
            echo '<button type="button" style="position: absolute; right: 10px; top: 10px; background: none; border: none; cursor: pointer;" title="Voice Recording">';
            echo '<i class="fa fa-microphone" style="font-size: 20px; color: #666;"></i>';
            echo '</button>';
            echo '</div>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="image_commentaire">Image (optional)</label>';
            echo '<input type="file" name="image_commentaire" accept="image/*">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-success">Submit</button>';
            echo '<button type="button" class="btn btn-secondary" onclick="document.getElementById(\'comment-modal-' . $blogId . '\').style.display=\'none\'">Cancel</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    public function countBlogsByType()
    {
        $sql = "SELECT type_blog, COUNT(*) as count FROM $this->tab_name GROUP BY type_blog";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    // --- Rating Functions ---
    public function addRating($id_blog, $rating_value) {
        $sql = "INSERT INTO ratings (id_blog, rating_value) VALUES (:id_blog, :rating_value)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_blog' => $id_blog, 'rating_value' => $rating_value]);
            return true;
        } catch (Exception $e) {
            error_log('Error adding rating: ' . $e->getMessage());
            return false;
        }
    }
    public function updateRating($rating_id, $rating_value) {
        $sql = "UPDATE ratings SET rating_value = :rating_value WHERE rating_id = :rating_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['rating_id' => $rating_id, 'rating_value' => $rating_value]);
            return true;
        } catch (Exception $e) {
            error_log('Error updating rating: ' . $e->getMessage());
            return false;
        }
    }
    public function deleteRating($rating_id) {
        $sql = "DELETE FROM ratings WHERE rating_id = :rating_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['rating_id' => $rating_id]);
            return true;
        } catch (Exception $e) {
            error_log('Error deleting rating: ' . $e->getMessage());
            return false;
        }
    }
    public function getAverageRating($id_blog) {
        $sql = "SELECT AVG(rating_value) as average, COUNT(rating_value) as count FROM ratings WHERE id_blog = :id_blog";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_blog' => $id_blog]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return [
                'average' => $result['average'] ? (float)$result['average'] : 0,
                'count' => $result['count'] ? (int)$result['count'] : 0
            ];
        } catch (Exception $e) {
            error_log('Error fetching average rating: ' . $e->getMessage());
            return ['average' => 0, 'count' => 0];
        }
    }
}

?>