<?php $this->layout('layout') ?>

<div class="bienvenue">


<h2>
    Bienvenue sur O'Quiz
</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore enim, veritatis quis expedita, nisi odio ea temporibus suscipit, hic deleniti officia ex eius! Debitis numquam enim in consequatur velit recusandae unde doloribus sed vel, odit voluptates, fugiat laborum officia, error incidunt facere ratione neque tenetur quasi? Necessitatibus totam, soluta. Ipsum dolor dolore perspiciatis et eligendi, atque laboriosam, odio amet repellendus.</p>
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
