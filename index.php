<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi Thử Bằng Lái Xe Máy - A1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container nav-container">
            <div class="logo">
                <div class="logo-text">Traffic Education</div>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="nav-link active">Trang chủ</a></li>
                <li class="nav-item" id="nav-item"><a href="#" class="nav-link required-login">Học lý thuyết</a></li>
                <li class="nav-item" id="nav-item"><a href="thi-bang-lai-xe-a1-online.php"
                        class="nav-link required-login">Thi thử</a>
                </li>
                <li class="nav-item" id="nav-item"><a href="#" class="nav-link required-login">Mẹo thi</a></li>
            </ul>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['name'])): ?>
                    <div class="user-info">
                        <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($_SESSION['name']); ?>
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
            <h1 class="hero-title">Thi thử lý thuyết bằng lái xe máy miễn phí</h1>
            <p class="hero-text">Luyện thi lý thuyết và biển báo với ngân hàng đề thi đa dạng. Đạt kết quả cao ngay lần
                thi đầu tiên.</p>
            <button class="btn btn-start" id="startExam">
                <a href="./pages/thi-thu-bang-lai-xe-may-a1.php"
                    style="text-decoration: none; color: var(--primary-color);">Bắt đầu
                    thi thử
                    ngay
                </a>
            </button>
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

    <!-- Reviews Section -->
    <section class="reviews">
        <div class="container reviews-container">
            <h2 class="section-title">Đánh giá từ học viên</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-quote">"</div>
                    <p class="review-text">Tôi đã thi đỗ bằng lái A1 ngay lần đầu tiên nhờ luyện tập trên trang web này.
                        Đề thi thử rất sát với đề thi thật!</p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <img src="https://nguoinoitieng.tv/images/nnt/103/0/bguo.jpg" alt="student1">
                        </div>
                        <div class="review-info">
                            <h4>Hoàng Hà</h4>
                            <p>Hà Nội</p>
                            <div class="review-stars">★★★★★</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-quote">"</div>
                    <p class="review-text">Giao diện dễ dùng, câu hỏi đa dạng, giải thích rõ ràng, rất hữu ích cho người
                        mới học và ôn luyện thi bằng lái xe máy.</p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <img src="https://sportal365images.com/process/smp-images-production/ringier.africa/17052023/12620bd4-0e88-4f14-a9c9-606e1437643f.jpg"
                                alt="student2">
                        </div>
                        <div class="review-info">
                            <h4>Jamal Musiala</h4>
                            <p>Stuttgart, Germany</p>
                            <div class="review-stars">★★★★★</div>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <div class="review-quote">"</div>
                    <p class="review-text">Tôi đã tiết kiệm được rất nhiều thời gian nhờ học trên trang web này. Các mẹo
                        thi rất hữu ích và dễ nhớ.</p>
                    <div class="review-author">
                        <div class="review-avatar">
                            <img src="https://kenh14cdn.com/2020/1/2/trucanh-15779407397171279996532.jpg"
                                alt="student3">
                        </div>
                        <div class="review-info">
                            <h4>Trúc Anh</h4>
                            <p>Tp. Hồ Chí Minh</p>
                            <div class="review-stars">★★★★☆</div>
                        </div>
                    </div>
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
                    <h3>Traffic Education</h3>
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

    <script src="./assets/js/main.js"></script>
</body>

</html>