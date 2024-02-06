<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/client/all2.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  
  <main>
    <section class="ticket">
      
      <header class="tichet__check">
        <h2 class="ticket__check-title">Вы выбрали билеты:</h2>
      </header>
      
      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{$allInfo[0]}}</span></p>
        <p class="ticket__info">Места: <span class="ticket__details ticket__chairs">{{$allInfo[1]}}</span></p>
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{$allInfo[2]}}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{$allInfo[3]}}</span></p>
        <p class="ticket__info">Стоимость: <span class="ticket__details ticket__cost">{{$allInfo[4]}}</span> рублей</p>

        <button class="acceptin-button" >Получить код бронирования</button>

        <div style="width: 100%; margin-left: 40%;" id="qrcode"></div>
        <p class="ticket__hint">После оплаты билет будет доступен в этом окне, а также придёт вам на почту. Покажите QR-код нашему контроллёру у входа в зал.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>     
  </main>
  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<!-- Создайте контейнер для QR-кода -->


<!-- JavaScript для генерации QR-кода -->
<script defer>
  $(document).ready(function() {
      // Обработчик события при нажатии на кнопку
      $('.acceptin-button').click(function() {
          // Получаем данные из блоков
      
          const filmTitle = $(".ticket__title").text();
          const seats = $(".ticket__chairs").text();
          const hall = $(".ticket__hall").text();
          const startTime = $(".ticket__start").text();
          const cost = $(".ticket__cost").text();

          // Формируем текст для QR-кода
          const qrText = `Фильм: ${filmTitle}\nМеста: ${seats}\nВ зале: ${hall}\nНачало сеанса: ${startTime}\nСтоимость: ${cost} рублей`;

          // Генерируем QR-код
          const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrText)}&size=200x200`;
          const imgElement = $("<img>").attr("src", qrUrl);

          // Вставляем элемент <img> внутри #qrcode
          $(".acceptin-button").remove();
          $("#qrcode").append(imgElement);
      });
  });
</script>
</html>