@extends('dashboard.main')

@section('content')
<div class="col-md-9 mx-auto mt-5">
  <!-- Button trigger modal -->


  <div class="card shadow">
    <div class="card-header">
      <h5 class="d-inline">لیست کاربر</h5>
      <a href="#" class="btn btn-primary float-left">{{$count}}</a>
      
    </div> 
    <div class="card-body text-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">شماره تلفن</th>
            <th scope="col">وضعیت</th>
            <th scope="col">تاریخ ثبت نام</th>
            <th scope="col">تاریخ اخرین ورود</th>
            <th scope="col">آگهی</th>
            <th scope="col">بررسی</th>
            <th scope="col">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user) 
          <tr>
            <td scope="row">{{ $user->id }}</td>
            <td scope="row">{{ $user->name }}</td>
            <td scope="row">{{ $user->number }}</td>
            <td scope="row">
              @if ($user->active == 1)
                <p>فعال</p>
              @else
              <p>غیرفعال</p>    
              @endif
            </td>
            <td scope="row">{{ jdate($user->created_at)->format('%d %B،%M : %H') }}</td>
            <td scope="row">{{ jdate($user->updated_at)->format('%d %B،%M : %H') }}</td>
            <td>
              <a class="btn btn-primary btn-sm" href="{{ route('d.post.user', ['slug'=>$user->slug]) }}">لیست آگهی</a>
            </td>
            <td scope="row">
              @if ($user->active == 1)
              <a class="btn btn-danger btn-sm" href="{{ route('d.user.edit', ['slug' => $user->slug,'status' => 0]) }}">غیرفعال بشه</a>
              @else
              <a class="btn btn-success btn-sm" href="{{ route('d.user.edit', ['slug' => $user->slug,'status' => 1]) }}">فعال بشه</a>
              @endif
            </td>
            <td>
              <form action="{{ route('d.user.destroy') }}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit" value="{{ $user->slug }}" name="slug">حذف</button>
              </form>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
      {{ $users->links() }}
    </div>
  </div>
</div>

@endsection

