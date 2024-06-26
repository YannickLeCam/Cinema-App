SELECT * 
FROM movie
WHERE YEAR(NOW())-5 > YEAR(date_release)
ORDER BY date_release DESC;