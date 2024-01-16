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
    border: none;
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
                <form accept-charset="utf-8" method="POST" action="{{ url('/admin/index') }}" name="hallAddForm" id="hallAddForm">
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
<div class="popup dellPopup" id="dellPopup">
  <div class="popup__container">
      <div class="popup__content">
          <div class="popup__header">
              <h2 class="popup__title">
                  Удаление зала
                  <a class="popup__dismiss" href="#"><img src="{{ asset('i/close.png') }}" alt="Закрыть" id="delModalDismiss"></a>
              </h2>

          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" method="POST" id="hallDeleteForm">
                  @csrf
                  @method('DELETE')
                  <p class="conf-step__paragraph">Вы действительно хотите удалить зал <span class="popupHallName"></span>?</p>
                  <!-- В span будет подставляться название зала -->
                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent delholl deleteForm">
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
          @foreach ($cinemaHalls as $cinemaHall)
            <li>Зал {{ $cinemaHall->name }}
                <button idattr="{{ $cinemaHall->id }}" class="show-popup conf-step__button conf-step__button-trash hallDeleteForm dellPopup"></button>
            </li>
          @endforeach
        </ul>
        <button attr-id="" class="show-popup conf-step__button conf-step__button-accent addPopup">Создать зал</button>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          @foreach ($cinemaHalls as $cinemaHall)
            <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="Зал 1" @if ($loop->first) checked @endif><span class="conf-step__selector">Зал {{$cinemaHall->name}}</span></li>
          @endforeach
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        <div class="conf-step__legend">
          <label class="conf-step__label">Рядов, шт<input holl="{{$cinemaHall->id}}" id="rowsall" type="number" class="conf-step__input" value="10" ></label>
          <span class="multiplier">x</span>
          <label class="conf-step__label">Мест, шт<input holl="{{$cinemaHall->id}}" id="seatsall" type="number" class="conf-step__input" value="8" ></label>
        </div>
        <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
        <div class="conf-step__legend">
          <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
          <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
          <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
          <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
        </div>  
        @foreach ($cinemaHalls as $cinemaHall)
        <div class="conf-step__hall"@if ($loop->first)
                                    @else 
                                    style="display: none;"
                                    @endif
                                    >
          <div class="conf-step__hall-wrapper" holl="{{$cinemaHall->id}}">
            <div class="start_check conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_disabled"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_vip"></span><span class="conf-step__chair conf-step__chair_vip"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_disabled"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
            </div>  

            <div class="conf-step__row" holl="{{$cinemaHall->id}}">
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>
              <span class="conf-step__chair conf-step__chair_standart"></span><span class="conf-step__chair conf-step__chair_standart"></span>          
            </div>
          </div>  
        </div>
        @endforeach
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent db_push">
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
        idDel = classList[length - 2];
        $("#"+lastClass+", #popup-bg").show();
        let id = event.currentTarget.attributes.idattr.value;
        if (id) {
          let act = '\/admin\/index\/holls\/'+id;
          $("#" + lastClass).find("#" + idDel).attr("action", act);
        }
      });

      $(".db_push").click(function() {
        var data = [];
        $('.conf-step__row').each(function() {
            var row = [];
            $(this).find('span').each(function() {
                var chair = $(this).attr('class').split(' ')[1];
                if (chair == 'conf-step__chair_disabled') {
                    row.push([0, false]);
                } else if (chair == 'conf-step__chair_standart') {
                    row.push([1, false]);
                } else if (chair == 'conf-step__chair_vip') {
                    row.push([2, false]);
                }
            });
            data.push(row);
        });
        //Отправка данных в базу !!!
        var json_data = JSON.stringify(data);
        $.post('url_адрес', {data: 'данные'}, function(response) {
            console.log(response);
        });
      });


      //Управление местами 
      let chairClasses = ['conf-step__chair_disabled', 'conf-step__chair_standart', 'conf-step__chair_vip'];
      let chairIndex = 0;
      $('.conf-step__hall-wrapper').on('click', 'span.conf-step__chair', function() {
        if ($(this).hasClass('conf-step__chair_vip')) {
          $(this).removeClass('conf-step__chair_vip');
          $(this).addClass('conf-step__chair_disabled');
        } else if ($(this).hasClass('conf-step__chair_disabled')) {
          $(this).removeClass('conf-step__chair_disabled');
          $(this).addClass('conf-step__chair_standart');
        } else {
          $(this).removeClass('conf-step__chair_standart');
          $(this).addClass('conf-step__chair_vip');
        }
      });

      //Управление рядами
      $('input#rowsall').on('input', function(e) {
        let rows = parseInt($('input#rowsall:first').val());
        if (isNaN(rows)) {
          return;
        }
        if (rows < 1 || rows > 10) {
          $('input#rowsall').attr('value', 8);
          alert('Количество рядов и мест в ряде должно быть от 5 до 10');
          return;
        }
        let step = $('.conf-step__row[data-attribute="'+e.target.attributes.holl.value+'"]');
        let rowCount = step.length;

        if (rowCount < rows) {
            let lastRow = step.last();
            let countToAdd = parseInt(rows) - parseInt(rowCount);

            for (let i = 0; i < countToAdd; i++) {
                lastRow.clone().appendTo('.conf-step__hall-wrapper');
            }
        } else if (rowCount > rows) {
            let countToRemove = parseInt(rowCount) - parseInt(rows);

            for (let i = 0; i < countToRemove; i++) {
              $('.conf-step__hall-wrapper').children().last().remove();
            }
        }
        
      });

      // управление местами в ряду
      $('input#seatsall').on('input', function(e) {
        let seats = parseInt($('input#seatsall:last').val());
        if (isNaN(seats)) {
          return;
        }
        if (seats < 1 || seats > 10) {
          $('input#seatsall').attr('value', 8);
          alert('Количество рядов и мест в ряде должно быть от 5 до 10');
          return;
        }

        let stepCheck = $('div.start_check span.conf-step__chair[data-attribute="'+e.target.attributes.holl.value+'"]');
        let rowCount = stepCheck.length;

        let step = $('.conf-step__row');
        if (rowCount < seats) {
            let lastStep = step.children().last();
            let countToAdd = parseInt(seats) - parseInt(rowCount);
            step.each(function() {
              for (let i = 0; i < countToAdd; i++) {
                lastStep.clone().appendTo(this);
              }
            });
        } else if (rowCount > seats) {
          let countToRemove = parseInt(rowCount) - parseInt(seats);
          step.each(function() {
            for (let i = 0; i < countToRemove; i++) {
              $(this).children().last().remove();
            }
          });
        }
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
