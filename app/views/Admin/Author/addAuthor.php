<h1 style="text-align: center;">Thêm tác giả:</h1>
<div class="container mt-5">
    <form action="<?php echo BASE_URL ?>/?url=author/add" method="post">
        <div class="mb-3">
            <label for="itemName" class="form-label">Tên tác giả:</label>
            <input type="text" class="form-control" id="itemName" name="name" placeholder="Nhập tên tác giả">
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <?php
        if (!empty($_GET['msg'])) {
            $msg = unserialize(urldecode($_GET['msg']));
            foreach ($msg as $key => $value) {
                echo"<p style='color: green'><br> $value </p>";
            }
        }
        ?>
    </form>
</div>