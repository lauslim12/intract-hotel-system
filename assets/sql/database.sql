DROP DATABASE IF EXISTS intractive
CREATE DATABASE IF NOT EXISTS intractive
USE intractive

CREATE DATABASE users (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  first_name VARCHAR(25),
  last_name VARCHAR(25),
  username VARCHAR(100) UNIQUE,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  birthday DATE,
  gender VARCHAR(2),
  signup_date DATE,
  profile_pic VARCHAR(255),
  privilege_level INT,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE DATABASE hotels (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  name VARCHAR(50),
  location VARCHAR(50),
  description VARCHAR(50),
  rooms INT,
  picture VARCHAR(255),
  rating FLOAT,
  price INT,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE DATABASE orders (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  user_id INT,
  hotel_id INT,
  price INT,
  PRIMARY KEY (id),
  FOREIGN KEY user_id REFERENCES users(id),
  FOREIGN KEY hotel_id REFERENCES hotels(id)
)
ENGINE = InnoDB;

INSERT INTO hotels VALUES
(1, 'Atalanta Greek Hotel', 'Arcadia, Greece', 'Hotel that lives for its customers!', 10, '', 5, 100000),
(2, 'Ishtar Babylonian Hotel', 'Mt. Ebih, Mesopotamia', 'Hotel led by Goddess Ishtar herself!', 25, '', 4.5, 250000);