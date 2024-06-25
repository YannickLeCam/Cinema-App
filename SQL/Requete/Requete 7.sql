SELECT person.* 
FROM person
JOIN actor
ON actor.id_person = person.id_person
JOIN director
ON director.id_person = person.id_person
WHERE actor.id_person = director.id_person