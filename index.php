<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi Thử Bằng Lái Xe Máy - A1</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #28a745;
            --secondary-color: #218838;
            --accent-color: #ff6b6b;
            --bg-color: #f8f9fa;
            --text-color: #343a40;
            --light-grey: #e9ecef;
            --dark-green: #155724;
            --light-green: #d4edda;
            --medium-green: #5cb85c;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header styles */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 40px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-item {
            margin-left: 25px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            font-size: 0.9rem;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-login:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }

        .btn-register:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
        }

        /* Hero section */
        .hero {
            background-color: #011640;
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background: linear-gradient(to right bottom, transparent 49%, white 50%);
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/100/100') repeat;
            opacity: 0.05;
            z-index: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-text {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-start {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 30px;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);
        }

        .btn-start:hover {
            background-color: #FF5252;
            transform: translateY(-2px);
        }

        /* Features section */
        .features {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 50px;
            position: relative;
            color: var(--dark-green);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border-bottom: 3px solid var(--medium-green);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            background-color: var(--light-green);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
        }

        .feature-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .feature-text {
            color: #666;
        }

        /* Modal styles for login/register */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: var(--accent-color);
        }

        .form-title {
            text-align: center;
            margin-bottom: 25px;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        .form-input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
            background-color: white;
        }

        .form-submit {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }

        .form-submit:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .form-link {
            color: var(--accent-color);
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        .form-link:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background-color: #011640;
            color: white;
            padding: 50px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--accent-color);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #bbb;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 500;
            color: var(--primary-color);
            font-size: 0.95rem;
            padding: 8px 20px;
            border-radius: 30px;
            background-color: #f0f9f0;
            box-shadow: 0 2px 8px rgba(0, 128, 0, 0.1);
        }

        .btn-logout {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-title {
                font-size: 2rem;
            }

            .feature-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container nav-container">
            <div class="logo">
                <div class="logo-text">Luyện thi lý thuyết lái xe máy</div>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="nav-link active">Trang chủ</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Học lý thuyết</a></li>
                <li class="nav-item"><a href="thi-bang-lai-xe-a1-online.php" class="nav-link">Thi thử</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Mẹo thi</a></li>
            </ul>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['name'])): ?>
                    <div class="user-info">
                        👤 <?php echo htmlspecialchars($_SESSION['name']); ?>
                        <a href="./includes/logout.php" class="btn btn-logout">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <button class="btn btn-login" id="showLogin">Đăng nhập</button>
                    <button class="btn btn-register" id="showRegister">Đăng ký</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1 class="hero-title">Thi thử bằng lái xe máy A1 miễn phí</h1>
            <p class="hero-text">Luyện thi lý thuyết và biển báo với ngân hàng đề thi đa dạng. Đạt kết quả cao ngay lần
                thi đầu tiên.</p>
            <button class="btn btn-start" id="startExam">
                <a href="./pages/thi-thu-bang-lai-xe-may-a1.php" style="text-decoration: none; color: white;">Bắt đầu
                    thi thử
                    ngay</a></button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3 class="feature-title">600+ câu hỏi lý thuyết</h3>
                    <p class="feature-text">Ngân hàng câu hỏi đầy đủ, cập nhật theo chuẩn mới nhất của Bộ GTVT.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Đề thi sát thực tế</h3>
                    <p class="feature-text">Mô phỏng chính xác đề thi thật với thời gian và số lượng câu hỏi tương tự.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3 class="feature-title">Học mọi lúc mọi nơi</h3>
                    <p class="feature-text">Tương thích với điện thoại, máy tính bảng và máy tính để bàn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="close-modal" id="closeLogin">&times;</span>
            <h2 class="form-title">Đăng nhập</h2>
            <form id="loginForm" method="post" action="./includes/login.php">
                <div class="form-group">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" id="loginEmail" name="loginEmail" class="form-input"
                        placeholder="Nhập email của bạn" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword" class="form-label">Mật khẩu</label>
                    <input type="password" id="loginPassword" name="loginPassword" class="form-input"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="form-submit" name="btn-log">Đăng nhập</button>
                <div class="form-footer">
                    Chưa có tài khoản? <span class="form-link" id="switchToRegister">Đăng ký ngay</span>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal" id="registerModal">
        <div class="modal-content">
            <span class="close-modal" id="closeRegister">&times;</span>
            <h2 class="form-title">Đăng ký tài khoản</h2>
            <form id="registerForm" method="post" action="./includes/register.php">
                <div class="form-group">
                    <label for="registerName" class="form-label">Họ và tên</label>
                    <input type="text" id="registerName" name="registerName" class="form-input"
                        placeholder="Nhập họ và tên" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail" class="form-label">Email</label>
                    <input type="email" id="registerEmail" name="registerEmail" class="form-input"
                        placeholder="Nhập email của bạn" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword" class="form-label">Mật khẩu</label>
                    <input type="password" id="registerPassword" name="registerPassword" class="form-input"
                        placeholder="Tạo mật khẩu" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-input"
                        placeholder="Nhập lại mật khẩu" required>
                </div>
                <button type="submit" class="form-submit" name="btn-reg">Đăng ký</button>
                <div class="form-footer">
                    Đã có tài khoản? <span class="form-link" id="switchToLogin">Đăng nhập</span>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>ThiLaiXeA1<span style="color: var(--accent-color);">.</span></h3>
                    <p>Nền tảng ôn thi bằng lái xe hàng đầu Việt Nam với hơn 50,000 học viên đã thi đỗ.</p>
                </div>
                <div class="footer-column">
                    <h3>Liên kết nhanh</h3>
                    <ul class="footer-links">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Học lý thuyết</a></li>
                        <li><a href="#">Đề thi thử</a></li>
                        <li><a href="#">Mẹo thi</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Hỗ trợ</h3>
                    <ul class="footer-links">
                        <li><a href="#">Trung tâm hỗ trợ</a></li>
                        <li><a href="#">Câu hỏi thường gặp</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Liên hệ</h3>
                    <ul class="footer-links">
                        <li>Email: hotro@thilaixea1.vn</li>
                        <li>Điện thoại: 0987 654 321</li>
                        <li>Địa chỉ: Hà Nội, Việt Nam</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 TrafficEdu. Tất cả các quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <script>
        // Modal functionality
        const loginModal = document.getElementById('loginModal');
        const registerModal = document.getElementById('registerModal');
        const showLoginBtn = document.getElementById('showLogin');
        const showRegisterBtn = document.getElementById('showRegister');
        const closeLoginBtn = document.getElementById('closeLogin');
        const closeRegisterBtn = document.getElementById('closeRegister');
        const switchToRegisterBtn = document.getElementById('switchToRegister');
        const switchToLoginBtn = document.getElementById('switchToLogin');
        const startExamBtn = document.getElementById('startExam');

        // Show modals
        showLoginBtn.addEventListener('click', () => {
            loginModal.style.display = 'flex';
        });

        showRegisterBtn.addEventListener('click', () => {
            registerModal.style.display = 'flex';
        });

        // Close modals
        closeLoginBtn.addEventListener('click', () => {
            loginModal.style.display = 'none';
        });

        closeRegisterBtn.addEventListener('click', () => {
            registerModal.style.display = 'none';
        });

        // Switch between modals
        switchToRegisterBtn.addEventListener('click', () => {
            loginModal.style.display = 'none';
            registerModal.style.display = 'flex';
        });

        switchToLoginBtn.addEventListener('click', () => {
            registerModal.style.display = 'none';
            loginModal.style.display = 'flex';
        });

        // Start exam button (shows login if not authenticated)
        startExamBtn.addEventListener('click', () => {
            // For demo purposes, always show login modal
            loginModal.style.display = 'flex';
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                loginModal.style.display = 'none';
            }
            if (e.target === registerModal) {
                registerModal.style.display = 'none';
            }
        });
    </script>
</body>

</html>