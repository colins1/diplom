const mix = require('laravel-mix');

mix.sass('resources/sass/client/styles.scss', 'public/css') // компилирует файл style.scss в файл style.css и помещает его в папку public/css
   .copy('resources/css/client/normalize.css', 'public/css') // копирует файл normalize.css из папки resources/css в папку public/css
   .styles([
       'public/css/client/normalize.css',
       'public/css/client/styles.css'
   ], 'public/css/client/all2.css'); 

mix.sass('resources/sass/admin/styles.scss', 'public/css') // компилирует файл style.scss в файл style.css и помещает его в папку public/css
.copy('resources/css/admin/normalize.css', 'public/css') // копирует файл normalize.css из папки resources/css в папку public/css
.styles([
    'public/css/admin/normalize.css',
    'public/css/admin/styles.css'
], 'public/css/admin/all.css'); 

