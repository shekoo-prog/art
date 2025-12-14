<?php
header('Content-Type: application/json');

require_once '../classes/Comment.php';

if (isset($_GET['poem_id'])) {
    $poemId = intval($_GET['poem_id']);
    $commentObj = new Comment();
    $comments = $commentObj->getComments($poemId);
    $html = '';
    foreach ($comments as $comment) {
        $html .= '<div class="comment"><p>' . htmlspecialchars($comment['comment']) . '</p><small>' . $comment['created_at'] . '</small></div>';
    }
    echo json_encode(['html' => $html]);
} else {
    echo json_encode(['html' => '']);
}
?>
