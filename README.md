## INSTALL

INSTALL VENDOR VIA COMPOSER
```
composer install
```

`buat` database baru

buat file `.env` dan sesuaikan pada bagian `database`

CONTOH KONFIGURASI DATABASE:
```
DB_DATABASE=sakti
DB_USERNAME=root
DB_PASSWORD=
```

MIGRASI DATABASE DAN SEEDER
```
php artisan migrate:fresh --seed
```

MENGATASI FILE HASIL UPLOAD TIDAK TERBACA KETIKA DIPANGGIL VIA URL
```
php artisan storage:link
```

MENJALANKAN APLIKASI
```
php artisan serve
```
