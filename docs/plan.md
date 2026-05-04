# Sistem Pencatatan Kantin Kejujuran KOIN

### Penting: Jika ada hal yang masih ambigu silahkan tanyakan dahulu agar kamu tidak mengambil tindakan diluar planning atau terjadi bias dari plan awal yang mungkin kurang jelas.

## Tujuan
Membuat sistem pencatatan yang bisa digunakan dengan mandiri oleh pelanggan dan memberikan admin data penjualan, perhitungan untung/rugi, dan lain lain. Selain itu sistem ini bertujuan sebagai media pembelajaran saya tentang "Pembuatan Sistem Fullstack Dengan Laravel". Saya ingin vibe coding seminimal mungkin.

## Flow Pelanggan 
- Pelanggan membuka website kantin
- Pelanggan memilih menu yang tersedia di web kantin kejujuran
- Pelanggan mengisi data "Nama Pembeli" pada input
- Pelanggan membayar via QRIS/CASH
- Sistem mencatatat transaksi tersebut ke database
- [Kegiatan Fisik] Pelanggan mengambil makanan yang sudah di pilih dari web tadi

## Fitur Dashboard Admin
- Admin bisa login menggunakan akun admin
- Admin bisa melihat riwayat transaksi dan rincian uang masuk
- Admin bisa menambah menu dan melakukan update stock
- Admin bisa mengedit dan menghapus menu
- Saat menambah/update menu admin bisa menaruh harga modal
- Sistem harus bisa menghitung profit
- Data laba, transaksi, dan penambahan barang bisa di filter per hari, minggu, 3 bulan, 1 tahun

## Lain lain
- Item di menu pelanggan bisa dikategorikan berdasarkan "Kategori" yang tersedia. Kategori akan ditambahkan oleh admin di dashboard, dan akan dikaitkan dengan item menu saat pembuatan atau pengeditan menu. Menu boleh tidak memiliki kategori.

---

## Database
DBMS: SQLite

### Tabel "user"
- id >> PRIMARY KEY INTEGER AUTO INCREMENT
- name >> VARCHAR
- email >> VARCHAR
- password >> VARCHAR
- created_at >> DATETIME
- updated_at >> DATETIME

### Tabel "category"
- id >> PRIMARY KEY INTEGER AUTO INCREMENT
- name >> VARCHAR
- deleted_at >> DATETIME
- created_at >> DATETIME
- updated_at >> DATETIME

### Tabel "menu"
- id >> PRIMARY KEY INTEGER AUTO INCREMENT
- name >> VARCHAR
- cost_price INTEGER
- selling_price INTEGER
- stock INTEGER
- is_active BOOLEAN
- image_path TEXT
- category_id >> FOREIGN KEY to "category" INTEGER 
- created_at >> DATETIME
- updated_at >> DATETIME
- deleted_at >> DATETIME

### Tabel "transactions"
- id >> PRIMARY KEY INTEGER AUTO INCREMENT
- buyer_name >> VARCHAR
- payment_method >> enum('CASH', 'QRIS')
- total_amount >> INTEGER
- total_profit >> INTEGER
- created_at >> DATETIME
- updated_at >> DATETIME

### Tabel "transaction_items"
- id >> PRIMARY KEY INTEGER AUTO INCREMENT
- transaction_id >> FOREIGN KEY to "transactions" INTEGER 
- menu_id >> FOREIGN KEY to "menu" INTEGER 
- quantity >> INTEGER
- cost_price_snapshot >> INTEGER
- profit INTEGER

--- 

## Frontend
Laravel Blade, Tailwind, Alpine.js (Saya belum tahu Alpine.js juga)
Style: Clean, Minimalist, Light Theme Only, Primary Color Red #6c1517, Accent Color #d9a514, Dark Color #300d08, Light Color #ffffff or #faf1dc (gunakan secara bergantian, tapi saya ingin warna dasarnya adalah putih).

---

Catatan: Saya ingin belajar seluruh laravel, jadi pandu saya dengan detail

--- 

## Tahap Implementasi (Sambil Mengajari Saya)
### Fase 1: Database & Model (Membangun Fondasi)
  [ ] Belajar membuat Migration untuk mendefinisikan tabel SQLite.

  [ ] Belajar membuat Seeder & Factory.

  [ ] Belajar Eloquent Relationships (hasMany, belongsTo) antara User, Category, Menu, dan Transaction.

### Fase 2: Autentikasi Admin
  [ ] Belajar menggunakan Laravel Breeze untuk login Admin, atau mencoba membuat Custom Auth sendiri untuk pemahaman yang lebih dalam.

### Fase 3: Logika Bisnis & Routing (Controller)
  [ ] Belajar menggunakan Resource Controllers untuk operasi CRUD pada Menu dan Kategori.

  [ ] Belajar menggunakan Form Requests untuk memvalidasi input dari pelanggan (misal: memastikan nama pembeli diisi, metode pembayaran valid).

### Fase 4: Frontend (Blade & Tailwind)
  [ ] Belajar Blade Templating (membuat layout.blade.php utama agar header/footer tidak perlu ditulis berulang kali).

  [ ] Belajar menggunakan Blade Components (misal: membuat komponen <x-card-menu> untuk menampilkan daftar makanan).

---

Setelah membuat planning dengan mode "Planning" kamu akan saya set ke mode "Ask" jadi pastikan kamu sudah menyiapkan cara belajar yang efektif dan mudah dipahami.