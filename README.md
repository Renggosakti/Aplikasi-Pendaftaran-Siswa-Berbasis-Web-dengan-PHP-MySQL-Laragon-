# Aplikasi Pendaftaran Siswa Berbasis Web dengan PHP & MySQL (Laragon)

**Nama:** Arya Rangga Putra Pratama<br>
**NRP:** 5025241072<br>
**Kelas:** Pemrograman Web A<br>
**Dosen Pengampu:** Bapak Fajar

---

## 🚀 Pendahuluan
Aplikasi ini dikembangkan sebagai implementasi dari sistem pendaftaran siswa berbasis web menggunakan bahasa pemrograman PHP dan basis data MySQL.
Proyek dijalankan menggunakan **Laragon** sebagai server lokal untuk mempermudah proses pengembangan dan pengujian.

Tujuan utama proyek ini adalah membangun sistem digital yang memudahkan admin untuk mengelola data calon siswa.
Melalui sistem ini, pihak admin dapat mengelola data siswa secara efisien, menyimpan informasi ke database dengan aman, serta melakukan seluruh proses pendaftaran secara terstruktur.

Selain itu, aplikasi ini juga menjadi sarana pembelajaran bagi pengembang dalam memahami konsep dasar integrasi **PHP (back-end)** dengan **HTML (front-end)**,
serta penerapan sistem **CRUD (Create, Read, Update, Delete)** secara fundamental menggunakan PHP dan MySQL.

## 📝 Deskripsi Sistem
Aplikasi ini dibangun dengan alur multi-halaman (multi-page) yang tradisional dan mudah dipahami, sesuai dengan konsep dasar tutorial PHP. Setiap file memiliki tanggung jawab yang spesifik:

* **`config.php`** – File inti untuk mengatur koneksi ke database MySQL.
* **`index.php`** – Halaman utama atau 'dashboard' yang berfungsi sebagai portal, biasanya berisi menu navigasi ke halaman daftar siswa atau halaman tambah siswa.
* **`form-daftar.php`** – Berisi formulir HTML untuk menginput data calon siswa baru, termasuk form untuk unggah foto.
* **`proses-pendaftaran.php`** – Script PHP yang menerima data (via POST) dari `form-daftar.php`. Script ini memvalidasi data dan menjalankankan query `INSERT` ke database.
* **`list-siswa.php`** – Halaman utama untuk admin. Menampilkan semua data siswa yang tersimpan di database (query `SELECT`) dalam bentuk tabel. Halaman ini juga berisi tombol "Edit" dan "Hapus".
* **`form-edit.php`** – Formulir yang mirip dengan `form-daftar.php`, namun sudah terisi data siswa yang ada (berdasarkan ID) dan berfungsi untuk mengubah data.
* **`proses-edit.php`** – Script PHP yang menerima data dari `form-edit.php` dan menjalankan query `UPDATE` untuk memperbarui data di database.
* **`hapus.php`** – Script PHP sederhana yang menerima ID siswa (via GET) dan menjalankan query `DELETE` untuk menghapus data siswa dari database.
* **`style.css`** – File CSS terpusat untuk mengatur tampilan dan tata letak seluruh halaman web.
* **`uploads/`** – Folder khusus untuk menyimpan file foto siswa yang diunggah.

## ✨ Fitur Utama
Fitur-fitur aplikasi ini difokuskan pada fungsionalitas dasar CRUD yang solid:

* **Fungsionalitas CRUD** – Implementasi penuh **Create** (`proses-pendaftaran.php`), **Read** (`list-siswa.php`), **Update** (`proses-edit.php`), dan **Delete** (`hapus.php`).
* **Upload Foto** – Kemampuan untuk mengunggah file gambar (foto siswa) ke server dan menyimpan nama filenya di database.
* **Validasi Sederhana** – Penerapan validasi input di sisi server (dalam script PHP) untuk memastikan data yang masuk sesuai format.
* **Navigasi Multi-Halaman** – Alur kerja yang jelas antar halaman, memudahkan pemahaman proses request dan response HTTP.
* **Manajemen Data Terpusat** – Seluruh data siswa disimpan dalam database MySQL, memudahkan pengelolaan dan pencarian.

## 🔄 Alur Kerja Sistem
Alur kerja aplikasi mengikuti alur PHP tradisional:

1.  Admin membuka `index.php`, lalu memilih menu "Lihat Daftar Siswa" (ke `list-siswa.php`) atau "Tambah Siswa Baru".
2.  Jika memilih "Tambah Siswa Baru", admin diarahkan ke `form-daftar.php`.
3.  Admin mengisi formulir dan mengklik "Simpan". Data dikirim ke `proses-pendaftaran.php`.
4.  `proses-pendaftaran.php` menyimpan data ke database dan foto ke folder `uploads/`, lalu mengarahkan (redirect) admin kembali ke halaman `list-siswa.php`.
5.  Di `list-siswa.php`, admin dapat melihat data baru.
6.  Untuk mengubah data, admin mengklik tombol "Edit" di samping nama siswa, yang akan mengarah ke `form-edit.php` (dengan membawa ID siswa).
7.  Setelah mengubah data di `form-edit.php`, admin mengklik "Simpan Perubahan". Data dikirim ke `proses-edit.php`, yang akan meng-UPDATE data di database, lalu redirect kembali ke `list-siswa.php`.
8.  Untuk menghapus data, admin mengklik "Hapus", yang akan memanggil `hapus.php` (dengan membawa ID) untuk menghapus data, lalu redirect kembali ke `list-siswa.php`.

## 📂 Struktur Folder Proyek
Struktur file yang dirapikan dan diimprovisasi agar lebih fungsional:

```

📂 pendaftaran-siswa/
├── config.php           (Koneksi database)
├── index.php            (Halaman utama/portal)
├── form-daftar.php      (Formulir tambah siswa)
├── proses-pendaftaran.php (Logika INSERT data)
├── list-siswa.php       (Tabel data siswa - READ)
├── form-edit.php        (Formulir edit siswa - \*improvisasi)
├── proses-edit.php      (Logika UPDATE data)
├── hapus.php            (Logika DELETE data)
├── style.css            (File styling)
├── uploads/             (Folder penyimpanan foto)
│   └── (foto-siswa.jpg)
└── api/                 (Opsional untuk pengembangan API)
├── list.php
├── add.php
├── update.php
└── delete.php

```

## 🛠️ Teknologi yang Digunakan
* **PHP 8** – Bahasa utama untuk pemrosesan logika di sisi server (CRUD).
* **MySQL** – Basis data untuk menyimpan informasi calon siswa.
* **Laragon** – Server lokal (WAMP stack) untuk menjalankan dan menguji aplikasi.
* **HTML5** – Struktur halaman web (formulir, tabel, dll.).
* **CSS3** – Untuk memberikan styling dasar pada halaman.

## 📸 Dokumentasi
Bagian ini disediakan untuk menampilkan tangkapan layar hasil pengujian dan implementasi sistem.

#### Screenshot
* **Halaman Utama (index.php):** *Menampilkan menu navigasi.*
* **Halaman Daftar Siswa (list-siswa.php):** *Tabel dinamis berisi data siswa dari database.*
* **Form Pendaftaran (form-daftar.php):** *Form dengan input teks dan upload foto.*
* **Form Edit (form-edit.php):** *Formulir yang sudah terisi data siswa yang akan diubah.*

## 📎 Link Demo & Source Code
* **Link Demo:** *(masukkan link demo online di sini)*
* **Source Code:** *(Repo ini)*

## 🏁 Kesimpulan
Aplikasi ini berhasil menerapkan konsep dasar dan fundamental dari sistem **CRUD** menggunakan PHP natif dan database MySQL.
Dengan struktur file yang terorganisir berdasarkan fungsinya (memisahkan form, proses, dan tampilan daftar), sistem ini dapat dijadikan **fondasi yang solid** untuk pembelajaran dan pengembangan aplikasi berbasis web yang lebih kompleks di masa depan.
```
