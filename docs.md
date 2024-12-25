# ROUTING
Mendefinisikan halaman berdasarkan rute untuk menghasilkan fungsi yang diperluas untuk membangun data objek dan halaman terstrutur.

## Persiapan
### Instalasi
Menambahkan dependency di dalam file composer.json: _“haschamedia/routing: “dev-main”_, atau, gunakan perintah CLI: _composer require haschamedia/routing_.

### Kelas Utama
Membuat kelas daftar halaman: _php artisan routing:data-install_, ini akan menghasilkan file Router.php dan PageableData.php sebagai kelas utama di dalam direktori app/Routing.

## FUNGSI
### Fungsi Utama Kelas Router
+ ``Router::data()`` menampilkan semua data rute (array).
+ route() method berguna untuk mengambil nama rute.
+ url(params = []) method, membuat url lengkap berdasarkan rute.
+ pageName() method, mendapatkan nama halaman.
+ pageTitle() method, mendapatkan judul halaman.

### Router Instance
``Router::on(routeName)`` digunakan untuk mengambil instance Router berdasarkan nama rute atau halaman saat ini.