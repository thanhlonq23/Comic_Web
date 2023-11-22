<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>

    <form autocomplete="off" action="<?php echo BASE_URL ?>/categoryController/insertCategory" method="post">
        <table>
            <tr>
                <td>ID</td>
                <td>
                    <input type="text" name="id" required>
                </td>
            </tr>

            <tr>
                <td>UserName</td>
                <td>
                    <input type="text" name="username" required>
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td>
                    <input type="text" name="password" required>
                </td>

            </tr>

            <tr>
                <td>
                    <input type="submit" name="insert" value="Thêm dữ liệu">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>