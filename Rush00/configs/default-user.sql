CREATE USER 'site'@'localhost' IDENTIFIED BY 'root00';
GRANT ALL PRIVILEGES ON * . * TO 'site'@'localhost';
FLUSH PRIVILEGES;
CREATE DATABASE ft_minishop;
