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
  <link rel="stylesheet" href="{{ asset('css/register.
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
    <h1>新規登録</h1>

    @if ($errors->any())
        <div>
            <strong>エラー:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" required placeholder="名前">
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required placeholder="メールアドレス">
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required placeholder="パスワード">
        </div>
        <div>
            <label for="password_confirmation">パスワード確認:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="パスワード確認">
        </div>
        <button type="submit">登録</button>
    </form>

    <p>すでにアカウントをお持ちですか？ <a href="{{ route('login.form') }}">ログイン</a></p>
</body>