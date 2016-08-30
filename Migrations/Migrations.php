<?php 

date_default_timezone_set('America/Chicago');

class Migrations extends DatabaseController{

public $link;
public $result;
public $test;
public $first_name = [
    'Maria',
    'John', 
    'Ellen',
    'Jack',
    'Zachary',
    'Igore',
    'Eli',
    'Ashley',
    'Andrew',
    'Jim',
    'Josh'
];
public $last_name = [
    'Smith',
    'Dawson', 
    'Hayes',
    'Roswell',
    'Schmitt',
    'Long',
    'Elektra',
    'Tosh',
    'Jennings',
    'Manning',
    'Simpson'
]; 


public function createTables(){

$expiration_date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 60, date('Y')));
$submission_date = date('Y-m-d');
$submission_time = date("H:i:s");
$this->test = "";
$this->test = "DROP TABLE players; DROP TABLE games; ";
$this->test .= "SHOW TABLES IN `" . getenv('DATABASE') . "` WHERE `Tables_in_tests` = 'players'";
$this->link = $this->databaseConnect();

// perform the query and store the result
$this->result = $this->link->query($this->test);

if($this->result){

    // echo "Table Exists";

    }

    else{

        //create table players
        $sql  = "CREATE TABLE players";
        $sql .= "(";
        $sql .= "player_id INT(7) NOT NULL AUTO_INCREMENT, ";
        $sql .= "submission_date DATE, ";
        $sql .= "submission_time TIME, "; 
        $sql .= "birth_date DATE, ";
        $sql .= "date_of_death DATE, ";
        $sql .= "first_name VARCHAR(255) NOT NULL, ";
        $sql .= "last_name VARCHAR(255) NOT NULL, ";
        $sql .= "username VARCHAR(255) NOT NULL, ";
        $sql .= "credits INT(7) NOT NULL, ";
        $sql .= "coins_won INT(7) NOT NULL, ";
        $sql .= "coins_bet INT(7) NOT NULL, ";
        $sql .= "lifetime_spins INT(7) NOT NULL, ";
        $sql .= "lifetime_average_return INT(7) NOT NULL, ";
        $sql .= "password VARCHAR(255) NOT NULL, ";
        $sql .= "salt VARCHAR(255) NOT NULL, ";
        $sql .= "email_address VARCHAR(255) NOT NULL, ";
        $sql .= "admin_privileges INT(7) NOT NULL, ";
        $sql .= "PRIMARY KEY ( player_id )";
        $sql .= ");";


        if ( mysqli_query($this->link,$sql) )

            {

                $sql = "INSERT INTO players (submission_date, submission_time, birth_date, date_of_death, first_name, last_name, username, credits, coins_won, coins_bet, lifetime_spins, lifetime_average_return, password, salt, email_address, admin_privileges) VALUES ";

                for ($i = 0; $i <= 1000; $i++) {

                    $tmp_first_name = $this->first_name[rand(0, 10)];
                    $tmp_last_name = $this->last_name[rand(0, 10)];
                    $tmp_username = substr($tmp_first_name, 0, 1) . $tmp_last_name;
                    $tmp_birth_month = rand(1, 12);
                    
                    if($tmp_birth_month == 4 || $tmp_birth_month == 6 || $tmp_birth_month == 9 || $tmp_birth_month == 11)
                    {
                        $tmp_birthday = rand(1, 30);
                    }
                    elseif($tmp_birth_month == 2)
                    {
                        $tmp_birthday = rand(1, 28);   
                    }
                    else
                    {
                        $tmp_birthday = rand(1, 31);        
                    }

                    $tmp_birth_year = rand(1900, 2000);

                    $tmp_birthdate = $tmp_birth_year . '-' . $tmp_birth_month . '-' . $tmp_birthday;

                    $tmp_year_of_death = rand($tmp_birth_year, 2000);

                    $tmp_month_of_death = rand(1, 12);

                    if($tmp_month_of_death == 4 || $tmp_month_of_death == 6 || $tmp_month_of_death == 9 || $tmp_month_of_death == 11)
                    {
                        $tmp_day_of_death = rand(1, 30);
                    }
                    elseif($tmp_month_of_death == 2)
                    {
                        $tmp_day_of_death = rand(1, 28);   
                    }
                    else
                    {
                        $tmp_day_of_death = rand(1, 31);        
                    }

                    $tmp_date_of_death = $tmp_year_of_death . '-' . $tmp_month_of_death . '-' . $tmp_day_of_death;
                    
                    $tmp_credits = rand(0,9); 
                    $tmp_coins_won = rand(0,9);
                    $tmp_coins_bet = rand(0,9);
                    $tmp_lifetime_spins = rand(0,50);
                    $tmp_lifetime_average_return = rand(0,9);

                    $tmp_salt = hash('sha256', 'salt');

                    $sql .= "('";
                    $sql .= $submission_date . "', '"; 
                    $sql .= $submission_time . "', '"; 
                    $sql .= $tmp_birthdate . "', '"; 
                    $sql .= $tmp_date_of_death . "', '"; 
                    $sql .= $tmp_first_name .  "', '";
                    $sql .= $tmp_last_name . "', '"; 
                    $sql .= $tmp_username . "', '"; 
                    $sql .= $tmp_credits . "', '"; 
                    $sql .= $tmp_coins_won . "', '"; 
                    $sql .= $tmp_coins_bet . "', '"; 
                    $sql .= $tmp_lifetime_spins . "', '"; 
                    $sql .= $tmp_lifetime_average_return . "', '"; 
                    $sql .= "password', '";
                    $sql .= $tmp_salt . "', '"; 
                    $sql .= "test@example.com', '";
                    $sql .= "1'),";

                } 

                    $sql .= "('";
                    $sql .= $submission_date . "', '"; 
                    $sql .= $submission_time . "', '"; 
                    $sql .= '1948-12-01' . "', '"; 
                    $sql .= '1999-20-08' . "', '"; 
                    $sql .= 'John' .  "', '";
                    $sql .= 'Doe' . "', '"; 
                    $sql .= 'JDoe' . "', '"; 
                    $sql .= '3' . "', '"; 
                    $sql .= '5' . "', '"; 
                    $sql .= '8' . "', '"; 
                    $sql .= '80' . "', '"; 
                    $sql .= '80' . "', '"; 
                    $sql .= "password', '";
                    $sql .= $tmp_salt . "', '"; 
                    $sql .= "test@example.com', '";
                    $sql .= "1');";
        
                if ( mysqli_query($this->link,$sql) ){

                // echo "it worked";

                }

                else {

                 // echo "<h1>You have encountered a problem.</h1>";
                 // echo "<h2 style='color:red'>" . mysqli_error($this->link) . "</h2>";


                }

            }

        else

            {

                // do nothing
                 // echo "<h1>You have encountered a problem.</h1>";
                 // echo "<h2 style='color:red'>" . mysqli_error($this->link) . "</h2>";

            }

}
//end of table creation
?>

<?php 

$this->test = "SHOW TABLES IN '". getenv('DATABASE') . "' WHERE 'Tables_in_tests' = 'games'";

// perform the query and store the result
$this->result = $this->link->query($this->test);

if($this->result){

    // echo "Table Exists";

    }

    else{

        //create table games table
        $sql  = "CREATE TABLE games";
        $sql .= "(";
        $sql .= "game_id INT(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "game_title VARCHAR(255) NOT NULL, ";
        $sql .= "game_content text NOT NULL,";
        $sql .= "game_publisher VARCHAR(255) NOT NULL,";        
        $sql .= "game_publication_date DATE NOT NULL, ";
        $sql .= "last_played_date DATE, ";
        $sql .= "last_played_time TIME, ";
        $sql .= "PRIMARY KEY ( game_id )";
        $sql .= ") ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";
        
/*        $sql .= "ALTER TABLE `games`";
        $sql .= "  ADD PRIMARY KEY (`game_id`);";

        $sql .= "ALTER TABLE `games`";
        $sql .= "  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;";
*/

        if ( mysqli_query($this->link,$sql) )

            {

                 $sql = "INSERT INTO games (game_title, game_content, game_publisher, game_publication_date, last_played_date, last_played_time) VALUES ";

                    $game_title = 'Lottery Game';
                    $game_content = 'A bunch of lottery stuff';
                    $game_publisher = 'Scientific Games';
                    $game_publication_date = $submission_date;
                    $last_played_date = $submission_date;
                    $last_played_time = $submission_time;


                    $sql .= "('";
                    $sql .= $game_title . "', '"; 
                    $sql .= $game_content . "', '"; 
                    $sql .= $game_publisher . "', '"; 
                    $sql .= $game_publication_date . "', '"; 
                    $sql .= $last_played_date .  "', '";
                    $sql .= $last_played_time . "'), "; 


                    $game_title = 'Space Game';
                    $game_content = 'A bunch of space stuff';
                    $game_publisher = 'Scientific Games';
                    $game_publication_date = $submission_date;
                    $last_played_date = $submission_date;
                    $last_played_time = $submission_time;


                    $sql .= "('";
                    $sql .= $game_title . "', '"; 
                    $sql .= $game_content . "', '"; 
                    $sql .= $game_publisher . "', '"; 
                    $sql .= $game_publication_date . "', '"; 
                    $sql .= $last_played_date .  "', '";
                    $sql .= $last_played_time . "'); "; 

                 if ( mysqli_query($this->link,$sql) ){
                     
                     // echo "it worked";

                 }

                 else {

                // echo "<h1>You have encountered a problem games not created.</h1>";
                // echo "<h2 style='color:red'>" . mysqli_error($this->link) . "</h2>";

                 }




            }

        else

            {

                // do nothing
                // echo "<h1>You have encountered a problem games not created.</h1>";
                // echo "<h2 style='color:red'>" . mysqli_error($this->link) . "</h2>";

            }

}
//end of table creation
}
}
?>


