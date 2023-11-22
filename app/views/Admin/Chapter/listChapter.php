<div class="container-fluid">
    <table class="table table-striped" style="width: 100%; border: 1px ;">
        <thead>
            <th colspan="11">
                <h1 style="text-align: center; font-size: 80px;">Chapter</h1>
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
                <th class="col-2 text-center">Webtoon ID</th>
                <th class="col-3 text-center">Name</th>
                <th class="col-1 text-center">Media</th>
                <th class="col-1 text-center">Price</th>
                <th class="col-1 text-center">Views</th>
                <th class="col-1 text-center">Date</th>
                <th class="col-2 text-center">Status</th>
                <th class="col-2 text-center" colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $stt = 0;
            foreach ($chapters as $key => $value) {
                $stt++;
            ?>
                <tr>
                    <td class="col-1 text-center"><?php echo $stt ?></td>
                    <td class="col-1 text-center"><?php echo $value['id'] ?></td>
                    <td class="col-2 text-center"><?php echo $value['webtoon_id'] ?></td>
                    <td class="col-3 text-center"><?php echo $value['name'] ?></td>
                    <td class="col-1 text-center"><?php echo $value['media'] ?></td>
                    <td class="col-1 text-center"><?php echo $value['price'] ?></td>
                    <td class="col-1 text-center"><?php echo $value['views'] ?></td>
                    <td class="col-1 text-center"><?php echo $value['date'] ?></td>
                    <td class="col-2 text-center">
                        <?php
                        if ($value['status'] == true) {
                            echo 'Unlock';
                        } else {
                            echo 'Lock';
                        }
                        ?>
                    </td>
                    <td class="col-1 text-center">
                        <a href="<?php echo BASE_URL ?>/chapter/edit_Chapter/<?php echo $value['id'] ?>" style="text-decoration: none;">Edit</a>
                    </td>
                    <td class="col-1 text-center">
                        <a href="<?php echo BASE_URL ?>/chapter/delete_Chapter/<?php echo $value['id'] ?>" style="text-decoration: none;">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>