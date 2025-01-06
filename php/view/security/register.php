<?php
$title = "Register";
?>
<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/forms.css">

<div class="container-form">
    <h1><?= $title ?></h1>
    
    <?php include('view/partials/flash.php'); ?>
    
    <form action="?ctrl=security&action=register" method="post">
        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>
        </div>
    
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
    
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </div>
    
        <div class="form-group">
            <label for="confirmPassword">Confirm Password :</label>
            <input type="password" name="confirmPassword" id="confirmPassword" required>
        </div>
    
        <div class="actions">
            <button type="submit" name="submit">Register</button>
        </div>
    </form>
</div>
