CREATE TABLE ft_minishop.categories
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(200) NOT NULL
);
CREATE UNIQUE INDEX categories_id_uindex ON ft_minishop.categories (id);
INSERT INTO ft_minishop.categories (id, name) VALUES (1, 'Informatique');
INSERT INTO ft_minishop.categories (id, name) VALUES (2, 'Art');
INSERT INTO ft_minishop.categories (id, name) VALUES (3, 'Humains');
CREATE TABLE ft_minishop.order_products
(
    order_id int(11) NOT NULL,
    product_id int(11) NOT NULL,
    amount int(11) DEFAULT '1' NOT NULL
);
CREATE TABLE ft_minishop.orders
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user int(11) NOT NULL,
    date int(22) DEFAULT '0' NOT NULL
);
CREATE UNIQUE INDEX orders_id_uindex ON ft_minishop.orders (id);
CREATE TABLE ft_minishop.product_link
(
    product_id int(11) NOT NULL,
    category_id int(11) NOT NULL
);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (7, 1);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (9, 1);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (10, 1);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (4, 2);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (8, 2);
INSERT INTO ft_minishop.product_link (product_id, category_id) VALUES (1, 3);
create table products
(
    id    float auto_increment,
    name  varchar(100) not null,
    price float        not null,
    stock int          not null,
    constraint products_id_uindex
        unique (id)
);
CREATE UNIQUE INDEX products_id_uindex ON ft_minishop.products (id);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (1, 'dde-jesu', 1000000, 1);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (2, 'extincteur', 35, 6);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (3, 'Pchit Pchit', 3.9, 18);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (4, 'Hello Nicolas', 500, 3);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (5, 'Chaise (Sale)', 50, 900);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (6, 'Poubelle', 25.5, 18);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (7, 'Clavier Apple', 25, 950);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (8, 'OBEY', 500.05, 3);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (9, 'Souris appeul (Un peu usee)', 0.01, 300);
INSERT INTO ft_minishop.products (id, name, price, stock) VALUES (10, 'Tapis de souris', 15, 900);
CREATE TABLE ft_minishop.users
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login varchar(20) NOT NULL,
    passwd varchar(128) NOT NULL,
    rank enum('user', 'admin') DEFAULT 'user'
);
CREATE UNIQUE INDEX users_login_uindex ON ft_minishop.users (login);
CREATE INDEX id ON ft_minishop.users (id);
CREATE INDEX users_id_index ON ft_minishop.users (id);
