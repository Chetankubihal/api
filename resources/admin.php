<?php 

class Admin{

    private $conn;
    public $password;
    private $loginTime;
    private $table='admin';

    public function __construct($con)
    {
        $this->conn = $con;
    }


   

    function updateLoginTime($MAC,$IP)
    {   
        date_default_timezone_set("Asia/Kolkata"); 
        $date = new DateTime("NOW");
        $loginTime= '"' . $date->format('Y-m-d H:i:s') .'"';

        $query = "UPDATE
        " . $this->table . "
          SET
            loginTime = " . $loginTime." ,MAC_ADDR =".$MAC." ,IP_ADDR=".$IP;

// prepare query statement
            $stmt = $this->conn->prepare($query);

// execute the query
        if($stmt->execute()){
            return true;
            }

        return false;
}
    function login(){
 
         
        $query = "SELECT id
               FROM
                   " . $this->table . "
               WHERE password = " . $this->password;
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
    
       // execute query
       $stmt->execute();
       
       return $stmt;

    }

    function updatePassword()
    {
        $query = "UPDATE
        " . $this->table . "
          SET
            
             password = :password
              WHERE
             email = :email";

// prepare query statement
            $stmt = $this->conn->prepare($query);
           
// sanitize
           
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));

// bind new values
           
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

// execute the query
        if($stmt->execute()){
            return true;
            }

        return false;
}


}


?>