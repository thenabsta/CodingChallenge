<?php

namespace functions;

class base{

   
    function sanitizeData($data){
    
	    // Sanatize input and pass it back out
        return htmlspecialchars($data);
    
    }
    
    function validateUser($userInfo)
    {
        //  Run validatePhoneNumber;  
        //  Run sanitizeData;
        //  Return all data 
	    return false;
    }
    
    function validatePhoneNumber($phoneNumber){
    
         // Run a regex statement on phone number and return it
    
    }

   

    
    function createTable($tableName, $arrayOfFields){
    
        //  It will include databaseConnect();
        //  This function will check if the table exists and create the table if it is not present
        //  It will execute an SQL statement to generate the table in the database
    }
    
    
    function loadUser($userId)
    {
	    // Connect to database
	    // Find user by user ID using an SQL Where statement
	    // Close database connection
	    // Return user information as an array
	    return array();
    }
    
  
    function saveUser($userInfo)
    {
        // Connect to database
        // Store user information in database with SQL Insert Into command
	    // Redirect to confirmation page
	    return false;
    }
    
    }
    
class admin extends base
    {
    
        //var password;
        //var player_id;
    
    function loadContent($userId)
    {
	    // Connect to database
	    // Find user by user ID using an SQL Where statement
	    // Close database connection
	    // Return user information as an array
	    return array();
    }

}

class user extends base

{    

    //public function __construct(){password, player_id}
    
    
    function loadContent($userId)
    {
	    // Connect to database
	    // Find user by user ID using an SQL Where statement
	    // Close database connection
	    // Return user information as an array
	    return array();
    }
    
    function loginUser($userId)
    {
    
    
    }
    
    function logoutUser($userId)
    {
    
    
    }
    
    function startSession($userId)
    {
    
    
    }
    
    function killSession($userId)
    {
    
    
    }
}

?>