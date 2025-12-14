<?php
// Basic index page - public view of poems
require_once '../config/database.php';
require_once '../classes/Poem.php';
require_once '../classes/Comment.php';
require_once '../classes/Like.php';

$poemObj = new Poem();
$commentObj = new Comment();
$poems = $poemObj->getAllPoems();

include __DIR__ . '/partials/header.php';
?>

<section class="container py-4">
    <h2 class="section-title">أشهر القصائد</h2>

    <div class="row g-4">
        <?php foreach ($poems as $poem): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <h3 class="card-title">
                                <?php echo htmlspecialchars($poem['title']); ?>
                            </h3>
                            <small class="card-date">
                                <?php echo date('d/m/Y', strtotime($poem['created_at'])); ?>
                            </small>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            <?php echo htmlspecialchars(mb_substr($poem['content'], 0, 150))
                                . (mb_strlen($poem['content']) > 150 ? '...' : ''); ?>
                        </p>
                    </div>

                    <div class="card-footer">
                        <!-- استخدام Grid لتنسيق الأزرار -->
                        <div class="actions-grid">
                            <button class="action-btn like-btn" data-id="<?php echo $poem['id']; ?>">
                                <i class="far fa-heart"></i>
                                <span class="btn-text">إعجاب</span>
                                <span class="badge bg-danger rounded-pill likes-count">
                                    <?php echo $poemObj->getLikesCount($poem['id']); ?>
                                </span>
                            </button>

                            <button class="action-btn comment-btn" data-id="<?php echo $poem['id']; ?>"
                                data-bs-toggle="modal" data-bs-target="#commentModal">
                                <i class="far fa-comment"></i>
                                <span class="btn-text">تعليق</span>
                                <span class="badge bg-primary rounded-pill comments-count">
                                    <?php echo $commentObj->getCommentsCount($poem['id']); ?>
                                </span>
                            </button>

                            <button class="action-btn share-btn">
                                <i class="fas fa-share-alt"></i>
                                <span class="btn-text">مشاركة</span>
                            </button>

                            <a href="view_poem.php?id=<?php echo $poem['id']; ?>" class="view-btn">
                                <i class="far fa-eye"></i>
                                <span class="btn-text">مشاهدة القصيدة</span>
                                <span class="badge bg-light text-dark rounded-pill">
                                    <?php echo $poem['views'] ?? 0; ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">التعليقات على القصيدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="comments-list-modal mb-3">
                    <div class="comment-item">
                        <div class="comment-author">محمد أحمد</div>
                        <div class="comment-text">قصيدة رائعة تعبر عن مشاعر عميقة</div>
                    </div>
                    <div class="comment-item">
                        <div class="comment-author">فاطمة حسن</div>
                        <div class="comment-text">أعجبتني الصور البلاغية المستخدمة في القصيدة</div>
                    </div>
                </div>

                <form class="add-comment-form-modal">
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="أضف تعليقاً..." required rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">نشر التعليق</button>
                </form>

            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="js/theme.js"></script>
<script src="js/ajax.js"></script>

<script>
    // Like button functionality
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function() {
            const poemId = this.getAttribute('data-id');
            const likeCount = this.querySelector('.likes-count');

            // Toggle active state
            this.classList.toggle('active');
            this.querySelector('i').classList.toggle('far');
            this.querySelector('i').classList.toggle('fas');

            // Update like count
            let currentCount = parseInt(likeCount.textContent);
            if (this.classList.contains('active')) {
                likeCount.textContent = currentCount + 1;
            } else {
                likeCount.textContent = currentCount - 1;
            }

            // Here you would typically send an AJAX request to update the like in the database
            console.log('Like toggled for poem ID:', poemId);
        });
    });
</script>

</body>

</html>