CREATE DATABASE tracker;

use tracker;

CREATE TABLE entries (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	planttype VARCHAR(30) NOT NULL,
	height VARCHAR(50) NOT NULL,
	watered VARCHAR(30),
    notes VARCHAR(30),
	date TIMESTAMP
);