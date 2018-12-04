<?php $this->layout('layout') ?>

<div class="bienvenue">
    <h2>Mon compte</h2>
</div>

<div class="col-md-6 m-auto ">

<p>Prénom: <?= $user->getFirstName()?></p>
<p>Nom : <?=$user->getLastName()?></p>
<p>Email : <?=$user->getEmail()?></p>

</div>

<div class="bienvenue">
    <h3>Mes quiz</h3>
</div>
<div class="col-md-6 m-auto">


<?php if($quizzes) : ?>
    <ul class="list-group">
        <?php foreach($quizzes as $quizz) : ?>
        <li class="list-group-item"><a href="<?= $router->generate('quiz',['id'=>$quizz->getId()]) ?>"> <?=$quizz->getTitle() ?> </a> </li>
        <?php endforeach;?>
    </ul>
<?php else :?> 
<p>Vous n'avez pas créé de Quizz</p>
<?php endif;?> 
</div>