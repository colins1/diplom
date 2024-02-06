<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Авторизация | ИдёмВКино</title>
  <link rel="stylesheet" href="{{ asset('css/admin/all.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>

  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>
  
  <main>
    <section class="login">
      <header class="login__header">
        <h2 class="login__title">Авторизация</h2>
      </header>
      <div class="login__wrapper">
        <div class="card-header">{{ __('Login') }}</div>
        <form method="POST" class="login__form" action="{{ route('login') }}">
          @csrf
          <label for="email" class="login__label">{{ __('Email Address') }}
            <input id="email" type="email" class="login__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <label for="password" class="login__label">{{ __('Password') }}
              <input id="password" type="password" class="login__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </label>
          <div class="text-center">
              <input value="Авторизоваться" type="submit" class="login__button">
          </div>
        </form>
      </div>
    </section>
  </main>

  <script src="js/accordeon.js"></script>
</body>
</html>
