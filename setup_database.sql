CREATE DATABASE IF NOT EXISTS easyservice;

USE easyservice;

CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
    phone_number VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    signed_up TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS service_category (
	category_id INT PRIMARY KEY AUTO_INCREMENT,
	category_name VARCHAR (255) UNIQUE
);

-- Populating service_category table with 3 entries

INSERT INTO service_category (category_name) VALUES ('plumber');
INSERT INTO service_category (category_name) VALUES ('electrician');
INSERT INTO service_category (category_name) VALUES ('painter');

CREATE TABLE IF NOT EXISTS service (
  service_id INT AUTO_INCREMENT PRIMARY KEY,
  service_name VARCHAR(100),
  description TEXT,
  category_id INT,
  user_id INT,
  FOREIGN KEY (category_id) REFERENCES service_category (category_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS service_provider (
  provider_id INT AUTO_INCREMENT PRIMARY KEY,
  phone VARCHAR(20),
  email VARCHAR(100),
  provider_name VARCHAR(100),
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS booking (
	booking_id INT AUTO_INCREMENT PRIMARY KEY,
	booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	booking_status INT,
	service_id INT,
    FOREIGN KEY (service_id) REFERENCES service (service_id)
	);
	
CREATE TABLE IF NOT EXISTS review (
	review_id INT AUTO_INCREMENT PRIMARY KEY,
	review_comment VARCHAR(255),
	review_rating INT,
	service_id INT,
    FOREIGN KEY (service_id) REFERENCES service (service_id)
	)
	
	
	
	
    



