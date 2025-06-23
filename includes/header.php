<header>
    <div class="container-header">
        <nav>
            <ul class="nav-menu">
                <li><a href="#">Chọn Phần Thi</a></li>
                <li><a href="thi-bang-lai-xe-a1-online.php"
                        <?php if ($current_page == 'thi-bang-lai-xe-a1-online.php') echo 'class="active"'; ?>>Thi Thử
                        A1</a></li>
                <li><a href="thi-bang-lai-xe-a2-online.php"
                        <?php if ($current_page == 'thi-bang-lai-xe-a2-online.php') echo 'class="active"'; ?>>Thi Thử
                        A2</a></li>
                <li><a href="20-cau-hoi-diem-liet-a1.php"
                        <?php if ($current_page == '20-cau-hoi-diem-liet-a1.php') echo 'class="active"'; ?>>Thi 20 Câu
                        Điểm Liệt A1</a></li>
                <li><a href="50-cau-hoi-diem-liet-a2.php"
                        <?php if ($current_page == '50-cau-hoi-diem-liet-a2.php') echo 'class="active"'; ?>>Thi 50 Câu
                        Điểm Liệt A2</a></li>
                <li>
                    <?php if (isset($_SESSION['name'])): ?> <div class="user-info">
                            <i class="fa-solid fa-user-tie"></i><?php echo htmlspecialchars($_SESSION['name']); ?>
                            <a href="../includes/logout.php" class="btn btn-logout">Đăng xuất</a>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</header>