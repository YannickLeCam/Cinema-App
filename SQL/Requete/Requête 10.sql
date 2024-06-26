SELECT genre , COUNT(id_actor)
FROM person
JOIN actor
ON actor.id_person = person.id_person
GROUP BY person.genre;