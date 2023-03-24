<?php

require_once 'Controller.php';

class UsersController extends Controller
{

    protected $modelName = "UsersModel";

    public function register()
    {
        // template users/register.php
        $this->view('users/register');
    }

    public function formLogin()
    {
        // template users/form-login.php
        $this->view('users/form-login');
    }

    public function myCount()
    {
        //template users/form-login.php
        $this->view('users/count');
    }

    public function save()
    {
        // Redirection formulaire pas soumis
        Request::redirectIfNotSubmitted('index.php');

        //  POST et redirection formulaire  mal rempli
        $firstName = Request::get('firstName', Request::SAFE);
        $lastName = Request::get('lastName', Request::SAFE);
        $email = Request::get('email', Request::EMAIL);
        $password = Request::get('password');
        $passwordConfirm = Request::get('passwordConfirm');
        $description = Request::get('description', Request::SAFE);
        $avatar = Request::get('avatar', FILTER_VALIDATE_URL);

        if (!$firstName || !$lastName || !$email || !$password || !$passwordConfirm || !$avatar) {
            $this->redirectBackWithError("Votre formulaire n'était pas complet !");
        }

        // aucun utilisateur n'existe déjà avec cet email
        
        $user = $this->model->findByEmail($email);

        //  avec cet email, affiche une erreur
        if ($user) {
            $this->redirectBackWithError("Un compte existe déjà avec cette adresse email");
        }

        //  Vérification (password et passwordConfirm)
        if ($password != $passwordConfirm) {
            $this->redirectBackWithError("Les deux mots de passe fournis ne correspondent pas !");
        }
        // special message cat validator
        if ($description != "4 pattes" ) {
            $this->redirectBackWithError("Mauvaise réponse à la question !");
        }
        

        //  Création du hash
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tableau associatif avec les données
        $data = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'password' => $password,
            'email' => $email,
            'avatar' => $avatar,
            'description' => $description,
        ];
        
        
        $this->model->insert($data);

        // Redirection
        $this->redirectWithSuccess(
            "index.php?controller=users&task=formLogin",
            "Félicitations, vous pouvez désormais vous connecter !"
        );
    }

    public function login()
    {
        //  Vérification
        Request::redirectIfNotSubmitted('index.php');


        $email = Request::get('email', Request::EMAIL);
        $password = Request::get('password');

        if (!$email || !$password) {
            $this->redirectBackWithError("Le formulaire a été mal rempli");
        }

        // Récupération de l'utilisateur correspond à l'email donné
        $user = $this->model->findByEmail($email);

        if (!$user) {
            $this->redirectBackWithError("Aucun compte utilisateur ne possède cette adresse email");
        }

        //  Vérification du mot de passe hashé
        $correspondance = password_verify($password, $user['password']);

        if (!$correspondance) {
            $this->redirectBackWithError("Le mot de passe ne correspond au compte utilisateur trouvé");
        }

        //  session de l'utilisateur 
        Session::connect($user);

        //  Redirection
        $this->redirectWithSuccess(
            "index.php",
            "Bravo <strong>$user[firstName] $user[lastName]</strong>, vous êtes désormais connecté(e) au réseau !"
        );
    }

    public function count()
    {
        // Vérification
        Request::redirectIfNotSubmitted('index.php');

        // récupération des données
        $user = Session::getUser();

     
        $firstName = Request::get('firstName');
        $lastName = Request::get('lastName');
        $email = Request::get('email', Request::EMAIL);
        $password = Request::get('password');

        // Vérification des données extraites, sinon redirection vers la page précédente
        if (!$firstName || !$lastName || !$email || !$password) {
            $this->redirectBackWithError("Le formulaire a été mal rempli");
        }

        // Vérification si l'email n'est pas déjà utilisé par un autre utilisateur
        $existingUser = $this->model->findByEmail($email);
        if ($existingUser && $existingUser['id'] != $user['id']) {
            $this->redirectBackWithError("L'adresse email est déjà utilisée par un autre compte utilisateur");
        }

        // Mise à jour des informations de l'utilisateur
        $result = $this->model->update([
            'id' => $user['id'],
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' =>$password
        ]);


        $this->redirectWithSuccess(
            "index.php",
            "Votre compte a été mis à jour avec succès <strong>$user[firstName] $user[lastName]</strong> !"
        );

        // Vérification si la mise à jour a réussi
        if (!$result) {
            $this->redirectBackWithError("La mise à jour du compte utilisateur a échoué, <strong>$user[firstName] $user[lastName]</strong>");
        }


        $user = $this->model->findById($user['id']);
        Session::updateUser($user);
    }

    public function logout()
    {
        Session::disconnect();

        $this->redirectWithSuccess(
            "index.php",
            "Vous êtes désormais déconnecté  !"
        );
    }
}
