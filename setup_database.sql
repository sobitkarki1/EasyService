CREATE DATABASE IF NOT EXISTS easyservice;

USE easyservice;

CREATE TABLE IF NOT EXISTS users (
    userid INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
    phone_number VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    signed_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS service_category (
	category_id INT PRIMARY KEY AUTO_INCREMENT,
	category_name VARCHAR (255) UNIQUE
);

