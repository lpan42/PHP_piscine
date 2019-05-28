SELECT COUNT(`member_history`.`id_film`) AS 'movies' FROM `member_history`
    WHERE (`member_history`.`date` BETWEEN DATE('2006-10-30') AND DATE('2007-07-27'))
    OR DATE_FORMAT(`member_history`.`date`, '%m-%d') = '12-24';