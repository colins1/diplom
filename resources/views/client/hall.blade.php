<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/client/all2.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  <main>
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          @foreach ($sessions as $session)
            @if ($session->id_ses == $id_ses)
              @foreach ($cinema_all as $cinema)
                @if ($cinema->id == $session->movie_id)
                  <h2 id_movie="{{$cinema->id}}" class="buying__info-title">{{$cinema->name}}</h2>
                  <p class="buying__info-start">Начало сеанса: {{$session->time}}</p>
                    @foreach ($cinemaHalls as $cinemaHall)
                      @if ($cinemaHall->id == $session->hall_id)
                      <p id_hall="{{$cinemaHall->id}}" class="buying__info-hall">
                          Зал {{$cinemaHall->name}}
                      </p>
                      @endif
                    @endforeach
                @endif
              @endforeach  
            @endif
          @endforeach         
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
          {{$a = 0}}
          @foreach ($cinemaHalls as $cinemaHall)
          
            @if ($cinemaHall->id == $holl_id_now)
              @foreach ((array)$cinemaHall->number_of_seats as $keys => $row)
                @foreach ($sessions as $session)
                  @if ($session->id_ses == $id_ses && $holl_id_now == $session->hall_id)
                    @php
                      $price = $cinemaHall->price_per_regular_seat;
                      $price_vip = $cinemaHall->price_per_vip_seat;
                    @endphp
                    <div class="buying-scheme__row">
                      {{print_r($hallBuySpot)}}
                      @foreach ((array)$row as $key => $spot)
                        <span 
                          @if ($hallBuySpot != [])
                            @foreach ($hallBuySpot as $itmTic)
                                @if ($itmTic['idMov'] == $session->movie_id && $itmTic['id_ses'] == $id_ses)
                                  {{$a = 0}}
                                  @foreach ($itmTic['data_row_spot'] as $itm)
                                      @if ($itm[0]-1 == $keys && $itm[1]-1 == $key)
                                      {{$a = 1}}
                                        row="{{$keys+1}}" row_spot="{{$key+1}}" class="buying-scheme__chair buying-scheme__chair_taken"
                                        @break
                                      @endif
                                  @endforeach
                                @endif
                            @endforeach
                            @if ($a == 0)
                              check="true" row="{{$keys+1}}" row_spot="{{$key+1}}" class="buying-scheme__chair buying-scheme__chair_{{ $spot[0] == 0 ? 'disabled' : ($spot[0] == 1 ? 'standart' : 'vip') }}"
                            @endif
                          @else
                          check="true" row="{{$keys+1}}" row_spot="{{$key+1}}" class="buying-scheme__chair buying-scheme__chair_{{ $spot[0] == 0 ? 'disabled' : ($spot[0] == 1 ? 'standart' : 'vip') }}"
                          @endif
                        ></span>        
                      @endforeach
                    </div>
                  @endif
                @endforeach
              @endforeach
            @endif
          @endforeach
          <div class="buying-scheme__legend">
            <div class="col">
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value standart_res">{{$price}}</span>руб)</p>
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value vip_res">{{$price_vip}}</span>руб)</p>            
            </div>
            <div class="col">
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
              <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
            </div>
          </div>
        </div>
      </div>
      <button class="acceptin-button" style="background-color: grey;" id_ses="{{$id_ses}}" timeToDay="{{$timeToDay}}" disabled>Забронировать</button>
    </section>     
  </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script defer>
  $(document).ready(function() {
    //Управление местами
    $('.buying-scheme__row').on('click', 'span.buying-scheme__chair[check="true"]', function() {
      if ($(this).hasClass('buying-scheme__chair_selected')) {
        $(this).removeClass('buying-scheme__chair_selected');
      } else if (!$(this).hasClass('buying-scheme__chair_selected')) {
        $(this).addClass('buying-scheme__chair_selected');
      }
      if ($('.buying-scheme__chair_selected').length == 1) {
        $('.acceptin-button').attr('disabled', true);
        $('.acceptin-button').attr('style', 'background-color: grey;');
      }
      if ($('.buying-scheme__chair_selected').length > 1) {
        $('.acceptin-button').removeAttr('disabled');
        $('.acceptin-button').removeAttr('style');
      }
    });

    //Отправка данных в базу мест
    $(".acceptin-button").click(function(e) {
      if ($('.buying-scheme__chair_selected').length <= 1) {
        return false;
      }
      e.preventDefault();
      
      let timeToDays = $(this).attr('timeToDay');
      let nameMov = $('.buying__info-title').text();
      let idMov = $('.buying__info-title').attr('id_movie');
      let idHall = $('.buying__info-hall').attr('id_hall');
      let id_ses = $(this).attr('id_ses');
      let data_row_spot = [];
      let priceText = 0;
      $('.buying-scheme__chair_selected[check="true"]').each(function(i, block) {
        data_row_spot.push([$(this).attr('row'),$(this).attr('row_spot')]);
        if ($(this).hasClass('buying-scheme__chair_vip')) {
          priceText += Number($('.vip_res').text());
        } else if ($(this).hasClass('buying-scheme__chair_standart')) {
          priceText += Number($('.standart_res').text());
        }
      });
      let json_data = JSON.stringify({
        'timeToDays': timeToDays,
        'nameMov': nameMov,
        'idMov': idMov,
        'idHall': idHall,
        'id_ses': id_ses,
        'data_row_spot': data_row_spot,
        'priceText': priceText
      });
      //Отправка данных в базу !!!

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          url: '/client/hall/buy',
          type: 'POST',
          data: json_data,
          contentType: 'application/json',
          success: function(response) {
            window.location.href = '/payment';
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
              console.log('Сообщение об ошибке: ' + jqXHR.responseJSON.message);
          }
      });
    });
  });
</script>
</html>