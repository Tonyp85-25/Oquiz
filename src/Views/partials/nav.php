

    <h1 class="justify-content-start"> O'Quiz</h1>

    <ul class="nav justify-content-end">
        <?php if ($connectedUser !== false) : ?>

         <li class="nav-item">
             <a class="nav-link disabled" href="#">Bonjour, <?=$connectedUser->getFirstName() ?></a>
         </li>
         <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('home') ?>"><i class="fas fa-home"></i>Accueil</a>
        </li>
        <?php if ($connectedUser !== false) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('profile') ?>"><i class="fas fa-user"></i>Mon compte</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('signout') ?>"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
        </li>
        <?php else : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('signin') ?>"><i class="fas fa-sign-in-alt"></i>Connexion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('signup') ?>"><i class="fas fa-edit"></i>Inscription</a>
        </li>
         <?php endif; ?>
    </ul>
