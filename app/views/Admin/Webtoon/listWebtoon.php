<div class="container-fluid">
    <table class="table table-striped" style="width: 100%; border: 1px ;">
        <thead>
            <th colspan="9">
                <h1 style="text-align: center; font-size: 80px;">Webtoons</h1>
                <?php
                if (!empty($_GET['msg'])) {
                    $msg = unserialize(urldecode($_GET['msg']));
                    foreach ($msg as $key => $value) {
                        echo "<p style='color: green'><br> $value </p>";
                    }
                }
                ?>
            </th>
            <tr>
                <th class="col-1 text-center">STT</th>
                <th class="col-1 text-center">ID</th>
                <th class="col-3 text-center">Webtoon Name</th>
                <th class="col-2 text-center">Description</th>
                <th class="col-2 text-center">Date</th>
                <th class="col-2 text-center">Status</th>
                <th class="col-1 text-center">Cover</th>
                <th class="col-2 text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($webtoons as $key => $value) {
                $stt++;
            ?>
                <tr>
                    <td class="col-1 text-center"><?php echo $stt ?></td>
                    <td class="col-1 text-center"><?php echo $value['id'] ?></td>
                    <td class="col-3 text-center"><?php echo $value['name'] ?></td>
                    <td class="col-4 text-center"><?php echo $value['description'] ?></td>
                    <td class="col-2 text-center"><?php echo $value['date'] ?></td>
                    <td class="col-2 text-center">
                        <?php
                        if ($value['status'] == false) {
                            echo 'Chưa hoàn thành';
                        } else {
                            echo 'Đã hoàn thành';
                        } ?>
                    </td>
                    <td class="col-4 text-center">
                        <img src="../public/Uploads/Cover/Webtoon/<?php echo $value['cover'] ?> " alt="Ảnh bìa" width="100" style="height:auto;">
                    </td>
                    <td class="col-1 text-center">
                        <a href="<?php echo BASE_URL ?>/webtoon/edit_Webtoon/<?php echo $value['id'] ?>" style="text-decoration: none;">Edit</a>
                    </td>
                    <td class="col-1 text-center">
                        <a href="<?php echo BASE_URL ?>/webtoon/delete_Webtoon/<?php echo $value['id'] ?>" style="text-decoration: none;">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>