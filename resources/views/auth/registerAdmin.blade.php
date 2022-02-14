<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت نام</title>
  <link rel="stylesheet" href="{{ asset('website/css/log.css') }}">
</head>
<body>

  <div class="form-container">
    <form action="{{ route('register.admin') }}" method="POST">
      @csrf
      <h3>صفحه ثبت نام</h3>

      <div class="form-item">
        <label for="">نام</label>
        <input type="text" name="name" class="text-right" value="{{ old('name') }}">
        @error('name')<span class="error-msg">{{ $message }}</span>@enderror
        <span class="error-msg"></span>
      </div>

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
        <input type="submit" name="submit" value="ثبت نام" class="form-btn">
        <p><a href="{{ route('login.form') }}">صفحه ورود</a></p>
      </div>

    </form>
  </div>
  
</body>
</html>