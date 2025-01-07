<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/profile.css">

<main class="profile-container">
    <div class="inner-profile">
        <h1 class="profile-title">Profile Management</h1>
        
        <!-- Formulaire d'ajout de catégorie -->
        <div class="delete-form-container">
            <h2>Delete your account</h2>
            <form action="?ctrl=security&action=deleteUser" method="post" class="deleteuser-form">
                <input type="hidden" name="userId" value=<?= App\Session::getUser()->getId() ?>>
                <button type="submit" class="delete-button">Delete</button>
            </form>
        </div>
</main>
