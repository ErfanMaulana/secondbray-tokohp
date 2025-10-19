# 🛒 Secondbray - E-Commerce HP Second

Website e-commerce untuk menjual HP second berkualitas menggunakan Laravel 12, Tailwind CSS, dan MySQL.

## 🚀 Teknologi

- **Framework**: Laravel 12
- **Database**: MySQL (via Laragon)
- **Styling**: Tailwind CSS
- **Authentication**: Laravel Breeze
- **Template Engine**: Blade

## ✨ Fitur

### 👤 User (Pembeli)
- ✅ Register & Login
- ✅ Lihat daftar produk HP
- ✅ Filter produk berdasarkan merek, harga, dan kondisi
- ✅ Lihat detail produk
- ✅ Tambah ke keranjang
- ✅ Checkout (simulasi)
- ✅ Lihat riwayat pesanan
- ✅ Dark mode toggle

### 🧑‍💼 Admin
- ✅ Login Admin
- ✅ Dashboard dengan statistik
- ✅ CRUD Produk (nama, kategori, harga, deskripsi, stok, gambar)
- ✅ CRUD Kategori (merek HP)
- ✅ Lihat & kelola pesanan user
- ✅ Update status pesanan

## 📊 Struktur Database

```
users (id, name, email, password, role)
categories (id, name, slug)
products (id, category_id, name, slug, price, stock, description, image, condition)
orders (id, user_id, order_number, total_price, status, shipping_address, phone)
order_items (id, order_id, product_id, quantity, price, subtotal)
carts (id, user_id, product_id, quantity)
```

## 📦 Instalasi

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
php artisan key:generate
```

### 3. Konfigurasi Database di `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=secondbray
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database & Seeder (Sudah dijalankan)
Database sudah dibuat dengan data sample!

### 5. Compile Assets
```bash
npm run dev
```

### 6. Jalankan Server
```bash
php artisan serve
```

## 👥 Default Users

### Admin
- Email: `admin@secondbray.com`
- Password: `password`
- Akses: `/admin/dashboard`

### User
- Email: `user@secondbray.com`
- Password: `password`

## 🎯 Cara Menggunakan

### Sebagai User:
1. Register atau login dengan akun user demo
2. Browse produk di halaman Products
3. Gunakan filter untuk mencari produk
4. Klik produk untuk melihat detail
5. Tambahkan ke keranjang
6. Checkout dengan mengisi alamat pengiriman
7. Lihat riwayat pesanan

### Sebagai Admin:
1. Login dengan akun admin
2. Dashboard menampilkan statistik lengkap
3. Kelola produk (tambah, edit, hapus)
4. Kelola kategori merek HP
5. Kelola pesanan dan update status

## 🎨 Fitur Dark Mode

Dark mode sudah terintegrasi! Toggle ada di navbar untuk user dan sidebar untuk admin.

---

Made with ❤️ using Laravel 12 & Tailwind CSS

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
