<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/profile.css">
<script src="<?= PUBLIC_DIR ?>/js/profile.js" defer></script>

<main class="profile-container">
    <div class="inner-profile">
        <h1 class="profile-title">Profile Management</h1>
        
        <!-- Formulaire d'ajout de catégorie -->
        <div class="form-container">
            <h2>Delete your account</h2>
            <form action="?ctrl=security&action=deleteUser" method="post" class="deleteuser-form">
                <input type="hidden" name="userId" value=<?= App\Session::getUser()->getId() ?>>
                <button type="submit" class="delete-button">Delete</button>
            </form>
        </div>

        <div class="form-container">
            <h2>Change global theme</h2>
            <div class="color-select">
                <input type="color" id="themeColor">
                <p>Current color: <span class="current-color">#FFF</span></p>
            </div>
            <div class="options">
                <button type="button" class="success-button apply">Apply</button>
                <button type="button" class="delete-button reset ">Reset</button>
            </div>
        </div>
</main>
