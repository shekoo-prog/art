<?php
session_start();

$message = '';

if (isset($_POST['login'])) {
    if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin123') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'اسم المستخدم أو كلمة المرور خاطئة';
    }
}

if (isset($_SESSION['loggedin'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="assets/favicon.svg" type="image/svg+xml">
    <script defer src="js/theme.js"></script>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <?php include __DIR__ . '/partials/header.php'; ?>
    
    <div class="container py-5 my-auto">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <img src="assets/logo.png" alt="Logo" width="80" class="mb-3">
                                    <h2 class="fw-bold text-primary">تسجيل الدخول</h2>
                                    <p class="text-muted">ادخل بياناتك للوصول إلى لوحة التحكم</p>
                                </div>
                                
                                <?php if ($message): ?>
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div><?php echo $message; ?></div>
                                    </div>
                                <?php endif; ?>

                                <form method="post">
                                    <div class="mb-3">
                                        <label for="username" class="form-label"><i class="fas fa-user me-1"></i> اسم المستخدم</label>
                                        <input type="text" class="form-control form-control-lg" id="username" name="username" required placeholder="أدخل اسم المستخدم">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label"><i class="fas fa-lock me-1"></i> كلمة المرور</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="أدخل كلمة المرور">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" name="login" class="btn btn-primary btn-lg">
                                            <i class="fas fa-sign-in-alt me-2"></i> دخول
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            var icon = document.querySelector('.toggle-password i');
            if (x.type === "password") {
                x.type = "text";
                icon.className = "fas fa-eye-slash";
            } else {
                x.type = "password";
                icon.className = "fas fa-eye";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
