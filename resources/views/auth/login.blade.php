<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود</title>
  <link rel="stylesheet" href="{{ asset('website/css/log.css') }}">
</head>
<body>

  <div class="form-container">
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <h3>صفحه ورود</h3>

      <div class="form-item">
        <label for="">شماره موبایل</label>
        <input type="number" name="number" value="{{ old('number') }}">
        @error('number')<span class="error-msg">{{ $message }}</span>@enderror
      </div>

      <div class="form-item">
        <label for="">رمز</label>
        <input type="text" name="password">
        @error('password')<span class="error-msg">{{ $message }}</span>@enderror
      </div>

      <div class="form-item">
        <input type="submit" name="submit" value="ورود" class="form-btn">
        <p><a href="{{ route('register.form') }}">صفحه ثبت نام</a></p>
      </div>

    </form>
  </div>
  
</body>
</html>