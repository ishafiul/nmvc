<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1><?php echo $data['page_title']; ?></h1>
    <br>
<?php

//print_r($data);
if(isset($_SESSION['user_id'])){
    if($_SESSION['user_id'] == $data['post']->userid || $_SESSION['user_type'] == 'admin'){
        ?>
        <a href="<?php echo URLROOT; ?>/posts/editpost/<?php echo  $data['post']->id?>"><h4>Edit post</h4></a>
        <a href="<?php echo URLROOT; ?>/posts/deletepost/<?php echo  $data['post']->id?>"><h5>Delete post</h5></a>
    <br>

    <?php
    }
}
?>

    <h4><?php echo $data['post']->title?></h4>
    <div>
        <h6>Created by :  <?php echo $data['user']->name?></h6>
        <?php echo $data['post']->created_at?>
    </div>
    <br>
<?php echo $data['post']->description?>
    <a href="<?php echo URLROOT; ?>/posts/show"></a>
    <hr>
    <h3>Comments</h3>
<?php
foreach ($data['comments'] as $comment){
    ?>
    <?php echo $comment->comment?>
    <?php echo $comment->commentId?>
    <br>
    By : <i><?php echo $comment->name?></i>
    <?php
    if (isset($_SESSION['user_id'])){
        if($_SESSION['user_id'] == $comment->user_id || $_SESSION['user_type'] == 'admin'){
            ?>
            <div><a href="<?php echo URLROOT; ?>/posts/editcomments/<?php echo  $comment->commentId?>"><b>edit</b></a> <a href="<?php echo URLROOT; ?>/posts/deletecomment/<?php echo  $comment->commentId?>"><b>delete</b></a></div>
            <?php
        }
    }
    ?>
    <hr >
    <?php
}
if (empty($data['comments'])){
    echo 'there is no comments <br>';
}
require_once 'addcomments.php';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>