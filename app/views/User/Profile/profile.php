<body class="d-flex flex-column min-vh-100 bg-dark-subtle">
    <div>
        <div class="profile-container container">
            <div class="row">
                <div class="col-4">
                    <div class="user-avatar">
                        <img src="./public/Uploads/User/<?php echo $userInfo[0]["media"] ?>.jpg" alt="Profile Picture" class="card-img-top user-image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $userInfo[0]["name"] ?></h5>
                    </div>
                </div>
                <div class="col-8 m-auto">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">ID: <?php echo $userInfo[0]["id"] ?></li>
                        <li class="list-group-item">Email: <?php echo $userInfo[0]["email"] ?></li>
                        <li class="list-group-item">Số điện thoại: <?php echo $userInfo[0]["phoneNumber"] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container bg-white">
            <div class="m-3">
                <ul class="d-flex nav p-2 gap-3 justify-content-around">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Đã thích" role="button" target="_blank"><i class="fa-regular fa-heart"></i> Đang theo dõi</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Đã mở khóa" role="button" target="_blank"><i class="fa-solid fa-lock"></i> Đã mở khóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark m-1" href="#" title="Lịch sử" role="button" target="_blank"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử dọc</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>