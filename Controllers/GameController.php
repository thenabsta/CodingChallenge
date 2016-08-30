<?php

class GameController extends DatabaseController {

    public $gameId;
    public $gameTitle;
    public $gameContent;
    public $gamePublisher;
    public $publicationDate;
    public $gameData = "";
    public $gameOutput="";
    public $row;

    public function generateGame($row){
        
        $this->gameOutput .= "<p><div class=\"gameWrapper\">";
        $this->gameOutput .= "<strong><h1><span class = \"title\">" . $row['game_title'] . "</span></h1></strong>";
        $this->gameOutput .= "<p>" . $row['game_content'] . "</p>";
        $this->gameOutput .= "<p><em>" . $row['game_publisher'] . "</em></p>";
        $this->gameOutput .= "<p><em>" . $row['game_publication_date'] . "<em></p>";
        $this->gameOutput .= "<a href=\"../Views/GameView.php?game_id=" . $row['game_id'] . "&game_content=" . $row['game_content'] . "&game_title=" . $row['game_title'] . "&game_publication_date=" . $row['game_publication_date'] . "&game_publisher=" . $row['game_publisher'] . "\"class=\"btn btn-primary\">View</a>";
        $this->gameOutput .= "<a href=\"../Views/GameEdit.php?game_id=" . $row['game_id'] . "&game_content=" . $row['game_content'] . "&game_title=" . $row['game_title'] . "&game_publication_date=" . $row['game_publication_date'] . "&game_publisher=" . $row['game_publisher'] . "\"class=\"btn btn-primary\">Update</a>";
        $this->gameOutput .= "<a href=\"../Views/GameDelete.php?game_id=" . $row['game_id'] . "&game_content=" . $row['game_content'] . "&game_title=" . $row['game_title'] . "&game_publication_date=" . $row['game_publication_date'] . "&game_publisher=" . $row['game_publisher'] . "\"class=\"btn btn-danger\">Delete</a>";
        $this->gameOutput .= "</div></p>";
        return $this->gameOutput;
    }

    public function finalizeGame($row){
        echo $this->generateGame($row);
    }


    public function setData($dataArray) 
    {
        if(isset($dataArray['game_id']))
        {
        $this->gameId = $dataArray['game_id'];
        $this->gameTitle = $dataArray['game_title'];
        $this->gameContent = $dataArray['game_content'];
        $this->gamePublisher = $dataArray['game_publisher'];
        $this->publicationDate = $dataArray['game_publication_date'];
        }
    }

    public function fillInput($gameId)
    {
        $success = false;
        
        $db = $this->databaseConnectParameters();
        if ($db) 
        {

            $loadGameSQL = "SELECT * FROM games WHERE game_id = " . 
            $db->real_escape_string($gameId);


            $result = $db->query($loadGameSQL);
            if ($result) 
            {       
                $this->gameData = $result->fetch_assoc();
                $this->finalizeGame($this->gameData);
                $this->setData($this->gameData);
                $success = true;
            }
            else                 
            {
                echo "Does not work Here";
                echo mysql_error();
                die;                
            }
        } 
        else 
        {
            echo mysql_error();
            echo "Does not work 2";
            die;
        }
        
        return $success;
    }

    public function save()
    {

        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, $this->database);
        
            if ($this->gameId > 0) {
                // this is an update
                $gameUpdateSQL = "UPDATE games SET " .

                    "game_title = '" . $db->real_escape_string($this->gameTitle) . "', " .
                    "game_content = '" . $db->real_escape_string($this->gameContent) . "', " .
                    "game_publisher = '" . $db->real_escape_string($this->gamePublisher) . "', " .
                    "game_publication_date = '" . $db->real_escape_string($this->publicationDate) . "' " .
                    "WHERE game_id = " . $db->real_escape_string($this->gameId);
  
                $result = $db->query($gameUpdateSQL);
//                $rs = mysql_query($gameUpdateSQL);     
                if (!$result) {
                    echo mysql_error();
                    die;
                }
            }
            else 
            {
                // this is an insert
                $gameInsertSQL = "INSERT INTO games SET " . 
                    "game_title = '" . $db->real_escape_string($this->gameTitle) . "', " .
                    "game_content = '" . $db->real_escape_string($this->gameContent) . "', " .
                    "game_publisher = '" . $db->real_escape_string($this->gamePublisher) . "', " .
                    "game_publication_date = '" . $db->real_escape_string($this->publicationDate) . "'";

                $result = $db->query($gameInsertSQL);
                // $rs = mysqli_query($db, $gameInsertSQL);     
                if (!$result) {
                    echo mysql_error();
                    die;
                } 
                else 
                {
                    $this->gameId = $db->insert_id;
                    //$this->gameId = mysqli_insert_id($db);
                }

            }
        }
    }
    
    public function validate() 
    {
        $errorsArray = array();
        
        if (empty($this->gameTitle)) 
        {
            $errorsArray['gameTitle'] = "Game Title is required.";
        }

        if (empty($this->gameContent)) 
        {
            $errorsArray['gameContent'] = "Game Content is required.";
        }

        if (empty($this->gamePublisher)) 
        {
            $errorsArray['gamePublisher'] = "Game Publisher is required.";
        }
      
        return $errorsArray;
    }

    public function deleteGame($gameId){

        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, $this->database);
            
            $loadGameSQL = "DELETE FROM games WHERE game_id = " . htmlspecialchars($gameId);
            $result = $db->query($loadGameSQL);

            if(count($result) > 0 && $result != false) {

                $success = true;

            }
            else                 
            {
                ?> 
                
                <div class="jumbotron">This game does not exist:  
                    <?php echo " " . $searchValue ?>.
                </div>
                
                <?php

                echo mysql_error();
                die;                
            }
        
    }
}

}
