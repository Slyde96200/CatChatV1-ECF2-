<?php

require_once 'Controller.php';


require_once 'libraries/models/CommentsModel.php';

class StatusController extends Controller
{
    protected $modelName = "StatusModel";

    public function index()
    {
        // Récupération des status
        $status = $this->model->findAll();

        // Affichage HTML
        $this->view('status/index', [
            'status' => $status,
        ]);
    }

    public function show()
    {
        $id = Request::get('id', Request::INT);

        if (!$id) {
            $this->redirectWithError(
                "index.php",
                "Vous devez préciser de quel statut vous voulez voir les détails !"
            );
        }

        $status = $this->model->find($id);

        $commentsModel = new CommentsModel();
        $comments = $commentsModel->findAllByStatusId($id);

        // Affichage HTML
        $this->view('status/show', [
            'status' => $status,
            'comments' => $comments,
        ]);
    }

    public function edit()
    {
        //  Vérifier que  connecté ou erreur et redirection 
        if (!Session::isConnected()) {
            Session::addFlash('error', "Vous devez être connecté pour ce type d'opération");
            Http::redirect("index.php");
        }

        //  Vérifier que la page a bien un id en GET sinon rediriger 
        $id = Request::get('id', Request::INT);

        if (!$id) {
            $this->redirectWithError(
                "index.php",
                "Vous devez préciser le statut que vous souhaitez modifier"
            );
        }

        // Récupérer les infos du statut  find()
        $status = $this->model->find($id);

        //  erreur et redirection vers l'index
        if (!$status) {
            $this->redirectWithError(
                "index.php",
                "Le statut $id n'a pas été trouvé !"
            );
        }

        // ne correspond pas à l'auteur du statut (user_id)
        // erreur et redirection vers l'index
        if (!Session::isActualUser($status['user_id'])) {
            $this->redirectWithError(
                "index.php",
                "Vous n'êtes pas propriétaire de ce statut !"
            );
        }

        // Affichage HTML
        $this->view(
            "status/edit",
            [
                'status' => $status,
            ]
        );
    }

    public function update()
    {
        //  Redirection 
        Request::redirectIfNotSubmitted('index.php');

        //  Redirection  non connecté
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Il faut être connecté pour pourvoir faire cette opération !"
            );
        }

        //  redirection champs invalides
        $id = Request::get('id', Request::INT);
        $content = Request::get('content', Request::SAFE);

        if (!$id || !$content) {
            $this->redirectBackWithError('Le formulaire est mal rempli !');
        }

        // model et récupération du status 
        $status = $this->model->find($id);

        //  Redirection  pas de statut trouvé
        if (!$status) {
            $this->redirectBackWithError("Vous essayez de modifier un statut qui n'existe pas ...");
        }

        // Redirection  statut n'appartient pas à l'utilisateur 
        if (!Session::isActualUser($status['user_id'])) {
            $this->redirectBackWithError("Vous n'êtes pas le propriétaire de ce statut !");
        }

        // 7. Création tableau des données 
        $data = compact('id', 'content');
        $this->model->update($data);

        // 8. Redirection  page du status 
        $this->redirectWithSuccess(
            "index.php?controller=status&task=show&id=$id",
            "Statut modifié avec succès !"
        );
    }

    public function save()
    {

        Request::redirectIfNotSubmitted('index.php');

        //  Vérifier que l'utilisateur est bien connecté
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez vous connecter pour ajouter un statut !"
            );
        }

        //  VERIF
        $content = Request::get('content', Request::SAFE);

        if (!$content) {
            $this->redirectBackWithError("Vous devez fournir le contenu de votre statut !");
        }

        //  les données à insérer
        $prefixFile = "photo/";

        $data = [
            'content' => $content,
            'user_id' => $_SESSION['user']['id'],
            'createdAt' => date('Y-m-d H:i:s'),
            'media_url' => $prefixFile . $_FILES["fileToUpload"]["name"],
        ];

        // Insertion avec la méthode insert()
        $this->model->insert($data);

        //  Redirection vers l'index
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut posté avec succès sur le réseau <strong>$user[firstName] $user[lastName]</strong> !"
        );
    }

    public function upload()
    {
        // Redirection vers l'index formulaire pas soumis
        Request::redirectIfNotSubmitted('index.php');


        // Vérif
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez vous connecter pour ajouter un statut !"
            );
        }

        //  Vérifier si un fichier a été téléchargé avec succès
        /* if ($_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
            $this->redirectBackWithError("Une erreur s'est produite lors du téléchargement du fichier !");
        }

        // Vérifier que le fichier téléchargé est bien une image ou une vidéo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['fileToUpload']['tmp_name']);

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'video/mp4'])) {
            $this->redirectBackWithError("Le fichier téléchargé n'est pas une image ou une vidéo !");
        }

        //  Déplacer dans le dossier "media"
        $prefixFile = "media/";
        $filename = uniqid() . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        $destination = $prefixFile . $filename;

        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)) {
            $this->redirectBackWithError("Impossible de déplacer le fichier téléchargé !");
        } */

        //  vérif
        $content = Request::get('content', Request::SAFE);

        if (!$content) {
            $this->redirectBackWithError("Vous devez fournir le contenu de votre statut !");
        }

        // données à insérer
        $data = [
            'content' => $content,
            'user_id' => $_SESSION['user']['id'],
            'createdAt' => date('Y-m-d H:i:s'),
            'media_url' => $destination,
            'media_type' => strpos($mimeType, 'image/') === 0 ? 'image' : 'video'
        ];

        //  Insertion avec la méthode insert()
        $this->model->insert($data);

        // Redirection 
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut posté avec succès sur le réseau !"
        );
    }


    public function delete()
    {
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être connecté pour cette action"
            );
        }

        $id = Request::get('id', Request::INT);

        if (!$id) {
            $this->redirectBackWithError("ID de statut manquant !");
        }

        $status = $this->model->findById($id);

        if (!$status) {
            $this->redirectBackWithError("Le statut demandé n'existe pas !");
        }

        if ($status['user_id'] != $_SESSION['user']['id']) {
            $this->redirectBackWithError("Vous n'êtes pas autorisé à supprimer ce statut !");
        }

        // Insertion avec la méthode delete()
        $this->model->delete($id);

        //  Redirection
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut supprimé avec succès !"
        );;
    }
}
