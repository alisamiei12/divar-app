<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>دیوار</title>
  <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
</head>
<body>

  @include('website.inc.menu')

  <div class="body">
    <div class="container">
      <div class="body-div">