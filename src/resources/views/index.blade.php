<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  <link rel="stylesheet" href="css/style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link 
href="https://fonts.googleapis.com/css2?family=Gorditas&family=Noto+Serif+JP:wght@900&display=swap"
rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="name" placeholder="例:山田太郎" id="name" value="{{ old('name', $data['name'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('name')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content1">
            <div class="cp_ipradio06" >
                <label class="list_item">
                    <input class="option-input" type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }} checked> 男性
                </label>
                <label class="list_item">
                    <input class="option-input" type="radio" name="gender" value="女性"{{ old('gender') == '女性' ? 'checked' : '' }}> 女性
                </label>
                <label class="list_item">
                    <input class="option-input" type="radio" name="gender" value="その他"{{ old('gender') == 'その他' ? 'checked' : '' }}> その他
                </label>
            </div>
            <div class="form__error">
              @error('gender')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="例:test@example.com" id="email" value="{{ old('email', $data['email'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('email')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="tel" name="tel" placeholder="08012345678" id="tel" value="{{ old('tel', $data['tel'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('tel')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" id="address" value="{{ old('address', $data['address'] ?? '') }}" />
            </div>
            <div class="form__error">
              @error('address')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" id="building" value="{{ old('building', $data['building'] ?? '') }}" />
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title1">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="select_wrapper">
              <select type="select" name="content_type" placeholder="選択してください" class=select>
                <option value="" default>選択してください</option>
                <option value="商品のお届けについて" {{ old('content_type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ old('content_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ old('content_type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ old('gender') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ old('content_type') == 'その他' ? 'selected' : '' }}>その他</option>
              </select>
            </div>
            <div class="form__error">
              @error('content_type')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="content" placeholder="お問い合わせ内容をご記載ください" id="content" value="{{ old('content', $data['content'] ?? '') }}"></textarea>
            </div>
            <div class="form__error">
              @error('content')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit" >確認画面</button>
        </div>
      </form>
    </div>
  </main>
  
</body>

</html>