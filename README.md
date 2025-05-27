cara install project:
1. composer install
2. npm install
3. lalu copy file .env dan ubah untuk SESSION_DRIVER jadi file (karena file auth tidak ada session di DB validasi di file)
4. jalan kan php artisan migrate untuk migration database
5. jalankan php artisan key:generate untuk app_key
6. jalankan php artisan db:seed UserSeeder (untuk data User login)
7. lalu jalankan php artisan serve dan npm run dev (untuk library tailwindcss)
