<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/admin/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/styles.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <div id="popup-bg"></div>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>

  

<style>
  #popup-bg {
    /* Делаем его позицию фиксированной, чтобы он не зависел от прокрутки */
    position: fixed;
    /* Устанавливаем его размеры равными размерам экрана */
    width: 100%;
    height: 100%;
    /* Устанавливаем его цвет фона чёрным с небольшой прозрачностью */
    background-color: rgba(0, 0, 0, 0.5);
    /* Устанавливаем его z-index ниже, чем у элемента с классом popup, чтобы он не перекрывал его */
    z-index: 99;
    /* Скрываем его по умолчанию */
    display: none;
  }
  .popup {
    /* Делаем его позицию фиксированной, чтобы он не зависел от прокрутки */
    position: fixed;
    /* Устанавливаем его вертикальное положение по центру экрана */
    top: 50%;
    /* Устанавливаем его горизонтальное положение по центру экрана */
    left: 50%;
    /* Сдвигаем его на половину его высоты и ширины в обратном направлении, чтобы он был ровно по центру */
    transform: translate(-50%, 30%);
    /* Устанавливаем его z-index выше других элементов, чтобы он не перекрывался ими */
    z-index: 100;
  }
  #addModalDismiss {
    height: 1.5em;
  }

  .conf-step__button-trash {
    background-image: url("../i/trash-sprite.png");
    background-size: contain;
    background-size: cover;
  }
</style>

{{--Popup add Hall--}}
<div class="popup" id="addPopup" style="">
    <div class="popup__container">
        <div class="popup__content">
            <div class="popup__header">
                <h2 class="popup__title">
                    Добавление зала
                    <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="addModalDismiss"></a>
                </h2>

            </div>
            <div class="popup__wrapper">
                <form accept-charset="utf-8" name="hallAddForm" id="hallAddForm">
                    @csrf
                    <label class="conf-step__label conf-step__label-fullsize" for="name">
                        Название зала
                        <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" id="hallNameAdd" required>
                    </label>
                    <div class="conf-step__buttons text-center">
                        <input type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent" name="addHall">
                        <button class="conf-step__button conf-step__button-regular">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--Popup delete Hall--}}
<div class="popup" id="deletePopup">
  <div class="popup__container">
      <div class="popup__content">
          <div class="popup__header">
              <h2 class="popup__title">
                  Удаление зала
                  <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="delModalDismiss"></a>
              </h2>

          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" id="hallDeleteForm">
                  @csrf
                  <p class="conf-step__paragraph">Вы действительно хотите удалить зал <span class="popupHallName"></span>?</p>
                  <!-- В span будет подставляться название зала -->
                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                      <button class="conf-step__button conf-step__button-regular">Отменить</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>


{{--Movie add Popup--}}
<div class="popup" id="addMoviePopup">
  <div class="popup__container">
      <div class="popup__content">
          <div class="popup__header">
              <h2 class="popup__title">
                  Добавление фильма
                  <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="moviePopupDismiss"></a>
              </h2>
          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" id="addMovieForm">
                  @csrf
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                      Название фильма
                      <input class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="title" id="movieName" required>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                      Продолжительность фильма
                      <input class="conf-step__input" type="text" placeholder="Например, &laquo;86&raquo;" name="duration" id="movieDuration" required>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                      Описание фильма
                      <textarea class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн был бравым офицером и т.д и тп.&raquo;" name="description" id="movieDescription" required></textarea>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                      Страна
                      <input class="conf-step__input" type="text" placeholder="Например, &laquo;Индия&raquo;" name="country" id="movieCountry" required>
                  </label>
                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" id="addMovieToDbBtn">
                      <button class="conf-step__button conf-step__button-regular">Отменить</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>



{{--ShowTime add--}}
<div class="popup" id="addShowTimePopup">
  <div class="popup__container">
      <div class="popup__content">
          <div class="popup__header">
              <h2 class="popup__title">
                  Добавление сеанса
                  <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="showTimePopupDismiss"></a>
              </h2>

          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" id="seanceAddForm">
                  @csrf
                  <label class="conf-step__label conf-step__label-fullsize" for="hall_id">
                      Название зала
                      <select class="conf-step__input" name="hall_id" id="seance_hallName" required>
                          {{--@foreach($halls as $hall)
                          <option value="{{ $hall->id }}" selected>{{ $hall->name }}</option>
                          @endforeach--}}
                      </select>
                  </label>
                  <label class="conf-step__label conf-step__label-fullsize" for="name">
                      Время начала
                      <input class="conf-step__input" type="time" value="00:00" name="start_time" id="seance_startTime" required>
                  </label>


                  <label class="conf-step__label conf-step__label-fullsize" for="movie_id">
                      Название фильма
                  <input class="conf-step__input movie_name" type="text" placeholder="Например, &laquo;Альфа&raquo;" name="movie_name" id="seance_movieName" required>
                  </label>

                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Добавить" class="conf-step__button conf-step__button-accent">
                      <button class="conf-step__button conf-step__button-regular">Отменить</button>
                      <button type="button" class="conf-step__button conf-step__button-accent" id="movie_delete_btn">Удалить фильм</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{--showTime delete--}}
<div class="popup" id="delShowtimePopup">
  <div class="popup__container">
      <div class="popup__content">
          <div class="popup__header">
              <h2 class="popup__title">
                  Снятие с сеанса
                  <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="delShowTimePopupDismiss"></a>
              </h2>

          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" id="delete_hall_show">
                  @csrf
                  <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span class="popupMovieName"></span>?</p>
                  <!-- В span будет подставляться название фильма -->
                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                      <button class="conf-step__button conf-step__button-regular">Отменить</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>


  
  <main class="conf-steps" style=" background-color: rgba(0, 0, 0, 0.5);">
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <ul class="conf-step__list">
          <li>Зал 1
            <button class="conf-step__button conf-step__button-trash"></button>
          </li>
          <li>Зал 2
            <button class="conf-step__button conf-step__button-trash"></button>
          </li>
        </ul>
        <button class="show-popup conf-step__button conf-step__button-accent addPopup">Создать зал</button>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="Зал 1" checked><span class="conf-step__selector">Зал 1</span></li>
          <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="Зал 2"><span class="conf-step__selector">Зал 2</span></li>
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        <div class="conf-step__legend">
          <label class="conf-step__label">Рядов, шт<input type="text" class="conf-step__input" placeholder="10" ></label>
          <span class="multiplier">x</span>
          <label class="conf-step__label">Мест, шт<input type="text" class="conf-step__input" placeholder="8" ></label>
        </div>
        <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
        <div class="conf-step__legend">
          <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
          <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
          <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
          <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
        </div>  
        
        <div class="conf-step__hall">
          <div class="conf-step__hall-wrapper">
            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
            </div>  

            <div class="conf-step__row">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>          
            </div>
          </div>  
        </div>
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>                 
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          <li><input type="radio" class="conf-step__radio" name="prices-hall" value="Зал 1"><span class="conf-step__selector">Зал 1</span></li>
          <li><input type="radio" class="conf-step__radio" name="prices-hall" value="Зал 2" checked><span class="conf-step__selector">Зал 2</span></li>
        </ul>
          
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" ></label>
            за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
          </div>  
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input" placeholder="0" value="350"></label>
            за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
          </div>  
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
          <button class="show-popup conf-step__button conf-step__button-accent button__add-movie addMoviePopup">Добавить фильм</button>
        </p>
        <div class="conf-step__movies">
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png') }}">
            <h3 class="conf-step__movie-title">Звёздные войны XXIII: Атака клонированных клонов</h3>
            <p class="conf-step__movie-duration">130 минут</p>
          </div>
          
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png') }}">
            <h3 class="conf-step__movie-title">Миссия выполнима</h3>
            <p class="conf-step__movie-duration">120 минут</p>
          </div>
          
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png') }}">
            <h3 class="conf-step__movie-title">Серая пантера</h3>
            <p class="conf-step__movie-duration">90 минут</p>
          </div>
          
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png') }}">
            <h3 class="conf-step__movie-title">Движение вбок</h3>
            <p class="conf-step__movie-duration">95 минут</p>
          </div>   
          
          <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="{{ asset('i/poster.png') }}">
            <h3 class="conf-step__movie-title">Кот Да Винчи</h3>
            <p class="conf-step__movie-duration">100 минут</p>
          </div>            
        </div>
        
        <div class="conf-step__seances">
          <div class="conf-step__seances-hall">
            <h3 class="conf-step__seances-title">Зал 1</h3>
            <div class="conf-step__seances-timeline">
              <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 0;">
                <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                <p class="conf-step__seances-movie-start">00:00</p>
              </div>
              <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 360px;">
                <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                <p class="conf-step__seances-movie-start">12:00</p>
              </div>
              <div class="conf-step__seances-movie" style="width: 65px; background-color: rgb(202, 255, 133); left: 420px;">
                <p class="conf-step__seances-movie-title">Звёздные войны XXIII: Атака клонированных клонов</p>
                <p class="conf-step__seances-movie-start">14:00</p>
              </div>              
            </div>
          </div>
          <div class="conf-step__seances-hall">
            <h3 class="conf-step__seances-title">Зал 2</h3>
            <div class="conf-step__seances-timeline">
              <div class="conf-step__seances-movie" style="width: 65px; background-color: rgb(202, 255, 133); left: 595px;">
                <p class="conf-step__seances-movie-title">Звёздные войны XXIII: Атака клонированных клонов</p>
                <p class="conf-step__seances-movie-start">19:50</p>
              </div>
              <div class="conf-step__seances-movie" style="width: 60px; background-color: rgb(133, 255, 137); left: 660px;">
                <p class="conf-step__seances-movie-title">Миссия выполнима</p>
                <p class="conf-step__seances-movie-start">22:00</p>
              </div>              
            </div>
          </div>
        </div>
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>
      <div class="conf-step__wrapper text-center">
        <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
        <button class="conf-step__button conf-step__button-accent">Открыть продажу билетов</button>
      </div>
    </section>    
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="{{ asset('js/accordeon.js') }}"></script>
  <script src="{{ asset('js/admin_editor.js') }}"></script>


  <script>
    $(document).ready(function() {
      // Скрыть popup и фон по умолчанию
      $(".popup, #popup-bg").hide();
    
      // Показать popup и фон при клике на кнопку
      $(".show-popup").click(function() {
        let classList = event.currentTarget.classList;
        let length = classList.length;
        lastClass = classList[length - 1];
        $("#"+lastClass+", #popup-bg").show();
      });
    
      // Закрыть popup и фон при клике на крестик или вне popup
      $(".popup__dismiss, #popup-bg").click(function(e) {
        // Проверить, что клик был не внутри popup
        if (e.currentTarget == this) {
          $(".popup, #popup-bg").hide();
        }
      });
    });
    </script>
</body>
</html>
