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
  <link rel="stylesheet" href="{{ asset('css/login.
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
  <div class="contact-form__content">
    <div class="contact-form__heading">
         <h2>Login</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
             <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com"required id="email" value="{{ old('email', $data['email'] ?? '') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="例:coachtechn06"required id="password" value="{{ old('password', $data['password'] ?? '') }}" />
                </div>
                @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-login" type="submit" >ログイン</button>
        </div>
    </div>
</header>
</body>