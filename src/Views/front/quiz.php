<?php $this->layout('layout') ?>

<div class="bienvenue">

<h2> <?= $quiz->getTitle() ?></h2> <span class="badge badge-secondary"><?= count ($questions)?> questions</span>
<h3><?= $quiz->getDescription() ?></h3>

<span>par <?=$author->first_name ?> <?=$author->last_name ?></span>
</div>
 <?php if ($connectedUser !== false) : ?>
     <?=$this->insert('front/list-form', [
         'quiz' => $quiz,
         'questions'=> $questions,
         'question' => $question,
         'played' => $played,
        'style' => $style,
        'score' => $score,
         ])?>
       <?php else : ?>

 <div class="container quiz">
     <div class="row">
         <?php foreach ($questions as $currentQuestion) :?>

          <div class="col-sm-4">
              <div class="card question">
                  <div class="card-header">
                      <?php $level = $question->findLevelByQuestion($currentQuestion->getId());
                      ?>
                      <h4><?= $currentQuestion->getQuestion() ?></h4> <span class="badge badge-success"><?= $level->name ?></span>
                  </div>
                  <div class="card-body">
                      <?php  $props = $question->shuffleProps($currentQuestion->getId())?>

                      <p class="card-text">1. <?= $props[0] ?></p>
                      <p class="card-text">2. <?= $props[1]?></p>
                      <p class="card-text">3. <?= $props[2] ?></p>
                      <p class="card-text">4. <?= $props[3]?></p>
                  </div>
              </div>
          </div>
      <?php endforeach; ?>

     </div>
</div>
<?php endif; ?>
