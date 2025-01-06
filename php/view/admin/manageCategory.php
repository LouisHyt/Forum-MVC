<?php
    $categories = $data["categories"] ?? null;
?>
<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/admin.css">

<main class="admin-container">
<?php include('view/partials/flash.php'); ?>
    <div class="inner-admin">
        <h1 class="admin-title">Gestion des Catégories</h1>
        
        <!-- Formulaire d'ajout de catégorie -->
        <div class="category-form-container">
            <h2>Add a new Category</h2>
            <form action="index.php?ctrl=admin&action=addCategory" method="post" class="category-form">
                <input type="text" name="categoryName" placeholder="Category Name" required>
                <button type="submit" class="add-button">Add</button>
            </form>
        </div>

        <!-- Liste des catégories -->
        <div class="categories-list">
            <?php if($categories): ?>
                <?php foreach($categories as $category): ?>
                    <div class="category-card">
                        <div class="category-info">
                            <form action="index.php?ctrl=admin&action=editCategory" method="post" class="edit-form">
                                <input type="hidden" name="categoryId" value="<?= $category->getId() ?>">
                                <input type="text" name="categoryName" value="<?= $category->getName() ?>" class="category-name" required>
                                <button type="submit" class="edit-button">Edit</button>
                            </form>
                        </div>
                        <form action="index.php?ctrl=admin&action=deleteCategory" method="post" class="delete-form">
                            <input type="hidden" name="categoryId" value="<?= $category->getId() ?>">
                            <input type="hidden" name="categoryName" value="<?= $category->getName() ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-categories">No categories found</p>
            <?php endif; ?>
        </div>
    </div>
</main>
