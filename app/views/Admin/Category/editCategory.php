

<h1 style="text-align: center;">Sửa Thể loại</h1>
<div class="container mt-5">
    <?php
    foreach ($categories as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/?url=category/edit/<?php echo $value['id'] ?>" method="post">
            <div class="mb-3">
                Tên thể loại <br>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên thể loại" value="<?php echo $value['name'] ?>">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    ?>
</div>