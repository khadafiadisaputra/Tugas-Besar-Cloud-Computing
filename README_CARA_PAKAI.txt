CARA PAKAI CLOUD PROJECT ADMIN EDIT

1. Backup folder project lama kamu dulu.
2. Extract zip ini.
3. Rename folder hasil extract menjadi: cloud-project
4. Taruh folder cloud-project ke:
   C:\xampp\htdocs\cloud-project

5. Copy foto anggota ke folder:
   C:\xampp\htdocs\cloud-project\images
   Nama file foto yang dibutuhkan:
   - rakyan.jpg
   - aditya.jpg
   - kirana.jpg
   - khadafi.jpg

6. Nyalakan XAMPP:
   - Apache
   - MySQL

7. Buka phpMyAdmin:
   http://localhost/phpmyadmin

8. Import file SQL:
   C:\xampp\htdocs\cloud-project\database\anggota.sql

9. Buka website:
   http://localhost/cloud-project/index.php

10. Login admin:
    http://localhost/cloud-project/login.html
    Username: admin
    Password: 123

11. Setelah login, balik ke index.php. Tombol Edit Data akan muncul di setiap kartu anggota.

12. Untuk Load Balancer:
    - Pada instance 1, file instance.txt isi angka 1
    - Pada instance 2, file instance.txt isi angka 2
    Atau gunakan environment variable SERVER_INSTANCE=1 / SERVER_INSTANCE=2.

CATATAN:
- NIM yang masih ISI_NIM_RAKYAN / ISI_NIM_KIRANA / ISI_NIM_KHADAFI bisa diganti dari tombol Edit Data setelah login admin.
- Jika tampilan belum berubah, tekan Ctrl + F5 di browser.
