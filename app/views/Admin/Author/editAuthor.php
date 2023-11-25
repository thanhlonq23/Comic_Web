<h1 style="text-align: center;">Sửa Tác Giả</h1>
<div class="container mt-5">
    <?php
    foreach ($authorByID as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/?url=author/edit/<?php echo $value['id'] ?>" method="post">
            <div class="mb-3">
                Tên tác giả <br>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên tác giả" value="<?php echo $value['name'] ?>">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    ?>
</div>