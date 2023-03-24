<?php

class Http
{
    
    public static function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }

    
    public static function redirectBack()
    {
       
        self::redirect($_SERVER['HTTP_REFERER']);
    }

}
