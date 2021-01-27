
DROP TABLE IF EXISTS book ;

CREATE TABLE book (Code_book int AUTO_INCREMENT NOT NULL,
book_Name VARCHAR(255),
book_Editor VARCHAR(255),
book_Publication_date DATE,
book_Price FLOAT,
PRIMARY KEY (Code_book) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS author ;

CREATE TABLE author (Code_author int AUTO_INCREMENT NOT NULL,
author_First_name VARCHAR(255),
author_Last_name VARCHAR(255),
author_Stage_name VARCHAR(255),
author_Born_date DATE,
PRIMARY KEY (Code_author) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS written_by ;

CREATE TABLE written_by (Code_book int AUTO_INCREMENT NOT NULL,
Code_author int NOT NULL,
PRIMARY KEY (Code_book, Code_author) ) ENGINE=InnoDB;
