<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <script src="<?= PUBLIC_DIR ?>/js/script.js" defer></script>
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="wrapper"> 
            <header>
                <nav id="main-nav">
                    <div id="nav-left">
                        <a href="./" class="logo">
                            <span>Dev</span><span>Forum</span>
                        </a>
                    </div>
                    <div id="nav-right">
                    <?php
                        // si l'utilisateur est connecté 
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=security&action=profile">
                                <span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?>
                            </a>
                            <a href="index.php?ctrl=security&action=logout">Logout</a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="index.php?ctrl=security&action=login">Login</a>
                            <a href="index.php?ctrl=security&action=register">Register</a>
                        <?php
                        }
                    ?>
                    </div>
                </nav>
            </header>
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <main id="forum">
                    <?= $page ?>
                </main>
            </div>
            <footer>
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
            </footer>
        </div>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>