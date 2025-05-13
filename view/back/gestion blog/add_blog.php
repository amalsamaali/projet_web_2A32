<?php 
include '../../../Controller/blog_con.php'; 
include '../../../Model/blog.php';  

$blogC = new blogCon("blog");  
$blog = null;  

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
        $image_blog_tmp_name = $_FILES['image_blog']['tmp_name'];
        $image_blog_data = file_get_contents($image_blog_tmp_name);

        $currentDate = date("Y-m-d");

        $blog = new Blog(
            '',
            $image_blog_data,
            $_POST['nom'],
            $_POST['type'],
            $_POST['description'],
            $currentDate
        );

        $blogC->addBlog($blog);
        header('Location: ./gestion_blog.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" href="tableau-de-bord.css">

    <style>
        /* Container styling */
        .container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Form title */
        .top-content h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        /* Form group spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }

        /* Input and select styling */
        .form-control,
        .form-control-file,
        select,
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        /* Focus state */
        .form-control:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Labels */
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        /* Submit button styling */
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Error message */
        #typeError {
            font-size: 0.875rem;
            margin-top: 0.25rem;
            color: red;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }

            .top-content h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="logo">tripped</div>
        <a href="dashboard.html">Dashboard</a>
        <a href="gestion_blog.php" class="active">Blogs</a>
        <a href="virtual-reality.html">Virtual Reality</a>
        <a href="rtl.html">RTL</a>
        <a href="profile.html">Profile</a>
        <a href="sign-in.html">Sign In</a>
        <a href="sign-up.html">Sign Up</a>
        <div class="logout">Logout</div>
    </aside>

    <div class="content">
        <div class="top-content">
            <h1>Add New Blog</h1>
            <input type="text" class="search" placeholder="Search...">
            <div class="user-info">
                <i class="fas fa-user"></i>
                <span>John Doe</span>
            </div>
        </div>

        <div class="container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Blog Name</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="type">Blog Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="" selected disabled>Choose Type</option>
                        <option value="adventure">Adventure Travel</option>
                        <option value="cultural">Cultural Tourism</option>
                        <option value="beach">Beach Vacation</option>
                        <option value="city">City Break</option>
                        <option value="eco">Eco Tourism</option>
                        <option value="luxury">Luxury Travel</option>
                        <option value="road">Road Trip</option>
                        <option value="backpacking">Backpacking</option>
                    </select>
                    <div id="typeError"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image_blog">Blog Image</label>
                    <input type="file" class="form-control-file" id="image_blog" name="image_blog" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Blog</button>
            </form>
        </div>
    </div>
</body>
</html>
