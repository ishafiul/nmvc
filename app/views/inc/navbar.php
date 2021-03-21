<div class="container">
    <h1 class="d-flex justify-content-center"><a href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a></h1>
    <h2 class="d-flex justify-content-center">Sottotitolo sito - Tipo descrizione/motto</h2>

</div>
<hr>
<ul class="nav justify-content-center">
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="<?php echo URLROOT; ?>/posts">Lista Post</a>
    </li>
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="index">home</a>
    </li>
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="#">riservata</a>
    </li>
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="#">speciale</a>
    </li>
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="#">admin</a>
    </li>
    <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
        <a class="nav-link"  href="#">contatti</a>
    </li>

        <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </li>
        <?php else : ?>
            <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item" style="font-size: 2em;display: inline;padding: 0px 10px;background: lightgreen;border-radius: 5px;">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
        <?php endif; ?>

</ul>

<hr>
<div class="" style="margin-bottom: -300px; margin-left: 250px; font-size: 26px">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Lista Post</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">riservata</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" >speciale</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" >admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" >contatti</a>
        </li>
    </ul>
</div>

