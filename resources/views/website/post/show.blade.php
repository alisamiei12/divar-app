@extends('website.main2')

@section('content')
<div class="post-header">
  <span>اگهی مربوط به دسته</span> <a href="">ورزشی</a>
</div>
<div class="post-content">
  <div class="post-text">
    <p class="post-text-header">{{ $post->title }}</p>
    <p class="post-text-time">دقایقی پیش </p>
    <p class="post-text-item"><span>شماره تلفن</span><span>{{$post->user->number}}</span></p>
    <p class="post-text-item"><span>وضعیت</span><span>{{ $post->status_kala }}</span></p>
    <p class="post-text-item"><span>قیمت</span><span>{{ $post->price }} تومان</span></p>
    <p class="post-text-item"><span>تعداد بازدید</span><span>{{$post->view_count}}</span></p>
    <p class="post-text-des">توضیحات</p>
    <p class="post-text-des-text">{{ $post->description }}</p>
  </div>
  <div class="post-img">
    <img src="{{ asset('website/upload') }}/{{ $post->img }}">
  </div>
</div>
@endsection