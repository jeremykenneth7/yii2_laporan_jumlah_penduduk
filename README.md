# Yii2 Laporan Jumlah Penduduk

Ini adalah proyek aplikasi Yii2 untuk mengelola laporan jumlah penduduk berdasarkan provinsi dan kabupaten.

## Fitur Utama

- Manajemen data provinsi dan kabupaten.
- Pencatatan data penduduk berdasarkan Provinsi dan Kabupaten.
- Pembuatan laporan berdasarkan data yang tersedia.

### Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum menginstal proyek:

- PHP versi 7.4 atau yang lebih baru.
- MySQL atau database lain yang didukung oleh Yii2.
- Composer untuk manajemen paket PHP.

### Langkah-langkah Instalasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/jeremykenneth7/yii2_laporan_jumlah_penduduk.git

   ```

2. **Instal Dependensi**

   Masuk ke direktori proyek dan jalankan perintah berikut untuk menginstal dependensi PHP menggunakan Composer.

   ```bash
   cd yii2_laporan_jumlah_penduduk
   composer install

   ```

3. **Konfigurasi .env**

   ```bash
   cp .env.default .env

   ```

4. **Konfigurasi Database**

   Import database laporan_penduduk.sql

5. **Jalankan Aplikasi**

   ```bash
   php yii serve
   ```
