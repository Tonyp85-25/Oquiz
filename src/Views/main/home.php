<?php $this->layout('layout') ?>

<div class="bienvenue">


<h2>
    Bienvenue sur O'Quiz
</h2>
<p>Inscrivez-vous et testez vos connaissances sur les différents thèmes abordés</p>
</div>

<div class="container quiz">
  <div class="row home">
      <?php foreach($quizzes as $currentQuiz) : ?>
    <div class="col-sm-4">
    <a href=" <?= $router->generate('quiz', ['id' => $currentQuiz->getId()])?>"> <h3><?=$currentQuiz->getTitle()?></h3></a>
     <h4> <?=$currentQuiz->getDescription()?></h4>
     <?php $author = $currentQuiz->findAuthorByQuiz($currentQuiz->getId());?>
     <p>by <?=$author->first_name ?>  <?=$author->last_name ?>  </p>
    </div>

<?php endforeach; ?>
  </div>
</div>
