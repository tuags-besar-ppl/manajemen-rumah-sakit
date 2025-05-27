1. cara install project:
2. composer install
3. npm install
4. lalu copy file .env dan ubah untuk SESSION_DRIVER jadi file (karena file auth tidak ada session di DB validasi di file)
5. jalan kan php artisan migrate untuk migration database
6. jalankan php artisan key:generate untuk app_key
7. jalankan php artisan db:seed UserSeeder (untuk data User login)
8. lalu jalankan php artisan serve dan npm run dev (untuk library tailwindcss)
