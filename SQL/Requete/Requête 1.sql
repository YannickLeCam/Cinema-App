   SELECT movie.name,date_release ,floor(duration/60) AS "heure", (duration%60) AS "minute", person.name , person.firstname
	FROM movie,director,person
	WHERE movie.id_director = director.id_director AND director.id_person = person.id_person;


