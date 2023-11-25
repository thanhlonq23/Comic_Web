<header class="p-3 bg-dark sticky-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-end">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 hidden-xs home-bar">
                <li class="nav-item">
                    <a class="nav-link px-2 home-text" href="<?php echo BASE_URL ?>">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Theo dõi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Truyện hot</a>
                </li>
            </ul>

            <!-- Auth -->
            <div class="text-end">
                <?php
                session_start();
                // Kiểm tra xem session đã đăng nhập chưa
                if (isset($_SESSION['login'])) {
                    // Nếu đã đăng nhập, hiển thị nút đăng xuất
                    echo '<a href="' . BASE_URL . '/?url=login/logout">';
                    echo '<button type="button" class="btn btn-outline-light me-2">Logout</button>';
                    echo '</a>';
                } else {
                    // Nếu chưa đăng nhập, hiển thị nút login và sign-up
                    echo '<a href="' . BASE_URL . '/?url=login">';
                    echo '<button type="button" class="btn btn-outline-light me-2">Login</button>';
                    echo '</a>';
                    echo '<a href="' . BASE_URL . '/?url=signup">';
                    echo '<button type="button" class="btn btn-warning">Sign-up</button>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
        <form class="d-flex pt-2 w-100">
            <input type="search" class="form-control form-control-dark me-2" placeholder="Tìm kiếm..." aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
        </form>
    </div>
</header>