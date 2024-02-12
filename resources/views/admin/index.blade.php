<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/admin/all.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>
<body>
  <div id="popup-bgc"></div>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>

  

<style>
  #popup-bgc {
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
    background-image: url("../admin/i/trash-sprite.png");
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
                    <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть" id="addModalDismiss"></a>
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
                        <button class="conf-step__button conf-step__button-regular off-show">Отменить</button>
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
                  <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть" id="delModalDismiss"></a>
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
                      <button class="conf-step__button conf-step__button-regular off-show">Отменить</button>
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
            <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть" id="moviePopupDismiss"></a>
        </h2>
      </div>
      <div class="popup__wrapper">
        <form accept-charset="utf-8" enctype="multipart/form-data" id="addMovieForm" method="POST" action="{{ url('/admin/index/add_movie') }}">
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
            <label for="addImg" class="conf-step__button conf-step__button-accent">Добавить Постер</label>
            <input type="file" id="addImg" name="addImg" style="display:none;">
            <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent" id="addMovieToDbBtn">
            <button class="conf-step__button conf-step__button-regular off-show">Отменить</button>
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
          <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть" id="showTimePopupDismiss"></a>
        </h2>
      </div>
      <div class="popup__wrapper">
        <form accept-charset="utf-8" method="POST" id="seanceAddForm" >
          @csrf
          <label class="conf-step__label conf-step__label-fullsize" for="hall_id">
          Название зала
            <select class="conf-step__input" name="hall_id" id="seance_hallName" required>
              @foreach($cinemaHalls as $cinemaHall)
                <option value="{{ $cinemaHall->id }}" class="chois-id">{{ $cinemaHall->name }}</option>
              @endforeach
            </select>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Время начала
            <input class="conf-step__input" type="time" min="10:00" max="22:00" name="start_time" id="seance_startTime" required>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="movie_id">
          Название фильма
            <select class="conf-step__input" name="movie_id" id="seance_movieName" required>
              <option value="" class="movie_id"></option>
            </select>
          </label>
          <div class="conf-step__buttons text-center">
            <input type="submit" value="Добавить" class="add-mov-seans conf-step__button conf-step__button-accent">
            <button class="conf-step__button conf-step__button-regular off-show">Отменить</button>
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
                  <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть" id="delShowTimePopupDismiss"></a>
              </h2>

          </div>
          <div class="popup__wrapper">
              <form accept-charset="utf-8" id="delete_hall_show">
                  @csrf
                  <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span class="popupMovieName"></span>?</p>
                  <!-- В span будет подставляться название фильма -->
                  <div class="conf-step__buttons text-center">
                      <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                      <button class="conf-step__button conf-step__button-regular off-show">Отменить</button>
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
        <p class="conf-step__paragraph">Доступные залы: </p>
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
            <li><input type="radio" class="conf-step__radio" holl="{{$cinemaHall->id}}" name="chairs-hall" value="Зал" @if ($loop->first) checked @endif><span class="conf-step__selector">Зал {{$cinemaHall->name}}</span></li>
          @endforeach
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        @foreach ($cinemaHalls as $cinemaHall)
          <div holl="{{$cinemaHall->id}}" class="conf-step__legend"
                                    @if ($loop->first)
                                    @else 
                                    style="display: none;"
                                    @endif>
            <label class="conf-step__label">Рядов, шт<input holl="{{$cinemaHall->id}}" type="number" class="rowsall conf-step__input" placeholder="10" ></label>
            <span class="multiplier">x</span>
            <label class="conf-step__label">Мест, шт<input holl="{{$cinemaHall->id}}" type="number" class="seatsall conf-step__input" placeholder="8" ></label>
          </div>
        @endforeach
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
                                    holl="{{$cinemaHall->id}}">                 
          <div class="conf-step__hall-wrapper" holl="{{$cinemaHall->id}}" >
            @if (!$cinemaHall->number_of_seats)
              <div class="start_check conf-step__row" holl="{{$cinemaHall->id}}">
                <span class="conf-step__chair conf-step__chair_disabled"></span>
              </div>
            @else
              @foreach ((array)$cinemaHall->number_of_seats as $row)
                <div class="start_check conf-step__row" holl="{{$cinemaHall->id}}">
                  @foreach ((array)$row as $spot)
                    <span class="conf-step__chair conf-step__chair_{{ $spot[0] == 0 ? 'disabled' : ($spot[0] == 1 ? 'standart' : 'vip') }}"></span>
                  @endforeach
                </div>
              @endforeach
            @endif
          </div>
        </div>
        @endforeach
        
        <form method="POST" class="form_spot">
          @csrf
          <fieldset class="conf-step__buttons text-center">
            <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent db_push_spot">
          </fieldset> 
        </form>                
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
          @foreach ($cinemaHalls as $cinemaHall)
            <li><input prices-hall="{{$cinemaHall->id}}" type="radio" class="conf-step__radio" name="prices-hall" value="Зал" @if ($loop->first) checked @endif><span class="conf-step__selector">Зал {{$cinemaHall->name}}</span></li>
          @endforeach
        </ul>
          
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
        <div class="present_price">
          @foreach ($cinemaHalls as $cinemaHall)
            <div prices-hall="{{$cinemaHall->id}}" class="conf-step__legend" 
              @if ($loop->first)
              @else 
              style="display: none;"
              @endif>
              <label class="conf-step__label">Цена, рублей<input prices-hall="{{$cinemaHall->id}}" type="text" class="conf-step__input standart-spot" value="{{$cinemaHall->price_per_regular_seat}}" ></label>
              за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
            </div>  
            <div prices-hall="{{$cinemaHall->id}}" class="conf-step__legend"
              @if ($loop->first)
              @else 
              style="display: none;"
              @endif>
              <label class="conf-step__label">Цена, рублей<input prices-hall="{{$cinemaHall->id}}" type="text" class="conf-step__input vip-spot" value="{{$cinemaHall->price_per_vip_seat}}"></label>
              за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
            </div>  
          @endforeach
        </div>
        <form method="POST" class="form_price">
          @csrf
          <fieldset class="conf-step__buttons text-center">
            <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent db_push_price">
          </fieldset> 
        </form> 
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
          @foreach ($cinema_all as $cinema)
            <div class="conf-step__movie">
              <img class="conf-step__movie-poster" duration="{{$cinema->minutes}}" id_film="{{$cinema->id}}" alt="{{$cinema->name}}" src="{{ asset($cinema->url_img) }}">
              <h3 class="conf-step__movie-title">{{$cinema->name}}</h3>
              <p class="conf-step__movie-duration" duration="{{$cinema->minutes}}">{{$cinema->minutes}} минут</p>
              <form action="{{ url('/admin/index/delfilm', ['id' => $cinema->id]) }}" method="post" name="dellfilm" id="dellfilm">
                @csrf
                <input style="width: 20%; position: absolute; top: 30px; left: 200px;" type="submit" value="Dell" class="conf-step__button-accent dellfilm" name="dellfilm">
              </form>
            </div>
          @endforeach          
        </div>
        <div class="conf-step__seances" style="width: 100%">
          @foreach ($cinemaHalls as $cinemaHall)
            <div class="conf-step__seances-hall" style="width: 100%" id-holl-sessia="{{$cinemaHall->id}}">
              <h3 class="conf-step__seances-title">Зал {{$cinemaHall->name}}</h3>
              <div class="conf-step__seances-timeline" style="width: 100%">
                @if ($sessions != '')
                  @foreach ($sessions as $session)
                    @if ($session->hall_id == $cinemaHall->id)
                    <?php
                      $start_time = strtotime('10:00');
                      $end_time = strtotime('22:00');
                      $time = strtotime($session->time);
                      $max_left = 660;
                      $left = ($time - $start_time) / ($end_time - $start_time) * $max_left;
                    ?>
                    <style>
                      .show-del-session {
                        display: none;
                        position: absolute;
                        background-color: gray;
                        width: 100px;
                        height: 60px;
                        font-size: 12px;
                        color: white;
                        padding: 10px;
                      }
                      .conf-step__seances-movie:hover .show-del-session {
                        display: block;
                      }
                    </style>
                    <div class="conf-step__seances-movie" duration="{{$session->duration}}" id-holl-sessia="{{$cinemaHall->id}}" style="width: 115px; background-color: rgb(133, 255, 137); left: {{ $left }}px;">
                      <p class="conf-step__seances-movie-title">{{$session->movie_name}}</p>
                      <p class="conf-step__seances-movie-start" id-holl-sessia="{{$cinemaHall->id}}" duration="{{$session->duration}}">{{$session->time}}</p>
                      <div class="show-del-session">
                        <p>Удалить фильм из сетки?</p>
                        
                        <form action="{{ url('/admin/index/delfilmses', ['id' => $session->movie_id, 'mid' => $session->id_ses]) }}" method="post" name="dellfilmses" id="dellfilmses">
                          @csrf
                          <input style="width: 30%; position: absolute; top: 20px; left: 70px;" type="submit" value="Dell" class="conf-step__button-accent dellfilm" name="dellfilm">
                        </form>
                      </div>
                    </div>
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
          @endforeach
        </div>
        
        {{--<fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  --}}
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>
      <div class="conf-step__wrapper text-center">
        @foreach ($tickets as $ticket)
        <p class="conf-step__paragraph">@if ($ticket->is_available == 1) Приостановить продажу билетов @else Если все готово можно открыть продажу билетов @endif</p>
        <button class="conf-step__button conf-step__button-accent session-start"@if ($ticket->is_available == 1) sessionCheck="0" on="false"> Закрыть @else sessionCheck="1" on="true"> Открыть @endif продажу билетов</button>
        @endforeach
      </div>
    </section>    
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="{{ asset('js/accordeon.js') }}"></script>


  <script defer>
    $(document).ready(function() {

      function checkSell() {
        let sessionStart = $(".session-start").attr("on");
        if (sessionStart == "false") {
          return true;
        } else {
          return false;
        }
      }

      $('.dellfilm').click(function(event) {
        if (checkSell()) {
            alert("Редактирование разрешено только после отключения продаж билетов");
            return false;
        }
      });

      $('.add-mov-seans').click(function(event) {
      if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
      }
      let startTime = $('#seance_startTime').val();
      let duration = $(this).attr('duration');
      let id_holl_sessia = $(this).attr('id-holl-sessia');
      duration = Number(duration);
      let endTime = addMinutes(startTime, duration + 15);

      let isConflict = false; // Флаг для обнаружения конфликта времени [id-holl-sessia="'++'"]
      $('.conf-step__seances-movie-start[id-holl-sessia="'+id_holl_sessia+'"]').each(function() {
          let time = $(this).text(); // Получаем время из блока с фильмом
          let movieDuration = $(this).attr('duration'); // Получаем продолжительность фильма

          // Преобразуем время и продолжительность в числа (например, "15:30" -> 15.5)
          let newFilmTimeStart = parseFloat(startTime.replace(':', '.'));
          let newFilmTimeEnd = parseFloat(endTime.replace(':', '.'));
          let difference = newFilmTimeEnd - newFilmTimeStart;
          let movieTimeOldStart = parseFloat(time.replace(':', '.'));
          let movieEndTimeOld = addMinutes(time, Number(movieDuration) + 15);
          movieEndTimeOld = parseFloat(movieEndTimeOld.replace(':', '.'));

          if(newFilmTimeStart > movieEndTimeOld || newFilmTimeStart < movieTimeOldStart - difference + 0.15)
          {

          } else {
              isConflict = true;
              event.preventDefault();
              alert('На это время фильм уже существует, выбирите другое время.');
              return false; // Прерываем цикл, так как есть конфликт
          }
      });
    });

    function addMinutes(time, minutes) {
        // Разбиваем строку времени на часы и минуты
        const [hours, minutesStr] = time.split(":");
        
        // Преобразуем минуты в числовой формат
        const minutesNum = parseInt(minutesStr, 10);
        
        // Вычисляем новое время
        const newDate = new Date(1970, 0, 1, parseInt(hours, 10), minutesNum);
        newDate.setMinutes(newDate.getMinutes() + minutes);
        
        // Форматируем результат в формат "hh:mm"
        const newHours = newDate.getHours().toString().padStart(2, "0");
        const newMinutes = newDate.getMinutes().toString().padStart(2, "0");
        
        return `${newHours}:${newMinutes}`;
    }

      // Скрыть popup и фон по умолчанию
      $(".popup, #popup-bgc").hide();

      $('.conf-step__movie-poster').draggable({
          revert: true
      });

      // Проверка сессии
      $(".session-start").click(function(event) {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '/admin/index/session/1',
            type: 'POST',
            data: {sessionCheck: event.currentTarget.attributes.sessionCheck.value}, 
            contentType: 'application/x-www-form-urlencoded', 
            success: function(response) {
                alert('Все удачно сохранено');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Ошибка');
            }
        });
      });

      //Формирование сетки сеансов
      $('.conf-step__seances-hall').droppable({
          drop: function(event, ui) {
              let idFilm = ui.draggable.attr('id_film');
              let nameFilm = ui.draggable.attr('alt');
              let idHollSessia = $(this).attr('id-holl-sessia');
              $('.chois-id[value='+idHollSessia+']').attr("selected", true);
              $('.movie_id').text(nameFilm);
              $('.movie_id').attr("value", idFilm);
              $('.add-mov-seans').attr("duration", ui.draggable.attr('duration'));
              $('.add-mov-seans').attr("id-holl-sessia", idHollSessia);
              $('#seanceAddForm').attr("action", '/admin/index/seans');
              $("#addShowTimePopup").show();
              $("#popup-bgc").show();
          }
      });
      
      // Показать popup и фон при клике на кнопку
      $(".show-popup").click(function() {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
        let classList = event.currentTarget.classList;
        let length = classList.length;
        lastClass = classList[length - 1];
        idDel = classList[length - 2];
        $("#"+lastClass+", #popup-bgc").show();
        let id = event.currentTarget.attributes.idattr.value;
        if (id) {
          let act = '\/admin\/index\/holls\/'+id;
          $("#" + lastClass).find("#" + idDel).attr("action", act);
        }
      });

      //Смена зала
      $('.conf-step__radio[name="chairs-hall"]').click(function(e) {
        // Получаем значение атрибута .conf-step__radio
        $(this).attr('checked', true);
        let hollValue = $(this).attr('holl');

        // Находим все блоки с атрибутом holl
        let blocks = $('[holl]');

        // Перебираем все блоки и проверяем значение атрибута holl
        blocks.each(function() {
          let block = $(this);
          let blockHollValue = block.attr('holl');

          // Если значение атрибута holl соответствует значению .conf-step__radio, показываем блок
          if (blockHollValue == hollValue) {
            block.show();
          } else {
            if(block[0].localName != 'input') {
              block.hide();
            }
          }
        });
      });

      //Смена цен зала
      $('.conf-step__radio[name="prices-hall"]').click(function(e) {
        // Получаем значение атрибута .conf-step__radio
        $(this).attr('checked', true);
        let holl_id = $(this).attr('prices-hall');

        // Находим все блоки с атрибутом prices-hall
        let blocks = $('.present_price [prices-hall]');

        // Перебираем все блоки и проверяем значение атрибута holl
        blocks.each(function() {
          let block = $(this);
          let blockHollValue = block.attr('prices-hall');

          // Если значение атрибута holl соответствует значению .conf-step__radio, показываем блок
          if (blockHollValue == holl_id) {
            block.show();
          } else {
            block.hide();
          }
        });
      });

      //Отправка данных в базу мест
      $(".db_push_spot").click(function(e) {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
        e.preventDefault();
        let data = [];
        let id_holl;
        $('.conf-step__row:visible').each(function(i, block) {
            let row = [];
            id_holl = block.attributes.holl.value;
            $(this).find('span').each(function() {
                let chair = $(this).attr('class').split(' ')[1];
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

        let json_data = JSON.stringify(data);
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '/admin/index/update/'+ id_holl,
            type: 'POST',
            data: json_data,
            contentType: 'application/json',
            success: function(response) {
                alert('Все удачно сохранено');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
                console.log('Сообщение об ошибке: ' + jqXHR.responseJSON.message);
            }
        });
      });

      // Отправка в базу данных цен за место
      $(".db_push_price").click(function(e) {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
        e.preventDefault();
        let id_holl = $('.standart-spot:visible').attr('prices-hall');
        let standart = parseInt($('.standart-spot[prices-hall="'+id_holl+'"]').val());
        let vip = parseInt($('.vip-spot[prices-hall="'+id_holl+'"]').val());
        //Отправка данных в базу !!!

        let data = ['price'];
        data.push(standart);
        data.push(vip);
        let json_price = JSON.stringify(data);
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: '/admin/index/update/'+ id_holl,
            type: 'POST',
            data: json_price,
            contentType: 'application/json',
            success: function(response) {
                alert('Все удачно сохранено');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
                console.log('Сообщение об ошибке: ' + jqXHR.responseJSON.message);
            }
        });
      });

      //Управление местами
      let chairClasses = ['conf-step__chair_disabled', 'conf-step__chair_standart', 'conf-step__chair_vip'];
      let chairIndex = 0;
      $('.conf-step__hall-wrapper').on('click', 'span.conf-step__chair', function() {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
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
      $('input.rowsall').on('input', function(e) {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
        let rows = parseInt($('input.rowsall[holl="'+e.target.attributes.holl.value+'"]').val());
        if (isNaN(rows)) {
          return;
        }
        if (rows < 1 || rows > 10) {
          alert('Количество рядов и мест в ряде должно быть от 5 до 10');
          return;
        }
        let step = $('.conf-step__row[holl="'+e.target.attributes.holl.value+'"]');
        let rowCount = step.length;

        if (rowCount < rows) {
            let lastRow = step.last();
            let countToAdd = parseInt(rows) - parseInt(rowCount);

            for (let i = 0; i < countToAdd; i++) {
                lastRow.clone().appendTo('.conf-step__hall-wrapper[holl="'+e.target.attributes.holl.value+'"]');
            }
        } else if (rowCount > rows) {
            let countToRemove = parseInt(rowCount) - parseInt(rows);

            for (let i = 0; i < countToRemove; i++) {
              $('.conf-step__hall-wrapper[holl="'+e.target.attributes.holl.value+'"]').children().last().remove();
            }
        }
        
      });

      // управление местами в ряду
      $('input.seatsall').on('input', function(e) {
        if (checkSell()) {
          alert("Редактирование разрешено только после отключения продаж билетов");
          return false;
        }
        let seats = parseInt($('input.seatsall[holl="'+e.target.attributes.holl.value+'"]').val());
        if (isNaN(seats)) {
          return;
        }
        if (seats < 1 || seats > 10) {
          alert('Количество рядов и мест в ряде должно быть от 5 до 10');
          return;
        }

        let stepCheck = $('div.start_check[holl="'+e.target.attributes.holl.value+'"]');
        let children = stepCheck[0].children;
        let rowCount = children.length;

        let step = $('.conf-step__row[holl="'+e.target.attributes.holl.value+'"]');
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
      $(".popup__dismiss, .off-show, #popup-bgc").click(function(e) {
        // Проверить, что клик был не внутри popup
        e.preventDefault();
        if (e.currentTarget == this) {
          $(".popup, #popup-bgc").hide();
        }
      });
    });
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>

</body>
</html>
