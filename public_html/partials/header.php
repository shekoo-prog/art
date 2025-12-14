<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع الشاعر</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">

    <!-- Logo -->
    <link rel="icon" href="assets/favicon.ico" type="image/svg+xml">

    <style>
        /* منع السكرول الأفقي على مستوى الموقع */
        html, body {
            overflow-x: hidden !important;
            max-width: 100%;
        }
        
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2B48C;
            --accent-color: #A0522D;
            --light-color: #FAF0E6;
            --dark-color: #3E2723;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color)) !important;
            padding: 0.8rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }

        .navbar-brand .small {
            font-size: 0.7rem;
            opacity: 0.9;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 0.8rem !important;
            border-radius: 8px;
            margin: 0 0.1rem;
            min-width: 70px;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .nav-link i {
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
        }

        .nav-text {
            font-size: 0.75rem;
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            transform: translateY(-1px);
        }

        /* تحسينات للهواتف */
        @media (max-width: 768px) {
            .navbar .container {
                padding: 0 1rem;
            }

            .navbar-nav {
                flex-direction: row !important;
                justify-content: space-around;
                width: 100%;
                margin-top: 1rem;
                padding: 0.5rem 0;
                background: rgba(0, 0, 0, 0.2);
                border-radius: 12px;
            }

            .nav-item {
                flex: 1;
                text-align: center;
            }

            .nav-link {
                flex-direction: column;
                padding: 0.4rem 0.3rem !important;
                margin: 0;
                min-width: auto;
                font-size: 0.8rem;
            }

            .nav-link i {
                font-size: 1rem;
                margin-bottom: 0.15rem;
            }

            .nav-text {
                font-size: 0.7rem;
                line-height: 1.2;
            }

            .btn-outline-light {
                padding: 0.3rem 0.5rem;
                font-size: 0.8rem;
                min-width: auto;
            }

            .btn-outline-light .nav-text {
                display: none;
            }

            /* إخفاء النص في زر الوضع على الهواتف الصغيرة */
            #themeToggle .nav-text {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand .fw-bold {
                font-size: 1rem;
            }

            .navbar-brand .small {
                font-size: 0.65rem;
            }

            .nav-link {
                padding: 0.3rem 0.2rem !important;
            }

            .nav-link i {
                font-size: 0.9rem;
            }

            .nav-text {
                font-size: 0.65rem;
            }

            /* إخفاء جميع النصوص في الأزرار على الهواتف الصغيرة جداً */
            .nav-text {
                display: none !important;
            }

            .nav-link {
                min-width: 50px;
            }
        }

        /* تحسينات للشاشات الكبيرة */
        @media (min-width: 1200px) {
            .navbar .container {
                max-width: 1400px;
            }
        }

        /* تأثيرات تفاعلية */
        .navbar-brand img {
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        #themeToggle {
            color: rgba(255, 255, 255, 0.9) !important;
            text-decoration: none;
            border: none;
            background: transparent;
        }

        #themeToggle:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- الشعار -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                    <img src="assets/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top rounded-circle">
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-5">د/محمد شهاب</span>
                        <span class="small text-white-50">بيتٌ لكل قصيدة</span>
                    </div>
                </a>

                <ul class="navbar-nav mt-3 text-center">
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex flex-column align-items-center" href="index.php">
                            <i class="fas fa-book-open me-2"></i>
                            <span>الأشعار</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex flex-column align-items-center" href="biography.php">
                            <i class="fas fa-user me-2"></i>
                            <span>السيرة الذاتية</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex flex-column align-items-center" href="dashboard.php">
                            <i class="fas fa-chart-line me-2"></i>
                            <span>لوحة التحكم</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <button id="themeToggleMobile" class="btn btn-link nav-link d-flex flex-column align-items-center w-100" title="تبديل الوضع">
                            <i class="fa-solid fa-moon me-2"></i>
                            <span>تبديل الوضع</span>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <?php
    $current_page = basename($_SERVER['SCRIPT_NAME']);
    if ($current_page != 'login.php'):
        ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <h1 class="display-4 display-md-3 fw-bold text-center mb-3 mb-md-4">الشعر العربـى الأصيل</h1>
                    <h2 class="h3 h2-md fw-semibold text-center mb-3 mb-md-4">رحلة فى عـالم الشعر العربـى</h2>
                    <p class="lead text-center mb-0 px-3 px-md-0">استكشف أجمل القصائد الشعرية للشاعر د/ محمد شهاب، واكتشف جمال اللغة العربية وأسرارها الشعرية</p>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
