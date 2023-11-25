<h1 style="text-align: center;">Sửa Chapter</h1>
<div class="container mt-5">
    <?php
    foreach ($chapterByID as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/?url=chapter/edit/<?php echo $value['id'] ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Chapter Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên Chapter" value="<?php echo $value['name'] ?>">
            </div>

            <div class="mb-3">
                Tình trạng <br>
                <input type="radio" id="status1" name="status" value="1">
                <label for="status1">Mở khóa</label>
                <input type="radio" id="status2" name="status" value="0">
                <label for="status2">Khóa</label>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    // Hiện thông báo
    if (!empty($_GET['msg'])) {
        $msg = unserialize(urldecode($_GET['msg']));
        foreach ($msg as $key => $value) {
            echo "<p style='color: green'><br> $value </p>";
        }
    }
    ?>
</div>