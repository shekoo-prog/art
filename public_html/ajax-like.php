<?php
header('Content-Type: application/json');

require_once '../classes/Poem.php';
require_once '../classes/Like.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['poem_id'])) {
    $poemId = intval($_POST['poem_id']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $likeObj = new Like();
    $poemObj = new Poem();

    if ($likeObj->hasLiked($poemId, $ip)) {
        // Remove like
        $likeObj->removeLike($poemId, $ip);
    } else {
        // Add like
        $likeObj->addLike($poemId, $ip);
    }

    $likes = $poemObj->getLikesCount($poemId);

    echo json_encode([
        'success' => true,
        'likes' => $likes
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'طلب غير صالح']);
}
?>
