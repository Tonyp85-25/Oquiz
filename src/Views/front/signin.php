<?php $this->layout('layout') ?>

<h2>Connexion</h2>

<form  class="col-md-6 m-auto" action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Votre adresse email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
