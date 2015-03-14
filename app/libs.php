<?php
session_start();
require_once 'app.class.php';

class libs extends app {
    
    function __construct()
    {
       parent::__construct();
        
    }
    
    public function startPage($data)
    {
       // $this->smarty->display("libs.tpl");
        
        if (!$this->run_app($data,$this))
        {
           // print_r($data);
            
            if (isset($data["run"]) && intval($data["run"])==1)
            {
                $this->show_book();
            }
            else if (isset($data["run"]) && intval($data["run"])==2)
            {
                $this->show_search();
            }
            else 
            {
                $this->smarty->display($_SESSION["libs"]["last_page"]);
            }
        }
        
    }
    
    public function edit_fnc($id,$data)
    {
        $this->editBookData($id);
    }
    
    private function editBookData($id)
    {
        $query = sprintf("SELECT * FROM [books] WHERE [id]=%d",intval($id));
        $row = $this->db->sql_row($query);
       
        if (!isset($row["error"]))
        {
            $row["tags"] = $this->readBookTags($row["id"]);
            $row["action"] = "addBook_fnc";
            $this->smarty->assign("book",$row);
            $this->smarty->display("book.tpl");
        }
        
        
    }
    
    private function readBookTags($book_id)
    {
        $result = "";
        
        $query = sprintf("SELECT * FROM [tags] WHERE [book_id]=%d",intval($book_id));
        $table = $this->db->sql_table($query);
        
        if ($table["status"])
        {
            $data = $table["table"];
            $tagsArr = array();
            $dataCn = count($data);
            for ($i=0; $i<$dataCn; $i++)
            {
                $tagsArr[$i] = $data[$i]["tag"];  
            }
            
            $result = implode(",",$tagsArr);
        }
        else
        {
            $result="";
        }
        
        return $result;
    }
    
    private function show_book()
    {
        $_SESSION["libs"]["last_page"] = "book.tpl";
        
        $book = array("action"=>"addBook_fnc");
        
        $this->smarty->assign("book",$book);
        $this->smarty->display("book.tpl"); 
    }
    
    private function show_search()
    {
        $_SESSION["libs"]["last_page"] = "search.tpl";
        
        $search = array("action"=>"search_fnc");
        $this->smarty->assign("search",$search);
        $this->smarty->display("search.tpl");
    }
    
    public function addBook_fnc($id,$request)
    {
       
      $this->saveBook($request);
    }
        
    
    public function search_fnc($data,$request)
    {
        $this->searchBooks($request);
    }
      
    
    
    private function searchBooks($request)
    {
        $searchIn = $request["searchin"];
        $phrase = trim($request["phrase"]);
        $searchInMiddle = false;
        
        if (isset($request["inword"]) && $request["inword"] == "yes")
        {
            $searchInMiddle = true;
        }

        $phraseArr = explode(" ",$phrase);
        
        
        $passCn = count($phraseArr);
        $query = "";
        $where = "";
        print_r($passCn);
        if ($passCn == 0)
        {
            if (!$searchInMiddle)
            {
                $query = sprintf("LIKE '%s'",$phrase."%");
            }
            else
            {
                $query = sprintf("LIKE '%s'","%".$phrase."%");
            }    
        }
        else
        {
            $queryArr = array();
            for ($i=0; $i<$passCn;$i++)
            {
                if (!$searchInMiddle)
                {
                    $_query = sprintf("'%s'",$phraseArr[$i]."%");
                }
                else
                {
                    $_query = sprintf("'%s'","%".$phraseArr[$i]."%");
                }
                
                $queryArr[$i] = $_query;
            }
            $query = implode(" OR ",$queryArr);
            
        }
        
         
        switch ($searchIn) {
           case "name":
               $where = '[name]';
               break;
           case "autor":
               $where = "[autors]";
               break;
        }  
        
        $finalQuery = sprintf("SELECT * FROM [books] WHERE %s LIKE %s",$where,$query);
        
        
        $table = $this->db->sql_table($finalQuery);
        
        if ($table["status"])
        {
            $result = $table["table"];
            $this->smarty->assign("search_phrase", $phrase);
            $this->smarty->assign("search_result","Počet nájdených položiek: ".count($result));
            $this->smarty->assign("result",$result);
            $this->smarty->display("search.tpl");
            
        }
        else
        {
            $data = array("message"=>"Chyba".$table["error"]);
            $this->showError("search.tpl",$data,"message");
        }
    }
    
    
    private function saveBook($request)
    {
       //print_r($request); 
       $data = array();
       $book = array();
       $data["name"] = $request["name_txt"];
       $data["subname"]  = $request["subname_txt"];
       $data["bookprint"] = $request["bookprint_txt"];
       $data["isbn"] = $request["isbn_txt"];
       $data["autors"] = $request["autors_txt"];
       $data["amount"] = intval($request["amount_txt"]);
       /* tu je nutne este kontrola vstupu*/
       $tagsArr = explode(",",$request["tags_txt"]);
       
       $res = $this->db->insert_row("books",$data);
       
        if ($res["status"])
        {
            $tagsData = array();
            $tagLn = count($tagsArr);
                       
             if ($tagLn >0)
             {
                
                 for ($t=0;$t<$tagLn;$t++)
                 {
                    $tagsData[$t]["book_id"] = $res["last_id"];
                    $tagsData[$t]["tag"] = $tagsArr[$t]; 
                    $tagsData[$t]["user_id"] = $_SESSION["libs"]["user_id"];
                 }
                 
                 $res1 = $this->db->insert_rows('tags',$tagsData);
                 
                 if ($res1["status"])
                 {
                     $book["message"] = "Data uložené OK....";
                     $this->showError("book.tpl",$book,"book");
                 }
                 else 
                 {
                     $book["message"] = "Chyba:".$res1["error"];
                     $this->showError("book.tpl",$book,"book");
                 }
             }
             else 
             {
                 $tagsData["user_id"] =  $_SESSION["libs"]["user_id"];
                 $tagsData["tag"] = $request["tags_txt"];
                 $tagsData["book_id"] = $res["last_id"];
                 
                 $res1 = $this->db->insert_row('tags',$tagsData);
                 
                 if ($res1["status"])
                 {
                     $book["message"] = "Data uložené OK....";
                     $this->showError("book.tpl",$book,"book");
                 }
                 else
                 {
                     $book["message"] = "Chyba:".$res1["error"];
                     $this->showError("book.tpl",$book,"book");
                 }
                 
             }
        }
        else 
        {
            $book["message"] = "Chyba:".$res["error"];
            $this->showError("book.tpl",$book,"book");
        }
       
        
    }
  
    
    
    private function showError($page,$data,$smartyTag)
    {
       $this->smarty->assign($smartyTag,$data);
       $this->smarty->display($page);  
    }
    
}

?>