-- SQL untuk menambahkan kolom video_url, description, dan order ke tabel subcourses
-- Jalankan query ini di phpMyAdmin atau MySQL client

-- Tambah kolom description (setelah title)
ALTER TABLE `subcourses` 
ADD COLUMN `description` TEXT NULL AFTER `title`;

-- Tambah kolom video_url (setelah content)
ALTER TABLE `subcourses` 
ADD COLUMN `video_url` VARCHAR(255) NULL AFTER `content`;

-- Tambah kolom order (setelah video_url)
ALTER TABLE `subcourses` 
ADD COLUMN `order` INT NOT NULL DEFAULT 0 AFTER `video_url`;

-- Verifikasi struktur tabel
DESCRIBE subcourses;
