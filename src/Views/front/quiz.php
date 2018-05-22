<?php $this->layout('layout') ?>

<div class="bienvenue">

<h2> <?= $quiz->getTitle() ?></h2> <span class="badge badge-secondary">nb questions</span>
<h3><?= $quiz->getDescription() ?></h3>

<span>by auteur</span>
</div>



 <div class="container quiz">
     <div class="row">
         <?php foreach ($questions as $currentQuestion) :?>
          <div class="col-sm-4">
              <div class="card question">
                  <div class="card-header">
                      <h4><?= $currentQuestion->getQuestion() ?></h4> <span class="badge badge-success">niveau</span>
                  </div>
                  <div class="card-body">
                      <p class="card-text">1. <?= $currentQuestion->getProp1() ?></p>
                      <p class="card-text">2. <?= $currentQuestion->getProp2() ?></p>
                      <p class="card-text">3. <?= $currentQuestion->getProp3() ?></p>
                      <p class="card-text">4. <?= $currentQuestion->getProp4() ?></p>
                  </div>
              </div>
          </div>
      <?php endforeach; ?>
     </div>
</div>
