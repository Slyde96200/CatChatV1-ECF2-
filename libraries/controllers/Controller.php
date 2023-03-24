<?php


abstract class Controller
{
    
    protected $model;

   
    protected $modelName;

   
    public function __construct()
    {
       
        if (empty($this->modelName)) {
           
            throw new Exception('erreur! ' . get_called_class() . " fournir le nom du Model à utiliser !");
        }

       
        $chemin = "libraries/models/{$this->modelName}.php";
       
        if (!file_exists($chemin)) {
           
            throw new Exception("erreur!" . get_called_class() . " ({$this->modelName}) n'existe pas ! should be here : $chemin !");
        }

        
        require_once $chemin;
        $this->model = new $this->modelName();
       
    }

    
    protected function view(string $template, array $variables = [])
    {
        extract($variables);

       
        require_once 'templates/partials/header.php';

       
        require_once "templates/$template.php";

       
        require_once 'templates/partials/footer.php';
    }

   
    protected function redirectWithError(string $url, string $message)
    {
        Session::addFlash('error', $message);
        Http::redirect($url);
    }

    
    protected function redirectWithSuccess(string $url, string $message)
    {
        Session::addFlash('success', $message);
        Http::redirect($url);
    }

  
   
    protected function redirectBackWithError(string $message)
    {
        $url = $_SERVER['HTTP_REFERER'];
        $this->redirectWithError($url, $message);
    }

    
    protected function redirectBackWithSuccess(string $message)
    {
        $url = $_SERVER['HTTP_REFERER'];
        $this->redirectWithSuccess($url, $message);
    }
}
