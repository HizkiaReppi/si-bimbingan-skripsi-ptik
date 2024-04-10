# Sistem Informasi Bimbingan Skripsi

## Deskripsi

Sistem Informasi Bimbingan Skripsi adalah sebuah sistem informasi yang digunakan untuk mempermudah proses bimbingan skripsi antara dosen pembimbing dan mahasiswa. Sistem ini memungkinkan mahasiswa untuk mengajukan jadwal bimbingan skripsi, melihat jadwal bimbingan skripsi, dan melihat catatan bimbingan skripsi. Sistem ini juga memungkinkan dosen pembimbing untuk menyetujui atau menolak jadwal bimbingan skripsi yang diajukan oleh mahasiswa, memberikan catatan bimbingan skripsi, dan melihat catatan bimbingan skripsi.

## Fitur

1. Mahasiswa
    - Mengajukan jadwal bimbingan skripsi
    - Mengubah jadwal bimbingan skripsi
    - Melihat jadwal bimbingan skripsi
    - Melihat catatan hasil review skripsi
    - Mengajukan permintaan ujian hasil (proses pengembangan)
    - Cetak surat persetujuan ujian (proses pengembangan)
2. Dosen Pembimbing
    - Menyetujui atau menolak jadwal bimbingan skripsi
    - Memberikan catatan dan upload file hasil review skripsi
    - Melihat catatan bimbingan skripsi
    - Menyetujui atau menolak permintaan ujian hasil (proses pengembangan)
3. Ketua Jurusan
    - Melihat aktivitas bimbingan skripsi
    - Menyetujui atau menolak permintaan ujian hasil (proses pengembangan)
4. Admin
    - Manajemen Dosen
    - Manajemen Mahasiswa
    - Manajemen Ketua Jurusan
    - Manajemen Bimbingan (proses pengembangan)
    - Manajemen Ujian Hasil (proses pengembangan)
5. Lainnya
    - Lupa & Reset Password (proses pengembangan)
    - Edit Profile (proses pengembangan)

## Cara Penggunaan

1. Clone repository

```bash
$ git clone https://github.com/HizkiaReppi/sistem-informasi-bimbingan-skripsi.git
```

2. Buka terminal dan arahkan ke direktori repository

```bash
$ cd sistem-informasi-bimbingan-skripsi
```

3. Install dependencies php dengan perintah `composer install`

```bash
$ composer install
```

4. Install dependencies nodejs dengan perintah `npm install`

```bash
$ npm install
```

5. Copy file `.env.example` menjadi `.env`

```bash
$ cp .env.example .env

atau

$ copy .env.example .env
```

6. Generate key aplikasi dengan perintah `php artisan key:generate`

```bash
$ php artisan key:generate
```

7. Buat database baru dan sesuaikan konfigurasi database pada file `.env`

8. Migrasi database dengan perintah `php artisan migrate` atau `php artisan migrate --seed` jika ingin mengisi data awal.

    _Catatan: ubah file `database/seeders/DatabaseSeeder.php` terlebih dahulu jika diperlukan, disarankan mengubah data admin yang akan digunakan untuk login termasuk passwordnya_

```bash
$ php artisan migrate

atau

$ php artisan migrate --seed
```

9. Jalankan server dengan perintah `php artisan serve`

```bash
$ php artisan serve
```

10. Jalankan vite dengan perintah `npm run dev`

```bash
$ npm run dev
```

11. Buka browser dan akses `http://localhost:8000`

_***Catatan Kecil: Banyak Aset Bawaan Dari Template Dashboard dan Breeze Yang Tidak Digunakan Tapi Masih Tersimpan, Akan Diperbaiki Semua Saat MVP Selesai.***_

Create By Hizkia Reppi
