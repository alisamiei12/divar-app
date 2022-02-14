@extends('website.main2')

@section('content')
<div class="post-header manage">
  <div class="post-enteshar">
    @if($post->status == 1) 
    <p class="text-orange">در صف انتشار</p>
    @elseif($post->status == 2)
    <p class="text-green-2">منتشر شد</p>
    @else
    <p class="text-red">آگهی شما منتشر نشد</p>
    @endif
  </div>
  <div class="post-action">
    <a href="{{ route('post.destroy', ['slug' => $post->slug]) }}" class="btn-delete">حذف</a>
    <a href="{{ route('post.edit', ['slug' => $post->slug]) }}" class="btn-edit">ویرایش</a>
    <a href="{{ route('post.edit.img', ['slug' => $post->slug]) }}" class="btn-img">افزودن یا تغییر عکس</a>
  </div>
</div>
<div class="post-content">
  <div class="post-text">
    <p class="post-text-header">{{ $post->title }}</p>
    <p class="post-text-time">{{ jdate($post->created_at)->format('%d %B،%M : %H') }}</p>
    <p class="post-text-item"><span>شماره تلفن</span><span>{{$post->user->number}}</span></p>
    <p class="post-text-item"><span>وضعیت</span><span>@if($post->status_kala==1) نو @else کهنه @endif</span></p>
    <p class="post-text-item"><span>قیمت</span><span>{{$post->price}} تومان</span></p>
    <p class="post-text-item"><span>تعداد بازدید</span><span>{{$post->view_count}}</span></p>
    <p class="post-text-des">توضیحات</p>
    <p class="post-text-des-text">{{ $post->description }}</p>
  </div>
  <div class="post-img">
    <img src="{{ asset('website/upload') }}/{{ $post->img }}">
  </div>
</div>
@endsection