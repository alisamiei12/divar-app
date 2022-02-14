@extends('website.main2')

@section('content')
<div class="create">
  <div class="create-header">افزودن یا تغییر عکس</div>
  <div class="create-form">
    <form action="{{ route('post.update.img') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="slug" value="{{ $post->slug }}">
      <div class="form-div">
        <label>عکس(اختیاری)</label>
        <input type="file"  id="fileImg" name="img">
        @error('img')<span>{{ $message }}</span>@enderror
        <span id="spane"></span>
      </div>
      <div class="form-div">
        <button type="submit" id="btnSubmit">ارسال عکس</button>
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