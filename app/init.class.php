<?php 
session_start();
require_once 'app.class.php';

class init {
    
    function __construct()
    {
        
    }
    
    function run($data)
    {
        
       //print_r($data);
       
        
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