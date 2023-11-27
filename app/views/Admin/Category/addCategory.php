<h1 style="text-align: center;">Thêm Category:</h1>
<div class="container mt-5">
    <form action="<?php echo BASE_URL ?>/?url=chapter/add" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Webtoon:</label>
            <select class="form-select form-select-lg mb-3" name="webtoon_id">
                <option selected value="null">Select Webtoon</option>
                <?php
                foreach ($webtoons as $key => $value) {
                ?>
                    <option value="<?php echo $value['id'] ?>">
                        <?php echo $value['name'] ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categories Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên Chapter">
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <?php
        if (!empty($_GET['msg'])) {
            $msg = unserialize(urldecode($_GET['msg']));
            foreach ($msg as $key => $value) {
                echo "<p style='color: green'><br> $value </p>";
            }
        }
        ?>
    </form>
</div>