<header class="p-3 bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a class="nav-link px-2 home-text" href="<?php echo BASE_URL ?>">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="">Theo dõi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Thể loại</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Lịch sử</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 menu-text" href="#">Truyện hot</a>
                </li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Tìm kiếm..." aria-label="Search">
            </form>
            <div class="text-end">
                <?php
                session_start();
                // Kiểm tra xem session đã đăng nhập chưa
                if (isset($_SESSION['login'])) {
                    // Nếu đã đăng nhập, hiển thị nút đăng xuất
                    echo '<a href="' . BASE_URL . '/login/logout">';
                    echo '<button type="button" class="btn btn-outline-light me-2">Logout</button>';
                    echo '</a>';
                } else {
                    // Nếu chưa đăng nhập, hiển thị nút login và sign-up
                    echo '<a href="' . BASE_URL . '/login">';
                    echo '<button type="button" class="btn btn-outline-light me-2">Login</button>';
                    echo '</a>';
                    echo '<a href="' . BASE_URL . '/signup">';
                    echo '<button type="button" class="btn btn-warning">Sign-up</button>';
                    echo '</a>';
                }
                ?>
            </div>


        </div>
    </div>
    <style>
        .home-text {
            color: yellow;
            font-size: 16px;
            font-family: Arial;
            font-weight: 700;
            word-wrap: break-word
        }

        .home-text:hover {
            color: red
        }

        .menu-text {
            color: white;
            font-size: 16px;
            font-family: Arial;
            font-weight: 700;
            word-wrap: break-word
        }

        .menu-text:hover {
            color: lightgreen
        }
    </style>
</header>