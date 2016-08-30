    <?php

    class DatabaseController extends BaseController{

    public $database = getenv('DATABASE');

    protected function databaseConnect(){

    $hostname = "127.0.0.1"; 
    $username = getenv('DB_USERNAME'); 
    $database = getenv('DATABASE');  
    $password = getenv('DB_PASSWORD'); 
    
    $link;

    $link = mysqli_connect($hostname, $username, $password, $database); //$link is the connection object created by this command.
    $link = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($link));

        if (!$link)                                     
        // If the connection ($link) is NOT good then handle the error
                { 
                    echo "Bad Connection";
                }
        
        return $link;
        // Returns connection
    
    }

    public function databaseConnectParameters(){

            $link = $this->databaseConnect();
            return $link;

            }
}