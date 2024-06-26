SELECT NAME , firstname , genre 
FROM person
JOIN actor
ON person.id_person = actor.id_person
JOIN casting
ON actor.id_actor = casting.id_actor
WHERE casting.id_movie = 1;