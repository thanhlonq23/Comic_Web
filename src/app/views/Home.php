<div>
    <h1>HOME PAGE</h1>
</div>


<p>
    Category:
    <?php
    foreach ($data as $key) {
        echo $key['cate1'] . '<br>';
        echo $key['cate2'] . '<br>';
        echo $key['cate3'] . '<br>';
    }
    ?>
</p>