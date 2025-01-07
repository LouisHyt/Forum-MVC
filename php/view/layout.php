<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if($meta_description) : ?>
            <meta name="description" content="<?= $meta_description ?>">
        <?php endif ?>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <?php if(App\Session::getUser()) : ?>
                        <?php if(App\Session::isAdmin()) : ?>
                            <a href="?ctrl=admin&action=manageCategory">
                                <i class="fa-solid fa-table-cells-large"></i>
                                <span>Manage categories</span>
                            </a>
                            <a href="?ctrl=admin&action=banUser">
                                <i class="fa-solid fa-user-slash"></i>
                                <span>Ban a user</span>
                            </a>
                            <span>|</span>
                        <?php endif ?>
                        <a href="?ctrl=security&action=profile">
                            <span class="fas fa-user"></span>
                            <span><?= App\Session::getUser() ?></span>
                        </a>
                        <a href="?ctrl=security&action=logout">
                            <span>
                                Logout
                            </span>
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    <?php else : ?>       
                            <a href="?ctrl=security&action=login">Login</a>
                            <a href="?ctrl=security&action=register">Register</a>
                    <?php endif ?>
                    </div>
                </nav>
            </header>
            <div id="mainpage">
                <?= $page ?>
            </div>

            <footer>
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Forum rules</a> - <a href="#">Legals mentions</a></p>
            </footer>
        </div>
    </body>
</html>