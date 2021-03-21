<?php
if (isset($_SESSION['user_id'])) {
    ?>
    <br>
    <form action="<?php echo URLROOT; ?>/posts/addcomments/<?php echo $data['post']->id?>" method="post">
        <textarea name="comment" id="" cols="30" rows="10"></textarea>
        <input type="submit"  name="addComment" value="Add New Comment" >
    </form>
    <?php
}
?>