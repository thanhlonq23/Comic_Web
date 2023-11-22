<h1 style="text-align: center;">Thêm truyện:</h1>
<div class="container mt-5">
    <form action="<?php echo BASE_URL ?>/webtoon/add" method="post">
        <div class="mb-3">
            <label class="form-label">Tên truyện:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên truyện">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả:</label>
            <input type="text" class="form-control" name="description" placeholder="Nhập mô tả">
        </div>
        <div class="mb-3">
            Ảnh bìa <br>
            <input type="file" id="fileInput" class="form-control" name="cover">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <div>
            <?php
            if (!empty($_GET['msg'])) {
                $msg = unserialize(urldecode($_GET['msg']));
                foreach ($msg as $key => $value) {
                    echo "<p style='color: green'><br> $value </p>";
                }
            }
            ?>
        </div>
    </form>
</div>