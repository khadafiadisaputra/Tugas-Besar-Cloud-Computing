CREATE DATABASE IF NOT EXISTS cloud_project;
USE cloud_project;

DROP TABLE IF EXISTS anggota;
CREATE TABLE anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(30) NOT NULL,
    kelas VARCHAR(50) NOT NULL,
    peran VARCHAR(100) DEFAULT 'Anggota',
    deskripsi TEXT,
    foto VARCHAR(255) NOT NULL
);

INSERT INTO anggota (nama, nim, kelas, peran, deskripsi, foto) VALUES
('Rakyan Adhitya Nugroho', 'ISI_NIM_RAKYAN', 'BBK3CAB3', 'Anggota', 'Bertanggung jawab membantu implementasi website, dokumentasi, dan pengujian sistem Komputasi Awan.', 'rakyan.jpg'),
('Muhammad Aditya Djalil', '102022300225', 'BBK3CAB3', 'Anggota', 'Bertanggung jawab membantu pengembangan website, database, dan pengujian fitur utama.', 'aditya.jpg'),
('Kirana Amelia Maharani', 'ISI_NIM_KIRANA', 'BBK3CAB3', 'Anggota', 'Bertanggung jawab membantu penyusunan data anggota dan dokumentasi proyek.', 'kirana.jpg'),
('Muhammad Khadafi Adi Saputra', 'ISI_NIM_KHADAFI', 'BBK3CAB3', 'Anggota', 'Bertanggung jawab membantu konfigurasi, pengujian instance, dan load balancer.', 'khadafi.jpg');

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', '123');
