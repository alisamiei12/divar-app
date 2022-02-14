<div class="header">
  <div class="container mx-auto">
    <div class="header-div">
      <ul class="ul-right">
        <li><a href="{{ route('post.index') }}">دیوار</a></li>
        <li class="li-margin-right"><a href="{{ route('post.index') }}">خانه</a></li>
        @auth
        @if(auth()->user()->role == 5)
        <li class="li-margin-right"><a href="{{ route('d.post.filter', ['status' => 'releaseQueue']) }}">بخش مدیریت</a></li>
        @endif
        @endauth
        <li class="li-margin-right"><a href="{{ route('post.create') }}" class="btn-add">ثبت آگهی</a></li>
      </ul>
      <ul class="ul-left">
        <li><a href="/">{{jdate()->format('%d %B،%M : %H')}}</a></li>
        @auth
        <li><a href="{{ route('post.mypost') }}">دیوار من</a></li>
        <li class="li-margin-right">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red">خروج</button>
          </form>
        </li>
        @endauth
        
        @guest
        <li><a href="{{ route('login.form') }}">ورود</a></li>
        <li><a href="{{ route('register.form') }}">ثبت نام</a></li>
        @endguest
        
      </ul>
    </div>
  </div>
</div>