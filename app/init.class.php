<?php 
session_start();
require_once 'app.class.php';

class init {
    
    function __construct()
    {
        
    }
    
    /**
     * 
     * Funkcia zavola triedu a instancuje dla formularu ktory ju zavolal a odovzda jej webovsky request
     * 
     * @param array $data REQUEST data
     * 
     * @todo toto treba obohatit a furu veci :)
     */
    public function run($data)
    {
        if (isset($data["class"]))
        {
            $cls = $data["class"];
            require_once $cls.'.class.php';
            $obj = new $cls();
            $obj->startPage($data);
            
        }
        else  //fallback class
        {
            $cls = "libs";
            require_once $cls.'.class.php';
            $obj = new $cls();
            $obj->startPage($data);
        }
    }
}

?>