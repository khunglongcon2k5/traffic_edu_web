<?php
session_start();
require_once '../includes/config.php';

$current_page = basename($_SERVER['PHP_SELF']);

$category_id = 2;
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
    <title>20 Câu Hỏi Điểm Liệt Thi Bằng Lái Xe Máy A1 2025</title>
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
            <h3 class="sidebar-title">Giới Thiệu Ứng Dụng Ôn Tập Lý Thuyết A1!</h3>
            <p style="font-weight: 800; color: #ef4444;">
                Ôn tập câu điểm liệt bằng lái xe A1 – Học dễ, nhớ lâu, thi là đậu!
            </p>

            <p>
                Để giúp bạn chuẩn bị cho kỳ thi bằng lái xe A1 dễ dàng và hiệu quả hơn, Trung Tâm đã phát triển phần mềm
                thi thử 20 câu hỏi điểm liệt, chính thức áp dụng từ <span
                    style="color:#ef4444; font-weight: 700;">18/06/2025</span> . Với
                bộ công cụ này, bạn sẽ có cơ hội ôn tập và kiểm tra kiến thức lý thuyết mọi lúc, mọi nơi, hoàn toàn miễn
                phí!
            </p>

            <p>
                Đặc biệt, phần mềm này được tối ưu hóa để sử dụng trên nhiều thiết bị khác nhau như điện thoại, laptop,
                máy tính bảng, iPhone, iPad, điện thoại Android, thậm chí cả điện thoại Nokia, miễn là bạn có kết nối
                mạng (Wifi, 3G, 4G, 5G). Chỉ cần vài bước đơn giản, bạn có thể trải nghiệm và ôn luyện ngay lập tức.
            </p>

            <p>
                Khi bạn hoàn thành 20 câu hỏi này, bạn sẽ tự tin hơn rất nhiều, vì đây chính là phần thi quan trọng giúp
                bạn “tránh được việc bị loại” khi bước vào kỳ thi lý thuyết 200 câu hỏi. Đây là một công cụ cực kỳ hữu
                ích, giúp bạn làm quen với những câu hỏi thường gặp và chuẩn bị tinh thần sẵn sàng cho kỳ thi chính
                thức.
            </p>

            <p>
                Không cần lo lắng hay tốn kém chi phí, phần mềm 20 câu hỏi điểm liệt này hoàn toàn miễn phí, dễ sử dụng
                và giúp bạn nâng cao khả năng thi đạt điểm cao một cách nhanh chóng. Vậy thì còn chờ gì nữa? Hãy thử
                ngay hôm nay và chinh phục kỳ thi lái xe A1 với sự tự tin tuyệt đối!
            </p>

            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb; color: #1340ef;">
            </div>
        </aside>

        <main class="content">
            <h2 class="content-title">ĐỀ THI THỬ 20 CÂU HỎI ĐIỂM LIỆT A1 MỚI NHẤT 2025</h2>

            <div class="sub-content">
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px; text-align: center;">PHẦN MỀM LUYỆN THI 20 CÂU HỎI
                        ĐIỂM LIỆT A1</h2>
                    <img src="../assets/img/20-cau-hoi-diem-liet-A1.png"
                        alt=" thi bằng lái xe máy a1 2025 20 câu hỏi điểm liệt A1" class="ad-image" />
                </div>
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px;">BỘ ĐỀ THI THỬ 20 CÂU HỎI ĐIỂM LIỆT A1 CHÍNH THỨC
                        TỪ 01/08/2020
                    </h2>
                    <p>
                        Cấu trúc bộ đề thi câu điểm liệt hạng A1 mới sẽ bao gồm 20 câu hỏi, mỗi câu hỏi có 1 đáp án duy
                        nhất phản ánh chính xác bản chất của kỳ thi trắc nghiệm. Điều này khác hoàn toàn với bộ đề thi
                        luật cũ, nơi mỗi câu hỏi lại có 2 đáp án để bạn phải lựa chọn.

                        Với bộ đề thi mới này, học viên sẽ dễ dàng hơn trong việc xác định đúng đáp án và tự tin hơn khi
                        bước vào kỳ thi. Không cần phải phân vân hay lo lắng về những câu hỏi có nhiều đáp án mơ hồ, vì
                        chỉ có một lựa chọn đúng duy nhất, giúp bạn tập trung ôn luyện và nâng cao khả năng thi đậu.

                        Hãy chuẩn bị thật kỹ càng với bộ đề thi 20 câu hỏi điểm liệt, để khi bước vào kỳ thi thật, bạn
                        sẽ dễ dàng vượt qua mà không gặp phải bất kỳ trở ngại nào!
                    </p>

                    <ul class="exam-info">
                        <li>
                            <span style="font-weight: 700">Số lượng câu hỏi</span>: 20 câu.
                        </li>

                        <li>
                            <span style="font-weight: 700">Yêu cầu làm đúng</span>: 20/20 câu.
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
                <h3 style="margin-bottom: 15px;">Khám phá ngay bộ đề 20 câu điểm liệt, giúp bạn tự tin chinh phục kỳ
                    thi! 📲🔥:</h3>
                <div style="text-align: center;">
                    <?php
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<a href="thi-thu-20-cau-diem-liet-a1.php?set_id='
                            . $row['set_id']
                            . '"class="exam-btn" style="display: inline-block; margin-bottom: 20px; width: auto;">20 Câu hỏi điểm liệt A1 </a>';
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