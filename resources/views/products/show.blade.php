@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('title', 'Товар-'.$product->name)

@section('content')

<div class="row">
    <div class="col-3 mx-auto my-5">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded" width="300" height="300">
    </div>
    <div class="col-6 m-auto mt-5">
        <label for="name">Наименование</label>
        <p id="name">{{ $product->name }}</p>
        <label for="SKU">SKU</label>
        <p id="SKU">{{ $product->SKU }}</p>
        <label for="price">Цена</label>
        <p id="price">${{ $product->price }}</p>
    </div>
</div>

@stop
