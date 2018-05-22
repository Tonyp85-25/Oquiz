<?php $this->layout('layout') ?>

<div class="bienvenue" id="formtop">
    <h2>Connexion</h2>
     <div class="alert alert-danger" id="errorsDiv" role="alert" style="display:none;">
    </div>
</div>

<form  class="col-md-6 m-auto " action="" method="post" id="formLogin">
  <div class="form-group">
    <label for="exampleInputEmail1">Votre adresse email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre email" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
