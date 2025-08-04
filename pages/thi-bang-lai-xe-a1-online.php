<?php
session_start();
require_once '../includes/config.php';

$current_page = basename($_SERVER['PHP_SELF']);

$category_id = 1;
$stmt = $conn->prepare("SELECT * FROM exam_sets WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thi Thử Bằng Lái Xe Máy A1 Online 2025 - Bộ Đề 200 Câu Hỏi Mới</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/page.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header -->
    <?php include '../includes/header.php' ?>

    <!-- Content -->
    <div class="container main-content">
        <aside class="side-bar">
            <h3 class="sidebar-title">Giới Thiệu Ứng Dụng Ôn Tập Lý Thuyết A1!</h3>
            <p style="font-weight: 800; color: #ef4444;">
                Ôn Tập Lý Thuyết A1 – Dễ Hiểu, Dễ Nhớ, Dễ Đậu!
            </p>

            <p>
                Bạn đang lo lắng cho kỳ thi lý thuyết A1 sắp tới? Đừng lo! Giờ đây, bạn có thể ôn tập mọi lúc mọi nơi
                với
                ứng dụng thi thử A1 online do chúng tôi phát triển, được chính thức đưa vào sử dụng từ
                <b style="color: red">18/06/2025.</b>
            </p>

            <p>
                Ứng dụng này tích hợp trọn bộ 200 câu hỏi chuẩn do Tổng Cục Đường Bộ Việt Nam ban hành – sát đề, đúng
                trọng tâm, giúp bạn ôn nhanh, nắm chắc kiến thức cần thiết.
            </p>

            <p>
                Chỉ cần có kết nối mạng (Wifi, 3G, 4G, 5G), bạn có thể truy cập ngay trên mọi thiết bị quen thuộc: điện
                thoại, máy tính bảng, iPhone, Android, Samsung, Nokia, laptop, iPad... Không cần cài đặt, chỉ cần mở web
                là học liền!
            </p>

            <p>
                Vào học thử là mê – học kỹ là đậu! Còn chờ gì nữa, bắt đầu ôn tập ngay hôm nay để tự tin bước vào kỳ thi
                A1 nhé!
            </p>
        </aside>

        <main class="content">
            <h2 class="content-title">ĐỀ THI THỬ BẰNG LÁI XE A1 200 CÂU HỎI MỚI NHẤT 2025</h2>

            <div class="sub-content">
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px; text-align: center;">PHẦN MỀM LUYỆN THI LÝ THUYẾT
                        200 CÂU A1</h2>
                    <img src="../assets/img/200-cau-hoi-thi-A1.png"
                        alt="thi bằng lái xe máy a1 2025 8 bộ đề 200 câu hỏi" width="328" height="474"
                        class="ad-image" />
                </div>
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px;">BỘ ĐỀ THI THỬ BẰNG LÁI XE MÁY A1 CHÍNH THỨC TỪ
                        01/08/2020</h2>
                    <p>
                        Cấu trúc bộ đề thi sát hạch giấy phép lái xe hạng A1 sẽ bao gồm 25
                        câu hỏi, mỗi câu hỏi chỉ có <strong>duy nhất 1 đáp án trả lời đúng</strong> phản ánh
                        đúng bản chất của thi trắc nghiệm. Khác hẳn với bộ đề thi luật cũ
                        là 2 đáp án. Mỗi đề thi chúng tôi sẽ bố trí từ 2 - 4 câu hỏi điểm
                        liệt để học viên có thể làm quen và ghi nhớ, tránh việc làm sai
                        câu hỏi liệt.
                    </p>

                    <ul class="exam-info">
                        <li>
                            <span style="font-weight: 700">Số lượng câu hỏi</span>: 25 câu.
                        </li>

                        <li>
                            <span style="font-weight: 700">Yêu cầu làm đúng</span>: 21/25 câu.
                        </li>

                        <li><span style="font-weight: 700">Thời gian</span>: 19 phút.</li>
                    </ul>

                    <div class="warning-box">
                        <p>
                            <strong> Lưu ý đặc biệt:</strong> Tuyệt đối không được làm sai câu hỏi điểm liệt, vì
                            trong kỳ thi thật nếu học viên làm sai "Câu Điểm Liệt" đồng nghĩa
                            với việc "KHÔNG ĐẠT" dù cho các câu khác trả lời đúng!
                        </p>
                    </div>

                    <p>
                        Khởi Động Cùng 20 Câu Hỏi Điểm Liệt A1 -
                        <a href="thi-thu-20-cau-diem-liet-a1.php" style="text-decoration: none">
                            <span style="color: red; font-weight: 700">Cùng Thử Sức Ngay! 🚗💥</span>
                        </a>
                    </p>

                    <p style="margin-top: 10px;">
                        Thi thử A1 – Hãy cùng thử sức ngay với bộ đề thi chính thức! 🏍️ Với nền tảng thi thử A1 của
                        chúng tôi, bạn sẽ được trải nghiệm những câu hỏi trắc nghiệm chuẩn với đề thi thật, giúp bạn làm
                        quen với các câu hỏi quan trọng, đặc biệt là các câu điểm liệt. 📝🔑

                        Chỉ cần đăng nhập và làm bài thi thử, bạn sẽ dễ dàng kiểm tra được trình độ của mình và chuẩn bị
                        sẵn sàng cho kỳ thi A1. 📚✨ Đừng lo lắng, đây là cơ hội tuyệt vời để bạn luyện tập và tự tin hơn
                        trong kỳ thi thật!

                        Nhanh tay đăng ký và bắt đầu thi thử ngay hôm nay! 🏆 Cùng nhau chinh phục kỳ thi và biến giấc
                        mơ sở hữu bằng lái A1 thành hiện thực! 💨
                    </p>
                </div>
            </div>

            <div>
                <h3 style="margin-bottom: 15px;">Chọn đề thi:</h3>
                <div>
                    <a href="thi-thu-20-cau-diem-liet-a1.php" class="exam-btn"
                        style="display: inline-block; margin-bottom: 20px; width: auto;">20 Câu
                        Hỏi Điểm Liệt</a>
                </div>

                <div class="exam-grid">
                    <?php
                    $count = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($count <= 8) {
                                echo '<a href="thi-thu-bang-lai-xe-may-a1.php?set_id=' . $row['set_id'] . '" class="exam-btn">Đề ' . $count . '</a>';
                                $count++;
                            } else {
                                break;
                            }
                        }
                    }
                    ?>
                </div>

                <div class="address-section">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.2120340408314!2d109.19560007474969!3d13.766083186627293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x316f6cb7c3c5685f%3A0x3df59a1674b81b54!2zMzYxIFTDonkgU8ahbiwgUXVhbmcgVHJ1bmcsIFF1eSBOaMahbiwgQsOsbmggxJDhu4tuaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1747291617983!5m2!1svi!2s"
                        width="800" height="400" style="border:0; margin-top: 10px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <p style="font-weight: 700; margin-top: 10px;">Địa Chỉ Đăng Ký Thi Bằng Lái Xe Máy Thành phố Quy
                        Nhơn:
                    </p>
                    <ul>
                        <li>
                            <span style="color: blue;">
                                Lịch thi A1 sớm nhất tại Thành phố Quy Nhơn => Nhấp Để Xem</span> <span>
                                <a href="https://www.facebook.com/vieclamsinhvienqn"
                                    style="text-decoration: none; color: red; font-weight: 700;">
                                    Lịch Thi Bằng Lái Xe Máy 2025 Cập Nhật Thường Xuyên</a>
                            </span>
                        </li>

                        <li>
                            <span style="color: blue;">Địa chỉ đăng ký học :</span> <strong>361 Tây Sơn, P.Quang Trung,
                                TP
                                Quy Nhơn, Bình Định</strong>
                        </li>

                        <li>
                            <span style="color: blue;">Địa chỉ thi lý thuyết & thực hành: </span><strong>Trung tâm Đào
                                tạo
                                NVGTVT Bình Định, Lô A1.02+03 Nhơn Hội, TP Quy Nhơn</strong>
                        </li>

                        <li>
                            <span style="color: blue;">Google Maps: </span>
                            <a href="https://www.google.com/maps/place/Trung+T%C3%A2m+%C4%90%C3%A0o+T%E1%BA%A1o+V%C3%A0+S%C3%A1t+H%E1%BA%A1ch+L%C3%A1i+Xe+C%C6%A1+Gi%E1%BB%9Bi+B%C3%ACnh+%C4%90%E1%BB%8Bnh/@13.8270828,109.2606696,291m/data=!3m1!1e3!4m6!3m5!1s0x316f6b9668e9e65d:0xe3e4a78c81c7a9c0!8m2!3d13.8273109!4d109.2613589!16s%2Fg%2F11vxm7x_fq?entry=ttu&g_ep=EgoyMDI1MDQxNC4xIKXMDSoASAFQAw%3D%3D"
                                style="color: #ef4444; text-decoration: none; font-weight: 700;">Xem
                                Tại Đây
                            </a>
                        </li>
                    </ul>
                </div>
        </main>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>
</body>

</html>