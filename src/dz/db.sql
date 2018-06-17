CREATE DATABASE `bazaDZ`
CHARACTER SET='utf8mb4' 
COLLATE='utf8mb4_general_ci';

USE `bazaDZ`;
CREATE TABLE users(
    id          int not null AUTO_INCREMENT primary key,
    username    varchar(40) not null unique,
    pass        varchar(256) not null
);