<?php
    $users = $data["users"] ?? null;
?>
<link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/admin.css">

<main class="admin-container">
<?php include('view/partials/flash.php'); ?>
    <div class="inner-admin">
        <h1 class="admin-title">Gestion des Utilisateurs</h1>
        
        <div class="users-list">
            <?php foreach($users as $user): ?>
                <div class="user-card">
                    <div class="user-info">
                        <div class="upper">
                            <p class="user-name"><?= $user->getUsername() ?></p>
                            <p class="user-email"><?= $user->getEmail() ?></p>
                        </div>
                        <p class="user-topics">Topics créés: <?= $user->getTopicCount() ?></p>
                        <p class="user-date">Membre depuis: <?= $user->getCreatedAt() ?></p>
                    </div>
                    <form action="index.php?ctrl=admin&action=banUser" method="post" class="ban-form">
                        <input type="hidden" name="userId" value="<?= $user->getId() ?>">
                        <button type="submit" class="ban-button <?= $user->getIsBanned() ? 'unban' : 'ban' ?>">
                            <?= $user->getIsBanned() ? 'Unban user' : 'Ban user' ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>