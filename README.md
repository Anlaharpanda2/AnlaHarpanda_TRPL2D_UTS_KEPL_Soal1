# Refaktoring Kode Movie

![Hasil Tampilan](Hasil.png)

Nama  : Anla Harpanda
Kelas : TRPL 2D
NIM   : 2311083015

Pada proyek ini, saya telah berhasil melakukan refaktoring pada kode aplikasi Movie yang melibatkan beberapa aspek, di antaranya:

- **Controller**: Semua kode pada controller Movie sudah dipersingkat dan disusun lebih efisien dengan menghilangkan komentar yang tidak perlu. Nama controller kini menjadi `AnlaMovingController.php`.
- **Routes**: Rute-rute untuk halaman-halaman yang berkaitan dengan Movie juga sudah diubah untuk mencerminkan controller yang baru. 
- **Views**: Semua tampilan (view) yang berkaitan dengan Movie sudah dipersingkat dan disesuaikan dengan controller baru.

Aplikasi ini kini memiliki fungsi-fungsi utama sebagai berikut:

1. **Menampilkan Data Movie**: Pada halaman utama, pengguna dapat melihat daftar film lengkap dengan kategori, tahun, dan pemain.
2. **Detail Movie**: Pengguna dapat melihat informasi lebih lanjut mengenai film, termasuk gambar sampul dan sinopsis.
3. **Menambah dan Mengedit Movie**: Pengguna dapat menambah film baru serta mengedit film yang sudah ada melalui form input yang telah disederhanakan.
4. **Menghapus Movie**: Pengguna dapat menghapus film yang ada dengan konfirmasi terlebih dahulu.

## Langkah Penggunaan

1. Clone atau download repository ini.
2. Install semua dependensi menggunakan perintah `composer install`.
3. Jalankan migrasi database dengan perintah `php artisan migrate`.
4. Jalankan aplikasi dengan perintah `php artisan serve`.
5. Akses aplikasi di browser pada `http://localhost:8000`.

Aplikasi ini menggunakan Laravel sebagai backend dan Bootstrap untuk tampilan antarmuka. Semua file gambar yang terkait dengan film disimpan dalam folder `public/images`.

Terima kasih telah memeriksa proyek ini!
