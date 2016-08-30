<?php

class PlayersController extends DatabaseController {

    public $playerOutput;
    public $player_id;
    public $submission_date;
    public $submission_time;
    public $birth_date;
    public $date_of_death;
    public $credits;
    public $lifetime_spins;
    public $lifetime_average_return;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $salt;
    public $email_address;
    public $admin_privileges;
    public $confirmationMessage="";
    public $row;
    public static $years = [];

    public function generateTable($row){
        
        $this->playerOutput .= "<tr>";
        $this->playerOutput .= "<td>" . $row['player_id'] . "</td>";
        $this->playerOutput .= "<td>" . $row['first_name'] . "</td>";
        $this->playerOutput .= "<td>" . $row['last_name'] . "</td>";
        $this->playerOutput .= "<td>" . $row['username'] . "</td>";
        $this->playerOutput .= "<td> ******** </td>";
        $this->playerOutput .= "<td>" . $row['birth_date'] . "</td>";
        $this->playerOutput .= "<td>" . $row['date_of_death'] . "</td>";
        $this->playerOutput .= "<td>" . $row['credits'] . "</td>";
        $this->playerOutput .= "<td>" . $row['coins_won'] . "</td>";
        $this->playerOutput .= "<td>" . $row['coins_bet'] . "</td>";
        $this->playerOutput .= "<td>" . $row['lifetime_spins'] . "</td>";
        $this->playerOutput .= "<td>" . $row['lifetime_average_return'] . "</td>";
        $this->playerOutput .= "<td>" . $row['email_address'] . "</td>";
        $this->playerOutput .= "<td>" . $row['admin_privileges'] . "</td>";
        $this->playerOutput .= "<td>" . $row['submission_date'] . "</td>";
        $this->playerOutput .= "<td>" . $row['submission_time'] . "</td>";
        $this->playerOutput .= "<td> <a href=\"../Views/PlayerEdit.php?player_id=" . $row['player_id'] . "&first_name=" . $row['first_name'] . "&last_name=" . $row['last_name'] . "&username=" . $row['username'] . "&credits=" . $row['credits'] . "&lifetime_spins=" . $row['lifetime_spins'] . "&lifetime_average_return=" . $row['lifetime_average_return'] . "&player_id=" . $row['player_id'] . "&email_address=" . $row['email_address'] . "\"class=\"btn btn-primary\">Edit</a></td>";
        $this->playerOutput .= "<td> <a href=\"../Views/PlayerDelete.php?player_id=" . $row['player_id'] . "&first_name=" . $row['first_name'] . "&last_name=" . $row['last_name'] . "&player_id=" . $row['player_id'] . "&email_address=" . $row['email_address'] . "\"class=\"btn btn-danger\">Delete</a></td>";
        echo $this->playerOutput;
    }
    
    public function initializeYears(){
                for ($i = 1900; $i <= 2000; $i++) {
            // ${"year_$i"} = 0;
            // var_dump(${"year_$i"});
            if(!isset($this->years[${"year_$i"}])) {
                $this->years['year_' . $i] = 0;
            }
        }
    }

    public function getLivingPlayersPerYear($row){

        $birth_year = intval(substr($row['birth_date'], 0, 4));
        $year_of_death = intval(substr($row['date_of_death'], 0, 4));


        for ($i = $birth_year; $i <= $year_of_death; $i++) {
            $this->years['year_' . $i] +=1 ;
        }
    }

    public function outputGraph(){

        arsort($this->years);
        echo "<div class=\"gameWrapper\">";
        echo "<h1>Players Alive Per Year</h1>";
        foreach($this->years as $year => $players_alive){


            $bar_size = $players_alive + 150;
            echo "<div class=\"graphBox\" style=\"width:" . $bar_size . "px;\">";
            echo "During the year " . substr($year, -4) . " there were " . $players_alive . " players alive."; 
            echo "</div>";
        }
        echo "</div>";

        // foreach($this->years as $year => $players_alive){
// 
            // echo "Year: " . substr($year, -4) . " Players Alive: " . $players_alive . "<br";
        // }
    }

    public function setData($dataArray) 
    {
        
        if(isset($dataArray['player_id']))
        {
        $this->player_id = $dataArray['player_id'];
        $this->submission_date=$this->submission_date = date('Y-m-d');
        $this->submission_time=$this->submission_time = date("H:i:s");
        $this->first_name = $dataArray['first_name'];
        $this->last_name = $dataArray['last_name'];
        $this->username = $dataArray['username'];
        $this->password = $dataArray['password'];
        $this->email_address = $dataArray['email_address'];
        $this->admin_privileges = $dataArray['admin_privileges'];
        }
    }

    public function fillInput($player_id)
    {
        $success = false;
        
        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, getenv('DATABASE'));
            
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

    public function save()
    {
        $db = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($db) 
        {
            mysqli_select_db($db, getenv('DATABASE'));
        
            if ($this->player_id > 0) {
                // this is an update
                $playerUpdateSQL = "UPDATE players SET " .

                    "player_id = '" . $db->real_escape_string($this->player_id) . "', " .
                    "submission_date = '" . $db->real_escape_string($this->submission_date) . "', " .
                    "submission_time = '" . $db->real_escape_string($this->submission_time) . "', " .
                    "first_name = '" . $db->real_escape_string($this->first_name) . "', " .
                    "last_name = '" . $db->real_escape_string($this->last_name) . "', " .
                    "username = '" . $db->real_escape_string($this->username) . "', " .
                    "password = '" . $db->real_escape_string($this->password) . "', " .
                    "email_address = '" . $db->real_escape_string($this->email_address) . "', " .
                    "admin_privileges = '" . $db->real_escape_string($this->admin_privileges) . "' " .
                    "WHERE player_id = " . $db->real_escape_string($this->player_id);
                  $result = $db->query($playerUpdateSQL);
                  var_dump($result);

//                $rs = mysql_query($playerUpdateSQL);     
                if (!$result) {
                    echo mysql_error();
                    die;
                }
            }
            else 
            {
                // this is an insert
                $playerInsertSQL = "INSERT INTO players SET " . 

                    "first_name = '" . $db->real_escape_string($this->first_name) . "', " .
                    "last_name = '" . $db->real_escape_string($this->last_name) . "', " .
                    "username = '" . $db->real_escape_string($this->player_id) . "', " .
                    "password = '" . $db->real_escape_string($this->password) . "', " .
                    "email_address = '" . $db->real_escape_string($this->email_address) . "', " .
                    "admin_privileges = '" . $db->real_escape_string($this->admin_privileges) . "', " .
                    "submission_date = '" . $db->real_escape_string($this->submission_date) . "', " .
                    "submission_time = '" . $db->real_escape_string($this->submission_time) . "'";

                $result = $db->query($playerInsertSQL);
                // $rs = mysqli_query($db, $playerInsertSQL);     
                if (!$result) {
                    echo mysql_error();
                    die;

                } 
                else 
                {
                    $this->player_id = $db->insert_id;
                    //$this->player_id = mysqli_insert_id($db);
                }

            }
        }
    }
    
    public function validate() 
    {
        $errorsArray = array();
        
        if (empty($this->first_name)) 
        {
            $errorsArray['first_name'] = "First Name is required.";
        }

        if (empty($this->last_name)) 
        {
            $errorsArray['last_name'] = "Last Name is required.";
        }

        if (empty($this->username)) 
        {
            $errorsArray['username'] = "username is required.";
        }
        if (empty($this->password)) 
        {
            $errorsArray['password'] = "Password is required.";
        }
        if (empty($this->email_address)) 
        {
            $errorsArray['email_address'] = "Email is required.";
        }
        if (empty($this->admin_privileges)) 
        {
            $errorsArray['admin_privileges'] = "Admin Privileges are required.";
        }
        return $errorsArray;
    }

    public function deletePlayer($player_id){

        $db = $this->databaseConnectParameters();
        if ($db) 
        {
            mysqli_select_db($db, getenv('DATABASE'));
            
            $loadPlayerSQL = "DELETE FROM players WHERE player_id = " . htmlspecialchars($player_id);
            $result = $db->query($loadPlayerSQL);

            if(count($result) > 0 && $result != false) {

                $success = true;

            }
            else                 
            {
                ?> 
                
                <div class="jumbotron">This player does not exist:  
                    <?php echo " " . $searchValue ?>.
                </div>
                
                <?php

                echo mysql_error();
                die;                
            }
        
    }
}

}