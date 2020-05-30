<?php

class Product{

private $conn;
private $table = 'products';

public $product_id;
public $product_SKU;   
public $product_HSN; 
public $product_name;
public $product_category;
public $product_sub_category;
public $product_description;
public $product_MRP;
public $product_selling_price;
public $merchant_id;
public $seller_email;
public $status;
public $package_length;
public $package_width;
public $package_breadth;
public $package_weight;
public $product_quantity;
public $address1;
public $address2;
public $city;
public $pincode;
public $state;
public $contact;
public $type;
public $last_updated;
public $role;
public $district;


public function __construct($con)
{
    $this->conn = $con;
}

function category_name()
{
    $query="select category_name from category where category_id = ".trim($this->product_category,'"');

    
    $stmt=$this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	
 
    $this->product_category= '"'.$row['category_name'].'"';


}

function sub_category_name()
{
	$query="select sub_category_name from sub_category where category_id = ".trim($this->product_category,'"') ." AND sub_category_id = ".trim($this->product_sub_category,'"');


    $stmt=$this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->product_sub_category='"'. $row['sub_category_name'] .'"';


}
function addProduct()
{
	$this->sub_category_name();

	$this->category_name();

    $query="INSERT INTO products(product_SKU,product_HSN,product_name,product_description,product_category,product_sub_category,seller_email,product_MRP,product_selling_price,package_length,package_width,package_breadth,package_weight) values (".$this->product_SKU.','.$this->product_HSN.','.$this->product_name.','.$this->product_description.','.$this->product_category.','.$this->product_sub_category.','.$this->seller_email.','.$this->product_MRP.','.$this->product_selling_price.','.$this->package_length.','.$this->package_width.','.$this->package_breadth.','.$this->package_weight.")";

  
    $stmt= $this->conn->prepare($query);

   if($stmt->execute())
   {
       //query to get last product id and increment by one
       $query1="SELECT MAX(product_id) as id from products where seller_email=".$this->seller_email;

       $stmt1=$this->conn->prepare($query1);

       if($stmt1->execute())
            {
                $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                $this->product_id=$row['id'];
               # $this->product_id=$row['product_SKU'];

                return true;
            }
        else 
            {
             return false;
            } 
   }

   else
   {
       return false;
   }

}

function getCategory()
{
    $query="SELECT * From category";

    $stmt= $this->conn->prepare($query);

   $stmt->execute();

   return $stmt;

}
function getSubCategory($category_id)
{
    $query="SELECT * From sub_category WHERE category_id=".$category_id;

    $stmt= $this->conn->prepare($query);

   $stmt->execute();

   return $stmt;

}

function readOne(){
 
    // query to read single record
     $query = "SELECT *
            FROM
                " . $this->table . "
            WHERE
                product_SKU = " . $this->product_SKU . "
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    if ($stmt->execute())
 {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->product_name = $row['product_name'];
    $this->product_description = $row['product_description'];
    $this->product_category = $row['product_category'];
    $this->product_sub_category = $row['product_sub_category'];
    $this->product_MRP = $row['product_MRP'];
    $this->product_selling_price = $row['product_selling_price'];
    $this->product_SKU = $row['product_SKU'];
    $this->product_HSN = $row['product_HSN'];
    $this->status = $row['status'];
    $this->package_length=$row['package_length'];
    $this->package_breadth=$row['package_breadth'];
    $this->package_width=$row['package_width'];
    $this->package_weight=$row['package_weight'];

    return true;
 }
 else
 {
     return false;
 }
    
  
}

function readInventory(){
 
    // query to read single record
     $query = "SELECT *
            FROM
                inventory
            WHERE
                sku_code = " . $this->product_SKU . "
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    if ($stmt->execute())
 {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->product_quantity = $row['quantity'];
    $this->address1 = $row['address1'];
    $this->address2 = $row['address2'];
    $this->city = $row['city'];
    $this->pincode = $row['pincode'];
    $this->state = $row['state'];
    $this->contact = $row['contact'];
    $this->type = $row['type'];
    $this->last_updated = $row['last_updated'];
    $this->role=$row['role'];
    $this->district=$row['district'];
   
    return true;
 }

 else
 {
     return false;
 }
    
  
}

function updateProduct()
{
    $query="Update products SET product_HSN=".$this->product_HSN.", product_name=".$this->product_name.",product_description=".$this->product_description.",product_category=".$this->product_category.",product_sub_category=".$this->product_sub_category.",product_MRP=".$this->product_MRP.",product_selling_price=".$this->product_selling_price.",package_length=".$this->package_length.",package_width=".$this->package_width.",package_breadth=".$this->package_breadth.",package_weight=".$this->package_weight."WHERE  product_id=".$this->product_id;
  
    $stmt= $this->conn->prepare($query);

   if($stmt->execute())
   {
        return true;   
   }

   else
   {
       return false;
   }

}

function excelUpload($sheet_data,$seller_email)
{
   $flag=0;

    foreach ($sheet_data as $row)
    {
        if(!empty($row['C']) && $row['C']!='Name' )
        {

                $query='INSERT INTO products (product_SKU,product_HSN,product_name,product_description,product_category,product_sub_category,seller_email,product_MRP,product_selling_price,package_length,package_width,package_breadth,package_weight) values ("'.$row['A'].'","'.$row['B'].'","'.$row['C'].'","'.$row['D'].'","'.$row['E'].'","'.$row['F'].'","'.$seller_email.'","'.$row['G'].'","'.$row['H'].'","'.$row['I'].'","'.$row['J'].'","'.$row['K'].'","'.$row['L'].'") ';
                $stmt= $this->conn->prepare($query);

                if(!$stmt->execute())
                {
                     $flag++;   
                }

  else
                {
                    $current_directory=getcwd();
                    //concatenate current_directory with product_id
                    $current_directory=$current_directory."/product_images/".trim($seller_email,'"')."/";
            
                    //making directory by product_id
                    if(!is_dir($current_directory))
                    mkdir($current_directory);
            
                    $current_directory=$current_directory.$row['A']."/";
            
                    if(!is_dir($current_directory))
                    mkdir($current_directory);
                }       }

    }

    return $flag;

}
function checkSKUCode()
{
    $query = "SELECT product_name from products where product_SKU=".$this->product_SKU." AND seller_email = " .$this->seller_email;

    $stmt=$this->conn->prepare($query);

    $stmt->execute();

    return $stmt;

}
function addInventory($address1,$address2,$city,$pincode,$state,$contact,$district)
{
  $query="INSERT INTO inventory(sku_code,quantity,address1,address2,city,pincode,state,contact,district) VALUES (".$this->product_SKU.",".$this->product_quantity.",".$address1.",".$address2.",".$city.",".$pincode.",".$state.",".$contact.",".$district.")";

  $stmt=$this->conn->prepare($query);

  $stmt->execute();

  return $stmt;
}

function updateInventory($address1,$address2,$city,$pincode,$state,$contact,$district,$type,$role)
{

  

  $query="UPDATE inventory SET quantity=".$this->product_quantity.",address1 =" .$address1. ",address2 = ".$address2.",city=". $city .",pincode=".$pincode.",state=".$state.",contact=".$contact.",type=".$type.",district=".$district.",role=".$role." WHERE sku_code=".$this->product_SKU;

  echo $query;

  $stmt=$this->conn->prepare($query);

  $stmt->execute();

  return $stmt;
}
}

?>
