<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт студенческих иницатив</title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    
</head>
<body>
@if(session()->has('success'))
    <div class="alert alert-success" role="alert" style="position: absolute; top: 120px; right: 30px; z-index: 100; max-width: 420px">
        <p>{{ session('success') }}</p>
    </div>
@endif
@if(session()->has('wrong'))
    <div class="alert alert-danger" role="alert" style="position: absolute; top: 120px; right: 30px; z-index: 100; max-width: 420px">
        <p>{{ session('wrong') }}</p>
    </div>
@endif