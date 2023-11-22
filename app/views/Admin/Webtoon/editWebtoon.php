<h1 style="text-align: center;">Sửa Truyện</h1>
<div class="container mt-5">
    <?php
    foreach ($webtoonByID as $key => $value) {
    ?>
        <form action="<?php echo BASE_URL ?>/webtoon/edit/<?php echo $value['id'] ?>" method="post">
            <div class="mb-3">
                Tên Truyện <br>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên Truyện" value="<?php echo $value['name'] ?>">
            </div>
            <div class="mb-3">
                Mô tả <br>
                <input type="text" class="form-control" name="description" placeholder="Nhập mô tả" value="<?php echo $value['description'] ?>">
            </div>
            <div class="mb-3">
                Ảnh bìa <br>
                <input type="file" class="form-control" name="cover">
            </div>
            <div class="mb-3">
                Tình trạng <br>
                <input type="radio" id="status1" name="status" value="1">
                <label for="status1">Đã hoàn thành</label>
                <input type="radio" id="status2" name="status" value="0">
                <label for="status2">Chưa hoàn thành</label>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php
    }
    ?>
</div>