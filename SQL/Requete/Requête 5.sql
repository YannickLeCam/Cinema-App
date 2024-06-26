SELECT person.* , COUNT(id_movie)
FROM person
JOIN director
ON director.id_person = person.id_person
JOIN movie
ON movie.id_director = director.id_director
GROUP BY movie.id_director
ORDER BY COUNT(id_movie) DESC; 