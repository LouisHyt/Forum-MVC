<?php
    $title = "Login";
?>
<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/forms.css">

<div class="container-form">
    <h1><?= $title ?></h1>
    
    <?php include('view/partials/flash.php'); ?>
    
    <form action="?ctrl=security&action=login" method="post">
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>
        </div>
    
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="actions">
            <button type="submit" name="submit">Login</button>
        </div>
    </form>
</div>