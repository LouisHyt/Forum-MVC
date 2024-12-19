<!-- c'est ici que les messages (erreur ou succès) s'affichent-->
<?php
    use App\Session;
    $flashError = Session::getFlash("error");
    $flashSuccess = Session::getFlash("success");
?>


<?php if($flashSuccess) : ?>
    <h3 class="flash-message success"><?= $flashSuccess ?></h3>
<?php endif; ?>

<?php if($flashError) : ?>
    <h3 class="flash-message error"><?= $flashError ?></h3>
<?php endif; ?>