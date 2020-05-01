DROP DATABASE IF EXISTS intractive;
CREATE DATABASE IF NOT EXISTS intractive;
USE intractive;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  first_name VARCHAR(25),
  last_name VARCHAR(25),
  username VARCHAR(100) UNIQUE,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  birthdate DATE,
  gender VARCHAR(2),
  signup_date DATE,
  profile_pic VARCHAR(255),
  privilege_level INT,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE hotels (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  name VARCHAR(50),
  location VARCHAR(50),
  headline TEXT,
  description TEXT,
  picture VARCHAR(255),
  rating FLOAT,
  star INT,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE rooms (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  hotel_id INT NOT NULL,
  room_name VARCHAR(50),
  room_count INT,
  price INT,
  PRIMARY KEY (id),
  FOREIGN KEY (hotel_id) REFERENCES hotels(id)
)
ENGINE = InnoDB;

CREATE TABLE orders (
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  user_id INT,
  hotel_id INT,
  room_id INT,
  num_rooms INT,
  duration INT,
  price INT,
  finished BOOLEAN,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (hotel_id) REFERENCES hotels(id),
  FOREIGN KEY (room_id) REFERENCES rooms(id)
) 
ENGINE = InnoDB;

INSERT INTO hotels VALUES
  (1,
  'InterContinental Bordeaux Le Grand Hotel',
  'Bordeaux, France',
  'Stay in the center of Bordeaux!',
  'Directly opposite the Grand Théâtre, this 5-star hotel is in the heart of the historic center of Bordeaux. It offers a concierge service, a babysitting service upon request, gourmet restaurants and a 3281 ft² spa and wellness center. New Bordeaux Stadium is 3.7 mi away.',
  '/assets/images/hotel_pics/bordeaux.jpg',
  9,
  5
  ),
  (2, 
  'Parilio', 
  'Kolympithres, Greece', 
  'Get the celebrity treatment with world-class service at Parilio, a member of Design Hotels!', 
  'Located in Kolympithres, a 12-minute walk from Kolymbithres beach, Parilio, a Member of Design Hotels has accommodations with a restaurant, free private parking, a seasonal outdoor swimming pool and a fitness center. Among the facilities at this property are a 24-hour front desk and room service, along with free WiFi throughout the property. The property offers bike rental and features a garden and sun terrace.',
  '/assets/images/hotel_pics/parilio.jpg',
  9.5,
  5);

INSERT INTO rooms VALUES 
(1, 1, 'Presidental Suite', 5, 5000000),
(2, 1, 'High-Roller Suite', 15, 3750000),
(3, 1, 'Deluxe Suite', 10, 2500000),
(4, 1, 'Twin Room', 20, 1250000),
(5, 1, 'Single Room', 30, 750000),
(6, 2, 'Imperial Villa', 5, 4500000),
(7, 2, 'Bungalow', 15, 3500000),
(8, 2, 'Deluxe Suite', 20, 2000000),
(9, 2, 'Twin Bed', 10, 1250000),
(10, 2, 'Junior Class', 30, 500000);