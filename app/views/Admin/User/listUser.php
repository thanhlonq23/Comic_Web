<div class="container-fluid">

    <table class="table table-striped" style="width: 100%; border: 1px;">
        <thead>
            <th colspan="10">
                <h1 style="text-align: center; font-size: 80px;">Users</h1>
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
                <th class="text-center">STT</th>
                <th class="text-center">ID</th>
                <th class="text-center">Username</th>
                <th class="text-center">Name</th>
                <th class="text-center">PhoneNumber</th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <!-- <th class="text-center">Password</th> -->
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($users as $key => $value) {
                $stt++;
            ?>
                <tr>
                    <th class="text-center"><?php echo $stt ?></th>
                    <td class="text-center"><?php echo $value['id'] ?></td>
                    <td class="text-center"><?php echo $value['username'] ?></td>
                    <td class="text-center"><?php echo $value['name'] ?></td>
                    <td class="text-center"><?php echo $value['phoneNumber'] ?></td>
                    <td class="text-center"><?php echo $value['email'] ?></td>
                    <td class="text-center"><?php echo $value['role'] ?></td>
                    <!-- <td class="text-center"><?php //echo $value['password'] ?></td> -->
                    <td class="text-center">
                        <a href="<?php echo BASE_URL ?>/?url=user/edit_User/<?php echo $value['id'] ?>" style="text-decoration: none;">Edit</a>
                    </td>
                    <td class="col-1 text-center">
                        <a href="<?php echo BASE_URL ?>/?url=user/delete_User/<?php echo $value['id'] ?>" style="text-decoration: none;">Delete</a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
</div>