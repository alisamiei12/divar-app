@extends('website.main2')

@section('content')
<div class="create">
  <div class="create-header">فرم ویرایش آگهی</div>
  <div class="create-form">
    <form action="{{ route('post.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="slug" value="{{ $post->slug }}">
      <div class="form-div">
        <label>انتخاب دسته</label>
        <select name="category">
          @foreach ($categories as $category)
          <option @if($post->category_id ==  $category->id) selected @endif value="{{ $category->id }}">{{ $category->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-div">
        <label>عنوان</label>
        <input type="text" name="title" value="{{ $post->title }}">
        @error('title')<span>{{ $message }}</span>@enderror
      </div>
      <div class="form-div">
        <label>وضعیت کالا</label>
        <select name="status_kala">
          <option @if($post->status_kala == 1) selected @endif value="1">نو</option>
          <option @if($post->status_kala == 0) selected @endif value="0">کهنه</option>
        </select>
      </div>
      <div class="form-div">
        <label>قیمت(به تومان)</label>
        <input type="number" name="price" value="{{ $post->price }}" class="text-left">
        @error('price')<span>{{ $message }}</span>@enderror
      </div>
      <div class="form-div">
        <label>توضیحات(اختیاری)</label>
        <textarea name="description" id="" cols="30" rows="7">{{ $post->description }}</textarea>
        @error('description')<span>{{ $message }}</span>@enderror
        
      </div>
      <div class="form-div">
        <button type="submit" id="btnSubmit">ویرایش آگهی</button>
      </div>
    </form>
  </div>
</div>
@endsection

