<main class="main">
    <div style="background-color: #f6f6f9; padding: 15px; width: 100% ;border-radius: 20px; position: sticky; top: 50px;">
        <div class="upload-category">
            <a href="<?php echo BASE_URL ?>/?url=author/add_Author/">
                <button style="display: block; background-color: #00c493; color: #ffffff; font-size: 16px; cursor: pointer; padding: 12px 24px;
                    border-radius: 8px;border: none; outline: none;">
                    Add Author
                </button>
            </a>
        </div>
    </div>

    <!-- ... -->
    <!-- Phần dữ liệu phía dưới -->
    <div class="bottom-data">
        <!-- Bảng Categories -->
        <div class="comics">
            <div class="header">
                <i class='bx bx-category'></i>
                <h3>List of Authors</h3>
                <?php
                if (!empty($_GET['msg'])) {
                    $msg = unserialize(urldecode($_GET['msg']));
                    foreach ($msg as $key => $value) {
                        echo "<p style='color: green'><br> $value </p>";
                    }
                }
                ?>
                <!-- Thêm form tìm kiếm nếu cần -->
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 7px; font-size: 17px;">ID</th>
                        <th style="padding-left: 7px; font-size: 17px;">Author Name</th>
                        <th style="padding-left: 7px; font-size: 17px; text-align: right; padding-right: 60px;">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($authors as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td style="text-align: right; padding-right: 20px;">
                                <a href="<?php echo BASE_URL ?>/?url=author/edit_Author/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;">
                                    <input type="button" value="Edit">
                                </a>
                                <a href="<?php echo BASE_URL ?>/?url=author/delete_Author/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;">
                                    <input type="button" value="Delete">
                                </a>
                            </td>

                            <td class="col-1 text-center">
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>