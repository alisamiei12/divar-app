@extends('dashboard.main')

@section('content')
<div class="col-md-7 mx-auto mt-5">
  <div class="card shadow">
    <h5 class="card-header">درج دسته جدید</h5>
    <div class="card-body">
      <form method="POST" action="{{ route('d.category.store') }}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">عنوان</label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="ماشین">
          @error('title')
            <small class="form-text text-red">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">عنوان انگلیسی</label>
          <input type="text" name="slug" class="form-control text-left" value="{{ old('slug') }}" placeholder="car">
          @error('slug')
            <small class="form-text text-red">{{ $message }}</small>
          @enderror
        </div>
        <br>
        <button type="submit" class="btn btn-primary">ثبت</button>
      </form>
    </div>
  </div>
</div>
@endsection