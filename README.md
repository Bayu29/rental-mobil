# plikasi rental mobil

## Database Version
-Maria DB v10.4.19
-PHP v8.1.5
-Framework Laravel v9.19


# Data login Aplikasi 

## Data Login Superadmin
Email
```markdown
superadmin@gmail.com
```
Password
```markdown
admin
```

## Data Login Admin
Email
```markdown
admin@gmail.com
```

Password
```markdown
admin
```

# Panduan Instalasi Aplikasi pada localhost

1. Buat database dengan nama rental-mobil
2. Buka file .env dan masukkan ke nama database, username, dan password ke .env seperti berikut

```markdown
DB_DATABASE=rental-mobil
DB_USERNAME=root
DB_PASSWORD=
```

3. Jalankan command berikut
```markdown
php artisan optimize
```

4. Kemudian jalankan command berikut
```markdown
php artisan migrate:fresh --seed
```

5. setelah database terbuat dengan perintah diatas maka selanjutnya jalankan aplikasi dengan command berikut
```markdown
php artisan serve
```
6. Setelah itu akses ```markdown http://localhost:8000 ```

# Panduan penggunaan Aplikasi

### Peminjaman Mobil
1. Login ke Aplikasi yang sudah diinstal dengan menggunakan email dan password yang tertera diatas
2. Buat Master Data untuk Driver dan Mobil yang akan digunakan untuk transaksi peminjaman mobil
3. Masuk Ke menu Master Data dan Pilih Menu Mobil
4. Pada halaman mobil klik tombol create dan isi form yang tersedia setelah itu klik tombol simpan
5. selanjutnya Buat master data untuk driver
6. Masuk ke menu Driver pada list menu Master data
7. selanjutnya klik tombol create untuk membuat data driver yang baru
8. Setelah semua master data telah dibuat selanjutnya buat Transaksi peminjaman Mobil pada halaman transaksi
9. untuk itu silahkan klik menu Transaksi pada sidebar
10. klik tombol create untuk membuat transaksi peminjaman mobil yang baru
11. isi semua form yang tersedia selanjutnya akan diarahkan ke form update transaksi untuk mengubah status persetujuan peminjaman
12. perlu diketahui untuk status persetujuan harus 2 kali dan untuk persetujuan ke 2 sendiri hanya dapat dilakukan oleh user Super Admin
13. apabila sudah memilih status persetujuan maka selanjutnya klik simpan

### Buat laporan per bulan
1. Login ke Aplikasi yang sudah diinstal dengan menggunakan email dan password yang tertera diatas
2. Pilih Menu Transaction Report 
3. Masukkan Periode Tanggal transaksi yang ingin di download 
4. setelah itu klik tombol download

### Fitur Aplikasi
1. Super Admin bisa membuat user apabila pada instansi tersebut ada beberapa karyawan dan setiap karyawan ingin menggunakan akun sendiri
2. terdapat fitur log sistem untuk memantau setiap perubahan sistem dilengkapi dengan nama user yang melakukan perubahan



   