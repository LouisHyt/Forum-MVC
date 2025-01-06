<?php
    $title = "Create a new Topic";
    $categories = $data["categories"] ?? null;
?>

<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/forms.css">

<div class="container-form">
    <h1><?= $title ?></h1>
    
    <?php include('view/partials/flash.php'); ?>
    
    <form action="?ctrl=topic&action=create" method="post">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" maxlength="150" minlength="10">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="7" required></textarea>
        </div>
    
        <div class="form-group">
            <label for="category">Category :</label>
            <?php if(!$categories): ?>
                <p class="danger">No categories available</p>
            <?php else: ?>
                <select name="category" id="category" required>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </div>
    
        <button type="submit" name="submit">Create</button>
    </form>
</div>
