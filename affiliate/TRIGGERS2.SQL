




CREATE TRIGGER insert_shopclues 
AFTER
INSERT ON products 
for each row 
BEGIN 
INSERT INTO shopclues(list_price,price,category,hsn_code,product_name,description,sku_code,merchant_email) 
VALUES (new.product_MRP,new.product_selling_price,new.product_category,new.product_HSN,new.product_name,new.product_description,new.product_SKU,new.seller_email);
END#

CREATE TRIGGER insert_flipkart 
AFTER
INSERT ON products 
for each row 
BEGIN 
INSERT INTO flipkart(list_price,price,category,hsn_code,product_name,description,sku_code,merchant_email) 
VALUES (new.product_MRP,new.product_selling_price,new.product_category,new.product_HSN,new.product_name,new.product_description,new.product_SKU,new.seller_email);
END#

CREATE TRIGGER insert_amazon 
AFTER
INSERT ON products 
for each row 
BEGIN 
INSERT INTO amazon(list_price,price,category,hsn_code,product_name,description,sku_code,merchant_email) 
VALUES (new.product_MRP,new.product_selling_price,new.product_category,new.product_HSN,new.product_name,new.product_description,new.product_SKU,new.seller_email);
END#