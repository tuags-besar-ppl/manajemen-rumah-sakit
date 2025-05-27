cara install project:
composer install
npm install
lalu copy file .env dan ubah untuk SESSION_DRIVER jadi file (karena file auth tidak ada session di DB validasi di file)
jalan kan php artisan migrate untuk migration database
jalankan php artisan key:generate untuk app_key
jalankan php artisan db:seed UserSeeder (untuk data User login)
lalu jalan php artisan serve dan npm run dev (untuk library tailwindcss)
