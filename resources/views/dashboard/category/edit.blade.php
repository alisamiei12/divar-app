@extends('dashboard.main')

@section('content')
<div class="col-md-7 mx-auto mt-5">
  <div class="card shadow">
    <h5 class="card-header">ویرایش دسته بندی</h5>
    <div class="card-body">
      <form method="POST" action="{{ route('d.category.update') }}">
        @csrf
        <input type="hidden" value="{{ $category->slug }}" name="slug_base" >
        <div class="form-group">
          <label for="exampleInputEmail1">عنوان</label>
          <input type="text" name="title" class="form-control" value="{{ $category->title }}">
          @error('title')
            <small class="form-text text-red">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">عنوان انگلیسی</label>
          <input type="text" name="slug" class="form-control text-left" value="{{ $category->slug }}" placeholder="car">
          @error('slug')
            <small class="form-text text-red">{{ $message }}</small>
          @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">ویرایش</button>
      </form>
    </div>
  </div>
</div>
@endsection