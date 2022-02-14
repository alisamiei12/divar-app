@extends('dashboard.main')

@section('content')
<div class="col-md-9 mx-auto mt-5">
  <!-- Button trigger modal -->


  <div class="card shadow">
    <div class="card-header">
      <h5 class="d-inline">لیست آگهی</h5>
      <a href="#" class="btn btn-primary float-left">{{$count}}</a>
      
    </div> 
    <div class="card-body text-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان</th>
            <th scope="col">دسته</th>
            <th scope="col">کاربر</th>
            <th scope="col">تاریخ ثبت</th>
            <th scope="col">وضعیت</th>
            <th scope="col">بررسی</th>
            <th scope="col">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post) 
          <tr>
            <td scope="row">{{ $post->id }}</td>
            <td scope="row">{{ $post->title }}</td>
            <td scope="row">{{ $post->category->title }}</td>
            <td scope="row">{{ $post->user->name }}</td>
            <td>{{ jdate($post->created_at)->format('%d %B،%M : %H') }}</td>
            <td scope="row">
              @if ($post->status == 1)
                <p>در صف انتشار</p>
              @elseif($post->status == 2)
                <p>منتشر شده</p>
              @else
              <p>منتشر نشده</p>
                  
              @endif
            </td>
            <td scope="row"><a class="btn btn-primary btn-sm" href="{{ route('d.post.manage', ['slug' => $post->slug]) }}">دیدن</a></td>
            <td>
              <form action="{{ route('d.post.destroy') }}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit" value="{{ $post->slug }}" name="slug">حذف</button>
              </form>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
      {{ $posts->links() }}
    </div>
  </div>
</div>

@endsection

