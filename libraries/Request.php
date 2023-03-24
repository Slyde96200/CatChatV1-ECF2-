<?php


class Request
{
    
    const EMAIL = FILTER_VALIDATE_EMAIL;

   
    const INT = FILTER_VALIDATE_INT;

   
    const SAFE = FILTER_SANITIZE_SPECIAL_CHARS;

    
    public static function get(string $name, int $filter = FILTER_DEFAULT)
    {
        
        $value = filter_input(INPUT_POST, $name, $filter);

       
        if (!$value) {
            $value = filter_input(INPUT_GET, $name, $filter);
        }

       
        return $value;
    }

    
    public static function redirectIfNotSubmitted(string $url)
    {
        if (empty($_POST)) {
            Http::redirect($url);
        }
    }
}
