<!doctype html>
<html class="no-js" lang="en">
	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
		<title>Travel Blog</title>

		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--animate.css-->
		<link rel="stylesheet" href="assets/css/animate.css" />

		<!--hover.css-->
		<link rel="stylesheet" href="assets/css/hover-min.css">

		<!--datepicker.css-->
		<link rel="stylesheet"  href="assets/css/datepicker.css" >

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css"/>

		<!-- range css-->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css"/>

		<!--style.css-->
		<link rel="stylesheet" href="assets/css/style.css" />

		<!--responsive.css-->
		<link rel="stylesheet" href="assets/css/responsive.css" />

		<link rel="stylesheet" href="blog_add_model_style.css">
    </head>

<?php
include '../../../Controller/blog_con.php';

// Création d'une instance du contrôleur des événements
$blogC = new blogCon("blog");

// Récupération de la liste des événements
$blogs = $blogC->listBlogs();


// Handle rating submission
$rating_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_rating']) && isset($_POST['blog_id'])) {
    $blog_id = intval($_POST['blog_id']);
    $rating_value = intval($_POST['rating']);
    if ($rating_value >= 1 && $rating_value <= 5) {
        $blogC->addRating($blog_id, $rating_value);
        $rating_message = 'Thank you for your rating!';
    } else {
        $rating_message = 'Please select a valid rating.';
    }
}
?>


	<body style="background: url('assets/images/home/banner.jpg') no-repeat center center fixed; background-size: cover; position: relative;">
		<!-- main-menu Start -->
		<header class="top-area" style="position:fixed;top:0;left:0;width:100%;z-index:1000;background:#393e46;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
			<div class="header-area" style="background:#393e46;">
				<div class="container">
					<div class="row" style="align-items:center;">
						<div class="col-sm-2">
							<div class="logo">
								<a href="index.html" style="color:#00bfff;font-size:24px;font-weight:bold;letter-spacing:1px;">
									TRIP<span style="color:#fff;">PED</span>
								</a>
							</div>
						</div>
						<div class="col-sm-10">
							<div class="main-menu">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<i class="fa fa-bars" style="color:#fff;"></i>
									</button>
								</div>
								<div class="collapse navbar-collapse">
									<ul class="nav navbar-nav navbar-right" style="margin-top:0;">
										<li><a href="../../../../travel/view/main" style="color:#fff;">Home</a></li>
										<li class="smooth-menu"><a href="#gallery" style="color:#fff;">Transport</a></li>
										<li><a href="../../../../Projet/view/event-front.php" style="color:#fff;">Events</a></li>
										<li class="smooth-menu"><a href="#spo" style="color:#fff;">Accommodation</a></li>
										<li class="smooth-menu"><a href="blog.php" style="color:#fff;">Blog</a></li>
										<li><a href="../../../../travel/view/front/clients.php" style="color:#fff;">Subscription</a></li>
										<li>
											<button class="book-btn" style="background:#00bfff;color:#fff;border:none;padding:6px 18px;border-radius:4px;margin-left:10px;">Book Now</button>
										</li>
										<li>
											<a href="../../back/gestion blog/gestion_blog.php" class="btn btn-primary" style="background:#222e3c;color:#fff;margin-left:10px;border:none;">Go To Back Office</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="home-border" style="border-bottom:2px solid #fff;"></div>
				</div>
			</div>
		</header>
		<div style="height:90px;"></div>
		<!-- main-menu End -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->

			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="main">Home</a></li>
						</ul>
						<h1 class="white-text">Blog Page</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">


			<div id="id01" class="modal" style="display:none;">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content enhanced-modal" action="add_blog_front.php" method="post" enctype="multipart/form-data">
        <style>
            :root {
                --primary: #2b90d9;
                --primary-dark: #2176ae;
                --accent: #ff6700;
                --accent-dark: #d35400;
                --bg: #f4f6fa;
                --card-bg: #fff;
                --border: #e0e6ed;
                --text-main: #222e3c;
                --text-light: #6c7a89;
                --btn-gradient: linear-gradient(90deg, #2b90d9 0%, #ff6700 100%);
                --btn-gradient-hover: linear-gradient(90deg, #ff6700 0%, #2b90d9 100%);
            }
            body {
                background: var(--bg);
            }
            .modal {
                display: flex;
                align-items: center;
                justify-content: center;
                position: fixed;
                z-index: 9999;
                left: 0;
                top: 0;
                width: 100vw;
                height: 100vh;
                overflow: auto;
                background: rgba(34,46,60,0.18);
            }
            .modal-content.enhanced-modal {
                background: var(--card-bg);
                border-radius: 18px;
                box-shadow: 0 8px 48px rgba(34,46,60,0.13);
                padding: 36px 28px 28px 28px;
                max-width: 460px;
                width: 100%;
                margin: 0 auto;
            }
            .enhanced-modal label {
                font-weight: 600;
                color: var(--primary-dark);
                margin-top: 16px;
                font-size: 1.08rem;
                display: block;
            }
            .enhanced-modal input[type="text"], .enhanced-modal textarea, .enhanced-modal select {
                border-radius: 10px;
                border: 1.5px solid var(--border);
                padding: 12px 16px;
                font-size: 1.07rem;
                margin-top: 5px;
                margin-bottom: 18px;
                width: 100%;
                outline: none;
                transition: border 0.2s, box-shadow 0.2s;
                background: #f7f9fb;
                color: var(--text-main);
            }
            .enhanced-modal textarea:focus, .enhanced-modal input[type="text"]:focus, .enhanced-modal select:focus {
                border: 1.5px solid var(--primary);
                box-shadow: 0 2px 12px rgba(43,144,217,0.07);
            }
            .enhanced-modal input[type="file"] {
                border: none;
                margin-top: 4px;
                margin-bottom: 18px;
                background: #f7f7f7;
                border-radius: 8px;
                padding: 8px 0;
                width: 100%;
            }
            .enhanced-modal .clearfix {
                display: flex;
                gap: 18px;
                margin-top: 28px;
                justify-content: flex-end;
            }
            .enhanced-modal .cancelbtn, .enhanced-modal .deletebtn {
                padding: 12px 28px;
                border: none;
                border-radius: 8px;
                font-size: 1.08rem;
                font-weight: 600;
                cursor: pointer;
                background: var(--btn-gradient);
                color: #fff;
                transition: background 0.2s, box-shadow 0.2s;
                box-shadow: 0 2px 8px rgba(0,0,0,0.07);
                position: relative;
                overflow: hidden;
                min-width: 140px;
            }
            .enhanced-modal .cancelbtn:hover, .enhanced-modal .deletebtn:hover {
                background: var(--btn-gradient-hover);
                box-shadow: 0 8px 32px rgba(255,103,0,0.12);
            }
            .enhanced-modal .cancelbtn .btn-ripple, .enhanced-modal .deletebtn .btn-ripple {
                position: absolute;
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                background: rgba(255,255,255,0.5);
                pointer-events: none;
                width: 120%;
                height: 120%;
                left: -10%;
                top: -10%;
                z-index: 1;
            }
            @keyframes ripple {
                to { transform: scale(2.5); opacity: 0; }
            }
            @keyframes modalIn {
                0% { transform: scale(0.8) translateY(80px); opacity: 0; }
                100% { transform: scale(1) translateY(0); opacity: 1; }
            }
            .enhanced-modal h1 {
                font-family: 'Poppins',sans-serif;
                font-weight: 700;
                color: var(--primary);
                font-size: 2rem;
                margin-bottom: 8px;
                text-align: center;
            }
            .enhanced-modal p.text-muted {
                color: var(--text-light);
                margin-bottom: 18px;
                text-align: center;
            }
            .enhanced-modal hr {
                border: none;
                border-top: 1.5px solid var(--border);
                margin: 16px 0 24px 0;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 32px;
                font-weight: bold;
                margin-top: -12px;
                margin-right: -8px;
                cursor: pointer;
            }
            .close:hover { color: #222; }
        </style>
        <h1>Ajouter Un Blog</h1>
        <p class="text-muted mb-4">Remplissez le formulaire pour ajouter un nouveau blog.</p>
        <hr>
        <label for="nom">Nom</label>
        <input type="text" placeholder="Enter Nom" name="nom" id="nom" required>
        <div id="nomError" style="color: red;"></div>
        <label for="image_blog">Image</label>
        <input type="file" id="image_blog" name="image_blog" accept="image/*" class="form-input" required />
        <div id="image_blogError" style="color: red;"></div>
        <label for="type">Type</label>
        <select id="type" name="type" required>
            <option value="" selected disabled>Choose travel type</option>
            <option value="Adventure Travel">Adventure Travel</option>
            <option value="Cultural Tourism">Cultural Tourism</option>
            <option value="Beach Vacation">Beach Vacation</option>
            <option value="City Break">City Break</option>
            <option value="Eco Tourism">Eco Tourism</option>
            <option value="Luxury Travel">Luxury Travel</option>
            <option value="Road Trip">Road Trip</option>
            <option value="Backpacking">Backpacking</option>
        </select>
        <div id="typeError" style="color: red;"></div>
        <label for="description">Description</label>
        <textarea placeholder="Enter description" name="description" id="description" cols="30" rows="6" class="form-textarea" required style="resize:vertical;"></textarea>
        <div id="descriptionError" style="color: red;"></div>
        <hr>
        <div class="clearfix">
            <input type="submit" class="cancelbtn" name="addbtn" id="addbtn" value="Ajouter" onmousedown="addRipple(event,this)">
            <button type="button" class="deletebtn" onclick="document.getElementById('id01').style.display='none'" onmousedown="addRipple(event,this)">Annuler</button>
        </div>
        <script>
            // Ripple effect for buttons
            function addRipple(e, btn) {
                var ripple = document.createElement('span');
                ripple.className = 'btn-ripple';
                var rect = btn.getBoundingClientRect();
                ripple.style.left = (e.clientX - rect.left) + 'px';
                ripple.style.top = (e.clientY - rect.top) + 'px';
                btn.appendChild(ripple);
                setTimeout(function(){ ripple.remove(); }, 700);
            }
        </script>
    </form>
</div>

			</div>
			

			<!-- container -->
			<div class="container">

				<button type="button" onclick="document.getElementById('id01').style.display='block'" class="btn btn-animated btn-warning w-100 my-4 mb-2 d-md-none" id="addbtn">
    <span>Ajout +</span>
    <span class="btn-ripple"></span>
</button>

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-12" style="display: flex; flex-direction: column; align-items: center; width: 100%; padding: 0;">

    <!-- generate blogs -->
    <div id="blog-list" style="width: 100%; display: flex; flex-direction: column; align-items: center; gap: 0;">
        <?php $blogC->generateBlogs($blogs);?>
    </div>
<!-- Add a floating action button for adding a blog on larger screens -->
<button onclick="document.getElementById('id01').style.display='block'" class="fab-add-blog btn-animated d-none d-md-block" title="Add Blog">
    <i class="fa fa-plus"></i>
    <span class="btn-ripple"></span>
</button>
<style>
:root {
    --primary: #2b90d9;
    --primary-dark: #2176ae;
    --accent: #ff6700;
    --accent-dark: #d35400;
    --bg: #f7f9fb;
    --card-bg: #fff;
    --border: #e0e6ed;
    --text-main: #222e3c;
    --text-light: #6c7a89;
    --shadow: 0 4px 24px rgba(34,46,60,0.10);
    --shadow-hover: 0 12px 40px rgba(34,46,60,0.18);
    --radius: 16px;
    --transition: .25s cubic-bezier(.4,2,.6,1);
    --btn-gradient: linear-gradient(90deg, #2b90d9 0%, #ff6700 100%);
    --btn-gradient-hover: linear-gradient(90deg, #ff6700 0%, #2b90d9 100%);
    --btn-glow: 0 0 12px 2px rgba(255,103,0,0.16);
}

/* Animated Button Styles */
.btn-animated {
    position: relative;
    overflow: hidden;
    background: var(--btn-gradient);
    color: #fff;
    border: none;
    outline: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-shadow: 0 6px 24px rgba(0,0,0,0.16);
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
}
.fab-add-blog:hover {
    background: #e65c00;
    box-shadow: 0 8px 32px rgba(0,0,0,0.28);
}
@media (max-width: 991px) {
    .fab-add-blog { display: none !important; }
}
</style>
				

</div>

  <style>
    .enhanced-comments .comment-card {
      background: var(--card-bg);
      border-radius: 18px;
      box-shadow: var(--shadow);
      padding: 24px 28px 18px 28px;
      border: 1.5px solid #e0e6ed;
      margin-bottom: 0;
      animation: fadeInUp 0.5s cubic-bezier(.4,2,.6,1) both;
      display: flex;
      flex-direction: column;
      gap: 10px;
      transition: box-shadow 0.2s;
    }
    .enhanced-comments .comment-card:hover {
      box-shadow: var(--shadow-hover);
    }
    .enhanced-comments .comment-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 8px;
    }
    .enhanced-comments .avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--primary);
      color: #fff;
      font-weight: 700;
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 10px rgba(43,144,217,0.12);
      border: 2.5px solid #fff;
    }
    .enhanced-comments .comment-meta {
      display: flex;
      flex-direction: column;
    }
    .enhanced-comments .comment-author {
      font-family: 'Poppins', sans-serif;
      font-size: 1.08rem;
      font-weight: 600;
      color: var(--primary-dark);
      margin-bottom: 2px;
    }
    .enhanced-comments .comment-date {
      font-size: 0.98rem;
      color: var(--text-light);
      font-weight: 400;
    }
    .enhanced-comments .comment-body {
      font-size: 1.08rem;
      color: var(--text-main);
      margin-bottom: 6px;
      font-family: 'Poppins', sans-serif;
      word-break: break-word;
    }
    .enhanced-comments .comment-image {
      margin: 10px 0 0 0;
      max-width: 120px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(43,144,217,0.08);
      border: 1.5px solid #e0e6ed;
      display: block;
    }
    .enhanced-comments .comment-actions {
      display: flex;
      gap: 10px;
      margin-top: 4px;
    }
    .enhanced-comments .comment-btn {
      background: var(--btn-gradient);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 0.98rem;
      font-weight: 600;
      padding: 7px 18px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px rgba(255,103,0,0.10);
      outline: none;
    }
    .enhanced-comments .comment-btn.update {
      background: var(--btn-gradient);
    }
    .enhanced-comments .comment-btn.delete {
      background: linear-gradient(90deg, #ff5252 0%, #ff6700 100%);
    }
    .enhanced-comments .comment-btn:hover {
      background: var(--btn-gradient-hover);
      box-shadow: var(--btn-glow);
    }
    .enhanced-comments .comment-btn .btn-ripple {
      position: absolute;
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.6s linear;
      background: rgba(255,255,255,0.5);
      pointer-events: none;
      width: 120%;
      height: 120%;
      left: -10%;
      top: -10%;
      z-index: 1;
    }
    .enhanced-comments .comment-rating {
      margin-top: 6px;
      color: #FFD700;
      font-size: 1.18rem;
      letter-spacing: 1.5px;
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
    }
    .enhanced-comments .add-comment-btn {
      width: 100%;
      margin-top: 18px;
      background: var(--btn-gradient);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-size: 1.09rem;
      font-weight: 600;
      padding: 13px 0;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px rgba(255,103,0,0.10);
      outline: none;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .enhanced-comments .add-comment-btn:hover {
      background: var(--btn-gradient-hover);
      box-shadow: var(--btn-glow);
    }
    .enhanced-comments .add-comment-btn .btn-ripple {
      position: absolute;
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.6s linear;
      background: rgba(255,255,255,0.5);
      pointer-events: none;
      width: 120%;
      height: 120%;
      left: -10%;
      top: -10%;
      z-index: 1;
    }
    .enhanced-comments .no-comments {
      color: var(--text-light);
      font-size: 1.03rem;
      font-family: 'Poppins', sans-serif;
      text-align: center;
      margin: 18px 0 0 0;
      font-weight: 500;
    }
    @media (max-width: 600px) {
      .enhanced-comments .comment-card { padding: 14px 4px; }
      .enhanced-comments .add-comment-btn { padding: 11px 0; font-size: 1rem; }
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes ripple {
      to { transform: scale(2.5); opacity: 0; }
    }
  </style>
  <script>
    // Ripple effect for comment button
    document.addEventListener('DOMContentLoaded', function() {
      var commentBtn = document.querySelector('#comment-form .btn-animated');
      if(commentBtn) {
        commentBtn.addEventListener('click', function(e) {
          var ripple = document.createElement('span');
          ripple.className = 'btn-ripple';
          var rect = commentBtn.getBoundingClientRect();
          ripple.style.left = (e.clientX - rect.left) + 'px';
          ripple.style.top = (e.clientY - rect.top) + 'px';
          commentBtn.appendChild(ripple);
          setTimeout(function(){ ripple.remove(); }, 700);
        });
      }
      // Comment form submit (demo only)
      var commentForm = document.getElementById('comment-form');
      if(commentForm){
        commentForm.addEventListener('submit', function(e){
          e.preventDefault();
          document.getElementById('comment-success').style.display = 'block';
          commentForm.reset();
          setTimeout(function(){ document.getElementById('comment-success').style.display = 'none'; }, 2500);
        });
      }
    });
  </script>
</div>
<!-- COMMENT SECTION END -->
						
						
						<!-- /row -->
					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

					

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->




		<!-- footer-copyright start -->
		<footer  class="footer-copyright">
			<div class="container">
				<div class="footer-content">
					<div class="row">
						<div class="col-sm-3">
							<div class="single-footer-item">
								<div class="footer-logo">
									<a href="index.html">
										TRIP<span>PED</span>
									</a>
									<p>
										best travel agency
									</p>
								</div>
							</div><!--/.single-footer-item-->
						</div><!--/.col-->

						<div class="col-sm-3">
							<div class="single-footer-item">
								<h2>link</h2>
								<div class="single-footer-txt">
									<p><a href="#">home</a></p>
									<p><a href="#">Transport</a></p>
									<p><a href="#">Tours</a></p>
									<p><a href="#">Accommodation</a></p>
									<p><a href="#">Blog</a></p>
									<p><a href="#">contacts</a></p>
								</div><!--/.single-footer-txt-->
							</div><!--/.single-footer-item-->
						</div><!--/.col-->

						<div class="col-sm-3">
							<div class="single-footer-item">
								<h2>popular destination</h2>
								<div class="single-footer-txt">
									<p><a href="#">china</a></p>
									<p><a href="#">venezuela</a></p>
									<p><a href="#">brazil</a></p>
									<p><a href="#">australia</a></p>
									<p><a href="#">london</a></p>
								</div><!--/.single-footer-txt-->
							</div><!--/.single-footer-item-->
						</div><!--/.col-->

						<div class="col-sm-3">
							<div class="single-footer-item text-center">
								<h2 class="text-left">contacts</h2>
								<div class="single-footer-txt text-left">
									<p>+216 71 234 567 </p>
									<p class="foot-email"><a href="#"> contact@tripped.com </a></p>
									<p>North Warnner Park 336/A</p>
									<p>Newyork, USA</p>
								</div><!--/.single-footer-txt-->
							</div><!--/.single-footer-item-->
						</div><!--/.col-->

					</div><!--/.row-->

				</div><!--/.footer-content-->
				<hr>
				<div class="foot-icons ">
					<ul class="footer-social-links list-inline list-unstyled">
		                <li><a href="#" target="_blank" class="foot-icon-bg-1"><i class="fa fa-facebook"></i></a></li>
		                <li><a href="#" target="_blank" class="foot-icon-bg-2"><i class="fa fa-twitter"></i></a></li>
		                <li><a href="#" target="_blank" class="foot-icon-bg-3"><i class="fa fa-instagram"></i></a></li>
		        	</ul>
		        	<p>&copy; 2017 <a href="https://www.themesine.com">ThemeSINE</a>. All Right Reserved</p>

		        </div><!--/.foot-icons-->
				<div id="scroll-Top">
					<i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div><!--/.scroll-Top-->
			</div><!-- /.container-->

		</footer><!-- /.footer-copyright-->
		<!-- footer-copyright end -->

		<script src="assets/js/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->

		<!--modernizr.min.js-->
		<script  src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

		<!--bootstrap.min.js-->
		<script  src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!-- jquery.filterizr.min.js -->
		<script src="assets/js/jquery.filterizr.min.js"></script>

		<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

		<!--jquery-ui.min.js-->
        <script src="assets/js/jquery-ui.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

		<!--owl.carousel.js-->
        <script  src="assets/js/owl.carousel.min.js"></script>

        <!-- jquery.sticky.js -->
		<script src="assets/js/jquery.sticky.js"></script>

        <!--datepicker.js-->
        <script  src="assets/js/datepicker.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>

		<!-- Blog specific JS -->
		<script src="../../../js/blogs/blog_js.js"></script>

		<!-- Comment validation JS -->
		<script src="../../../js/comments/comment_js.js"></script>

	</body>
<script src="gemini-chatbot.js"></script>
<script>
document.getElementById('open-chatbot-btn').onclick = function() {
  // Show chatbot box if hidden, or focus input
  var chatbot = document.getElementById('gemini-chatbot-container');
  if (chatbot) {
    chatbot.style.display = 'flex';
    var input = chatbot.querySelector('input[type="text"]');
    if(input) input.focus();
.enhanced-modal {
    border-radius: var(--radius) !important;
    box-shadow: 0 8px 48px rgba(34,46,60,0.13) !important;
    padding: 32px 32px 24px 32px !important;
    max-width: 500px;
    margin: 0 auto;
    background: var(--card-bg) !important;
    animation: modalIn .4s cubic-bezier(.4,2,.6,1) both;
    background: #fff !important;
    animation: modalIn 0.4s cubic-bezier(.4,2,.6,1) both;
}
@keyframes modalIn {
    0% { transform: scale(0.8) translateY(80px); opacity: 0; }
    100% { transform: scale(1) translateY(0); opacity: 1; }
}
.enhanced-modal .modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}
.enhanced-modal .close {
    font-size: 2rem;
    color: #ff6700;
    cursor: pointer;
    font-weight: bold;
    opacity: 0.7;
    transition: opacity 0.2s;
}
.enhanced-modal .close:hover {
    opacity: 1;
}
.enhanced-modal label {
    font-weight: 600;
    color: #393e46;
    margin-top: 16px;
}
.enhanced-modal input[type="text"], .enhanced-modal textarea, .enhanced-modal select {
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    padding: 10px 14px;
    font-size: 1rem;
    margin-top: 4px;
    margin-bottom: 6px;
    width: 100%;
    outline: none;
    transition: border 0.2s;
}
.enhanced-modal input[type="text"]:focus, .enhanced-modal textarea:focus, .enhanced-modal select:focus {
    border: 1.5px solid #00bfff;
}
.enhanced-modal input[type="file"] {
    border: none;
    margin-top: 4px;
    margin-bottom: 6px;
    background: #f7f7f7;
    border-radius: 8px;
    padding: 8px 0;
}
.enhanced-modal .clearfix {
    display: flex;
    gap: 12px;
    margin-top: 20px;
    justify-content: flex-end;
}
.enhanced-modal .cancelbtn, .enhanced-modal .deletebtn {
    padding: 10px 24px;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    background: #ff6700;
    color: #fff;
    transition: background 0.2s;
}
.enhanced-modal .cancelbtn:hover, .enhanced-modal .deletebtn:hover {
    background: #e65c00;
}

/* Blog cards enhancements */
#blog-list .single-blog {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    margin-bottom: 32px;
    padding: 0;
    overflow: hidden;
    transition: box-shadow 0.3s, transform 0.2s;
    display: flex;
    flex-direction: column;
    min-height: 420px;
    border: 1.5px solid #f2f2f2;
    position: relative;
}
#blog-list .single-blog:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.18);
    transform: translateY(-6px) scale(1.02);
    border-color: #ff6700;
}
#blog-list .blog-img {
    width: 100%;
    height: 220px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f7f7f7;
    border-bottom: 1.5px solid #f2f2f2;
}
#blog-list .blog-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(.4,2,.6,1);
}
#blog-list .single-blog:hover .blog-img img {
    transform: scale(1.08) rotate(-1deg);
}
#blog-list h4 {
    font-size: 1.4rem;
    font-weight: 700;
    margin: 20px 20px 8px 20px;
    color: #222;
    letter-spacing: 0.5px;
}
#blog-list p {
    margin: 0 20px 20px 20px;
    color: #555;
    font-size: 1.05rem;
    min-height: 60px;
}
#blog-list .blog-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0 20px 20px 20px;
    font-size: 0.97rem;
    color: #888;
}
#blog-list .blog-meta-author a {
    color: #ff6700;
    font-weight: 600;
}
#blog-list .btn.btn-primary {
    background: #ff6700;
    border: none;
    margin: 0 20px 20px 20px;
    border-radius: 8px;
    padding: 10px 22px;
    font-size: 1.05rem;
    font-weight: 600;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
}
#blog-list .btn.btn-primary:hover {
    background: #e65c00;
    transform: translateY(-2px) scale(1.03);
}
@media (max-width: 991px) {
    #main.col-md-9 {
        width: 100%;
        max-width: 100%;
    }
    #blog-list .single-blog {
        min-height: 340px;
    }
}
</style>
