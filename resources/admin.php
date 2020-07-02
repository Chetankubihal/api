<?php 

class Admin{

    private $conn;
    private $password;
    private $loginTime;
    $private $table='admin';
    public function __construct($con)
    {
        $this->conn = $con;
    }


   

    function updateLoginTime()
    {   
        date_default_timezone_set("Asia/Kolkata"); 
        $date = new DateTime("NOW");
        $loginTime= '"' . $date->format('Y-m-d H:i:s') .'"';

        $query = "UPDATE
        " . $this->table . "
          SET
            loginTime = " . $loginTime;

// prepare query statement
            $stmt = $this->conn->prepare($query);
   

// execute the query
        if($stmt->execute()){
            return true;
            }

        return false;
}
    function login(){
 
         
        $query = "SELECT *
               FROM
                   " . $this->table . "
               WHERE password = " . $this->password .;
    
       // prepare query statement
    
       $stmt = $this->conn->prepare($query);
    
    
       // execute query
       $stmt->execute();
       
       return $stmt;

    }



}


?>