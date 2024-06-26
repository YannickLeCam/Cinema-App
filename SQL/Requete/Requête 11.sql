SELECT CONCAT(NAME,' ',firstname), TIMESTAMPDIFF(YEAR, birthday, NOW()) AS 'Age'
FROM person
WHERE TIMESTAMPDIFF(YEAR, birthday, NOW()) >= 50;