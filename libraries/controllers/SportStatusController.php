<?php

require_once 'Controller.php';


require_once 'libraries/models/CommentsModel.php';

class SportStatusController extends Controller
{
    protected $modelName = "StatusModel";

    public function index()
    {
        // Récupération des status
        $sportStatus = $this->model->findAll();

        // Affichage HTML
        $this->view('status/index', [
            'status' => $sportStatus,
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

        $sportStatus = $this->model->find($id);

        $sportcommentsModel = new CommentsModel();
        $sportcomments = $sportcommentsModel->findAllByStatusId($id);

        // Affichage HTML
        $this->view('status/show', [
            'status' => $sportStatus,
            'comments' => $sportcomments,
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
        $sportStatus = $this->model->find($id);

        //  erreur et redirection vers l'index
        if (!$sportStatus) {
            $this->redirectWithError(
                "index.php",
                "Le statut $id n'a pas été trouvé !"
            );
        }

     
        // erreur 
        if (!Session::isActualUser($sportStatus['user_id'])) {
            $this->redirectWithError(
                "index.php",
                "Vous n'êtes pas propriétaire de ce statut !"
            );
        }

        // Affichage HTML
        $this->view(
            "status/edit",
            [
                'status' => $sportStatus,
            ]
        );
    }

    public function update()
    {
        //  Redirection
        Request::redirectIfNotSubmitted('index.php');

        //  Redirection
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Il faut être connecté pour pourvoir faire cette opération !"
            );
        }

        //  redirection 
        $id = Request::get('id', Request::INT);
        $content = Request::get('content', Request::SAFE);

        if (!$id || !$content) {
            $this->redirectBackWithError('Le formulaire est mal rempli !');
        }

  
        $sportStatus = $this->model->find($id);

        //  Redirection
        if (!$sportStatus) {
            $this->redirectBackWithError("Vous essayez de modifier un statut qui n'existe pas ...");
        }

        // Redirection
        if (!Session::isActualUser($sportStatus['user_id'])) {
            $this->redirectBackWithError("Vous n'êtes pas le propriétaire de ce statut !");
        }

        //  données à mettre à jour 
        $data = compact('id', 'content');
        $this->model->update($data);

        // Redirection
        $this->redirectWithSuccess(
            "index.php?controller=status&task=show&id=$id",
            "Statut modifié avec succès !"
        );
    }

    public function save()
    {

        Request::redirectIfNotSubmitted('index.php');

        //  Vérif
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez vous connecter pour ajouter un statut !"
            );
        }

   
        $content = Request::get('content', Request::SAFE);

        if (!$content) {
            $this->redirectBackWithError("Vous devez fournir le contenu de votre statut !");
        }

        // les données à insérer
        $prefixFile = "photo/";

        $data = [
            'content' => $content,
            'user_id' => $_SESSION['user']['id'],
            'createdAt' => date('Y-m-d H:i:s'),
            'media_url' => $prefixFile . $_FILES["fileToUpload"]["name"],
        ];

        //  Insertion avec la méthode insert()
        $this->model->insert($data);

        // Redirection
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut posté avec succès sur le réseau !"
        );
    }

    public function upload()
    {
        // Redirection erreur
        Request::redirectIfNotSubmitted('index.php');


        // Vérif
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez vous connecter pour ajouter un statut !"
            );
        }

        //  Vérif
        /* if ($_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
            $this->redirectBackWithError("Une erreur s'est produite lors du téléchargement du fichier !");
        }

        //  Vérif
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['fileToUpload']['tmp_name']);

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'video/mp4'])) {
            $this->redirectBackWithError("Le fichier téléchargé n'est pas une image ou une vidéo !");
        }

        // Déplacer le fichier téléchargé dans le dossier "media"
        $prefixFile = "media/";
        $filename = uniqid() . '.' . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        $destination = $prefixFile . $filename;

        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)) {
            $this->redirectBackWithError("Impossible de déplacer le fichier téléchargé !");
        } */

        $content = Request::get('content', Request::SAFE);

        if (!$content) {
            $this->redirectBackWithError("Vous devez fournir le contenu de votre statut !");
        }

        // les données à insérer
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

        $sportStatus = $this->model->findById($id);

        if (!$sportStatus) {
            $this->redirectBackWithError("Le statut demandé n'existe pas !");
        }

        if ($sportStatus['user_id'] != $_SESSION['user']['id']) {
            $this->redirectBackWithError("Vous n'êtes pas autorisé à supprimer ce statut !");
        }

        //Insertion avec la méthode delete()
        $this->model->delete($id);

        //  Redirection
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut supprimé avec succès !"
        );;
    }
}
