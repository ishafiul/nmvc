<?php
foreach ($data as $dataa){

    ?>

    <div class="post" id="">
        <h1><?php echo $dataa->title; ?></h1>
        <p>
            <?php echo substr($dataa->content, 0, 160)."..."; ?>
        </p>
        <a href="<?php echo $dataa->link; ?>" class="more" target="_blank">More</a>
    </div>

    <?php
}
?>