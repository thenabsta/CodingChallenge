<?php

class game 
{
    var $gameId;
    var $gameTitle;
    var $gameContent;
    var $gamePublisher;
    var $publicationDate;

    function setData($dataArray) 
    {
        $this->gameId = $dataArray['game_id'];
        $this->gameTitle = $dataArray['game_title'];
        $this->gameContent = $dataArray['game_content'];
        $this->gamePublisher = $dataArray['game_publisher'];
        $this->publicationDate = $dataArray['game_publication_date'];
    }
    
    function load($gameId)
    {
        $success = false;
        
        $db = databaseConnectParameters();
        if ($db) 
        {
            mysql_select_db(getenv('DATABASE'));
            
            $loadGameSQL = "SELECT * FROM games WHERE game_id = " . 
                mysql_real_escape_string($gameId);
            //var_dump($loadGameSQL);die;
            $rs = mysql_query($loadGameSQL);
            
            if ($rs) 
            {                
                $gameData = mysql_fetch_assoc($rs);
//                var_dump($gameData);die;
                $this->setData($gameData);
                $success = true;
            }
            else                 
            {
                echo mysql_error();
                die;                
            }
        } 
        else 
        {
            echo mysql_error();
            die;
        }
        
        return $success;
    }
    
    function save()
    {
        $db = databaseConnectParameters();
        if ($db) 
        {
            mysql_select_db('wdv441');
        
            if ($this->gameId > 0) {
                // this is an update
                $gameUpdateSQL = "UPDATE games SET " .
                    "game_title = '" . mysql_real_escape_string($this->gameTitle) . "', " .
                    "game_content = '" . mysql_real_escape_string($this->gameContent) . "', " .
                    "game_publisher = '" . mysql_real_escape_string($this->gamePublisher) . "', " .
                    "game_publication_date = '" . mysql_real_escape_string($this->publicationDate) . "' " .
                    "WHERE game_id = " . mysql_real_escape_string($this->gameId);

                $rs = mysql_query($gameUpdateSQL);     
                if (!$rs) {
                    echo mysql_error();
                    die;
                }
            }
            else 
            {
                // this is an insert
                $gameInsertSQL = "INSERT INTO games SET " . 
                    "game_title = '" . mysql_real_escape_string($this->gameTitle) . "', " .
                    "game_content = '" . mysql_real_escape_string($this->gameContent) . "', " .
                    "game_publisher = '" . mysql_real_escape_string($this->gamePublisher) . "', " .
                    "game_publication_date = '" . mysql_real_escape_string($this->publicationDate) . "'";

                $rs = mysql_query($gameInsertSQL);     
                if (!$rs) {
                    echo mysql_error();
                    die;
                } 
                else 
                {
                    $this->gameId = mysql_insert_id();
                }

            }
        }
    }
    
    function validate() 
    {
        $errorsArray = array();
        
        if (empty($this->gameTitle)) 
        {
            $errorsArray['gameTitle'] = "Article Title is required.";
        }

        if (empty($this->gameContent)) 
        {
            $errorsArray['gameContent'] = "Article Content is required.";
        }

        if (empty($this->gamePublisher)) 
        {
            $errorsArray['gamePublisher'] = "Article Author is required.";
        }
      
        return $errorsArray;
    }
    
}
?>