<h1 style="text-align: center;">Thêm truyện:</h1>
<div class="container mt-5">
    <form action="<?php echo BASE_URL ?>/webtoon/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên truyện:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên truyện">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label><br>
            <textarea class="form-control" name="description" rows="5" placeholder="Nhập mô tả"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh bìa:</label>
            <input type="file" class="form-control" name="cover" accept=".jpg,.png,.mov">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>

        <!-- Hiện thông báo -->
        <div>
            <h4 style='color: green'><br>
                <?php
                if (!empty($_GET['msg'])) {
                    $msg = unserialize(urldecode($_GET['msg']));
                    foreach ($msg as $key => $value) {
                        echo $value;
                    }
                }
                ?>
            </h4>
        </div>
    </form>
</div>