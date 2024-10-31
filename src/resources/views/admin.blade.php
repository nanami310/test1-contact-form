<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" 
content="IE=edge" />
  <meta name="viewport" content="width=device-width, 
initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/
sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.
css') }}" />
  <link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.
com">
<link 
href="https://fonts.googleapis.com/css2?
family=Gorditas&family=Noto+Serif+JP:wght@900&
display=swap"
rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">FashionablyLate</a>
                <button class="form__register" type="button"  onclick="location.href='{{ route('input.page') }}';">register</button>
        </div>
    </header>
    <h1>ダッシュボード</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</body>