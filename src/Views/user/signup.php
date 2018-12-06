<?php $this->layout('layout') ?>

<div class="bienvenue" id="formup">
    <h2>Inscription</h2>

    <?php  foreach ($errorList as $error): ?>
     <div class="alert alert-danger" role="alert" >
     
        <p> <?=$error ?> </p>  
    </div>
    <?php endforeach;  ?>
</div>

<div class="container-fluid">
 <div class="row">

  <form  class="col-lg-6 m-auto"  method="post" id="formSignup" novalidate>
    <div class="form-group">
      <label for="signupFname">Votre prénom</label>
      <input type="text" class="form-control" id="signupFname" aria-describedby="firstNameHelp" placeholder="Entrez votre prénom" name="first_name">
    </div>
    <div class="form-group">
      <label for="signupLname">Votre nom</label>
      <input type="text" class="form-control" id="signupLname" aria-describedby="lastNameHelp" placeholder="Entrez votre nom" name="last_name">
    </div>
    <div class="form-group">
      <label for="signupMail">Votre adresse email</label>
      <input type="email" class="form-control" id="signupMail" aria-describedby="emailHelp" placeholder="Entrez votre email" name="email">
    </div>
    <div class="form-group">
      <label for="signupPw"">Mot de passe</label>
      <input type="password" class="form-control" id="signupPw" placeholder="Entrez votre mot de passe" name="password">
    </div>
    <div class="form-group">
      <label for="signupConfirm">Validation mot de passe</label>
      <input type="password" class="form-control" id="signupConfirm" placeholder="Répétez votre mot de passe" name="confirmPassword">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
  </form>
  </div>
</div>