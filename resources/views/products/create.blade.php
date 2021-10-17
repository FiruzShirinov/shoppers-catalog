@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('title', 'Добавить товар')

@section('content')

<div class="row">
    <div class="col-6 mx-auto mt-5">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-adminlte-input name="name" label="Наименование" placeholder="Наименование" label-class="text-secondary" value="{{ old('name') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-muted"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="SKU" label="SKU" placeholder="AB-123456789CD" type="text" label-class="text-secondary" value="{{ old('SKU') }}"/>

            <x-adminlte-input name="price" label="Цена" placeholder="12.34" type="text" label-class="text-secondary"  value="{{ old('price') }}">
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
