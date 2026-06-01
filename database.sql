CREATE DATABASE IF NOT EXISTS db_jakabaring;
USE db_jakabaring;

-- ==========================
-- TABEL USERS
-- ==========================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    no_hp VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','pelanggan') NOT NULL
);

-- ==========================
-- TABEL LAPANGAN
-- ==========================

CREATE TABLE lapangan (
    id_lapangan INT AUTO_INCREMENT PRIMARY KEY,
    nama_lapangan VARCHAR(100) NOT NULL,
    jenis_olahraga VARCHAR(50) NOT NULL,
    harga_per_jam INT NOT NULL,
    foto VARCHAR(255),
    status ENUM('Aktif','Nonaktif') DEFAULT 'Aktif'
);

-- ==========================
-- TABEL BOOKING
-- ==========================

CREATE TABLE booking (
    id_booking INT AUTO_INCREMENT PRIMARY KEY,
    id INT NOT NULL,
    id_lapangan INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    durasi INT NOT NULL,
    total_harga INT NOT NULL,
    status ENUM(
        'Pending',
        'Dibayar',
        'Lunas',
        'Ditolak'
    ) DEFAULT 'Pending',
    FOREIGN KEY (id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    FOREIGN KEY (id_lapangan)
        REFERENCES lapangan(id_lapangan)
        ON DELETE CASCADE
);

-- ==========================
-- TABEL PEMBAYARAN
-- ==========================

CREATE TABLE pembayaran (
    id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,

    id_booking INT NOT NULL,

    tanggal_bayar DATETIME,

    bukti_bayar VARCHAR(255),

    status_verifikasi ENUM(
        'Pending',
        'Diterima',
        'Ditolak'
    ) DEFAULT 'Pending',

    FOREIGN KEY (id_booking)
        REFERENCES booking(id_booking)
        ON DELETE CASCADE
);

-- ==========================
-- DATA ADMIN
-- ==========================

INSERT INTO users
(
nama,
email,
no_hp,
password,
role
)
VALUES
(
'Administrator',
'admin@gmail.com',
'08123456789',
MD5('admin123'),
'admin'
);

-- ==========================
-- DATA LAPANGAN
-- ==========================

INSERT INTO lapangan
(
nama_lapangan,
jenis_olahraga,
harga_per_jam,
foto,
status
)
VALUES
('Futsal A','Futsal',150000,'futsal.jpg','Aktif'),
('Futsal B','Futsal',150000,'futsal2.jpg','Aktif'),
('Badminton Court 1','Badminton',75000,'badminton.jpg','Aktif'),
('Badminton Court 2','Badminton',75000,'badminton2.jpg','Aktif'),
('Basket Indoor','Basket',200000,'basket.jpg','Aktif'),
('Tennis Court','Tennis',100000,'tennis.jpg','Aktif');
select*from users;