<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project SI-KP
SIKP atau Sistem Informasi Kerja Praktik merupakan sebuah sistem informasi untuk melakukan semua keperluan terkait Kerja Praktik pada Departemen Teknik Komputer. Sistem ini dibangun dengan menggunakan framework laravel. 

Pada repository ini terdapat beberapa branch yang perlu diperhatikan.
- [main] = berfungsi sebagai branch production. Branch ini digunakan apabila fitur sudah selesai di develop dan bebas dari bug. 
- [development] = sesuai namanya, branch ini berfungsi sebagai tempat para pengembang untuk menggabungkan semua fitur yang telah dikembangkan oleh masing-masing pengembang. Apabila fitur yang dikerjakan sudah selesai dan bebas dari bug maka dapat dilakukan open pull request ke branch main untuk dimasukkan ke production.
- [akbar, pajil] = branch untuk masing-masing pengembang. apabila sudah selesai mengembangkan fitur atau apapun dapat melakukan pull request ke development dulu dan direview codenya. branch ini dapat disesuaikan sesuai dengan jumlah pengembangnya. Mis: ada pengembang namanya asep, bisa dibuat dulu branch asep dan melakukan pull request dari branch development
- [drive] = branch yang berfungsi untuk melakukan pengembangan integrasi SIKP dengan google drive api. Fitur ini masih dalam tahap pengembangan. Jadi apabila ada pengembang yang ingin melanjutkan fitur ini, maka branch ini wajib di pull request setelah melakukan pull request branch development (tetap membuat branch baru bagi pengembang baru)


## Setup Project

1. Clone dulu projectnya
2. Buat branch baru (bagi pengembang baru)
3. Melakukan pull dari branch development
5. Jalankan php artisan key:generate
6. Jalankan php artisan migrate:fresh
7. Jalankan php artisan db:seed
8. Jalankan php artisan serve

Conditional
1. Apabila ingin melakukan pengintegrasian fitur gdrive maka setelah pull dari branch development dapat melakukan pull dari branch drive

## Another Info

Proyek ini dibangun dengan menggunakan laravel 8. Jadi pastikan sudah menyesuaikan versi laravelnya.

Untuk pengembangan drive, dapat merujuk pada video tutorial youtube berikut: <a href="https://www.youtube.com/watch?v=sKqMHFHZuKU">Tutorial Integrasi Drive API</a>. Namun terdapat beberapa error lewat apinya.
