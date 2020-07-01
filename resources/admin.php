<?php 

class Admin{

    private $conn;

    public $password;
  
    public function __construct($con)
    {
        $this->conn = $con;
    }


   

    function login(){
 
         
        if($this->password==md5("Admin@123"))
        
            return true;
      
   

    }



}


?>