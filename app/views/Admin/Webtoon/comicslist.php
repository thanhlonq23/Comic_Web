<!-- Nội dung chính -->
<main class="main">
    <div style="background-color: #f6f6f9; padding: 15px; width: 100% ;border-radius: 20px; position: sticky; top: 50px;">
        <div class="upload-comic">
            <a href="<?php echo BASE_URL ?>/?url=webtoon/add_Webtoon">
                <button style="display: block; background-color: #00c493; color: #ffffff; font-size: 16px; cursor: pointer; padding: 12px 24px;
                    border-radius: 8px;border: none; outline: none;">
                    Create Project
                </button>
            </a>
        </div>
    </div>

    <!-- Phần dữ liệu phía dưới -->
    <div class="bottom-data">

        <!-- Bảng Comics gần đây -->
        <div class="comics">

            <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
            <div class="header">
                <i class='bx bxs-book-open'></i>
                <h3>List Comics</h3>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                    </div>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 7px; font-size: 17px;">Comics</th>
                        <th style="padding-left: 7px;font-size: 17px;">Status</th>
                        <th style="font-size: 17px;">Publish Date</th>
                        <th style="padding-left: 7px;font-size: 17px;">Chapter</th>
                        <th style="padding-left: 7px;font-size: 17px;" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($webtoons as $key => $value) {
                    ?>
                        <tr class="comic-row" data-id="<?php echo BASE_URL ?>/?url=admin/info/&id=<?php echo $value['id'] ?>" style="cursor: pointer;">
                            <td>
                                <img src="./public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?> " alt="Ảnh bìa">
                                <p><?php echo $value['name'] ?></p>
                            </td>
                            <td>
                                <?php
                                if ($value['status'] == false) {
                                    echo '<span class="status process">';
                                    echo 'Processing';
                                    echo '</span>';
                                } else {
                                    echo '<span class="status completed">';
                                    echo 'Completed';
                                    echo '</span>';
                                } ?>
                            </td>
                            <td class="date">
                            <?php
                                echo date("d/m/Y", strtotime($value['date']))
                                ?>
                            </td>
                            <td>30 chapters</td>
                            <td>
                                <a href="<?php echo BASE_URL ?>/?url=webtoon/edit_Webtoon/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;"><input type="button" value="Edit"></a>
                                <a href="<?php echo BASE_URL ?>/?url=webtoon/delete_Webtoon/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;"><input type="button" value="Delete"></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

</main>