const mix = require('laravel-mix');

mix.sass('resources/sass/style.scss', 'public/css') // компилирует файл style.scss в файл style.css и помещает его в папку public/css
   .copy('resources/css/normalize.css', 'public/css') // копирует файл normalize.css из папки resources/css в папку public/css
   .styles([
       'public/css/normalize.css',
       'public/css/style.css'
   ], 'public/css/all.css'); // объединяет файлы normalize.css и style.css в один файл all.css и помещает его в папку public/css