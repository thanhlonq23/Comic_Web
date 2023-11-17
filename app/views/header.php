<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
</head>

<body>
    <header class="p-3 bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link px-2 home-text" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2 menu-text" href="#">Theo dõi</a>
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
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>
</body>

</html>