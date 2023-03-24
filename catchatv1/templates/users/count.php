<?
// Vérification
Request::redirectIfNotSubmitted('index.php');

// récupération des données
$user = Session::getUser();


$firstName = Request::get('firstName');
$lastName = Request::get('lastName');
$email = Request::get('email', Request::EMAIL);
$password = Request::get('password');
?>


<form action="index.php?controller=users&task=count" method="post">
    <h1><i class="fas fa-user"></i>&nbsp; Modification du compte</h1>
    <div class="form-row">
        <label for="firstName">Prénom :</label>
        <input type="text" name="firstName" placeholder="Modifiez votre prénom"/>
    </div>
    <div class="form-row">
        <label for="lastName">Nom de famille</label>
        <input type="text" name="lastName" placeholder="Modifiez votre Nom de Famille" />
    </div>

    <h2><i class="fas fa-sign-in-alt"></i>&nbsp; Modification de vos Informations</h2>
    <div class="form-row">
        <label for="email">Adresse email</label>
        <input type="email" name="email" placeholder="Modifiez votre adresse Email" />
    </div>
    <div class="form-row">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" placeholder="Votre mot de passe" />
    </div>
    <button type="submit">
        <i class="ri-check-line"></i>&nbsp; Je confirme
    </button>
</form>