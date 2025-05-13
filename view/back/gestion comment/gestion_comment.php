<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../../back assets/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../../back assets/assets/img/favicon.png">
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../../back assets/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../../back assets/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../../back assets/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../../back assets/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/86ecaa3fdb.js" crossorigin="anonymous"></script>
</head>

<?php
include '../../../Controller/comment_con.php';
include '../../../Model/comment.php';

// Create an instance of the comment controller
$commentC = new commentCon("commentaire");

// Get list of comments
$comments = $commentC->listComments();


?>

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
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Comments</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Comments Management</h6>
        </nav>
      </div>
    </nav>

   

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Comments Table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Blog ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Content</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($comments as $comment) {
                    ?>
                      <tr>
                        <td class="ps-4">
                          <p class="text-sm font-weight-bold mb-0"><?= $comment['id_commentaire']; ?></p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0"><?= $comment['id_blog']; ?></p>
                        </td>
                        <td class="text-center">
                          <p class="text-sm font-weight-bold mb-0"><?= $comment['contenu_commentaire']; ?></p>
                        </td>
                        <td class="text-center">
                          <p class="text-sm font-weight-bold mb-0"><?= $comment['date_commentaire']; ?></p>
                        </td>
                        <td class="text-center">
                          <a href="update_comment.php?id=<?= $comment['id_commentaire']; ?>" class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-edit text-xs"></i>
                          </a>
                          <a href="delete_comment.php?id=<?= $comment['id_commentaire']; ?>" class="btn btn-link text-secondary mb-0">
                            <i class="fa fa-trash text-xs"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
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
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../../back assets/assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>