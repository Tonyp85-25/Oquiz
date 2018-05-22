
<div class="alert alert-primary" role="alert">
  Nouveau jeu : répondez au maximum de questions avant de valider!
</div>
 <form class="container">
     <div class="row">
         <?php foreach ($questions as $currentQuestion) :?>
          <div class="col-sm-4">
              <div class="card">
                  <div class="card-header">
                      <h4><?= $currentQuestion->getQuestion() ?></h4> <span>niveau</span>
                  </div>
                  <div class="card-body">
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="proposition" id="proposition1" value="option1" checked>
                          <label class="form-check-label" for="proposition1">
                              Default radio
                            </label>
                        </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="proposition" id="proposition2" value="option2">
                  <label class="form-check-label" for="proposition2">
                    Second default radio
                  </label>
                </div>
                <div class="form-check">
                      <input class="form-check-input" type="radio" name="proposition" id="proposition3" value="option1" checked>
                      <label class="form-check-label" for="proposition3">
                        prop3
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="proposition" id="proposition4" value="option2">
                      <label class="form-check-label" for="proposition4">
                        prop4
                      </label>
                    </div>
              </div>
          </div>
      <?php endforeach; ?>
  </div>
  <button type="button" name="button">OK</button>
</form>
