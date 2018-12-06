


    <h1> O'Quiz</h1>
    <nav class="navbar navbar-expand-lg navbar-light ">
    <a href="" class="navbar-brand d-none"></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=" navbar-toggler-icon"> </span>
        </button>
   
    <div class="collapse navbar-collapse" id="navbarContent" >
        <ul class="navbar-nav  ">
       
   
            <li class="nav-item ">
                <a class="nav-link" href="<?= $router->generate('home') ?>"><i class="fas fa-home "></i>Accueil</a>
            </li>
       
         <?php if ($connectedUser !== false) : ?>
        
            <li class="nav-item "> 
                <a class="nav-link" href="<?= $router->generate('profile',['id'=>$connectedUser->getId()]) ?>"><i class="fas fa-user"></i>Mon compte</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?= $router->generate('signout') ?>"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
            </li>
            <?php else : ?>
            <li class="nav-item ">
                <a class="nav-link" href="<?= $router->generate('signin') ?>"><i class="fas fa-sign-in-alt"></i>Connexion</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?= $router->generate('signup') ?>"><i class="fas fa-edit"></i>Inscription</a>
            </li>
            <?php endif; ?>
            
            </ul>
     </div>
</nav>