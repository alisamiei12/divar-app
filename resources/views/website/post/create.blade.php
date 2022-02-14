@extends('website.main2')

@section('content')
<div class="create">
  <div class="create-header">فرم ثبت آگهی</div>
  <div class="create-form">
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-div">
        <label>انتخاب دسته</label>
        <select name="category">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-div">
        <label>عنوان</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')<span>{{ $message }}</span>@enderror
      </div>
      <div class="form-div">
        <label>وضعیت کالا</label>
        <select name="status_kala">
          <option value="1">نو</option>
          <option value="0">کهنه</option>
        </select>
      </div>
      <div class="form-div">
        <label>قیمت(به تومان)</label>
        <input type="number" name="price" value="{{ old('price') }}" class="text-left">
        @error('price')<span>{{ $message }}</span>@enderror
      </div>
      <div class="form-div">
        <label>عکس(اختیاری)</label>
        <input type="file"  id="fileImg" name="img">
        @error('img')<span>{{ $message }}</span>@enderror
        <span id="spane"></span>
      </div>
      <div class="form-div">
        <label>توضیحات(اختیاری)</label>
        <textarea name="description" id="" cols="30" rows="7" value="{{ old('description') }}"></textarea>
        @error('description')<span>{{ $message }}</span>@enderror
        
      </div>
      <div class="form-div">
        <button type="submit" id="btnSubmit">ثبت آگهی</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
  maxImgSize = 1 * 1024 * 1024;
  
  $("#fileImg").change(function(){
    fileSize = this.files[0].size;
    fileType = this.files[0].type;

    if(fileType.split('/')[0] !== 'image'){
      $("#spane").text("عکس وارد کنید");
      $('#btnSubmit').attr("disabled", true);
    }else{
      if(fileSize > maxImgSize){
        $("#spane").text("سایز عکس حداکثر 1 مگ");
        $('#btnSubmit').attr("disabled", true);
      }else{
        $("#spane").text("");
        $('#btnSubmit').attr("disabled", false);
      }
    }
  });
});

</script>
@endsection