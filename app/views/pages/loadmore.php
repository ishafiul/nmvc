<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<?php
//print_r($data);
$url = URLROOT.'/pages/data/2';
foreach ($data as $dataa){

    ?>

<div class="post1" ">
    <h1><?php echo $dataa->title; ?></h1>
    <p>
        <?php echo substr($dataa->content, 0, 160)."..."; ?>
    </p>
    <a href="<?php echo $dataa->link; ?>" class="more" target="_blank">More</a>
</div>

<?php
            }
            ?>
<button id="load-more1">Load More</button>
<input type="hidden" id="row1" value="0">
<?php
loadmore('12','3','#row1','#load-more1','.post1',$url);
?>

</body>
</html>