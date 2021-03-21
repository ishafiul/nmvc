<?php require APPROOT . '/views/inc/header.php';
print_r($data);
echo $data['comments']->comment;
?>
    <form action="<?php echo URLROOT; ?>/posts/editcomments/<?php echo $data['comments']->id?>" method="post">

        <textarea rows="15" cols="100" name="comment" class=" <?php echo (!empty($data['details_err'])) ? 'is-invalid' : ''; ?>"> <?php echo $data['comments']->comment; ?></textarea>
        <span class="invalid-feedback"><?php echo $data['details_err']; ?></span>
        <input type="submit" value="Edit Comment">
    </form>
<?php require APPROOT . '/views/inc/footer.php'; ?>