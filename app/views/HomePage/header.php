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
                <a href="<?php echo BASE_URL ?>/login">
                    <button type=" button" class="btn btn-outline-light me-2" onclick="">Login</button>
                </a>
                <a href="<?php echo BASE_URL ?>/signup">
                    <button type=" button" class="btn btn-warning">Sign-up</button>
                </a>
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