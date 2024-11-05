<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance Management</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Gorditas&family=Noto+Serif+JP:wght@900&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <style>
    .header-nav__link {
        color: #D9D1CC; 
        text-decoration: none; 
       
    }

    .header-nav__link:active,
    .header-nav__link:focus,
    .header-nav__link:hover {
        color: #D9D1CC; 
        outline: none; 
        text-decoration: none;
    }

    .header-nav__item button {
        background: none; 
        border: none; 
        color: #D9D1CC; 
        padding: 0; 
       
    }

    .header-nav__item button:active,
    .header-nav__item button:focus {
        outline: none; 
        text-decoration: none;
    }
    .header__logo {
      
      /* 下線を消す */
  }

  .header__logo:hover {
      color: #85786C; 
    
       text-decoration: none;
  }
  </style>

  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/admin">
          FashionablyLate
        </a>
        <nav>
          <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
              <form class="form" action="{{ route('logout') }}" method="post" style="display:inline;">
                @csrf
                <button class="header-nav__link">logout</button>
              </form>
            </li>
            @else
            @if (Request::is('login'))
            <li class="header-nav__item">
              <a class="header-nav__link" href="/register">register</a>
            </li>
            @elseif (Request::is('register'))
            <li class="header-nav__item">
              <a class="header-nav__link" href="/login">login</a>
            </li>
            @endif
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>