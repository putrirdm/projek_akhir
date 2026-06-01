
CREATE DATABASE IF NOT EXISTS db_jakabaring;
USE db_jakabaring;
CREATE TABLE users(id_user INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(100),email VARCHAR(100) UNIQUE,password VARCHAR(255),role ENUM('admin','pelanggan'));
CREATE TABLE lapangan(id_lapangan INT AUTO_INCREMENT PRIMARY KEY,nama_lapangan VARCHAR(100),harga_per_jam INT);
CREATE TABLE booking(id_booking INT AUTO_INCREMENT PRIMARY KEY,id_user INT,id_lapangan INT,tanggal DATE,jam_mulai TIME,jam_selesai TIME,status VARCHAR(20));
INSERT INTO users(nama,email,password,role) VALUES('Administrator','admin@gmail.com',MD5('admin123'),'admin');
