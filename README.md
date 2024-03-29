# Дипломное задание по профессии "Веб-разработчик"

## Создание «информационной системы для администрирования залов, сеансов и предварительного бронирования билетов».

### Студенту предоставляются следующие компоненты системы:
* Верстка

## Задачи
* Разработать сайт бронирования билетов онлайн
* Разработать административную часть сайта

## Сущности
*Кинозал*
Помещение, в котором демонстрируются фильмы. Режим работы определяется расписанием на день. Зал - прямоугольный, состоит из N * M различных зрительских мест.

*Зрительское место*
Место в кинозале. Зрительские места могут быть VIP и обычные. 

*Фильм*
Информация о фильме заполняется администратором. Фильм связан с сеансом в кинозале.

*Сеанс*
Сеанс - это временной промежуток, в котором в кинозале будет показываться фильм. На сеанс могут быть забронированы билеты.

*Билет*
QR-код c уникальным кодом бронирования, в котором обязательно указаны место, ряд, сеанс; Билет действителен строго на свой сеанс. Для генерации QR-кода можно использовать http://phpqrcode.sourceforge.net/

## Роли пользователей системы
* Администратор - авторизованный пользователь
* Гость - неавторизованный посетитель сайта

### Возможности администратора
* Создание/редактирование залов
* Создание/редактирование фильмов
* Настройка цен
* Создание/редактирование расписания показов фильмов

### Возможности гостя
* Просмотр расписания
* Просмотр фильмов
* Выбор места в кинозале
* Бронирование билета

### Порядок запуска
* Склонируйте репозиторий на свой компьютор с помощью команды git clone
* Перейдите в папку с проектом: cd diplom
* Запустите установку зависимостей с помощью Composer: composer install
* Создайте копию файла .env.example и назовите ее .env: cp .env.example .env
* Выполните команду для генерации ключа приложения: php artisan key:generate
* Перейдите в корень сайте найдите фаел env и замените следуюющие значения
  
<li>DB_CONNECTION=sqlite</li>
<li>DB_HOST=</li>
<li>DB_PORT=</li>
<li>DB_DATABASE={ПУТЬ ДО ПАПКИ diplom}diplom/database/database.sqlite</li>
<li>DB_USERNAME=</li>
<li>DB_PASSWORD=</li>

* Запустите миграции: php artisan migrate
* Запустите встроенный сервер Laravel: php artisan serve
* Перейдите по ссылке созданого сервера по дефолту это http://localhost:8000

## Описание проекта
Проект выполнен на базовом JS и PHP, без использования стронних библиотек и фреймвороков.  
Хранение данных реализовано в базе данных MySQL. Дамп базы хранится в папке **DB**

### Доступ к интерфейсу управления залами
http://localhost:8000/admin/index - Администраторская
**Логин(e-mail)** – maxim@gmail.com
**Пароль** – qwerty;  


