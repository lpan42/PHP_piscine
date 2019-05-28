SELECT `title`, `summary` FROM film
   WHERE `summary` LIKE LOWER('%Vincent%')
   ORDER BY `id_film` ASC;