



CREATE OR REPLACE EVENT deleteNotVerified 
ON
SCHEDULE EVERY 1 MINUTE 
DO
DELETE FROM affiliates where status LIKE 'Not Verified' and (select TIMESTAMPDIFF(DAY,affiliates.date,CURRENT_TIMESTAMP)) >= 1


CREATE OR REPLACE EVENT deleteNotLoggedUser 
ON
SCHEDULE EVERY 1 DAY 
DO
UPDATE affiliates set status = 'Deactivated' WHERE (SELECT TIMESTAMPDIFF(MONTH,affiliates.loginTime,CURRENT_TIMESTAMP)) >= 6;


CREATE TRIGGER insert_shopclues 
AFTER
INSERT ON products 
for each row 
BEGIN 
INSERT INTO shopclues(list_price,price,category,hsn_code,product_name,description,sku_code,merchant_email) 
VALUES (new.product_MRP,new.product_selling_price,new.product_category,new.product_HSN,new.product_name,new.product_description,new.product_SKU,new.seller_email);
END#
