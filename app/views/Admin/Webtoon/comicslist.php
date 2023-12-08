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
            <?php
            if (!empty($_GET['msg'])) {
                $msg = unserialize(urldecode($_GET['msg']));
                foreach ($msg as $key => $value) {
                    echo "<p style='color: green'><br> $value </p>";
                }
            }
            ?>
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
                        <input id="searchInput" type="search" placeholder="Search...">
                        <i class='bx bx-sort-a-z' style="display: block; margin-left: 20px; margin-right: 10px;"></i>
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
                    usort($webtoons, function ($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
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

</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var sorted = false; // Biến để xác định trạng thái sắp xếp

        $('#searchInput').on('input', function() {
            var value = $(this).val().toLowerCase().trim();
            if (value === '') {
                // Nếu input trống, trả về danh sách ban đầu
                resetWebtoonList();
            } else {
                // Nếu có nội dung trong input, thực hiện tìm kiếm
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            }
        });

        $('.bx-sort-a-z').click(function() {
            sorted = !sorted; // Đảo ngược trạng thái sắp xếp
            var rows = $('tbody tr').get();
            rows.sort(function(a, b) {
                var A = $(a).children('td').eq(0).text().toUpperCase();
                var B = $(b).children('td').eq(0).text().toUpperCase();
                if (sorted) {
                    return A > B ? -1 : A < B ? 1 : 0;
                } else {
                    return A < B ? -1 : A > B ? 1 : 0;
                }
            });
            $.each(rows, function(index, row) {
                $('tbody').append(row);
            });

            // Thay đổi biểu tượng và class tùy thuộc vào trạng thái sắp xếp
            if (sorted) {
                $(this).removeClass('bx-sort-a-z').addClass('bx-sort-z-a');
            } else {
                $(this).removeClass('bx-sort-z-a').addClass('bx-sort-a-z');
            }
        });

        // Hàm để reset danh sách webtoon ban đầu
        function resetWebtoonList() {
            $('tbody tr').show(); // Hiển thị lại toàn bộ danh sách webtoon ban đầu
        }
    });
</script>