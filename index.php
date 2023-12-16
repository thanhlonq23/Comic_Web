<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F4 Comic</title>
    <link rel="shortcut icon" href="./public/Logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./public/css/user/comicPage.css">
    <link rel="stylesheet" href="./public/css/admin/admin.css">
    <link rel="stylesheet" href="./public/css/user/header.css">
    <link rel="stylesheet" href="./public/css/user/homePage.css">
    <link rel="stylesheet" href="./public/css/user/readPage.css">
    <link rel="stylesheet" href="./public/css/user/profile.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./public/js/admin/admin.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    // Tự động gọi tất cả class trong Folder system
    spl_autoload_register(function ($class) {
        include_once './system/libs/' . $class . '.php';
    });
    // Gọi ra domain
    include_once('./app/config/config.php');
    // Khởi tạo biến main để điều khiển chương trình
    $main = new Main();
    ?>

</body>

</html>