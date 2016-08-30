<?php

class Game extends GameController
{

    public function load($gameId)

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
                echo "Does not work";
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
    
    public function loadAll(){

        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, $this->database);
            
            $loadGameSQL = "SELECT * FROM games";
            $result = $db->query($loadGameSQL);
            $numberOfRows = mysqli_num_rows($result);
         
            while($this->row = mysqli_fetch_array($result)) 
            {      
                global $rowNumber;

                //$this->gameOutput = $this->generateGame($this->row);
                $this->finalizeGame($this->row);
                $this->gameOutput = "";
            }

                $success = true;

            }
            else                 
            {
                echo "Does not work";
                echo mysql_error();
                die;                
            }
        
        return $success;
    }

        public function findGames($searchValue){

        $db = $this->databaseConnectParameters();
        if ($db)  
        {
            
            $loadGameSQL = "SELECT * FROM games WHERE game_content LIKE " . '\'%' . $searchValue . '%\'';

            $result = $db->query($loadGameSQL);

            if(count($result) > 0 && $result != false) {
            $numberOfRows = mysqli_num_rows($result);
         

            while($this->row = mysqli_fetch_array($result)) 
            {      
                global $rowNumber;

                //$this->gameOutput = $this->generateGame($this->row);
                $this->finalizeGame($this->row);
                $this->gameOutput = "";
            }

                $success = true;

            }
            else                 
            {
                ?> 
                
                <div class="error">No results found for 
                    <?php echo " " . $searchValue ?>.
                </div>
                
                <?php

                echo mysql_error();
                die;                
            }
        
        return $success;
    }
    }
    
}
?>