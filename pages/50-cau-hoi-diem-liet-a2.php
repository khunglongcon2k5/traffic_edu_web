<?php
session_start();
require_once '../includes/config.php';

$current_page = basename($_SERVER['PHP_SELF']);

$category_id = 4;
$stmt = $conn->prepare(
    "SELECT * FROM exam_sets
     WHERE category_id = ?"
);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>50 Câu Hỏi Điểm Liệt Thi Bằng Lái Xe Máy A2 2025</title>
    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/page.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap">
    <!-- Favicon-->
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="../assets/img/logo.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header -->
    <?php include '../includes/header.php' ?>

    <!-- CONTENT -->
    <div class="container main-content">
        <aside class="side-bar">
            <h3 class="sidebar-title">Giới Thiệu Ứng Dụng Ôn Tập Lý Thuyết A2!</h3>
            <p style="font-weight: 800; color: #ef4444;">
                Ôn tập câu điểm liệt bằng lái xe A2 – Học dễ, nhớ lâu, thi là đậu!
            </p>

            <p>
                Chúng tôi xin giới thiệu phần mềm ôn luyện 50 câu điểm liệt A2 – chính thức ra mắt từ 18/06/2025! Bạn có
                thể luyện tập mọi lúc mọi nơi, hoàn toàn miễn phí, trên mọi thiết bị: từ smartphone, laptop, tablet đến
                cả những “dế” Nokia cổ điển – chỉ cần có mạng (Wifi, 3G/4G/5G) là xong.
            </p>

            <p>
                Chỉ với vài cú chạm, bạn đã sẵn sàng thử sức 50 câu hỏi “khó nhằn” nhất, giúp bạn làm chủ kiến thức và
                loại bỏ nỗi lo “câu bẫy” trong đề thi chính thức. Khi hoàn thành bộ đề này, bạn sẽ tự tin bước vào kỳ
                thi lý thuyết A2 (450 câu) mà không còn “lạc lối” trước những tình huống hóc búa.
            </p>

            <p>
                Giao diện thân thiện, thao tác nhanh gọn, phù hợp cho mọi lứa tuổi – từ tân binh lái xe đến “lão làng”
                muốn ôn lại kiến thức. Không tốn một đồng nào, không cần cài đặt rườm rà, chỉ cần vào app và bấm “BẮT
                ĐẦU” là xong
            </p>

            <p>
                👉 <span>
                    <a href="#" style="color: #1340ef; text-decoration: none; font-weight: 700;">
                        Thử ngay
                    </a>
                </span> hôm nay để chinh phục kỳ thi A2 với tâm lý vững vàng và kết quả “bao đậu”!
            </p>

            <div style=" margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb; color: #1340ef;">
            </div>
        </aside>

        <main class="content">
            <h2 class="content-title">ĐỀ THI THỬ 50 CÂU HỎI ĐIỂM LIỆT A2 MỚI NHẤT 2025</h2>

            <div class="sub-content">
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px; text-align: center;">PHẦN MỀM LUYỆN THI 50 CÂU HỎI
                        ĐIỂM LIỆT A2</h2>
                    <img src="../assets/img/50-cau-hoi-diem-liet-A2.png"
                        alt=" thi bằng lái xe máy a2 2025 50 câu hỏi điểm liệt A2" class="ad-image" />
                </div>
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px;">BỘ ĐỀ THI THỬ 50 CÂU HỎI ĐIỂM LIỆT A2 CHÍNH THỨC
                        TỪ 01/08/2020
                    </h2>
                    <p>
                        Cấu trúc bộ đề luyện thi 50 câu hỏi liệt A2 theo luật mới chính thức áp dụng từ 01/08/2020 sẽ
                        bao gồm 25 câu hỏi, mỗi câu có 1 đáp án duy nhất đúng, giúp bạn ôn luyện một cách dễ dàng và
                        hiệu quả.

                        Khác biệt hoàn toàn với các bộ đề thi cũ, bộ đề mới này tập trung vào sự chính xác và rõ ràng.
                        Mỗi câu hỏi chỉ có một đáp án đúng, giúp bạn dễ dàng lựa chọn và tránh những sự phân vân không
                        cần thiết. Đây là cơ hội tuyệt vời để bạn làm quen với cấu trúc câu hỏi trong kỳ thi, từ đó nâng
                        cao khả năng làm bài và tự tin hơn khi bước vào kỳ thi thực tế.

                        Hãy tận dụng cơ hội này để luyện tập và ôn thi một cách thông minh! Với bộ đề thi này, bạn không
                        chỉ chuẩn bị cho kỳ thi mà còn rèn luyện phản xạ nhanh chóng và chính xác. Chinh phục kỳ thi A2
                        ngay hôm nay và bước vào tương lai với tấm bằng lái xe an toàn!
                    </p>

                    <ul class="exam-info">
                        <li>
                            <span style="font-weight: 700">Số lượng câu hỏi</span>: 25 câu.
                        </li>

                        <li>
                            <span style="font-weight: 700">Yêu cầu làm đúng</span>: 25/25 câu.
                        </li>

                        <li><span style="font-weight: 700">Thời gian</span>: 15 phút.</li>
                    </ul>

                    <div class="warning-box">
                        <p>
                            <strong> Lưu ý đặc biệt:</strong> Tuyệt đối không được làm sai câu hỏi điểm liệt, vì
                            trong kỳ thi thật nếu học viên làm sai "Câu Điểm Liệt" đồng nghĩa
                            với việc "KHÔNG ĐẠT" dù cho các câu khác trả lời đúng!
                        </p>
                    </div>

                </div>
            </div>

            <div>
                <h3 style="margin-bottom: 15px;">Vượt qua 50 câu điểm liệt, đậu ngay kỳ thi như một chuyên gia! 🎯🚦💯:
                </h3>
                <div style="text-align: center;">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<a href="thi-thu-50-cau-diem-liet-a2.php?set_id='
                            . $row['set_id']
                            . '"class="exam-btn" style="display: inline-block; margin-bottom: 20px; width: auto;">50 Câu hỏi điểm liệt A2 </a>';
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