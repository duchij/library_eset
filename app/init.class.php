<?php 
require_once 'libs.php';

class init {
    
    function __construct()
    {
        
    }
    
    function run($data)
    {
        $libs = new libs();
       //print_r($data);
       
        
        if (isset($data["class"]) && $data["class"]=="libs")
        {
            
            $libs->startPage($data);
        }
        else 
        {
            $libs->startPage($data);
        }
    }
}

?>