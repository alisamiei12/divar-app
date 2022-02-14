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
    @if($post->status == 1) 
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 2]) }}" class="back-green">منتشر بشه</a>
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 0]) }}" class="back-red">منتشر نشه</a>
    @elseif($post->status == 2)
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 0]) }}" class="back-red">منتشر نشه</a>
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 1]) }}" class="back-orange">بره صف انتشار</a>
    @else
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 2]) }}" class="back-green">منتشر بشه</a>
    <a href="{{ route('d.post.edit', ['slug' => $post->slug,'status' => 1]) }}" class="back-orange">بره صف انتشار</a>
    @endif
  </div>
</div>
<div class="post-content">
  <div class="post-text">
    <p class="post-text-header">{{ $post->title }}</p>
    <p class="post-text-time">{{ jdate($post->created_at)->format('%d %B،%M : %H') }}</p>
    <p class="post-text-item"><span>شماره تلفن</span><span>{{$post->user->number}}</span></p>
    <p class="post-text-item"><span>وضعیت</span><span>@if($post->status_kala==1) نو @else کهنه @endif</span></p>
    <p class="post-text-item"><span>قیمت</span><span>{{ $post->price }}</span></p>
    <p class="post-text-item"><span>تعداد بازدید</span><span>{{ $post->view_count }}</span></p>
    <p class="post-text-des">توضیحات</p>
    <p class="post-text-des-text">{{ $post->description }}</p>
  </div>
  <div class="post-img">
    <img src="{{ asset('website/upload') }}/{{ $post->img }}">
  </div>
</div>
@endsection