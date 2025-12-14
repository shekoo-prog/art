<?php
require_once '../config/database.php';
require_once '../classes/Poem.php';
require_once '../classes/Comment.php';
require_once '../classes/Like.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$poemObj = new Poem();
$commentObj = new Comment();
$id = $_GET['id'];

// Increment views
$poemObj->incrementViews($id);

// Get poem details
$poem = $poemObj->getPoem($id);

if (!$poem) {
    header('Location: index.php');
    exit;
}

include __DIR__  .'/partials/header.php';
?>

<style>
    .poem-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 60px 0;
    }
    
    .poem-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .poem-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .poem-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .poem-title {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }
    
    .poem-meta {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        position: relative;
        z-index: 1;
    }
    
    .poem-meta i {
        margin: 0 8px;
    }
    
    .poem-content {
        padding: 50px 40px;
        font-size: 1.4rem;
        line-height: 2.2;
        color: #2d3748;
        font-family: 'Amiri', 'Times New Roman', serif;
        white-space: pre-line;
        text-align: center;
        background: linear-gradient(to bottom, #f7fafc 0%, #ffffff 100%);
    }
    
    .poem-actions {
        padding: 30px 40px;
        background: #f8f9fa;
        border-top: 2px solid #e9ecef;
    }
    
    .action-btn {
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .action-btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .action-btn i {
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }
    
    .action-btn:hover i {
        transform: scale(1.2);
    }
    
    .like-btn {
        border-color: #dc3545;
        color: #dc3545;
    }
    
    .like-btn:hover {
        background: #dc3545;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
    }
    
    .comment-btn {
        border-color: #0d6efd;
        color: #0d6efd;
    }
    
    .comment-btn:hover {
        background: #0d6efd;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
    }
    
    .share-btn {
        border-color: #6c757d;
        color: #6c757d;
    }
    
    .share-btn:hover {
        background: #6c757d;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
    }
    
    .badge-count {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-right: 5px;
    }
    
    .back-btn {
        margin-top: 30px;
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.9);
        color: #667eea;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .back-btn:hover {
        background: #ffffff;
        color: #764ba2;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .comments-section {
        padding: 40px;
        background: #ffffff;
    }
    
    .comments-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: inline-block;
    }
    
    .comment-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 15px;
        border-right: 4px solid #667eea;
        transition: all 0.3s ease;
    }
    
    .comment-item:hover {
        background: #e9ecef;
        transform: translateX(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .comment-author {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 8px;
    }
    
    .comment-text {
        color: #4a5568;
        line-height: 1.6;
    }
    
    .comment-date {
        font-size: 0.85rem;
        color: #a0aec0;
        margin-top: 8px;
    }
    
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        border: none;
        padding: 20px 30px;
    }
    
    .modal-title {
        font-weight: 700;
        font-size: 1.5rem;
    }
    
    .modal-body {
        padding: 30px;
    }
    
    .form-control {
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
</style>

<div class="poem-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <!-- Poem Card -->
                <div class="poem-card">
                    <!-- Header Section -->
                    <div class="poem-header">
                        <h1 class="poem-title">
                            <i class="fas fa-feather-alt me-3"></i>
                            <?php echo htmlspecialchars($poem['title']); ?>
                        </h1>
                        <div class="poem-meta">
                            <span>
                                <i class="far fa-calendar-alt"></i>
                                <?php echo date('d/m/Y', strtotime($poem['created_at'])); ?>
                            </span>
                            <span class="mx-3">|</span>
                            <span>
                                <i class="far fa-eye"></i>
                                <?php echo $poem['views'] ?? 0; ?> مشاهدة
                            </span>
                        </div>
                    </div>

                    <!-- Poem Content -->
                    <div class="poem-content">
                        <?php echo htmlspecialchars($poem['content']); ?>
                    </div>

                    <!-- Actions Section -->
                    <div class="poem-actions">
                        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                            <button class="action-btn like-btn" data-id="<?php echo $poem['id']; ?>">
                                <i class="far fa-heart"></i>
                                <span>إعجاب</span>
                                <span class="badge bg-danger badge-count likes-count">
                                    <?php echo $poemObj->getLikesCount($poem['id']); ?>
                                </span>
                            </button>
                            
                            <button class="action-btn comment-btn" data-bs-toggle="modal" data-bs-target="#commentModal">
                                <i class="far fa-comment-dots"></i>
                                <span>تعليق</span>
                                <span class="badge bg-primary badge-count comments-count">
                                    <?php echo $commentObj->getCommentsCount($poem['id']); ?>
                                </span>
                            </button>
                            
                            <button class="action-btn share-btn text-light">
                              <i class="fas fa-share-nodes"></i>
                                <span>مشاركة</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center">
                    <a href="index.php" class="back-btn">
                        <i class="fas fa-arrow-right"></i>
                        <span>العودة للرئيسية</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">
                    <i class="far fa-comments me-2"></i>
                    التعليقات
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Comments List -->
                <div class="comments-list-modal mb-4" style="max-height: 400px; overflow-y: auto;">
                    <div class="text-center text-muted py-4">
                        <i class="far fa-comment-dots fa-3x mb-3"></i>
                        <p>جاري تحميل التعليقات...</p>
                    </div>
                </div>
                
                <!-- Add Comment Form -->
                <form class="add-comment-form-modal">
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-pen me-2"></i>
                            أضف تعليقك
                        </label>
                        <textarea class="form-control" placeholder="شاركنا رأيك في هذه القصيدة..." required rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane me-2"></i>
                        نشر التعليق
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/ajax.js"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>