   SELECT movie.name,date_release ,CONCAT(floor(duration/60),' h ' , (duration%60),' min') AS durée, person.name , person.firstname
	FROM movie,director,person
	WHERE movie.id_director = director.id_director AND director.id_person = person.id_person;


