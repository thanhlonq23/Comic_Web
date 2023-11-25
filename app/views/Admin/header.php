<header>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?php echo BASE_URL ?>">
                            <img src="../app/upload/logo/f4.jpg" alt="" width="45" height="39" class="d-inline-block align-text-top">
                        </a>
                    </div>
                </nav>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class=" nav-item dropdown">
                            <a class=" nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Webtoon
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=webtoon/list_Webtoon">List</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=webtoon/add_Webtoon">Add</a></li>
                            </ul>
                        </li>
                        <li class=" nav-item dropdown">
                            <a class=" nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Chapter
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=chapter/list_Chapter">List</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=chapter/add_Chapter">Add</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Author
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=author/list_Author">List</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=author/add_Author">Add</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=user/list_User">List</a></li>
                                <li><a class="dropdown-item">Cấp quyền Admin</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>">Tài khoản</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL ?>/?url=login/logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL ?>/?url=admin"> Home</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        Welcome to Admin Page
                    </span>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>
</header>