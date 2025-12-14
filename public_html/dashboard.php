<?php
session_start();

require_once '../classes/Poem.php';
require_once '../classes/Comment.php';
require_once '../classes/Like.php';
require_once '../classes/Biography.php';

$poemObj = new Poem();
$commentObj = new Comment();
$likeObj = new Like();
$bioObj = new Biography();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['add_poem'])) {
    $poemObj->addPoem($_POST['title'], $_POST['content']);
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['edit_poem'])) {
    $poemObj->updatePoem($_POST['id'], $_POST['title'], $_POST['content']);
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['delete_poem'])) {
    $poemObj->deletePoem($_POST['id']);
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['update_biography'])) {
    foreach ($_POST['biography'] as $section => $content) {
        $bioObj->updateSection($section, $content);
    }
    header('Location: dashboard.php#biography');
    exit;
}

$poems = $poemObj->getAllPoems();

// حساب الإحصائيات
$totalPoems = count($poems);
$totalLikes = 0;
$totalComments = 0;

foreach ($poems as $poem) {
    $totalLikes += $poemObj->getLikesCount($poem['id']);
    $totalComments += $commentObj->getCommentsCount($poem['id']);
}

// حساب متوسط التفاعل
$avgEngagement = $totalPoems > 0 ? round(($totalLikes + $totalComments) / $totalPoems, 1) : 0;
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - ديوان الشعر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="assets/favicon.svg" type="image/svg+xml">
    <script defer src="js/theme.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
        }

        .nav-link {
            color: rgba(255, 255, 255, .75);
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
        }

        @media (min-width: 768px) {
            #sidebarMenu {
                position: static !important;
                height: auto !important;
                width: auto !important;
                visibility: visible !important;
                transform: none !important;
                display: block !important;
            }
        }
    </style>
</head>

<body class="bg-light">

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">لوحة التحكم</a>
        <button class="navbar-toggler position-relative d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="عرض القائمة">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="offcanvas offcanvas-start d-md-block bg-dark sidebar" tabindex="-1">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#overview">
                                <i class="fas fa-chart-line me-2"></i>
                                نظرة عامة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#poems">
                                <i class="fas fa-book me-2"></i>
                                القصائد
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#biography">
                                <i class="fas fa-user-edit me-2"></i>
                                السيرة الذاتية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-home me-2"></i>
                                العودة للموقع
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                تسجيل الخروج
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>المستخدم</span>
                    </h6>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">لوحة التحكم</h1>
                </div>

                <!-- Overview Section -->
                <div id="overview" class="mb-5">
                    <h2 class="mb-4">إحصائيات</h2>
                    <!-- Stats Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="card text-white bg-primary h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-0">إجمالي القصائد</h6>
                                            <h2 class="mt-2 mb-0"><?php echo $totalPoems; ?></h2>
                                        </div>
                                        <i class="fas fa-book fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-success h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-0">إجمالي الإعجابات</h6>
                                            <h2 class="mt-2 mb-0"><?php echo $totalLikes; ?></h2>
                                        </div>
                                        <i class="fas fa-heart fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-info h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-0">إجمالي التعليقات</h6>
                                            <h2 class="mt-2 mb-0"><?php echo $totalComments; ?></h2>
                                        </div>
                                        <i class="fas fa-comments fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-white bg-warning h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-0">متوسط التفاعل</h6>
                                            <h2 class="mt-2 mb-0"><?php echo $avgEngagement; ?></h2>
                                        </div>
                                        <i class="fas fa-chart-bar fa-2x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Poems Management Section -->
                <div id="poems" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>إدارة القصائد</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPoemModal">
                            <i class="fas fa-plus me-1"></i> إضافة قصيدة
                        </button>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>العنوان</th>
                                            <th>المحتوى</th>
                                            <th>التاريخ</th>
                                            <th>الإحصائيات</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($poems as $index => $poem):
                                            $likes = $poemObj->getLikesCount($poem['id']);
                                            $comments = $commentObj->getCommentsCount($poem['id']);
                                            ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td class="fw-bold"><?php echo htmlspecialchars($poem['title']); ?></td>
                                                <td>
                                                    <small class="text-muted">
                                                        <?php echo htmlspecialchars(mb_substr($poem['content'], 0, 50)) . '...'; ?>
                                                    </small>
                                                </td>
                                                <td><?php echo date('d/m/Y', strtotime($poem['created_at'])); ?></td>
                                                <td>
                                                    <span class="badge bg-danger me-1"><i class="fas fa-heart me-1"></i><?php echo $likes; ?></span>
                                                    <span class="badge bg-primary"><i class="fas fa-comment me-1"></i><?php echo $comments; ?></span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" class="btn btn-outline-primary edit-btn"
                                                            data-id="<?php echo $poem['id']; ?>"
                                                            data-title="<?php echo htmlspecialchars($poem['title']); ?>"
                                                            data-content="<?php echo htmlspecialchars($poem['content']); ?>"
                                                            data-bs-toggle="modal" data-bs-target="#editPoemModal">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form method="post" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟');">
                                                            <input type="hidden" name="id" value="<?php echo $poem['id']; ?>">
                                                            <button type="submit" name="delete_poem" class="btn btn-outline-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biography Management Section -->
                <div id="biography" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>إدارة السيرة الذاتية</h2>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="post">
                                <?php
                                $sections = $bioObj->getAllSections();
                                $bioData = [];
                                foreach ($sections as $section) {
                                    $bioData[$section['section_name']] = $section['content'];
                                }

                                $labels = [
                                    'poet_name' => 'اسم الشاعر',
                                    'poet_title' => 'اللقب / الوصف',
                                    'birth' => 'الميلاد',
                                    'education' => 'التعليم',
                                    'achievements' => 'الإنجازات',
                                    'style' => 'الأسلوب الشعري',
                                    'mission' => 'المهمة الحالية'
                                ];

                                foreach ($labels as $key => $label):
                                    $value = isset($bioData[$key]) ? $bioData[$key] : '';
                                    ?>
                                    <div class="mb-3">
                                        <label for="bio_<?php echo $key; ?>" class="form-label fw-bold"><?php echo $label; ?></label>
                                        <?php if ($key == 'poet_name' || $key == 'poet_title'): ?>
                                            <input type="text" class="form-control" id="bio_<?php echo $key; ?>" name="biography[<?php echo $key; ?>]" value="<?php echo htmlspecialchars($value); ?>">
                                        <?php else: ?>
                                            <textarea class="form-control" id="bio_<?php echo $key; ?>" name="biography[<?php echo $key; ?>]" rows="4"><?php echo htmlspecialchars($value); ?></textarea>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                
                                <div class="text-end">
                                    <button type="submit" name="update_biography" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> حفظ التغييرات
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal إضافة قصيدة -->
    <div class="modal fade" id="addPoemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i> إضافة قصيدة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="poem-title" class="form-label">عنوان القصيدة</label>
                            <input type="text" class="form-control" id="poem-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="poem-content" class="form-label">محتوى القصيدة</label>
                            <textarea class="form-control" id="poem-content" name="content" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" name="add_poem" class="btn btn-primary">حفظ القصيدة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal تعديل قصيدة -->
    <div class="modal fade" id="editPoemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i> تعديل القصيدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">عنوان القصيدة</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_content" class="form-label">محتوى القصيدة</label>
                            <textarea class="form-control" id="edit_content" name="content" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" name="edit_poem" class="btn btn-primary">تحديث القصيدة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script to handle edit modal data population
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editPoemModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var title = button.getAttribute('data-title');
                var content = button.getAttribute('data-content');

                var modalTitleInput = editModal.querySelector('#edit_title');
                var modalContentInput = editModal.querySelector('#edit_content');
                var modalIdInput = editModal.querySelector('#edit_id');

                modalTitleInput.value = title;
                modalContentInput.value = content;
                modalIdInput.value = id;
            });
        });
    </script>
</body>

</html>