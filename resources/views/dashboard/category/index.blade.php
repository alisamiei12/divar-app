@extends('dashboard.main')

@section('content')
<div class="col-md-8 mx-auto mt-5">
  <div class="card shadow">
    <div class="card-header">
      <h5 class="d-inline">لیست دسته</h5>
      <a href="{{ route('d.category.create') }}" class="btn btn-primary float-left">افزودن دسته</a>
    </div> 
    
    <div class="card-body text-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">نام انگلیسی</th>
            <th>تاریخ ثبت</th>
            <th scope="col">آگهی</th>
            <th scope="col">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category) 
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ jdate($category->created_at)->format('%d %B،%M : %H') }}</td>
            <td>
              <a class="btn btn-primary btn-sm" href="{{ route('d.post.category', ['slug'=>$category->slug]) }}">لیست آگهی</a>
            </td>
            <td>
              <a class="btn btn-warning btn-sm text-white mb-1" href="{{ route('d.category.edit', ['slug'=>$category->slug]) }}">ویرایش</a>
              <form action="{{ route('d.category.destroy') }}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit" value="{{ $category->slug }}" name="slug">حذف</button>
              </form>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection