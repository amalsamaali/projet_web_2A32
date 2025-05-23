<?php
include '../../../Controller/blog_con.php';
include '../../../Model/blog.php';

// Création d'une instance du contrôleur des événements
$blogC = new blogCon("blog");

// Création d'une instance de la classe Event
$blog = null;

if (isset($_GET['id'])){
    $current_id = $_GET['id'];
}

if (
  isset($_POST["nom"]) &&
  isset($_POST["type"]) &&
  isset($_POST["description"])
) {
    if (
      !empty($_POST['nom']) &&
      !empty($_POST["type"]) &&
      !empty($_POST["description"])
    ) {
       
        // Check if blog image is uploaded
        if (!empty($_FILES['image_blog']['name']) && $_FILES['image_blog']['error'] === 0) {
            // Get profile photo and cover data
            $image_blog_tmp_name = $_FILES['image_blog']['tmp_name'];
            $image_blog_data = file_get_contents($image_blog_tmp_name);

            // get current date
            $currentDate = date("Y-m-d");

            $blog = new Blog(
                $current_id,
                $image_blog_data,
                $_POST['nom'],
                $_POST['type'],
                $_POST['description'],
                $currentDate
            );

            $blogC->updateBlog($blog, $current_id);
            header('Location: ./gestion_blog.php');
        }
        else{
            // get current date
            $currentDate = date("Y-m-d");

            $blog = new Blog(
                $current_id,
                '',
                $_POST['nom'],
                $_POST['type'],
                $_POST['description'],
                $currentDate
            );

            $blogC->updateBlogWithoutImg($blog, $current_id);
            header('Location: ./gestion_blog.php');
        }
    } else {
        $error = "Missing information";
    }
}

?>