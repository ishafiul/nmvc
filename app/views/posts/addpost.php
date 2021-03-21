<?php require APPROOT . '/views/inc/header.php';
//print_r($data);
?>
    <form action="<?php echo URLROOT; ?>/posts/addpost" method="post">
       <div>
           <input type="text" name="title" class=" <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                  value="">
           <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
       </div>
        <BR>
        <textarea rows="15" cols="100" name="details" class=" <?php echo (!empty($data['details_err'])) ? 'is-invalid' : ''; ?>"></textarea>
        <span class="invalid-feedback"><?php echo $data['details_err']; ?></span>
        <input type="submit" value="Add New Post">
    </form>
<?php require APPROOT . '/views/inc/footer.php'; ?>