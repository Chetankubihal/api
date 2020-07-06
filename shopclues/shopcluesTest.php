
<?php



header("Content-Type: application/json; charset=UTF-8");
header("Authorization: Bearer".$accessToken);

{ "Products":

 [

      { 
        "product_code": 123, 
        "merchant_reference_number": 
        "SS1123", "status": "D", 
        "list_price": 2345,
        "price": 2134,
        "Quantity": 2, 
        "company_id":1,
        "shipping_freight": 0, 
        "is_cod": "Y", 
        "category": 355,
        "hsn_code":"10011090",
        "product_name": "Test Product Not For Sale084657830001", 
        "description": "newest my name product hii",
        "features": {  }, 
        "detailed_image_path": "http://cdn.shopclues.com/images/detailed/45984/testproductimg13734394321468314520_1476865505.gif",
        "product_shipping_estimation": ""  
        } 

 ]

} 
?>