Steps

1. Baseline check project auth saat ini.
Catat kondisi awal di web.php, welcome.blade.php, User.php, DatabaseSeeder.php agar jelas perubahan sebelum/sesudah Breeze.

2. Install dan generate Breeze Blade. Depends on 1.
Jalankan install package, generate scaffold Breeze, dan setup dependency frontend supaya halaman login siap dipakai.

3. Tambahkan penanda admin pada user. Depends on 2.
Buat migration baru di folder migrations untuk kolom is_admin default false, lalu update User.php dan UserFactory.php agar mendukung admin/non-admin.

4. Tetapkan akun admin dari seeder. Depends on 3.
Update DatabaseSeeder.php supaya user admin default memiliki is_admin true.

5. Nonaktifkan register publik. Depends on 2.
Matikan route register dan entry UI register pada file auth yang di-generate Breeze, supaya sistem sesuai kebutuhan admin-only.

6. Tambahkan middleware admin. Depends on 3 and 5.
Buat middleware cek user login + is_admin, daftarkan alias middleware di app.php, lalu terapkan di route grup admin pada web.php.

7. Pastikan alur redirect pasca-login benar. Depends on 6.
Admin berhasil ke dashboard admin, non-admin ditolak/redirect aman.

8. Catatan belajar per langkah. Parallel with 3-7.
Di setiap langkah, pahami konsep inti: guard, session auth, middleware, dan proteksi route.