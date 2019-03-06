

 <div class="container">
 
    <div class="alert alert-primary newgame" role="alert" >
      Nouveau jeu : répondez au maximum de questions avant de valider!
    </div>
    
    <div class="alert alert-success result" role="alert" style = display:none>
    <p>Votre score : <span id="score">  </span> </p>
    <a href="<?= $router->generate('quiz', ['id' => $quiz->getId()])?>">Rejouer</a>
    </div>
    <script>
            var quizId = <?= $quiz->getId()?>;
    </script>
    

     <div class="row">

         <form class="row" action="" method="post" id="formQuiz">


         <?php foreach ($questions as $currentQuestion) :?>
          <div class="col-sm-4">
              <div class="card question" >
             
                  <div class="card-header" id = "header_<?= $currentQuestion->getId() ?>" >
                      <?php $level = $currentQuestion->findLevelByQuestion($currentQuestion->getId());
                      ?>
               
                      <h4><?= $currentQuestion->getQuestion() ?></h4> <span class="float-right badge badge-success"><?= $level->name ?></span>
                  </div>
                  <div class="card-body">
                      <?php  $props = $currentQuestion->shuffleProps($currentQuestion->getId())?>
                      <?php for ($i=0; $i<4; $i++)  :?>                                 
                      <div class="form-check">
                      
                          <input class="form-check-input" type="radio" name="<?= $currentQuestion->getId()?>" id="proposition.$i" value="<?= $props[$i]?>" >
                          <label class="form-check-label" for="proposition.$i">
                             <?= $props[$i] ?>
                            </label>
                        </div> 
                        <?php endfor; ?> 

                </div>
               
                <div class="card-footer text-muted anecdote" style = "display:none" id= "anecdote_<?= $currentQuestion->getId()?>">
                    <p>    <?= $currentQuestion->getAnecdote() ?></p>
                    <a href="https://fr.wikipedia.org/wiki/<?= $currentQuestion->getWiki()?>" target="_blank" > Wikipedia(<?= $currentQuestion->getWiki()?>)</a>
                </div>
                
            </div>
        </div>
        <?php endforeach; ?>

       
            <button type="submit" class="btn btn-primary btn-block newgame">OK</button>
        
        <a href = "<?= $router->generate('quiz', ['id' => $quiz->getId()])?>" class="btn btn-success btn-block result" style= "display:none">Rejouer</a>

        </form>
    </div>
</div>
<!-- Utilisation de la méthode push de Plates pour ajouter du contenu à la section "js" du layout -->
<?php $this->push('js') ?>
<script>
// $('#formQuiz').on('submit', app.submitFormQuiz);

</script>
<?php $this->end('js') ?>
