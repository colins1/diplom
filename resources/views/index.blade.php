<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/client/all2.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
    @php
        use Carbon\Carbon;

        // Получаем текущую дату и время по московскому времени
        $now = Carbon::now('Europe/Moscow');

        // Создаем массив с днями недели, начиная с понедельника
        $daysOfWeek = [];
        $filmDay = $now->format('Y-m-d');
        for ($i = 0; $i < 7; $i++) {
            $day = $now->copy()->addDays($i);
            if ($day->isToday()) {
              $chek = 1;
            } else {
              $chek = 0;
            }
            $daysOfWeek[] = [
                'date' => $day->format('Y-m-d'),
                'dayOfWeek' => $day->formatLocalized('%a'), // Пн, Вт, Ср и т. д.
                'dayOfMonth' => $day->day,
                'isToday' => $chek,
            ];
        }
        $daysOfWeeks = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    @endphp
    <nav class="page-nav">
      @foreach ($daysOfWeek as $key => $day)
          <a date-film="{{ $day['date'] }}" class="page-nav__day @php echo $day['isToday'] == 1 ? 'page-nav__day_today page-nav__day_chosen': ''  @endphp" href="#">
              <span class="page-nav__day-week">{{ $daysOfWeeks[$key] }}</span>
              <span class="page-nav__day-number">{{ $day['dayOfMonth'] }}</span>
          </a>
      @endforeach
    </nav>
  
  
  <main>
    @foreach ($cinema_all as $cinema)
      <section class="movie">
        <div class="movie__info">
          <div class="movie__poster">
            <img class="movie__poster-image" alt="Звёздные войны постер" src="{{$cinema->url_img}}">
          </div>
          <div class="movie__description">
            <h2 class="movie__title">{{$cinema->name}}</h2>
            <p class="movie__synopsis">{{$cinema->description}}</p>
            <p class="movie__data">
              <span class="movie__data-duration">{{$cinema->minutes}} минут</span>
              <span class="movie__data-origin">{{$cinema->country}}</span>
            </p>
          </div>
        </div>
        @foreach ($cinemaHalls as $cinemaHall)
        <div class="movie-seances__hall">
          <h3 class="movie-seances__hall-title">Зал {{$cinemaHall->name}}</h3>
          <ul class="movie-seances__list">
            @foreach ($sessions as $session)
              @if ($session->hall_id == $cinemaHall->id && $session->movie_id == $cinema->id)
              <li class="movie-seances__time-block">
                <a class="movie-seances__time" date-film="{{$filmDay}}" id_holl="{{$cinemaHall->id}}" id_mov="{{$cinema->id}}" href="{{ route('hall', ['id_ses' => $session->id_ses.'_'.$filmDay.'_'.$cinemaHall->id]) }}">
                    {{$session->time}}
                </a>
              </li>
              @endif
            @endforeach  
          </ul>
        </div>
        @endforeach   
      </section>
    @endforeach
  </main>
  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script defer>
  $(document).ready(function() {
    // работа с page-nav__day_chosen
    $('.page-nav__day').click(function(e) {
      // Получаем значение атрибута .conf-step__radio
      const allDayBlocks = $(".page-nav__day");

      // Фильтровать только те, где есть класс page-nav__day_chosen
      const chosenDayBlocks = allDayBlocks.filter(".page-nav__day_chosen");

      // Удалить класс page-nav__day_chosen у найденных элементов
      chosenDayBlocks.removeClass("page-nav__day_chosen");

      // Добавить новый класс page-nav__day_chosen к $(this)
      $(this).addClass("page-nav__day_chosen");
      let dateFilmValue = $(this).attr("date-film");
      $(".movie-seances__time").each(function() {
          let holl = $(this).attr("id_holl");
          let mov = $(this).attr("id_mov");
          $(this).attr("date-film", dateFilmValue);
          $(this).attr("href", '../client/hall/'+mov+'_'+dateFilmValue+'_'+holl); // Здесь вы можете изменить значение атрибута date-film на нужное
      });
    });
  });
</script>
</html>