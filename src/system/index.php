<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("./inc/header.php");
    ?>

    <h1>
        <?php
        include_once("./system/libs/main.php");
        include_once("./system/libs/DController.php");

        // $main = new Main();
        $url = isset($_GET['url']) ? $_GET['url'] : null;

        if ($url != null) {
            $url = rtrim($url, '/');
            $url  = explode('/', filter_var($url, FILTER_SANITIZE_URL));
        } else {
            unset($url);
        }

        if (isset($url[0])) {
            include_once("./app/controller/" . $url[0] . ".php");
            $ctlr = new $url[0]();

            if (isset($url[2])) {
                $ctlr->{$url[1]}($url[2]);
            } else {
                if (isset($url[1])) {
                    $ctlr->{$url[1]};
                } else {
                }
            }
        } else {
            include_once("./app/controller/index.php");
            $index = new index();
            $index->homePage();
        }
        // $ctlr->{$url[1]}($url[2], $url[3]);

        // echo '<pre>';
        // print_r($url);
        // echo '<pre>';

        // echo '<br>Class: ' . $url[0];
        // echo '<br>Methods: ' . $url[1];
        // echo '<br>Parametter: ' . $url[2];
        // echo '<br>ID: ' . $url[3];


        ?>
    </h1>



    <?php
    include("./inc/footer.php");
    ?>

</body>

</html>