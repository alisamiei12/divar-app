<div class="menu">
  <div class="col-md-10 mx-auto">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="{{ route('d.category.index') }}">پنل ادمین</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="/">سایت اصلی</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('d.category.index') }}">خانه</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('d.category.index') }}">دسته بندی</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('d.user.index') }}">کاربر</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="navbarPost" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              آگهی
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarPost">
              <a class="dropdown-item" href="{{ route('d.post.index') }}">همش</a>
              <a class="dropdown-item" href="{{ route('d.post.filter', ['status' => 'releaseQueue']) }}">در صف انتشار</a>
              <a class="dropdown-item" href="{{ route('d.post.filter', ['status' => 'published']) }}">منتشر شده</a>
              <a class="dropdown-item" href="{{ route('d.post.filter', ['status' => 'unpublished']) }}">منتشر نشده</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto">
          <li>
            <button class="btn btn-primary btn-sm ml-3">{{jdate()->format('%d %B،%M : %H')}}</button>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">خروج</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>