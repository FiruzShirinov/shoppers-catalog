@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('title', 'Покупатель-'.$shopper->name)

@section('content')

<div class="row">
    <div class="col-3 mx-auto my-5">
        <img src="{{ $shopper->image }}" alt="{{ $shopper->name }}" class="rounded" width="300" height="300">
    </div>
    <div class="col-6 m-auto mt-5">
        <label for="name">ФИО</label>
        <p id="name">{{ $shopper->name }}</p>
        <label for="phone">Телефон</label>
        <p id="phone">{{ $shopper->phone }}</p>
        <label for="email">Эл. почта</label>
        <p id="email">{{ $shopper->email }}</p>
    </div>
</div>

@stop
