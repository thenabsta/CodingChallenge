<?php

class Player extends PlayersController
{


    public function load($player_id)

    {
        $success = false;
        
        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, $this->database);
            
            $loadPlayerSQL = "SELECT * FROM players WHERE player_id = " . 
            $db->real_escape_string($player_id);
            $result = $db->query($loadPlayerSQL);
            if ($result) 
            {       
                $this->playerData = $result->fetch_assoc();
                $this->generateTable($this->playerData);
                $this->setData($this->playerData);
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
            
            $loadPlayerSQL = "SELECT * FROM players";
            $result = $db->query($loadPlayerSQL);
            $numberOfRows = mysqli_num_rows($result);
         

            while($this->row = mysqli_fetch_array($result)) 
            {      
                global $rowNumber;

                //$this->playerOutput = $this->generatePlayer($this->row);
                $this->generateTable($this->row);
                $this->playerOutput = "";
            }

                $success = true;

            }
            else                 
            {
                echo "Does not work";
                echo mysql_error();
                die;                
            }
        echo "</table>";
        echo "</div></p>";        
        return $success;
    }


    public function loadMostCommonYear(){

        $db = $this->databaseConnectParameters();
        $this->initializeYears();
        if ($db) 
        {
            mysqli_select_db($db, $this->database);
            
            $loadPlayerSQL = "SELECT * FROM players";
            $result = $db->query($loadPlayerSQL);
            $numberOfRows = mysqli_num_rows($result);
         

            while($this->row = mysqli_fetch_array($result)) 
            {      
                global $rowNumber;

                //$this->playerOutput = $this->generatePlayer($this->row);
                $this->getLivingPlayersPerYear($this->row);
                $this->playerOutput = "";
            }

                $success = true;

            }
            else                 
            {
                echo "Does not work";
                echo mysql_error();
                die;                
            }
        $this->outputGraph();            
        echo "</table>";
        echo "</div></p>";        
        return $success;
    }


    public function findPlayers($searchValue){

        $db = $this->databaseConnectParameters();
        if ($db) 
        {

            mysqli_select_db($db, $this->database);
            
            $loadPlayerSQL = "SELECT * FROM players WHERE first_name LIKE " . '\'%' . $searchValue . '%\'';

            $result = $db->query($loadPlayerSQL);

            if(count($result) > 0 && $result != false) {
            $numberOfRows = mysqli_num_rows($result);
         

            while($this->row = mysqli_fetch_array($result)) 
            {      
                global $rowNumber;

                //$this->playerOutput = $this->generatePlayer($this->row);
                $this->generateTable($this->row);
                $this->playerOutput = "";
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
        echo "</table>";
        echo "</div></p>";        
        return $success;
        }
    }

    public function login(){
        $success = false;
        if(isset($_POST['username']) && isset($_POST['password'])){
    
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $db = $this->databaseConnectParameters();
            if ($db) 
            {
                mysqli_select_db($db, $this->database);
                
                $loadPlayerSQL = "SELECT * FROM players WHERE username = '" . 
                $username . "'";
                $result = $db->query($loadPlayerSQL);

                if ($result) 
                {       
                    while($this->row = mysqli_fetch_array($result)){ 

                        if($username == $this->row['username'] && $password == $this->row['password']){
                            
                            // var_dump($_SESSION, session_id());
                            // var_dump($this->row['player_id']);

                            $_SESSION['player_id'] = $this->row['player_id'];
                            $_SESSION['username'] = $this->row['username'];
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['timeout'] = date("H:i:s") + 30;
                            echo "<script>window.location.href = \"Login.php\"</script>;";
                            // header("Location:Login.php");  

                        }
                        $success = true;
                    }
                }
                else                 
                {
                    // echo "Does not work 1";
                    // echo mysql_error();
                    // die;                
                }
            } 
            else 
            {
                // echo mysql_error();
                // echo "Does not work 2";
                // die;
            }
            
            return $success;
        }

        else{

        }
    
    }

    public function logout(){
        if($_SESSION['loggedIn'] == true)           
        {
            $_SESSION['loggedIn'] = "";
            $_SESSION['username'] = "";
            $_SESSION['timeout'] = "";
            unset($_SESSION['validUser']);         
            session_destroy();                     
            header("Location:Login.php");  
            exit;
        }
        else
        {header("Location:Login.php");}

    }
}
?>