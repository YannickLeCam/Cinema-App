SELECT movie.name, role.name, YEAR(movie.date_release) AS "Année de sortie"
FROM actor
JOIN casting
ON actor.id_actor = casting.id_actor
JOIN role
ON role.id_role = casting.id_role
JOIN movie
ON movie.id_movie = casting.id_movie
WHERE casting.id_actor = 1;