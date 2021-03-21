<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1><?php echo $data['page_title']; ?></h1>
<?php
if(isset($_SESSION['user_id'])){
?>
    <a href="<?php echo URLROOT; ?>/posts/addpost"><h4>Add new post</h4></a>
    <br>

<?php
}
?>
    <hr>
<?php
foreach ($data['posts'] as $post){
    ?>

    <h4 class="d-flex justify-content-center"><?php echo $post->title?></h4>
    <div>
        <h6>Created by : <?php echo $post->name?></h6>
        <?php echo $post->created_at?>
    </div>
    <br>
    <?php
    if(strlen($post->description)>200){
        $text=substr($post->description,0,200).' ... <a href="'.URLROOT.'/posts/show/'.$post->postId.'"> Read More</a>';
    echo $text;

    }
    else{
        echo $post->description.'<br><a href="'.URLROOT.'/posts/show/'.$post->postId.'"> View Full Post</a>';
    }
     ?>
    <a href="<?php echo URLROOT; ?>/posts/show"></a>
    <hr>
    <?php
}

?>
<?php require APPROOT . '/views/inc/footer.php'; ?>