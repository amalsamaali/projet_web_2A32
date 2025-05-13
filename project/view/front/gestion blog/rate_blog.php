<?php
// rate_blog.php: Handles AJAX requests for blog ratings
header('Content-Type: application/json');

include '../../../Controller/blog_con.php';

$response = ['success' => false, 'average' => 0, 'count' => 0];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blog_id']) && isset($_POST['rating'])) {
    $blog_id = intval($_POST['blog_id']);
    $rating_value = intval($_POST['rating']);
    if ($rating_value >= 1 && $rating_value <= 5) {
        $blogC = new blogCon('blog');
        $blogC->addRating($blog_id, $rating_value);
        $avg = $blogC->getAverageRating($blog_id);
        $response['success'] = true;
        $response['average'] = $avg['average'];
        $response['count'] = $avg['count'];
    }
}
echo json_encode($response);
