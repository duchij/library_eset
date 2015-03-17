<?php
/**
 * @author Boris Duchaj
 * 
 *  
 *
 */
class libs extends app {
    
    function __construct()
    {
       parent::__construct();
        
    }
    
    /**
     * Bud zavola fnc udanu vo formulari alebo vykona urcitu cinnost
     * 
     * @param array $data REQUEST pole
     * 
     * 
     */
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
            else if (isset($data["run"]) && intval($data["run"]) == 3)
            {
                $this->showBorrowedBooks($data);
            }
            else 
            {
                $this->smarty->display($_SESSION["libs"]["last_page"]);
            }
        }
        
    }
    
    private function showBorrowedBooks($data)
    {
        $_SESSION["libs"]["last_page"] = "borrow.tpl";
        
        $qTmp = "SELECT [borrows].*,CONCAT([usersdata].[meno],' ',[usersdata].[priezvisko]) AS [cele_meno], 
                        [books].[name] AS [nazov] FROM [borrows] 
                        INNER JOIN [usersdata] ON [usersdata].[user_id] = [borrows].[user_id]
                        INNER JOIN [books] ON [books].[id] = [borrows].[book_id]
                   WHERE [borrows].[user_id] = %d 
                        ORDER By [borrows].[end];
            ";
        $query=sprintf($qTmp,$this->user_id);
        
        
        
        $borrows = $this->db->sql_table($query);
        
        
        if ($borrows["status"])
        {
             $this->smarty->assign("borrows",$borrows["table"]);
             $this->smarty->display("borrow.tpl");           
        }
        else
        {
            $this->smarty->assign("message",$borrows["error"]);
            $this->smarty->display("borrow.tpl");
        }
        
    }
    
    public function give_back_fnc($borrow_id)
    {
        print_r($borrow_id);
    }
    
    
    
    
    public function edit_fnc($id,$data)
    {
        $this->editBookData($id);
    }
    
    /**
     * Nacita data knihy a umozni jej editaciu
     * 
     * @param int $id idecko knihy
     */
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
    
    public function borrow_fnc($id,$data)
    {
        $this->borrowBook($id);
    }
    
  
    /**
     * Zistuje ci je uz dana kniha pozicana userom.
     * 
     * @param int $userId idecko uzivatela
     * @param int $bookId idecko Knihy
     * 
     * @return boolean true kniha je pozicana false-kniha nie je pozicana userom
     */     
    private function checkBorrowedBook($userId,$bookId)
    {
        $result = false;
        $query = sprintf("SELECT COUNT([book_id]) AS [borrowed_book] FROM [borrows] WHERE [user_id]=%d AND [book_id]=%d",$userId,$bookId);

        $row = $this->db->sql_row($query); 
        
        if ($row["borrowed_book"] > 0)
        {
            $result = true;
        }
        
        return $result;
    }
    
    /**
     * Pozicanie knihy.
     * Funguje tak, ze do db poslem len den pozicania a pocet dni zapozicania, nasledne triggerom sa vytvori
     * datum konca zapozicky a z poctu kusov sa odrata jeden kus....
     * vid tabulka borrows a trigger before insert...
     * vyhoda je nemusim sa v PHP kode starat o odratavanie kusov a sledovanie inych veci....
     * 
     * @param int $id idecko knihy
     */
    private function borrowBook($id) 
    {
       // print_r($id);
        $bookBorrowed = $this->checkBorrowedBook($this->user_id, intval($id));
       
        if (!$bookBorrowed)
        {
            $data = array();
            
            $data["user_id"] = $this->user_id;
            $data["book_id"] = intval($id);
            $data["start"] = date("Y-m-d");
            $data["days"] = 21;
            
            $res = $this->db->insert_row("borrows",$data);
            
            if ($res["status"])
            {
               $this->smarty->assign("message","Kniha bola zapožičaná");
               $this->smarty->display("search.tpl");
            }
        }
        else 
        {
            $this->smarty->assign("message","Knihu už máte požičanú....");
            $this->smarty->display("search.tpl");
        }
    }
    
    
    /**
     * Nacita tagy pre danu knihu...
     * 
     * @param int $book_id idecko knihy
     * @return string $result string oddeleny ciarkami
     */
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
      
    
    
    /**
     * Hladanie knih.
     * 
     * t.c. velmi primitivne, ale hlada sa dla nazvu, autora a ISBN. Jedna sa o obycajny LIKE. 
     * Tu je nutne spravit tzv. inteligentny search sojeni s AJAXOM ev citackou ciarovych kodov
     * Vysledkom v search.tpl je tabulka z ktorej sa da kniha z editovat, pozicat (tu len za predpokladu ze je viac kusov ako 0, vid search.tpl)
     * alebo zmazat....
     * 
     * @param array $request pole s postu stranky
     */
    private function searchBooks($request)
    {
        $searchIn = $request["searchin"];
        $phrase = trim($request["phrase"]);
        $searchInMiddle = false;
        if ($searchIn != "isbn")
        {
            if (isset($request["inword"]) && $request["inword"] == "yes")
            {
                $searchInMiddle = true;
            }
    
            $phraseArr = explode(" ",$phrase);
            
            
            $passCn = count($phraseArr);
            $query = "";
            $where = "";
            //print_r($passCn);
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
        }
        if ($searchIn !="isbn")
        {
            $finalQuery = sprintf("SELECT * FROM [books] WHERE %s LIKE %s",$where,$query);
        }
        else 
        {
            $finalQuery = sprintf("SELECT * FROM [books] WHERE [isbn]= '%s'", $phrase);
        }
        
        
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