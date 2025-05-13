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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../../back assets/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../../back assets/assets/img/favicon.png">
  <title>Soft UI Dashboard by Creative Tim</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="../../../back assets/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../../back assets/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../../back assets/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="../../../back assets/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/86ecaa3fdb.js" crossorigin="anonymous"></script>
</head>
<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="../../../back assets/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Soft UI Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../../../view/back/gestion blog/gestion_blog.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-blog text-dark"></i>
            </div>
            <span class="nav-link-text ms-1">Blogs</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../view/back/gestion publication/gestion_publication.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-newspaper text-dark"></i>
            </div>
            <span class="nav-link-text ms-1">Publications</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../../../view/back/gestion comment/gestion_comment.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-comments text-dark"></i>
            </div>
            <span class="nav-link-text ms-1">Comments</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Update Comment</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Update Comment</h6>
        </nav>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <form class="modal-content" id="commentForm" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_blog" value="<?php echo htmlspecialchars($comment_data['id_blog'] ?? ''); ?>">
        <label for="contenu_commentaire"><b>Content</b></label>
        <textarea name="contenu_commentaire" id="contenu_commentaire" cols="30" rows="5"><?php echo htmlspecialchars($comment_data['contenu_commentaire'] ?? ''); ?></textarea>
        <div id="contenu_commentaireError" style="color:red;"></div>
        <label for="image_commentaire"><b>Image</b></label>
        <input type="file" id="image_commentaire" name="image_commentaire" accept="image/*" class="form-input" />
        <div id="image_commentaireError" style="color:red;"></div>
        <?php if (!empty($comment_data['image_commentaire'])): ?>
            <div><img src="data:image/jpeg;base64,<?php echo base64_encode($comment_data['image_commentaire']); ?>" alt="Current Image" style="max-width:100px;max-height:100px;" /></div>
        <?php endif; ?>
        <div class="clearfix">
          <input type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2" name="updatebtn" id="updatebtn" value="Update Comment">
          <button type="button" class="btn btn-secondary w-100 mb-2" onclick="window.location.href='gestion_comment.php'">Cancel</button>
        </div>
        <?php if (!empty($error)): ?>
            <div style="color:red;"> <?php echo $error; ?> </div>
        <?php endif; ?>
      </form>
    </div>
  </main>
  <script src="../../../back assets/assets/js/core/popper.min.js"></script>
  <script src="../../../back assets/assets/js/core/bootstrap.min.js"></script>
  <script src="../../../back assets/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../../back assets/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script src="../../../back assets/assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  <script src="../../../js/comments/comment_js.js"></script>
</body>
</html>