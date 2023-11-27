<?php
$webtoonId = ''; // Khai báo biến webtoonId

// Lấy giá trị của tham số 'id' từ URL nếu có
$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $query_params);
    if (isset($query_params['id'])) {
        $webtoonId = $query_params['id'];
    }
}
?>
<!-- Này là phần hiển thị chapter và thêm chapter ở ơhias dưới của mỗi comic  -->
<main class="main">
    <!-- Phần dữ liệu phía dưới -->
    <div class="bottom-data">

        <!-- Bảng Comics gần đây -->
        <div class="comics">

            <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
            <div class="header">
                <i class='bx bxs-book-open'></i>
                <h3>Chapters</h3>

                <a href="<?php echo BASE_URL ?>/?url=chapter/add_Chapter/&id=<?php echo $webtoonId ?>">
                    <button style="display: block; background-color: #00c493; color: #ffffff; font-size: 16px; cursor: pointer; padding: 12px 24px;
                    border-radius: 8px;border: none; outline: none;">
                        Create Chapter
                    </button>
                </a>

            </div>
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 7px; font-size: 17px;">Chapter</th>
                        <th style="padding-left: 7px;font-size: 17px;">Status</th>
                        <th style="font-size: 17px;">Publish Date</th>
                        <th style="padding-left: 7px;font-size: 17px;" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($chapters as $key => $value) {
                    ?>
                        <tr class="chapter-row" data-chapter-id="<?php echo BASE_URL ?>/?url=comicPage/readPage/<?php echo $webtoonId ?>&chapter=<?php echo $value['id'] ?>" style="cursor: pointer;">
                            <td class="col-8">
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
                            <td>
                                <a href="<?php echo BASE_URL ?>/?url=chapter/edit_Chapter/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;"><input type="button" value="Edit"></a>
                                <a href="<?php echo BASE_URL ?>/?url=chapter/delete_Chapter/<?php echo $value['id'] ?>" style="text-decoration: none; font-size: 12px;"><input type="button" value="Delete"></a>
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