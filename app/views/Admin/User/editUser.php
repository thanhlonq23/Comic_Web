<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo "<p style='color: green'><br> $value </p>";
    }
}
?>
<h1 style="text-align: center;">Edit User</h1>
<div class="container mt-5">
    <?php
    foreach ($userByID as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/user/edit/<?php echo $value['id'] ?>" method="post">
            <div class="mb-3">
                Name <br>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="<?php echo $value['name'] ?>">
            </div>
            <div class="mb-3">
                PhoneNumber <br>
                <input type="text" class="form-control" name="phoneNumber" placeholder="Nhập số điện thoại" value="<?php echo $value['phoneNumber'] ?>">
            </div>
            <div class="mb-3">
                Email <br>
                <input type="text" class="form-control" name="email" placeholder="Nhập email" value="<?php echo $value['email'] ?>">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    ?>
</div>