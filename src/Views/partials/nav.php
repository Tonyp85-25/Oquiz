

    <h1 class="justify-content-start"> O'Quiz</h1>

    <ul class="nav justify-content-end">
         <li class="nav-item">
             <a class="nav-link disabled" href="#">Bonjour, Chuck</a>
         </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= $router->generate('home') ?>"><i class="fas fa-home"></i>Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $router->generate('profile') ?>"><i class="fas fa-user"></i>Mon compte</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
        </li>
    </ul>
