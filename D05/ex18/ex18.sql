SELECT `name` FROM distrib 
WHERE `id_distrib` IN (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90) 
AND UPPER(`name`) LIKE "%Y%Y%" 
LIMIT 2, 5;