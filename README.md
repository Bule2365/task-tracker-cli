# Task Tracker CLI

Task Tracker CLI adalah aplikasi sederhana untuk mengelola tugas menggunakan PHP. Aplikasi ini berjalan di Command Line Interface (CLI) dan menyimpan data tugas dalam format JSON.

## Cara Menggunakan

1. **Pastikan PHP Terinstal**  
   Periksa apakah PHP sudah terinstal dengan menjalankan perintah:
   ```bash
   php -v
   ```

2. **Clone Proyek ini**  
   Unduh proyek ini dari GitHub:
   ```bash
   git clone https://github.com/USERNAME/task-tracker-cli.git
   cd task-tracker-cli
   ```

3. **Menjalankan Perintah**  
   Gunakan salah satu perintah berikut untuk mengelola tugas:

   - **Menambahkan tugas baru**  
     ```bash
     php task-cli.php add "Deskripsi tugas"
     ```
     Contoh:  
     ```bash
     php task-cli.php add "Belajar PHP"
     ```

   - **Memperbarui tugas**  
     ```bash
     php task-cli.php update [id] "Deskripsi baru"
     ```
     Contoh:  
     ```bash
     php task-cli.php update 1 "Belajar PHP dan CLI"
     ```

   - **Menghapus tugas**  
     ```bash
     php task-cli.php delete [id]
     ```
     Contoh:  
     ```bash
     php task-cli.php delete 1
     ```

   - **Mengubah status tugas**  
     Tandai tugas sebagai sedang dikerjakan:  
     ```bash
     php task-cli.php mark-in-progress [id]
     ```
     Tandai tugas sebagai selesai:  
     ```bash
     php task-cli.php mark-done [id]
     ```

   - **Melihat daftar tugas**  
     Daftar semua tugas:  
     ```bash
     php task-cli.php list
     ```
     Daftar tugas berdasarkan status (`todo`, `in-progress`, `done`):  
     ```bash
     php task-cli.php list [status]
     ```
     Contoh:  
     ```bash
     php task-cli.php list todo
     ```

## Penyimpanan Data
Semua tugas disimpan dalam file `tasks.json` di direktori proyek. File ini akan dibuat secara otomatis jika belum ada.

## Saran
- Gunakan deskripsi tugas yang jelas agar mudah dipahami.
- Simpan tugas secara rutin untuk menghindari kehilangan data.

---
