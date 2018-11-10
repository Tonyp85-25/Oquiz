

 <div class="container">
    <div class="alert alert-primary" role="alert"id="newgame">
      Nouveau jeu : répondez au maximum de questions avant de valider!
    </div>
    <div class="alert alert-success" role="alert"id="result" style="display:none">
    <p>Votre score : <span id="score"></span> </p>
    <a href="#">Rejouer</a>
    </div>
     <div class="row">

         <form class="row" action="" method="post" id="formQuiz">


         <?php foreach ($questions as $currentQuestion) :?>
          <div class="col-sm-4">
              <div class="card question">
                  <div class="card-header">
                      <?php $level = $question->findLevelByQuestion($currentQuestion->getId());
                      ?>
                      <h4><?= $currentQuestion->getQuestion() ?></h4> <span class="float-right badge badge-success"><?= $level->name ?></span>
                  </div>
                  <div class="card-body">
                      <?php  $props = $question->shuffleProps($currentQuestion->getId())?>
                      <?php for ($i=0; $i<4; $i++)  :?>                                 
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="<?= $currentQuestion->getId()?>" id="proposition.$i" value="<?= $props[$i]?>" >
                          <label class="form-check-label" for="proposition.$i">
                             <?= $props[$i] ?>
                            </label>
                        </div>
                        <?php endfor; ?> 

                </div>
                <div class="card-footer text-muted anecdote" style="display:none">
                    <p>    <?= $currentQuestion->getAnecdote() ?></p>
                    <a href="#">Wikipedia(<?= $currentQuestion->getWiki()?>)</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
            <button type="submit" class="btn btn-primary btn-block">OK</button>

        </form>
    </div>
</div>
<!-- Utilisation de la méthode push de Plates pour ajouter du contenu à la section "js" du layout -->
<?php $this->push('js') ?>
<script>
// $('#formQuiz').on('submit', app.submitFormQuiz);

</script>
<?php $this->end('js') ?>
