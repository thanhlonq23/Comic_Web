<h1 style="text-align: center;">Edit User</h1>
<div class="container mt-5">
    <?php
    foreach ($userByID as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/user/edit/<?php echo $value['id'] ?>" method="post">
            Name <br>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nhập tên" value="<?php echo $value['name'] ?>">
            </div>
            PhoneNumber <br>
            <div class="mb-3">
                <input type="text" class="form-control" name="phoneNumber" placeholder="Nhập số điện thoại" value="<?php echo $value['phoneNumber'] ?>">
            </div>
            Email <br>
            <div class="mb-3">
                <input type="text" class="form-control" name="email" placeholder="Nhập email" value="<?php echo $value['email'] ?>">
            </div>
            Password <br>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Nhập Password" value="<?php echo $value['password'] ?>">
            </div>
            Role <br>
            <select class="form-select form-select-lg mb-3" name="role">
                <option selected value="user">Select role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    ?>
</div>