@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('title', 'Изменить товар')

@section('content')

<div class="row">
    <div class="col-3 m-auto">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded" width="300" height="300">
    </div>
    <div class="col-6 mx-auto mt-5">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-adminlte-input name="name" label="Наименование" placeholder="Наименование" label-class="text-secondary" value="{{ old('name') ? old('name') : $product->name }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-muted"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="SKU" label="SKU" placeholder="AB-123456789CD" type="text" label-class="text-secondary" value="{{ old('SKU') ? old('SKU') : $product->SKU }}"/>

            <x-adminlte-input name="price" label="Цена" placeholder="12.34" type="number" label-class="text-secondary"  value="{{ old('price') ? old('price') : $product->price }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-dollar-sign text-muted"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input-file name="image" label="Фотография" placeholder="Выберите файл..." label-class="text-secondary"/>

            <x-adminlte-button class="btn-block" type="submit" label="Сохранить" theme="success" icon="fas fa-lg fa-save"/>
        </form>
    </div>
</div>

@stop
