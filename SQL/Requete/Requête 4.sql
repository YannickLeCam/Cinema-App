SELECT NAME , COUNT(id_movie) AS "Nb Movie"
FROM type
JOIN be
ON be.id_type = type.id_type
GROUP BY be.id_type
ORDER BY "Nb movie" DESC;