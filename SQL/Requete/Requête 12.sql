SELECT person.* 
FROM person
JOIN actor
ON actor.id_person = person.id_person
JOIN casting
ON casting.id_actor = actor.id_actor
GROUP BY casting.id_actor
HAVING COUNT(casting.id_movie)>2;