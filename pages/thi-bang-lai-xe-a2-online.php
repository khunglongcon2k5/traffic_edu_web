<?php
session_start();
require_once '../includes/config.php';
$current_page = basename($_SERVER['PHP_SELF']);

// Lấy danh sách đề thi
$category_id = 3;
$sql_sets = "SELECT * FROM exam_sets WHERE category_id = $category_id";
$result_sets = $conn->query($sql_sets);

$sql_category = "SELECT * FROM exam_categories WHERE category_id = $category_id";
$result_category = $conn->query($sql_category);
$category = $result_category->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thi Thử Bằng Lái Xe Máy A2 Online 2025 - Bộ Đề 450 Câu Hỏi Mới</title>
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
                Ôn tập lý thuyết bằng lái xe A2 – Học dễ, nhớ lâu, thi là đậu!
            </p>

            <p>
                Bạn đang chuẩn bị thi bằng lái xe A2? Không cần lo lắng hay áp lực gì đâu, đã có phần mềm ôn tập A2
                online do chúng tôi phát triển – áp dụng chính thức từ <b style="color: red">18/06/2025.</b>
            </p>

            <p>
                Phần mềm này chứa trọn bộ 450 câu hỏi chuẩn do Tổng Cục Đường Bộ Việt Nam ban hành. Nội dung sát với đề
                thi thực tế, giúp bạn luyện tập tự tin và bám sát kiến thức cần thiết.
            </p>

            <p>
                Chỉ cần có kết nối mạng (Wifi, 3G, 4G, 5G) là bạn có thể sử dụng phần mềm mọi lúc mọi nơi, trên mọi
                thiết bị: điện thoại, laptop, iPad, máy tính bảng, Android, iPhone, Samsung, Nokia – mở web là học ngay,
                không cần cài đặt rườm rà.
            </p>

            <p>
                Học dễ, nhớ nhanh, thi tự tin – chúc bạn ôn luyện hiệu quả và vượt qua kỳ thi A2 thật nhẹ nhàng!
            </p>

            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e5e7eb; color: #1340ef;">
            </div>
        </aside>

        <main class="content">
            <h2 class="content-title">ĐỀ THI THỬ BẰNG LÁI XE A2 450 CÂU HỎI MỚI NHẤT 2025</h2>

            <div class="sub-content">
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px; text-align: center;">PHẦN MỀM LUYỆN THI LÝ THUYẾT
                        450 CÂU A2</h2>
                    <img src="../assets/img/450-cau-hoi-thi-A2.png"
                        alt=" thi bằng lái xe máy a2 2025 18 bộ đề 450 câu hỏi" class="ad-image" />
                </div>
                <div>
                    <h2 style="font-size: 18px; margin-bottom: 15px;">BỘ ĐỀ THI THỬ BẰNG LÁI XE MÁY A2 CHÍNH THỨC TỪ
                        01/08/2020</h2>
                    <p>
                        Cấu trúc bộ đề luyện thi sát hạch A2 luật mới áp dụng chính thức từ 01/08/2020 sẽ bao gồm 25 câu
                        hỏi, mỗi câu hỏi có duy nhất 1 đáp trả lời đúng. Mỗi đề thi A2 bố trí từ 2 - 4 câu hỏi điểm liệt
                        để học viên có thể làm quen và ghi nhớ, tránh việc làm sai câu hỏi liệt. Trong kỳ thi thật cấu
                        trúc đề thi sẽ được sắp xếp theo dạng ngẫu nhiên, yêu cầu học viên phải học - hiểu để vượt qua
                        các câu hỏi, tránh tình trạng học tủ hay học vẹt.
                    </p>

                    <ul class="exam-info">
                        <li>
                            <span style="font-weight: 700">Số lượng câu hỏi</span>: 25 câu.
                        </li>

                        <li>
                            <span style="font-weight: 700">Yêu cầu làm đúng</span>: 23/25 câu.
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
                        Bắt Đầu Với 50 Câu Hỏi Điểm Liệt A2 –
                        <a href="#" style="text-decoration: none">
                            <span style="color: red; font-weight: 700">NÀO TA CÙNG THI NÀO!</span>
                        </a>
                    </p>

                    <p style="margin-top: 10px;">
                        Thi thử A2 - Cùng thử sức ngay với bộ đề chính thức! 🚗💨

                        Chào mừng bạn đến với nền tảng thi thử A2 của chúng tôi! 🏍️ Với hệ thống câu hỏi trắc nghiệm
                        bám sát bộ đề thi chính thức, bạn sẽ được trải nghiệm những câu hỏi thực tế và đầy thử thách,
                        giúp chuẩn bị tốt nhất cho kỳ thi thật. 📚✨

                        Chỉ cần đăng nhập và làm bài thi trắc nghiệm ngay, bạn sẽ có cơ hội làm quen với các câu hỏi
                        điểm liệt và các câu hỏi quan trọng, giúp bạn tự tin vượt qua kỳ thi A2. 📝🔑

                        Nhanh tay đăng ký và bắt đầu thi ngay để kiểm tra trình độ của mình! 🏆 Hãy cùng nhau chinh phục
                        kỳ thi và đạt được bằng lái A2 trong tầm tay! 🏍️💨
                    </p>
                </div>
            </div>

            <div>
                <h3 style="margin-bottom: 15px;">Chọn đề thi:</h3>
                <div>
                    <a href="thi-thu-50-cau-diem-liet-a2.php" class="exam-btn"
                        style="display: inline-block; margin-bottom: 20px; width: auto;">50 Câu
                        Hỏi Điểm Liệt</a>
                </div>

                <div class="exam-grid">
                    <?php
                    $count = 1;
                    if ($result_sets->num_rows > 0) {
                        while ($row = $result_sets->fetch_assoc()) {
                            if ($count <= 18) {
                                echo '<a href="thi-thu-bang-lai-xe-may-a2.php?set_id=' . $row['set_id'] . '" class="exam-btn">Đề ' . $count . '</a>';
                                $count++;
                            } else {
                                break;
                            }
                        }
                    }
                    ?>
                </div>

                <div style="border-top: 2px solid #374151; margin-top: 15px;"></div>

                <div>
                    <h4
                        style="margin-bottom: 20px; margin-top: 20px; font-weight: 600; color: #ef4444; font-size: 20px;">
                        <span>Các bước học
                            và ôn thi bằng lái A2 hiệu
                            quả:</span>
                    </h4>
                    <ul class="study-steps">
                        <li>
                            <span style="color: blue;">
                                Bước 1:
                            </span>
                            <span style="color: red;">
                                Ôn lý thuyết với 450 câu hỏi chuẩn
                            </span>, các bạn có thể
                            <span>
                                <a href="https://drive.google.com/file/d/1FGJ6cBkFUjKEZfovH7HUWgfZQpJG_iJJ/edit"
                                    style="text-decoration: none; color: blue; font-weight: 700;">
                                    tải file PDF
                                </a>
                            </span>để ôn offline mọi lúc mọi nơi, hoặc luyện trực tiếp trên bộ đề
                            <span>
                                <a href="#" style="text-decoration: none; color: blue; font-weight: 700;">
                                    450 câu A2 Online
                                </a>
                            </span> . Đây là bước nền tảng giúp
                            bạn nắm vững kiến thức cơ bản.
                        </li>

                        <li>
                            <span style="color: blue;">
                                Bước 2:
                            </span> Xem
                            <span>
                                <a href="https://www.youtube.com/embed/videoseries?si=N3NU7K6v81fXKQed&amp;list=PLkuKd2OsgfWE1AutehdrJA_kWik36UShQ"
                                    style="color: blue; text-decoration: none; font-weight: 700;">
                                    12 video mẹo thi A2 để dễ nhớ – dễ đậu
                                </a>
                            </span> Video chia nhỏ theo từng phần, hướng dẫn cách làm nhanh, mẹo nhớ hiệu quả, giúp bạn
                            không bị rối với những câu hỏi lý thuyết tưởng dễ mà dễ sai.
                        </li>

                        <li>
                            <span style="color: blue;">
                                Bước 3:
                            </span> Làm thử
                            <span">
                                <a href="https://www.youtube.com/embed/nN8yp86xYzQ?si=sxn6-sRMYpyU2Wvg"
                                    style="color: blue; text-decoration: none; font-weight: 700;">
                                    50 câu điểm liệt A2
                                </a>
                                </span> Đây là những câu dễ khiến bạn mất điểm nặng nếu sai. Dù làm đúng 24/25 câu nhưng
                                trượt vì 1
                                <span style="color: blue; font-weight: 700;">câu điểm liệt</span> thì cũng rất tiếc, nên
                                đừng bỏ qua phần
                                này
                                nhé!
                        </li>

                        <li>
                            <span style="color: blue;">
                                Bước 4:
                            </span> Luyện đề sát hạch theo chuẩn
                            Hệ thống gồm 18 đề được sắp theo thứ tự để bạn làm quen với dạng bài thi thật.
                        </li>

                        <li>
                            <span style="color: blue;">
                                Bước 5:
                            </span> Xem video
                            <span>
                                <a href="https://www.youtube.com/watch?v=nN8yp86xYzQ"
                                    style="color: blue; text-decoration: none; font-weight: 700;">
                                    hướng dẫn thi thực hành A2
                                </a>
                            </span>
                            Nắm trước các bước khi lên xe, cách xử lý tình huống, cảm nhận khi thi trên xe cảm biến –
                            rất hữu ích nếu bạn chưa từng
                            thi thực hành.
                        </li>

                        <li>
                            <span style="color: blue;">
                                Bước 6:
                            </span> Thư giãn trước ngày thi
                            Tránh học dồn, nhồi nhét vào phút cuối. Thay vào đó,
                            <span style="color: blue; font-weight: 700;">
                                hãy nghỉ ngơi, ngủ đủ giấc để đầu óc
                                tỉnh táo, giữ tâm lý thoải mái
                                trước giờ thi.
                            </span>
                        </li>
                    </ul>
                    <p class="exam-note">
                        📌 Nhớ xem lại mẹo học lý thuyết A2 một lượt trước khi vào phòng thi – vừa gọn nhẹ mà cực kỳ hữu
                        ích.
                    </p>
                </div>

                <div>
                    <div class="description">
                        <h2 class="tips-section">MẸO THI LÝ THUYẾT BẰNG LÁI A2</h2>
                        <p>
                            <span style="text-transform: uppercase; color: red; font-weight: 700;">
                                Video hướng dẫn mẹo làm bài thi A2 dễ nhớ – dễ áp dụng:
                            </span>
                            12 video ngắn gọn, dễ hiểu giúp bạn nắm trọn mẹo làm bài lý thuyết, nhận diện nhanh các
                            loại biển báo và xử lý chính xác
                            phần sa hình. Tất cả đều đã cập nhật theo bộ 450 câu hỏi mới nhất – học một lần, nhớ lâu,
                            thi
                            đâu trúng đó!
                        </p>
                    </div>

                    <div class="video-wrapper">
                        <iframe width="700" height="400"
                            src="https://www.youtube.com/embed/videoseries?si=N3NU7K6v81fXKQed&amp;list=PLkuKd2OsgfWE1AutehdrJA_kWik36UShQ"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div>
                    <div class="description">
                        <h2 class="tips-section">Video Hướng Dẫn Thi Thực Hành Lái Xe A2</h2>
                        <p>
                            <span style="text-transform: uppercase; color: red; font-weight: 700;">
                                Video hướng dẫn chạy vòng số 8:
                            </span>
                            Video hướng dẫn chi tiết cách chạy vòng số 8 trong bài thi thực hành A2, từ cách giữ tay
                            lái,
                            điều chỉnh ga, tư thế ngồi
                            đến mẹo xử lý góc hẹp không bị chạm vạch. Nội dung dễ hiểu, phù hợp cho người mới bắt đầu,
                            giúp
                            bạn tự tin vượt qua bài
                            thi ngay từ lần đầu tiên.
                        </p>
                    </div>


                    <div class="video-wrapper">
                        <iframe width="700" height="400"
                            src="https://www.youtube.com/embed/nN8yp86xYzQ?si=sxn6-sRMYpyU2Wvg"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
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