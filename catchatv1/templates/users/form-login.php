<?require_once 'Controller.php';?>

<form action="index.php?controller=users&task=login" method="post">
  <h1>
      <i class="fas fa-unlock"></i>&nbsp;
      Connexion  
  </h1>
  <div class="form-row">
    <label for="email">Email : </label>
    <input type="email" name="email" placeholder="Votre adresse email" />
  </div>
  <div class="form-row">
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" placeholder="Votre mot de passe" />
  </div>
  <button type="submit">
  <i class="ri-check-line"></i>&nbsp;
    Je confirme
  </button>
</form>
