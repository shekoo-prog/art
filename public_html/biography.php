<?php
require_once __DIR__ . '/../classes/Biography.php';

$bioObj = new Biography();
$sections = $bioObj->getAllSections();
$bioData = [];
foreach ($sections as $section) {
    $bioData[$section['section_name']] = $section['content'];
}

// Helper function to safely get data
function getBio($key, $data)
{
    return isset($data[$key]) ? htmlspecialchars($data[$key]) : '';
}

include __DIR__ . '/partials/header.php';
?>
    
    <section class="container py-5">
        <div class="row g-3">
            <div class="col-lg-4 text-center">
                <div class="card shadow-sm border-0 sticky-top h-auto" style="top: 2rem;">
                    <div class="card-body p-4 p-lg-5 d-flex flex-column align-items-center">
                        <img src="assets/logo.png" alt="اللوغو الشخصي" class="img-fluid rounded-circle mb-3 shadow-sm" style="width: 200px; height: 200px; object-fit: cover;">
                        <h1 class="h3 fw-bold text-primary">الشاعر <?php echo getBio('poet_name', $bioData); ?></h1>
                        <p class="text-muted"><?php echo getBio('poet_title', $bioData); ?></p>
                        <hr>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="https://www.facebook.com/mhmd.shhab.123449" target="_blank" class="text-primary fs-2"><i class="fab fa-facebook"></i></a>
                            <a href="https://wa.me/201022556306" target="_blank" class="text-success fs-2"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-lg-5">
                        <h2 class="h3 fw-bold mb-4 border-bottom pb-3 text-primary">السيرة الذاتية</h2>
                        
                        <div class="d-flex gap-3 mb-4">
                            <div class="flex-shrink-0">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-birthday-cake fa-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold">الميلاد</h3>
                                <p class="text-secondary"><?php echo getBio('birth', $bioData); ?></p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="flex-shrink-0">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-graduation-cap fa-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold">التعليم</h3>
                                <p class="text-secondary"><?php echo getBio('education', $bioData); ?></p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="flex-shrink-0">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-award fa-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold">الإنجازات</h3>
                                <p class="text-secondary"><?php echo getBio('achievements', $bioData); ?></p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="flex-shrink-0">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-feather-alt fa-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold">الأسلوب الشعري</h3>
                                <p class="text-secondary"><?php echo getBio('style', $bioData); ?></p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <span class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 48px; height: 48px;">
                                    <i class="fas fa-share-alt fa-lg"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="h5 fw-bold">المهمة الحالية</h3>
                                <p class="text-secondary"><?php echo getBio('mission', $bioData); ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
