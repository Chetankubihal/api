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

