<main class="main">
    <div class="bottom-data">
        <!-- Bảng Categories -->
        <div class="comics">
            <div class="header">
                <i class='bx bx-category'></i>
                <h3>List of Users</h3>
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
                        <th style=" padding-left: 7px; font-size: 17px;">ID</th>
                        <th style="padding-left: 7px; font-size: 17px;">Username</th>
                        <th style=" padding-left: 7px; font-size: 17px;">Name</th>
                        <th style="padding-left: 7px; font-size: 17px;"> PhoneNumber</th>
                        <th style=" padding-left: 7px; font-size: 17px;">Email</th>
                        <th style="padding-left: 7px; font-size: 17px;">Role</th>
                        <th style="padding-left: 7px; font-size: 17px; text-align: right; padding-right: 60px;">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($users as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['username'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['phoneNumber'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['role'] ?></td>
                            <td style="text-align: right; padding-right: 20px;">
                                <a href="<?php echo BASE_URL ?>/?url=user/edit_User/<?php echo $value['id'] ?>" style="text-decoration: none;">
                                    <input type="button" value="Edit">
                                </a>
                                <a href="<?php echo BASE_URL ?>/?url=user/delete_User/<?php echo $value['id'] ?>" style="text-decoration: none;">
                                    <input type="button" value="Delete">
                                </a>
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