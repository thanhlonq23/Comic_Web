<!-- Nội dung chính -->
<main class="main">
    <div style="background-color: #f6f6f9; padding: 15px; width: 100% ;border-radius: 20px; position: sticky; top: 50px;">
        <div class="upload-category">
            <a href="<?php echo BASE_URL ?>/?url=category/add_Category">
                <button style="display: block; background-color: #00c493; color: #ffffff; font-size: 16px; cursor: pointer; padding: 12px 24px;
                    border-radius: 8px;border: none; outline: none;">
                    Create Category
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
                <h3>List of Categories</h3>
                <!-- Thêm form tìm kiếm nếu cần -->
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 7px; font-size: 17px;">ID</th>
                        <th style="padding-left: 7px; font-size: 17px;">Name</th>
                        <th style="padding-left: 7px; font-size: 17px; text-align: right; padding-right: 60px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td><?php echo $category['name']; ?></td>

                            <!-- Thêm các action nếu cần -->
                            <!-- Ví dụ: Edit và Delete -->
                            <td style="text-align: right; padding-right: 20px;">
                                <a href="<?php echo BASE_URL ?>/?url=category/edit_Category/<?php echo $category['id'] ?>" style="text-decoration: none; font-size: 12px;">
                                    <input type="button" value="Edit">
                                </a>
                                <a href="<?php echo BASE_URL ?>/?url=category/delete_Category/<?php echo $category['id'] ?>" style="text-decoration: none; font-size: 12px;">
                                    <input type="button" value="Delete">
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>