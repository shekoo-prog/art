<?php
header('Content-Type: application/json');

require_once '../classes/Comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['poem_id'], $_POST['comment'])) {
    $poemId = intval($_POST['poem_id']);
    $comment = trim($_POST['comment']);

    if (empty($comment)) {
        echo json_encode(['success' => false, 'message' => 'التعليق فارغ']);
        exit;
    }

    $commentObj = new Comment();
    if ($commentObj->addComment($poemId, $comment)) {
        echo json_encode([
            'success' => true,
            'comment' => htmlspecialchars($comment),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'فشل في إضافة التعليق']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'طلب غير صالح']);
}
?>
