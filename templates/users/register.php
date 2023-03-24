<form action="index.php?controller=users&task=save" method="post">
  <h1><i class="fas fa-user"></i>&nbsp; Inscription</h1>
  <div class="form-row">
    <label for="firstName">Prénom :</label>
    <input type="text" name="firstName" placeholder="Votre prénom !" />
  </div>
  <div class="form-row">
    <label for="lastName">Lignée</label>
    <input type="text" name="lastName" placeholder=" Nom de votre lignée !" />
  </div>
  <div class="form-row">
    <label for="description">Combien avons nous de pattes ? :</label>
    <textarea name="description" id="description" placeholder="Bonne réponse exigé !"></textarea>
    
  </div>
  <input type="checkbox" name="catverify">Je suis un chat 
  <div class="form-row">
  <br><label for="avatar">Avatar :</label>
    <input type="url" name="avatar" placeholder="URL de votre avatar" />
  </div>

  <h2><i class="fas fa-sign-in-alt"></i>&nbsp; Informations</h2>
  <div class="form-row">
    <label for="email">Adresse email</label>
    <input type="email" name="email" placeholder="Votre adresse Email" />
  </div>
  <div class="form-row">
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" placeholder="Votre mot de passe" />
  </div>
  <div class="form-row">
    <label for="passwordConfirm">Confirmer mot de passe :</label>
    <input type="password" name="passwordConfirm" placeholder="Confirmez votre mot de passe" />
  </div>
  <input type="checkbox" name="catmilk">J'aime le lait
  <button type="submit">
  <i class="ri-check-line"></i>&nbsp; Je confirme
  </button>
</form>