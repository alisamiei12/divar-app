<div class="sidebar">
  <div class="side-menu">
    <p>دسته ها</p>
    @foreach ($categories as $category) 
    <a href="{{ route('post.category', ['slug' => $category->slug]) }}">{{ $category->title }}</a>
    @endforeach
  </div>
</div>