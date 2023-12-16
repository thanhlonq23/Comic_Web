    <header class="p-3 bg-dark sticky-top">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 hidden-xs home-bar">
                    <li class="nav-item">
                        <a class="nav-link px-2 home-text" href="<?php echo BASE_URL ?>">Trang chủ</a>
                    </li>
                    <?php
                    session_start();
                    if (Session::get("login") == true) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link px-2 menu-text" href="<?php echo BASE_URL ?>/?url=home/profile">Hồ sơ</a>
                        </li>
                    <?php
                    }
                    if (Session::get("role") == "admin") {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link px-2 menu-text" href="<?php echo BASE_URL ?>/?url=admin">Admin</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post" action="<?php echo BASE_URL ?>/?url=home/search">
                    <input type="search" class="form-control form-control-dark" placeholder="Tìm kiếm..." name="tukhoa" aria-label="Search">
                </form>
                <div class="text-end">
                    <?php
                    // Kiểm tra session đã đăng nhập chưa
                    if (Session::get("login") == true) {
                    ?> -->
                        <a href="<?php echo BASE_URL ?>/?url=login/logout">
                            <button type="button" class="btn btn-outline-light me-2">Logout</button>
                        </a>

                    <?php
                    } else {
                    ?>
                        <a href="<?php echo BASE_URL ?>/?url=login">
                            <button type="button" class="btn btn-outline-light me-2">Login</button>
                        </a>
                        <a href="<?php echo BASE_URL ?>/?url=signup">
                            <button type="button" class="btn btn-warning">Sign-up</button>
                        </a>

                    <?php
                    }
                    ?>
                </div>


            </div>
        </div>
    </header>