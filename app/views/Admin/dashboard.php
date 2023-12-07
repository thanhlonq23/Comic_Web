<!-- Nội dung chính -->
<main class="main">
    <ul class="insights">
        <li>
            <i class='bx bxs-book-open'></i>
            <span class="info">
                <h3>
                    <?php echo $totalWebtoons[0]['totalWebtoons']; ?>
                </h3>
                <p>Total Comics</p>
            </span>
        </li>
        <li><i class='bx bx-show-alt'></i>
            <span class="info">
                <h3>
                    3,944
                </h3>
                <p>Site Visit</p>
            </span>
        </li>
        <li>
            <i class='bx bx-user-circle'></i>
            <span class="info">
                <h3>
                    14,721
                </h3>
                <p>Users</p>
            </span>
        </li>
        <li><i class='bx bx-dollar-circle'></i>
            <span class="info">
                <h3>
                    $6,742
                </h3>
                <p>Total Coins</p>
            </span>
        </li>
    </ul>
    <!-- End of Insights -->

    <!-- Phần dữ liệu phía dưới -->
    <div class="bottom-data">
        <!-- Bảng Comics gần đây -->
        <div class="comics">
            <!-- Bảng hiển thị các comics gần đây (name, date, trạng thái) -->
            <div class="header">
                <i class='bx bxs-book-open'></i>
                <h3>Recent Comics</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="padding-left: 7px; font-size: 17px;">Comics</th>
                        <th style="padding-left: 7px;font-size: 17px;">Status</th>
                        <th style="padding-left: 7px;font-size: 17px;">Publish Date</th>
                        <th style="padding-left: 7px;font-size: 17px;">Chapter</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($recommended_Webtoon as $key => $value) {
                    ?>
                        <tr class="comicdb-row" style="cursor: pointer;" datadb-id="<?php echo BASE_URL ?>/?url=admin/info/&id=<?php echo $value['id'] ?>">
                            <td>
                                <img src="./public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?> " alt="Comic">
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
                            <td>
                                <?php
                                echo date("d/m/Y", strtotime($value['date']))
                                ?>
                            </td>
                            <td>30 chapters</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</main>