SELECT film.`id_genre`,
        genre.`name` AS `name_genre`,
        film.`id_distrib` AS `id_distrib`,
        distrib.`name` AS `name_distrib`,
        film.title AS `title_film`
        FROM film
JOIN distrib ON film.`id_distrib` = distrib.`id_distrib`
JOIN genre ON film.`id_genre` = genre.`id_genre`
WHERE `id_genre` BE